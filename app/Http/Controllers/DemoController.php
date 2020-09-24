<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class DemoController extends Controller
{
    public function getDemoData() {
        $categories = Category::whereNull('parent_id')->with('childs')->with('products')->get();
        return view('demo.category')->with(['categories' => $categories]);
    }

    public function postOrderTo1c(Request $request) {
        $client = new Client();

        // $promise = $client->requestAsync('POST', 'http://31.128.156.218:55315/ushp/hs/obmen/get-orders', [
        //     'auth' => ['Анна', '17382256Ksu@'],
        //     'body' => $request->product_id
        // ]);
        // $promise->then(
        //     function (ResponseInterface $res) {
        //         Log::info($res->getStatusCode());
        //     },
        //     function (RequestException $e) {
        //         Log::info($e->getMessage());
        //         Log::info($e->getRequest()->getMethod());
        //     }
        // );
        try {
            $response = $client->request('POST', 'http://31.128.156.218:55315/ushp/hs/obmen/get-orders', [
                'auth' => ['Анна', '17382256Ksu@'],
                'body' => $request->product_id
            ]);
        } catch (Exception $e) {
            Log::info($e); 
            return response('ERROR', 500);
        }

        $body = $response->getBody();
        $stringBody = (string) $body;

        Log::info($response->getStatusCode());
        Log::info($stringBody);
        // $response = $client->request('POST', 'test');

        return redirect()->back()->with('success', $stringBody); 
    }
}
