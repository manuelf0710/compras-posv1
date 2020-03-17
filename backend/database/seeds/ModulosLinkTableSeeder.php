<?php
use App\ModuloLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ModulosLinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModuloLink::updateOrInsert(['id'=>1], [
			'modulo' => 6,
			'page'	 => 'Categorias',
			'url'	 => 'categorias',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);        
        ModuloLink::updateOrInsert(['id'=>2], [
			'modulo' => 6,
			'page'	 => 'Productos',
			'url'	 => 'productos',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);	       
		ModuloLink::updateOrInsert(['id'=>3], [
			'modulo' => 6,
			'page'	 => 'Clientes',
			'url'	 => 'clientes',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
		ModuloLink::updateOrInsert(['id'=>4], [
			'modulo' => 6,
			'page'	 => 'Ventas',
			'url'	 => 'ventas',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);		
		ModuloLink::updateOrInsert(['id'=>5], [
			'modulo' => 6,
			'page'	 => 'Administrar Ventas',
			'url'	 => 'admventa',
			'padre'	 => 4,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);	
		ModuloLink::updateOrInsert(['id'=>6], [
			'modulo' => 6,
			'page'	 => 'Crear Venta',
			'url'	 => 'crearventa',
			'padre'	 => 4,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
		ModuloLink::updateOrInsert(['id'=>7], [
			'modulo' => 6,
			'page'	 => 'Reporte Venta',
			'url'	 => 'repventa',
			'padre'	 => 4,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);		
    }
}