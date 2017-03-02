<?php

use Illuminate\Database\Seeder;

use App\Conference;
class ConfrerensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conferences = factory(Conference::class)->times(10)->make();
        Conference::insert($conferences->toArray());
    }
}
