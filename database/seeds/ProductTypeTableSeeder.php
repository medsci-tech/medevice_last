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
            ['type_ch' => '��촩����']
        );

        DB::table('product_categories')->insert(
            ['type_ch' => '���߼����е��']
        );

        DB::table('product_categories')->insert(
            ['type_ch' => '�ۺ��Ե�ҽ�Ʊ�����Ʒ��']
        );
    }
}
