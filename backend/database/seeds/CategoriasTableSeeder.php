<?php

use App\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::updateOrInsert(['id'=>1], [
			'nombre' => 'Equipos electromecánicos',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
		
        Categoria::updateOrInsert(['id'=>2], [
			'nombre' => 'Taladros',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Categoria::updateOrInsert(['id'=>3], [
			'nombre' => 'Andamios',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Categoria::updateOrInsert(['id'=>4], [
			'nombre' => 'Generadores de energía',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);		
    }
}
