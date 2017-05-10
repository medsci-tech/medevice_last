<?php

use Illuminate\Database\Seeder;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_categories')->insert(
            ['type_ch' => '活检穿刺类']
        );

        DB::table('product_categories')->insert(
            ['type_ch' => '免疫检测器械类']
        );

        DB::table('product_categories')->insert(
            ['type_ch' => '综合性的医疗保健产品制']
        );
    }
}
