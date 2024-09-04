<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['codigo' => '01', 'descripcion' => 'Encargado',]);
        DB::table('roles')->insert(['codigo' => '02', 'descripcion' => 'Vendedor',]);
        DB::table('roles')->insert(['codigo' => '03', 'descripcion' => 'Delivery',]);
        DB::table('roles')->insert(['codigo' => '04', 'descripcion' => 'Repartidor',]);
    }
}
