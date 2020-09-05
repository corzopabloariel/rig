<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'password' => '$2y$10$L7tAGduCtkMl3MtN0Sm71OLdqsBu4J8nmR6Fj2AioKyCE7TnO/T1G',
                'profile' => 'root',
                'tipo' => NULL,
                'comitente' => NULL,
                'nombre' => 'Pablo Ariel Corzo',
                'domicilio' => NULL,
                'post' => NULL,
                'pais' => NULL,
                'telefono' => NULL,
                'cuit' => NULL,
                'docu' => NULL,
                'numero_doc' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 03:18:11',
                'updated_at' => '2020-08-28 23:26:55',
            ),
        ));
        
        
    }
}