<?php

use Illuminate\Database\Seeder;

class RigTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rig')->delete();
        
        \DB::table('rig')->insert(array (
            0 => 
            array (
                'id' => 1,
                'images' => '{"logo":{"i":"images\\/empresa\\/logos\\/1598536022_logo_0.png","e":"png","n":"1598536022_logo_0","d":{"0":800,"1":210,"2":3,"3":"width=\\"800\\" height=\\"210\\"","bits":8,"mime":"image\\/png"}},"favicon":null}',
                'texts' => NULL,
                'captcha' => '{"public":"6Ldiu8QZAAAAAL5zbReIR0wzsm6ULZrU5wHXasIh","private":"6Ldiu8QZAAAAAGq63_dk046FJ8O6c7Q8acM9xNga"}',
                'created_at' => '2020-08-27 13:29:41',
                'updated_at' => '2020-08-28 23:40:34',
            ),
        ));
        
        
    }
}