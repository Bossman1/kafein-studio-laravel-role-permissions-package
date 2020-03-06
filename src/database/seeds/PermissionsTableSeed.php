<?php
namespace LaraPack\RolePermission\seed;
use Illuminate\Database\Seeder;

class PermissionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "admin-area"],
            ["name" => "overall-dashboard"],
            ["name" => "sales-tracking"],
            ["name" => "renter-tracking"],
            ["name" => "product-sales-tracking"],
            ["name" => "users"],
            ["name" => "bonus"],
            ["name" => "quality"],
            ["name" => "goals"],
            ["name" => "performance"],
        ];

        foreach ($data as $datum) {
            $permission = new \LaraPack\RolePermission\Models\Permission();
            $permission->name = $datum['name'];
            $permission->save();
        }

    }
}
