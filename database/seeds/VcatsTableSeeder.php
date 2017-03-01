<?php

use Illuminate\Database\Seeder;

use App\Vcat;
class VcatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id1 = Vcat::insertGetId([
            'title' => '经销商'
        ]);
        $id2 = Vcat::insertGetId([
            'title' => '公司职员'
        ]);
        $id3 = Vcat::insertGetId([
            'title' => '嘉宾'
        ]);

        Vcat::insert([
           ['title' => '北京办', 'parent_id' => $id1],
           ['title' => '江苏办', 'parent_id' => $id1],
           ['title' => '销售部', 'parent_id' => $id2],
        ]);
    }
}
