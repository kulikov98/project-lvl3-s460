<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i += 1) {
            DB::table('domains')->insert([
                'name' => "https://" . Str::random(5) . ".com"
            ]);
        }
    }
}
