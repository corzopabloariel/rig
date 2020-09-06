<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HelpsTableSeeder::class);
        $this->call(LabelsTableSeeder::class);
        $this->call(TextsTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
        $this->call(EmailsTableSeeder::class);
        $this->call(EmailUserTableSeeder::class);
        $this->call(ParametersTableSeeder::class);
        $this->call(RigTableSeeder::class);
    }
}
