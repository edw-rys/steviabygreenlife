<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\StatusDelivery;
use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreationRoleAndStatusesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creation-role-statuses:command';

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
        return ;
        $roleClient = Role::findOrCreate('client','Cliente');
        $roleAdmin = Role::findOrCreate('admin','Administrador');

        User::all()->each(function($item) use( $roleClient){
            $item->roles()->attach($roleClient);
        });

        
        // admin
        $roleAdmin = Role::findOrCreate('admin','Administrador');
        $user = User::create([
            'name'          => 'Administrador', 
            'last_name'     => 'Administrador', 
            'email'         => 'administrador@stevia.com', 
            'password'      => bcrypt('administrador@stevia.com' ),
            'country_id'    => 1
        ]);
        $user->roles()->attach($roleAdmin);

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
        return 0;
    }
}
