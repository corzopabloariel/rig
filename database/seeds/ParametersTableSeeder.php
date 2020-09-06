<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('parameters')->delete();
        
        \DB::table('parameters')->insert(array (
            0 => 
            array (
                'id' => 5,
                'type' => 'paginate',
                'value' => '15',
                'created_at' => '2020-08-27 13:20:41',
                'updated_at' => '2020-08-27 13:25:31',
            ),
        ));
        
        
    }
}