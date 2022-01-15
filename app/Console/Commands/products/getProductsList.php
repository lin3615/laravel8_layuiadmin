<?php

namespace App\Console\Commands\products;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class getProductsList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:products_getProductsList';

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
        $products = DB::table('products')->take(10)->get();
        foreach ($products as $product) {
            echo $product->id . ':' . $product->title . "\n";
        }
    }
}
