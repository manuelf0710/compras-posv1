<?php
use App\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = new ConsoleOutput();
        $output->writeln('Insertando modulos en tabla productos' );
		
        Producto::updateOrInsert(['id'=>1], [
			'categoria_id' => 1,
			'codigo' => 101,
            'descripcion' => 'Aspiradora Industrial',
			'imagen' => 'uploads/productos/101/105.png',
			'stock' => 13,
			'precio_compra' => '1200000',
			'precio_venta' => '1950000',
			'ventas'     => 0,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Producto::updateOrInsert(['id'=>2], [
			'categoria_id' => 1,
			'codigo' => 102,
            'descripcion' => 'plato flotante para allanadora',
			'imagen' => 'uploads/productos/102/940.jpg',
			'stock' => 6,
			'precio_compra' => '2300000',
			'precio_venta'  => '3400000',
			'ventas'     => 0,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);		
    }
}
