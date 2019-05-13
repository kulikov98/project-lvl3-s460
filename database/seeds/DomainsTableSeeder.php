<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urls = [
            'http://youtube.com',
            'http://yandex.com',
            'http://google.com',
            'http://vk.com',
            'http://facebook.com'
        ];

        $client = app()->httpClient;

        foreach ($urls as $url) {
            $response = $client->request('GET', $url);

            DB::table('domains')->insert([
                'name' => $url,
                'response_code' => $response->getStatusCode(),
                'response_content_length' => $response->getHeaderLine('content-length'),
                'response_body' => $response->getBody(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
