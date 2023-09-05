<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleClient = Role::findOrCreate('client','Cliente');
        $roleAdmin = Role::findOrCreate('admin','Administrador');

        User::all()->each(function($item) use( $roleClient){
            $item->roles()->attach($roleClient);
        });
    }
}
