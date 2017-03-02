<?php

use Illuminate\Database\Seeder;

use App\SignLog;
class Sign_logsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sign_logs = factory(SignLog::class)->times(2)->make();
        SignLog::insert($sign_logs->toArray());
    }
}
