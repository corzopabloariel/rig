<?php

use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('emails')->delete();
        
        \DB::table('emails')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'email' => 'corzo.pabloariel@gmail.com',
                'created_at' => '2020-08-24 03:22:12',
                'updated_at' => '2020-08-24 03:22:12',
            ),
        ));
        
        
    }
}