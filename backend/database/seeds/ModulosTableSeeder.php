<?php
use App\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = new ConsoleOutput();
        $output->writeln('Insertando modulos en tabla modulos' );
		
        Modulo::updateOrInsert(['id'=>1], [
			'nombre' => 'Solicitud de compra',
            'descripcion' => 'gestion de compras requerimientos',
			'icon' => 'fa fa-shopping-cart',
			'img' => '',
			'url' => 'solicitud',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Modulo::updateOrInsert(['id'=>2], [
			'nombre' => 'Ordenes de Compra',
            'descripcion' => 'gestion de ordenes de compra',
			'icon' => 'fa fa-shopping-cart',
			'img' => '',
			'url' => 'ordenes',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Modulo::updateOrInsert(['id'=>3], [
			'nombre' => 'Cotizaciones',
            'descripcion' => 'gestion de cotizaciones ',
			'icon' => 'fa fa-shopping-cart',
			'img' => '',
			'url' => 'cotizaciones',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Modulo::updateOrInsert(['id'=>4], [
			'nombre' => 'inventario',
            'descripcion' => 'gestion de inventarios compras requerimientos',
			'icon' => 'fa fa-shopping-cart',
			'img' => '',
			'url' => 'inventario',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Modulo::updateOrInsert(['id'=>5], [
			'nombre' => 'Comparativos',
            'descripcion' => 'gestion de comparativos requerimientos',
			'icon' => 'fa fa-shopping-cart',
			'img' => '',
			'url' => 'comparativos',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Modulo::updateOrInsert(['id'=>6], [
			'nombre' => 'Pos',
            'descripcion' => 'Sistema para gestión de ventas',
			'icon' => 'fa fa-shopping-cart',
			'img' => '',
			'url' => 'pos',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
