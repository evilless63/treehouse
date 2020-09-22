<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class DemoController extends Controller
{
    public function getDemoData() {
        $categories = Category::whereNull('parent_id')->with('childs')->with('products')->get();
        return view('demo.category')->with(['categories' => $categories]);
    }

    public function postOrderTo1c(Request $request) {
        dd($request);
    }
}
