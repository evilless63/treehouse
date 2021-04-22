<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Article;
use LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $categories;
    protected $products;
    protected $locales;
    protected $colors;
    protected $sizes;
    protected $articles;
    function __construct()
    {
        $this->categories = Category::all();  
        $this->products = Product::all(); 
        $this->locales = LaravelLocalization::getSupportedLanguagesKeys(); 
        $this->colors = Color::all();
        $this->sizes = Size::all();
        $this->articles = Article::all();
    }
}
