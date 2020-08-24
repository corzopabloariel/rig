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
                'name' => 'Pablo',
                'lastname' => 'Corzo',
                'comitente' => NULL,
                'document_number' => NULL,
                'document_type' => NULL,
                'password' => '$2y$10$L7tAGduCtkMl3MtN0Sm71OLdqsBu4J8nmR6Fj2AioKyCE7TnO/T1G',
                'profile' => 'root',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 03:18:11',
                'updated_at' => '2020-08-24 03:18:11',
            ),
        ));
        
        
    }
}