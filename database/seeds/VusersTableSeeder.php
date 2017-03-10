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
//        $vusers = factory(Vuser::class)->times(60)->make();
        $this->number = 1;
        $vusers = factory(Vuser::class)->times(60)->make()->each(function ($vuser) {
            $vuser->number = $this->number++;

        });
        Vuser::insert($vusers->toArray());
    }
}
