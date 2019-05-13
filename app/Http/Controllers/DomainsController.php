<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DomainsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add(Request $request)
    {
        $url = $request->input('url');

        $client = app()->httpClient;
        $response = $client->request('GET', $url);

        DB::table('domains')->insert([
            'name' => $url,
            'response_code' => $response->getStatusCode(),
            'response_content_length' => $response->getHeaderLine('content-length'),
            'response_body' => $response->getBody(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        $id = DB::getPdo()->lastInsertId();

        return redirect()->route('showDomains', ['id' => $id]);
    }

    public function show($id)
    {
        $domain = DB::table('domains')->find($id);

        return view('domain', ['domain' => $domain]);
    }

    public function showAll()
    {
        $domains = DB::table('domains')->paginate(10);

        return view('domains', ['domains' => $domains]);
    }
}
