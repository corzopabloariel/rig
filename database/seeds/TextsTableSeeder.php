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
            1 => 
            array (
                'id' => 2,
                'code' => 'TXT.STA.1',
                'data' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae nunc sed velit dignissim sodales ut eu. Arcu non sodales neque sodales ut etiam. Mi eget mauris pharetra et ultrices. Aliquam vestibulum morbi blandit cursus risus at ultrices mi tempus. Ac auctor augue mauris augue neque gravida. In ante metus dictum at tempor commodo. Habitant morbi tristique senectus et netus et malesuada. Purus ut faucibus pulvinar elementum integer enim neque volutpat. Senectus et netus et malesuada fames ac. Ut venenatis tellus in metus vulputate. In mollis nunc sed id semper risus in hendrerit gravida. Faucibus a pellentesque sit amet porttitor eget dolor morbi. Placerat in egestas erat imperdiet sed euismod nisi porta.</p>

<p>Tristique et egestas quis ipsum suspendisse ultrices gravida. Hac habitasse platea dictumst quisque sagittis purus. Viverra orci sagittis eu volutpat. Egestas egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Nunc id cursus metus aliquam eleifend mi in nulla. Nisi vitae suscipit tellus mauris. Quis commodo odio aenean sed adipiscing diam. Natoque penatibus et magnis dis. Habitant morbi tristique senectus et netus. Cras pulvinar mattis nunc sed blandit. Diam sollicitudin tempor id eu nisl nunc mi ipsum. Habitant morbi tristique senectus et netus et malesuada. Congue eu consequat ac felis donec et odio. Volutpat commodo sed egestas egestas fringilla phasellus faucibus. Orci ac auctor augue mauris. Morbi tristique senectus et netus et malesuada fames ac. Tellus molestie nunc non blandit massa. Orci sagittis eu volutpat odio facilisis mauris sit. Aliquet nibh praesent tristique magna sit. Id faucibus nisl tincidunt eget.</p>

<p>Scelerisque felis imperdiet proin fermentum leo vel orci porta non. Odio ut enim blandit volutpat. Vestibulum lorem sed risus ultricies. In hac habitasse platea dictumst quisque sagittis purus sit amet. Ac orci phasellus egestas tellus rutrum tellus pellentesque. Interdum velit laoreet id donec. Sollicitudin nibh sit amet commodo. Urna neque viverra justo nec ultrices dui. Tristique nulla aliquet enim tortor at. At in tellus integer feugiat scelerisque varius morbi enim. Consequat id porta nibh venenatis. Elementum nibh tellus molestie nunc non blandit massa. Mauris rhoncus aenean vel elit scelerisque mauris. Felis eget nunc lobortis mattis aliquam faucibus purus in. Aenean euismod elementum nisi quis eleifend quam adipiscing vitae. Ligula ullamcorper malesuada proin libero nunc. Pulvinar neque laoreet suspendisse interdum consectetur. Vestibulum sed arcu non odio euismod lacinia at.</p>

<p>Ultricies mi eget mauris pharetra et ultrices neque. Nec ultrices dui sapien eget mi proin sed libero. Diam maecenas ultricies mi eget mauris pharetra et ultrices neque. Turpis massa sed elementum tempus egestas sed sed risus pretium. Vitae semper quis lectus nulla at. Dolor magna eget est lorem. Sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis. Velit dignissim sodales ut eu. Faucibus purus in massa tempor nec feugiat nisl pretium. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque sit. Dis parturient montes nascetur ridiculus mus mauris vitae ultricies. Et pharetra pharetra massa massa ultricies mi quis hendrerit dolor. Risus in hendrerit gravida rutrum quisque non tellus orci ac. Nunc scelerisque viverra mauris in aliquam sem fringilla ut morbi. Ullamcorper velit sed ullamcorper morbi. Tempus urna et pharetra pharetra.</p>

<p>Nam libero justo laoreet sit amet cursus sit amet. Proin fermentum leo vel orci porta non pulvinar neque. Ullamcorper morbi tincidunt ornare massa. Amet cursus sit amet dictum sit amet justo donec enim. Tempus egestas sed sed risus pretium quam vulputate. Donec pretium vulputate sapien nec sagittis aliquam. Vitae auctor eu augue ut lectus arcu bibendum. Massa tincidunt nunc pulvinar sapien et ligula. Eget arcu dictum varius duis at consectetur lorem. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Amet est placerat in egestas erat imperdiet sed. Laoreet non curabitur gravida arcu ac. Gravida dictum fusce ut placerat orci nulla. Risus ultricies tristique nulla aliquet enim tortor at auctor. Mi tempus imperdiet nulla malesuada pellentesque elit eget.</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 15:38:48',
                'updated_at' => '2020-08-24 15:38:48',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'TXT.1.LOG',
                'data' => '<p>Este texto se pondrá como respuesta al colocar un email en&nbsp;<a href="http://3.19.243.243/" target="_blank">http://3.19.243.243/</a>. Si encuentra el mismo en el <strong>TXT</strong>, se mandará los correos.</p>

<p>En breve recibirá el correo con la información.</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-08-30 03:58:26',
                'updated_at' => '2020-08-30 05:01:24',
            ),
            3 => 
            array (
                'id' => 6,
                'code' => 'EMAIL.HASH',
                'data' => '<p>Sr. Cliente,</p>

<p>&nbsp;</p>

<p>Este mail recibe por ....</p>

<p>El sistema buscar la siguiente palabra para poner el link del hash: __EMAIL.HASH__, No lo borre, iempre debe estar presente</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-08-30 05:54:41',
                'updated_at' => '2020-08-30 05:54:41',
            ),
            4 => 
            array (
                'id' => 7,
                'code' => 'EMAIL.STAT',
                'data' => '<p>Mensaje al cliente</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-09-06 05:07:11',
                'updated_at' => '2020-09-06 05:07:11',
            ),
            5 => 
            array (
                'id' => 8,
                'code' => 'USER.ACT',
                'data' => '<p>Activo</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-09-06 05:07:48',
                'updated_at' => '2020-09-06 05:07:48',
            ),
            6 => 
            array (
                'id' => 9,
                'code' => 'TXT.PASS',
                'data' => '<h3 style="text-align:center">Texto editable</h3>

<p style="text-align:center">Texto editable</p>',
                'deleted_at' => NULL,
                'created_at' => '2020-09-06 05:08:58',
                'updated_at' => '2020-09-06 05:08:58',
            ),
        ));
        
        
    }
}