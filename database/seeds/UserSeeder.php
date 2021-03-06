<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        // Roles
        $adminRole = Role::create(['name'  => 'admin']);

        // Permisos
        $permisoShowArticles = Permission::create(['name' => 'show articles']);
        $permisoStoreArticles = Permission::create(['name' => 'store articles']);
        $permisoEditArticles = Permission::create(['name' => 'edit articles']);
        $permisoDestroyArticles = Permission::create(['name' => 'destroy articles']);

        $admin = new User();
        $admin->name = 'JoseM';
        $admin->email = 'Josemprog@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = bcrypt('erosennin620');
        $admin->main_admin = true;
        $admin->admin = true;
        $admin->remember_token = Str::random(10);
        $admin->save();
        
        // Asignando roles
        $admin->assignRole($adminRole);
        
        // Asignando Permisos
        $adminRole->givePermissionTo($permisoShowArticles);
        $adminRole->givePermissionTo($permisoStoreArticles);
        $adminRole->givePermissionTo($permisoEditArticles);
        $adminRole->givePermissionTo($permisoDestroyArticles);

        factory(App\User::class, 100)->create();
    }
}
