<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class ZagonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('zagons')->get()->count() == 0) {
            DB::table('zagons')->truncate();
            for ($i = 1; $i <= 4; $i++) {
                DB::table('zagons')->insert([
                    'name' => 'Загон ' . $i
                ]);
            }
        }else{
            echo 'Table zagons is not empty';
        }
    }
}
