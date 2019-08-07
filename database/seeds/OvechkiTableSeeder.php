<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class OvechkiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('ovechki')->get()->count() == 0) {
            DB::table('ovechki')->truncate();
            for ($i = 1; $i <= 10; $i++) {
                DB::table('ovechki')->insert([
                    'name' => 'Овечки ' . $i
                ]);
            }
        }else{
            echo 'Table ovechki is not empty';
        }
    }
}
