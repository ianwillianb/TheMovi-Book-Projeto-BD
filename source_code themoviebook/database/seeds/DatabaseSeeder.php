<?php

use Illuminate\Database\Seeder;
use XmlParser;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}
