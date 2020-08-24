<?php

use Illuminate\Database\Seeder;

class TextsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('texts')->delete();
        
        \DB::table('texts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'TXT.LOGIN',
                'data' => '<h3 style="text-align:center">Texto editable</h3>

<p style="text-align:center">Texto editable</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-08-23 23:12:32',
                'updated_at' => '2020-08-23 23:12:32',
            ),
        ));
        
        
    }
}