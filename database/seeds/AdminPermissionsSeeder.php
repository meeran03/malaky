<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Schema;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use HasRoles;

    protected $guard_name = 'web';

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('model_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        
        $user = \App\User::findOrFail(1);
        $permissions = \Spatie\Permission\Models\Permission::pluck('name')->toArray();
        $user->syncPermissions($permissions);
    }
}
