<?php

use Illuminate\Database\Seeder;

use App\Vuser;
class VusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vusers = factory(Vuser::class)->times(60)->make();
        Vuser::insert($vusers->toArray());
    }
}
