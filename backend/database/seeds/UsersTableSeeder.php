<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /*User::truncate();
        User::create([
            'email' => 'manuelf0710@gmail.com',
            'password' => Hash::make('manuelf'),
            'name' => 'Administrator Manuelf',
        ]);*/
        User::updateOrInsert(['id'=>1], [
			'email' => 'manuelf0710@gmail.com',
            'password' => Hash::make('manuelf'),
			'name' => 'Administrator Manuelf',
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);		
    }
}