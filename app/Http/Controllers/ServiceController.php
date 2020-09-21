<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class ServiceController extends Controller
{
    public function getRequestFrom1c(Request $request) {
        //Обработка категорий
        if($request->headers->has('categories')){
            try {
                $stack = $request->toArray();   
                foreach($stack as $s) {
                    $category = Category::where('category_id', $s['category_id'])->first();
                    if($category == null) {
                        $category = new Category();
                        $category->save($s);
                    } else {
                        $category->update($s);
                    }
                }

                return 'all ok';
                
            } catch (Exception $e) {
                abort(500);
            }
            
        }

        //Обработка товаров
        if($request->headers->has('products')) {

        }
    }
}
