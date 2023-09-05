<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::findOrCreate('admin','Administrador');
        $user = User::create([
            'name'          => 'Administrador', 
            'last_name'     => 'Administrador', 
            'email'         => 'administrador@stevia.com', 
            'password'      => bcrypt('administrador@stevia.com' ),
            'country_id'    => 1
        ]);
        $user->roles()->attach($roleAdmin);
    }
}
