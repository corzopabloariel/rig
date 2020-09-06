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
                'email' => 'pc@grupotodo.com.ar',
                'deleted_at' => NULL,
                'created_at' => '2020-08-28 23:26:55',
                'updated_at' => '2020-08-28 23:26:55',
            ),
        ));
        
        
    }
}