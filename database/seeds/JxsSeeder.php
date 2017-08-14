<?php

use Illuminate\Database\Seeder;

class JxsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vusers_company = \DB::table('vusers')->pluck('company', 'id')->toArray();
        $vusers_company_unique = array_unique($vusers_company);
        foreach ($vusers_company_unique as $vuser_id => $vuser_company) {

            \DB::table('jxs')->insert(['name'=>$vuser_company]);
        }


        $jxs_name = DB::table('jxs')->pluck('name', 'id');

        foreach ($vusers_company as $vuser_id => $vuser_company) {
            foreach ($jxs_name as $jxs_id => $jx_name) {
                if ($jx_name == $vuser_company){
                    \DB::table('vusers')
                        ->where('id', $vuser_id)
                        ->update(['company' => $jxs_id]);
                }
            }

        }

    }
}
