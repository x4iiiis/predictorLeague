<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateSitePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devRole = Role::create(['name' => 'Developer']);
        $adminRole = Role::create(['name' => 'Admin']);
        
        Permission::create(['name' => 'Access Backend']);
        
        $devRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions([
            'Access Backend',
        ]);
    }
}