<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('suppliers')->insert([
            'supplier_name' => 'STERYLAB S.r.l'
        ]);

        DB::table('suppliers')->insert([
            'supplier_name' => '佰奥达生物科技武汉有限公司',
            'supplier_desc' => '佰奥达生物科技武汉有限公司坐落于武汉光谷生物城——中国武汉国家生物产业基地。2011年11月正式注册成立，公司主要从事高新生物技术项目的研发及产业化生产，所开发的Bioda免疫检测系统以及配套的诊断试剂具备了“操作简便，快速、定量、全血检测”等即时检验系统的优点，已获得7项国家专利。 公司已经获得国家食品药品监督管理局（SFDA）颁发的《药品生产许可证》和《医疗器械生产许可证》等证书',
        ]);

        DB::table('suppliers')->insert([
            'supplier_name' => '佰奥达生物科技武汉有限公司',
            'supplier_desc' => '佰奥达生物科技武汉有限公司坐落于武汉光谷生物城——中国武汉国家生物产业基地。2011年11月正式注册成立，公司主要从事高新生物技术项目的研发及产业化生产，所开发的Bioda免疫检测系统以及配套的诊断试剂具备了“操作简便，快速、定量、全血检测”等即时检验系统的优点，已获得7项国家专利。 公司已经获得国家食品药品监督管理局（SFDA）颁发的《药品生产许可证》和《医疗器械生产许可证》等证书',
        ]);
    }
}
