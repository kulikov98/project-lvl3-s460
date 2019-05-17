<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use \GuzzleHttp\Client;

class DomainsController extends Controller
{
    private $guzzle;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function add(Request $request)
    {
        $url = $request->input('url');

        $v = Validator::make(
            ['url' => $url],
            ['url' => 'required|active_url']
        );
        if ($v->fails()) {
            $error = $v->errors()->first();
            return view('index', ['error' => $error]);
        }

        //$client = app()->make('httpClient');
        $response = $this->guzzle->request('GET', $url);

        $body = (string)$response->getBody();
        if (empty($response->getHeaderLine('content-length'))) {
            $length = strlen($body);
        } else {
            $length = $response->getHeaderLine('content-length');
        }

        $domainData = [
            'name' => $url,
            'response_code' => $response->getStatusCode(),
            'response_content_length' => $length,
            'response_body' => mb_convert_encoding($body, 'UTF-8'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ];

        $document = app()->document;
        $document->loadHtml($body);
        if ($document->has('h1')) {
            $domainData['h1'] = $document->first('h1')->text();
        }
        if ($document->has('meta[name="keywords"]')) {
            $domainData['meta_keywords'] = $document->first('meta[name="keywords"]')->attr('content');
        }
        if ($document->has('meta[name="description"]')) {
            $domainData['meta_description'] = $document->first('meta[name="description"]')->attr('content');
        }

        $id = DB::table('domains')->insertGetId($domainData);

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
