<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 获取权限分类列表方法方法
     * @param array $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    public function tree($list=[], $pk = 'id', $pid = 'parent_id',$child='_child', $root = 0) {
        $tree = [];
        if(empty($list)){
            $list = Permission::get()->toArray();
        }
        if(is_array($list)) {
            $refer = array();
            // ID作为键值的数组
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = & $list[$key];
            }
            foreach ($list as $key => $data) {
                $parentId = $data[$pid];
                if($parentId == $root) {
                    $tree[] = & $list[$key];
                }else{
                    if(isset($refer[$parentId])){
                        $parent = & $refer[$parentId];
                        $parent[$child][] = & $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     *  获取产品分类
     * @param int $pid
     * @param array $result
     * @param int $spac
     * @return array
     */
    public function getCateList($pid=0,&$result=array(),$spac=0){
        $rs = DB::table('category')
            ->where('parent_id','=',$pid)
            ->get()
            ->toArray();
        foreach($rs as  $row) {
            $row->name_cn = str_repeat(" ┗━━━━ ",$spac).$row->name_cn;
            $result[]=$row;
            $spac=$spac+1;
            $this->getCateList($row->id,$result,$spac);
            $spac = $spac - 1;
        }
        return $result;
    }
}
