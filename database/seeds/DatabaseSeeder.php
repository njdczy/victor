<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(VusersTableSeeder::class);
        $this->call(VcatsTableSeeder::class);
        $this->call(SalesmenTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
    }
}
