<?php

use App\Models\StatusDelivery;
use Illuminate\Database\Seeder;

class StatusDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusDelivery::create([
            'code'  => 'pending',
            'title' => 'Pendiente',
            'color' => '#EEE200'
        ]);

        StatusDelivery::create([
            'code'  => 'sent',
            'title' => 'Enviado',
            'color' => '#00EECE'
        ]);

        StatusDelivery::create([
            'code'  => 'delivered_courier',
            'title' => 'Entregado al currier',
            'color' => '#00EE52'
        ]);

        StatusDelivery::create([
            'code'  => 'delivered',
            'title' => 'Entregado',
            'color' => '#0098EE'
        ]);
    }
}
