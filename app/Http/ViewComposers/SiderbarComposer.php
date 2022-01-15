<?php

namespace  App\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SiderbarComposer {
    public function compose(View $view) {
        // 返回的导航数组
        $sidebar = [];
        $topMenus = DB::table('permissions')->where(['parent_id'=>0])->select()->get()->toArray();
        if($topMenus) {
            $top_ids = [];
            foreach ($topMenus as $row) {
                array_push($top_ids,$row->id);
                $sidebar[$row->id] = $row;
            }
            $secMenus = DB::table('permissions')
                ->whereIn('parent_id', $top_ids)
                ->get();

            if($secMenus){
                foreach ($secMenus as $sec_row) {
                    $sidebar[$sec_row->parent_id]->children[] = $sec_row;
                }
            }
        }
        $view->with('sidebar',$sidebar);
    }
}
