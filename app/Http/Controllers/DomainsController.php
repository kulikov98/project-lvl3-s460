<?php

namespace App\Http\Controllers;

use Debugbar;
use DB;

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

    public function add()
    {
        DB::table('domains')->insert([
            'name' => $_POST['url'],
            'created_at' => date('Y/m/d h:i:s', time()),
            'updated_at' => date('Y/m/d h:i:s', time())
        ]);

        $id = DB::getPdo()->lastInsertId();

        return redirect("/domains/{$id}");
    }

    public function show($id)
    {
        $domain = DB::table('domains')->find($id);

        return view('domain', ['domain' => $domain]);
    }
}
