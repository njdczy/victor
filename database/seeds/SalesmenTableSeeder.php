<?php

use Illuminate\Database\Seeder;

use App\Salesman;
class SalesmenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salesmen = factory(Salesman::class)->times(10)->make();
        Salesman::insert($salesmen->toArray());
    }
}
