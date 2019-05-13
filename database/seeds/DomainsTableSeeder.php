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
        $domainsNum = 30;

        for ($i = 0; $i < $domainsNum; $i += 1) {
            DB::table('domains')->insert([
                'name' => "https://" . Str::random(5) . ".com",
                'response_code' => "200",
                'response_content_length' => "100500",
                'response_body' => 'body'
            ]);
        }
    }
}
