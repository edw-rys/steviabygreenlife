<?php

namespace App\Console\Commands;

use App\Models\CartShop;
use App\Models\Location\City;
use App\Service\CartProductService;
use Illuminate\Console\Command;

class RestoreTotalCartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restore-total-command';

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
    public function handle(CartProductService $cartProductService)
    {
        $carts = CartShop::with(['products', 'products.product', 'billing', 'billing.city'])->get();
        foreach ($carts as $key => $cart) {
            $cartProductService->restoreCart($cart);
            if($cart->billing == null){
                continue;
            }
            if($cart->billing->city == null){
                continue;
            }
            $cart->delivery_cost = $cart->billing->city->delivery_cost;
            $cart->total_more_delivery = $cart->delivery_cost + $cart->total;
            $cart->save();

        }
        return 0;
    }
}
