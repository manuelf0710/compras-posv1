<?php
use App\Perfil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PerfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::updateOrInsert(['id'=>1], [
			'nombre' => 'Administrador',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Perfil::updateOrInsert(['id'=>2], [
			'nombre' => 'Vendedor',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Perfil::updateOrInsert(['id'=>3], [
			'nombre' => 'Consulta',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);        
    }
}
