<?php
 
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
use App\User;
 use App\Proveedor;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
 
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
 
        Model::reguard();
    }
}
 
class UserTableSeeder extends Seeder
{
 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
 
        User::create([
            'cedula'=>'1053850295',
            'apellidos'=>'galvis',
            'fechaNacimiento'=>'1996-05-10',
            'direccion'=>'calle 3 #8-65',
            'telefono'=>'3113505082',
            'rol'=>'1',
            'estado'=>'1',
            'fechaIngreso'=>'2016-05-10',
            'email' => 'admin@admi.com',
            'name' => 'Cristian',
            'password' => bcrypt('123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('proveedor')->delete();
 
        Proveedor::create([
            'cedula'=>'155555555',
            'nombre'=>'Daniel',
            'apellido'=>'Galvis',
            'telefono'=>'311350582',
            'empresa'=>'Bavaria',
            'estado'=>'1',
            'nit'=>'111111111'
        ]);
 
    }
 
}