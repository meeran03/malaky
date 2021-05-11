<?php

use App\Models\Apptable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();
        
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        
        $roles = ['admin','writer'];
        foreach ($roles as $role)
        {
            Role::create(['name' => $role]);
        }

        $perms = Apptable::select('id','title_en')->whereIsActive(1)->get();
        foreach ($perms as $perm)
        {
            Permission::create(['name' => $perm->title_en . ' create']);
            Permission::create(['name' => $perm->title_en . ' read']);
            Permission::create(['name' => $perm->title_en . ' update']);
            Permission::create(['name' => $perm->title_en . ' delete']);
        }
    }
}
