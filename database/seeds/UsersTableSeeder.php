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
                'email' => 'corzo.pabloariel@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$CwqQ9FYAExqbpoOxsmFI8eLEPUo5Cgc/JQSh1WlSzCeRjuuJ2ajge',
                'profile' => 'root',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-08-22 20:47:19',
                'updated_at' => '2020-08-22 20:47:19',
            ),
        ));
        
        
    }
}