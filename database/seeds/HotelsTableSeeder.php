<?php

use Illuminate\Database\Seeder;

use App\Hotel;
class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managers = factory(Hotel::class)->times(10)->make();
        Hotel::insert($managers->toArray());
    }
}
