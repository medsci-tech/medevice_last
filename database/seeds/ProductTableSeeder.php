<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
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
            ['type_ch' => '��촩����']
        );

        DB::table('supplier_types')->insert(
            ['type_ch' => '���߼����е��']
        );

        DB::table('supplier_types')->insert(
            ['type_ch' => '�ۺ��Ե�ҽ�Ʊ�����Ʒ��']
        );
    }
}
