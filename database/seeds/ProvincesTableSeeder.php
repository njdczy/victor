<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('provinces')->insertGetId([
            'name' => '中国', 'type' => 0
        ]);

        DB::table('provinces')->insert([
            ['name' => '北京市', 'parent_id' => $id],
            ['name' => '天津市', 'parent_id' => $id],
            ['name' => '上海市', 'parent_id' => $id],
            ['name' => '重庆市', 'parent_id' => $id],
            ['name' => '河北省', 'parent_id' => $id],
            ['name' => '山西省', 'parent_id' => $id],
            ['name' => '辽宁省', 'parent_id' => $id],
            ['name' => '吉林省', 'parent_id' => $id],
            ['name' => '黑龙江省', 'parent_id' => $id],
            ['name' => '江苏省', 'parent_id' => $id],
            ['name' => '浙江省', 'parent_id' => $id],
            ['name' => '安徽省', 'parent_id' => $id],
            ['name' => '福建省', 'parent_id' => $id],
            ['name' => '江西省', 'parent_id' => $id],
            ['name' => '山东省', 'parent_id' => $id],
            ['name' => '河南省', 'parent_id' => $id],
            ['name' => '湖北省', 'parent_id' => $id],
            ['name' => '湖南省', 'parent_id' => $id],
            ['name' => '广东省', 'parent_id' => $id],
            ['name' => '海南省', 'parent_id' => $id],
            ['name' => '四川省', 'parent_id' => $id],
            ['name' => '贵州省', 'parent_id' => $id],
            ['name' => '云南省', 'parent_id' => $id],
            ['name' => '陕西省', 'parent_id' => $id],
            ['name' => '甘肃省', 'parent_id' => $id],
            ['name' => '陕西省', 'parent_id' => $id],
            ['name' => '青海省', 'parent_id' => $id],
            ['name' => '台湾省', 'parent_id' => $id],
            ['name' => '内蒙古自治区', 'parent_id' => $id],
            ['name' => '广西壮族自治区', 'parent_id' => $id],
            ['name' => '西藏自治区', 'parent_id' => $id],
            ['name' => '新疆维吾尔自治区', 'parent_id' => $id],
            ['name' => '香港特别行政区', 'parent_id' => $id],
            ['name' => '澳门特别行政区', 'parent_id' => $id],
        ]);
    }
}
