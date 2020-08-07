<?php

use Illuminate\Database\Seeder;
use app\database\seeds\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // UsersTableSeeder.run();
         $this->call(UsersTableSeeder::class);
         $this->call(PostsTableSeeder::class);

    }
}
