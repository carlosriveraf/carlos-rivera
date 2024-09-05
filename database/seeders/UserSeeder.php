<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'Admin',
            'email' => 'admin@delfosti.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'codigo_trabajador' => '999',
            'telefono' => '999999999',
            'puesto' => 'Puesto A',
            'role_id' => Role::inRandomOrder()->first()->role_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory()->count(20)->create();
    }
}
