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
            'title' => '经销商',
            'is_father' => 1,
        ]);
        $id2 = Vcat::insertGetId([
            'title' => '工作人员',
            'is_father' => 1,
        ]);
        Vcat::insertGetId([
            'title' => '嘉宾'
        ]);

        Vcat::insert([
           ['title' => '北京办', 'parent_id' => $id1],
           ['title' => '江苏办', 'parent_id' => $id1],
           ['title' => '销售部', 'parent_id' => $id2],
        ]);
    }
}
