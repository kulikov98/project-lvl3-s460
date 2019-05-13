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

        $length = empty($response->getHeaderLine('content-length')) ? 0 : $response->getHeaderLine('content-length');
        $body = empty($response->getBody()) ? null : $response->getBody();

        DB::table('domains')->insert([
            'name' => $url,
            'response_code' => $response->getStatusCode(),
            'response_content_length' => $length,
            'response_body' => $body,
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
