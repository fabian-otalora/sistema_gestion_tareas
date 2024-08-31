<?php

namespace Database\Seeders;

use DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('rol')->insert([
            'rol' => 'Administrador',
            'description' => 'Administrador de la plataforma',
        ]);
        DB::table('rol')->insert([
            'rol' => 'Usuario',
            'description' => 'Usuario que crea tareas en la plataforma',
        ]);
    }
}
