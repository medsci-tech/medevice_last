<?php

use Illuminate\Database\Seeder;

class SupplierTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('supplier_types')->insert(
            ['type_ch' => '活检穿刺类']
        );

        DB::table('supplier_types')->insert(
            ['type_ch' => '免疫检测器械类']
        );

        DB::table('supplier_types')->insert(
            ['type_ch' => '综合性的医疗保健产品制']
        );
    }

}
