<?php

use Illuminate\Database\Seeder;

use App\Manager;
class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managers = factory(Manager::class)->times(10)->make();
        Manager::insert($managers->toArray());
    }
}
