<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function getProviders()
    {
        $url_1 = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';
        $url_2 = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';
        $response = file_get_contents($url_1);
        $provider_1 = json_decode($response);
        return response()->json($provider_1);
    }
}
