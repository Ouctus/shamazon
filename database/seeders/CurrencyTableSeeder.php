<?php

namespace Database\Seeders;
use App\Models\Currency;
use Illuminate\Database\Seeder;
use DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->UpdateOrInsert([
            'name'         => 'EUR',
        ],
        [
            'name'         => 'EUR',
        ]);
        
    }
}
