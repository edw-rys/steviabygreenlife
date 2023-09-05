<?php

namespace App\Console\Commands;

use App\Models\CartShop;
use App\Service\ConstantsService;
use Illuminate\Console\Command;

class UpdateDataCartShopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-dates-cart';

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
        $list = CartShop::where('status', ConstantsService::$CART_STATUS_FINISHED)
            ->get();
        foreach ($list as $key => $cart) {
            $cart->bought_at = $cart->created_at;
            $cart->save();
        }
        return 0;
    }
}
