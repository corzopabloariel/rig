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
                'name' => 'Pablo Ariel',
                'lastname' => 'Corzo',
                'comitente' => NULL,
                'document_number' => NULL,
                'document_type' => NULL,
                'password' => '$2y$10$L7tAGduCtkMl3MtN0Sm71OLdqsBu4J8nmR6Fj2AioKyCE7TnO/T1G',
                'profile' => 'root',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 03:18:11',
                'updated_at' => '2020-08-28 23:26:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Juan',
                'lastname' => 'Topo',
                'comitente' => NULL,
                'document_number' => NULL,
                'document_type' => NULL,
                'password' => '$2y$10$hjM8kqv.54vNEfnjElUIounzPmMV2MbNJ6.uUWAInyhoh2ymsLSne',
                'profile' => 'adm',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 14:12:45',
                'updated_at' => '2020-08-24 14:12:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pepe',
                'lastname' => 'Argento',
                'comitente' => NULL,
                'document_number' => NULL,
                'document_type' => NULL,
                'password' => '$2y$10$TMyH0e17UMbl8K7H.vEYvue4pKiJ9mlKQWjguX4POhOlw/hhlRILC',
                'profile' => 'user',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 15:17:02',
                'updated_at' => '2020-08-24 15:17:02',
            ),
            3 => 
            array (
                'id' => 27,
                'name' => 'Pablo',
                'lastname' => 'Pedraza',
                'comitente' => 554813541,
                'document_number' => NULL,
                'document_type' => NULL,
                'password' => 'SIN PASS',
                'profile' => 'user',
                'remember_token' => 'Wru9cdQMFBXjJMCeopR1T1DW8QITE2MvdRR7LIQb2mzYi6PPFoFdTTRdazUx',
                'deleted_at' => NULL,
                'created_at' => '2020-08-31 13:36:14',
                'updated_at' => '2020-08-31 13:36:14',
            ),
        ));
        
        
    }
}