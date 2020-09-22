<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use ElForastero\Transliterate\Transliterator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use ElForastero\Transliterate\Map;
class ServiceController extends Controller
{
    public function postRequestCategoryFrom1c(Request $request) {
        //Обработка категорий

            try {
                $stack = $request->toArray(); 
                foreach($stack as $s) {
                    $category = Category::where('category_id', $s['category_id'])->first();
                    $transliterator = new Transliterator(Map::LANG_RU, Map::DEFAULT);
                    $s['slug'] = strtolower($transliterator->slugify(preg_replace('/^[a-zа-я0-9_]$/', '', $s['name'])));
                    if($category == null) {
                        $category = new Category();             
                        $category->create($s);
                    } else {
                        $category->update($s);
                    }
                }

                return response('OK', 200);
                
            } catch (Exception $e) {
                Log::info($e); 
                return response('ERROR', 500);
            }

    }

    public function postRequestProductFrom1c(Request $request) {
        //Обработка товаров
            try {
                $stack = $request->toArray(); 
                foreach($stack as $s) {
                    $product = Product::where('product_id', $s['product_id'])->first();
                    $transliterator = new Transliterator(Map::LANG_RU, Map::DEFAULT);
                    $s['slug'] = strtolower($transliterator->slugify(preg_replace('/^[a-zа-я0-9_]$/', '', $s['name'])));
                    if($product == null) {
                        $product = new Product();             
                        $product->create($s);
                    } else {
                        $product->update($s);
                    }
                }

                return response('OK', 200);
                
            } catch (Exception $e) {
                Log::info($e); 
                return response('ERROR', 500);
            }

    }
}
