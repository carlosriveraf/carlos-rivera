<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert(['codigo' => '01', 'descripcion' => 'Por atender',]);
        DB::table('status')->insert(['codigo' => '02', 'descripcion' => 'En proceso',]);
        DB::table('status')->insert(['codigo' => '03', 'descripcion' => 'En delivery',]);
        DB::table('status')->insert(['codigo' => '04', 'descripcion' => 'Recibido',]);
    }
}
