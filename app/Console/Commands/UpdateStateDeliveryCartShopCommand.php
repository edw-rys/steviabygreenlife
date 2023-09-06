<?php

namespace App\Console\Commands;

use App\Models\CartShop;
use App\Models\Location\State;
use App\Service\ConstantsService;
use Illuminate\Console\Command;

class UpdateStateDeliveryCartShopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-delivery-cost';

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
        $list = State::where('id', '!=', 9)
            ->get();
        foreach ($list as $key => $state) {
            $state->delivery_cost = 5;
            $state->save();
        }
        return 0;
    }
}
