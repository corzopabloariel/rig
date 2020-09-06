<?php

use Illuminate\Database\Seeder;

class EmailUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_user')->delete();
        
        \DB::table('email_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email_id' => 1,
                'user_id' => 1,
            ),
        ));
    }
}