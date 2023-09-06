<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ProductRestoreValuesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productval:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        return;
        $products = Product::all();
        foreach ($products as $key => $product) {
            // Save original price
            $product->original_price = $product->price_unit;
            $auxValDis = $product->price_unit - $product->price ;
            $product->percentage_tax = 12;
            // Calc real value
            $subtotal = $product->price_unit * 100/112;
            $subtotal = round($subtotal, 2);
            // Tiene descuento
            if($auxValDis > 0){
                $product->discount_percentage = ($product->price_unit - $product->price  ) /($product->price_unit )* 100 ;
                $product->discount_percentage = round($product->discount_percentage, 2);
            }
            
            $product->price_unit = $subtotal;
            $product->discount_value = round(($product->discount_percentage/100 ) * $product->price_unit, 2);
            $product->total_tax = 0.12* ( $product->price_unit - (($product->discount_percentage/100) * $product->price_unit));
            $product->save();
        }
        return 0;
    }
}
