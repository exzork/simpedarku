<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            ['name'=>'POLISI','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'RUMAH SAKIT','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'PEMADAM KEBAKARAN','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ]);
    }
}
