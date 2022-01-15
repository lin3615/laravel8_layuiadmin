<?php

namespace App\Console\Commands\products;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class getProductsList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string  后面两个参数
     */
    protected $signature = 'command:products_getProductsList  {num} {start}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取最新10个产品';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$num = $this->argument('num');
		$start = $this->argument('start');
        $products = DB::table('products')->take($num)->get();
        foreach ($products as $product) {
            echo $product->id . ':' . $product->title . "\n";
        }
    }
}
