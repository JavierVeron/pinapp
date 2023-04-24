<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert(['nombre' => 'Javier', 'apellido' => 'Verón', 'fecha_nacimiento' => '1981-05-21', 'fecha_muerte' => '2051-05-21', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('cliente')->insert(['nombre' => 'Lionel', 'apellido' => 'Messi', 'fecha_nacimiento' => '1987-06-24', 'fecha_muerte' => '2061-06-20', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('cliente')->insert(['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'fecha_nacimiento' => '1985-02-05', 'fecha_muerte' => '2055-02-19', 'created_at' => date("Y-m-d H:i:s")]);
    }
}
