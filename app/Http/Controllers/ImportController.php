<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ColorVariation;
use App\Models\SizeVariation;
use Exception;

class ImportController extends Controller
{

    public function ImportColorsFrom1c(Request $request)
    {
        $stack = $request->toArray();
        foreach ($stack as $data) {
            $dataArr = [];
            if ($data == "") {
                $data = "Без цвета";
            }
            $dataArr['name'] = $data;
            $dataArr['slug'] = str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', $data));
            if (Color::where('slug', $dataArr['slug'])->count() == 0) {
                $item = new Color();
                $savedItem = $item->fill($dataArr)->save();

                if ($savedItem) {
                    $dataLocalize = [];
                    $dataLocalize['lang'] = 'ru';
                    $dataLocalize['title'] = $dataArr['name'];
                    $locale = $item->localizations()->create($dataLocalize);

                    $dataLocalize = [];
                    $dataLocalize['lang'] = 'en';
                    $dataLocalize['title'] = $dataArr['slug'];
                    $locale = $item->localizations()->create($dataLocalize);
                }
            }
        }
    }

    public function ImportSizesFrom1c(Request $request)
    {
        $stack = $request->toArray();
        foreach ($stack as $data) {

            $dataArr = [];
            if ($data == "") {
                $data = "Без размера";
            }
            $dataArr['name'] = $data;
            $dataArr['slug'] = str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', $data));
            if (Size::where('slug', $dataArr['slug'])->count() == 0) {
                $item = new Size();
                $savedItem = $item->fill($dataArr)->save();

                if ($savedItem) {
                    $dataLocalize = [];
                    $dataLocalize['lang'] = 'ru';
                    $dataLocalize['title'] = $dataArr['name'];
                    $locale = $item->localizations()->create($dataLocalize);

                    $dataLocalize = [];
                    $dataLocalize['lang'] = 'en';
                    $dataLocalize['title'] = $dataArr['slug'];
                    $locale = $item->localizations()->create($dataLocalize);
                }
            }
        }
    }

    public function ImportProductsFrom1c(Request $request)
    {
        $stack = $request->toArray();
        foreach ($stack as $data) {

            $data['slug'] = str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', $data['title']));

            $item = Product::where('code', $data['code'])->first();
            if ($item == null) {
                $item = new Product();
                $item->code = $data['code'];
                $item->sku = $data['sku'];
                $item->slug = $data['slug'];
                $savedItem = $item->save();

                if ($savedItem) {
                    $dataLocalize = [];
                    $dataLocalize['lang'] = 'ru';
                    $dataLocalize['title'] = $data['title'];
                    $locale = $item->localizations()->create($dataLocalize);

                    $dataLocalize = [];
                    $dataLocalize['lang'] = 'en';
                    $dataLocalize['title'] = $data['slug'];
                    $locale = $item->localizations()->create($dataLocalize);
                }
            } else {
                $item->sku = $data['sku'];
                $savedItem = $item->update();
            }
        }

        $this->ImportRerlationsAndStocks1c($stack);
    }


    public function ImportRerlationsAndStocks1c(array $stack)
    {
        $collection = collect($stack);

        $productsCodes = [];
        foreach ($stack as $row) {
            array_push($productsCodes, $row['code']);
        }
        $productsCodes = array_unique($productsCodes);

        foreach ($productsCodes as $productCode) {
            $productSet = $collection->where('code', $productCode)->all();

            // $productColors = [];
            // foreach($productSet as $productSetRow){
            //     array_push($productColors, str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', $productSetRow['color'])));           
            // } 
            // $productsCodes = array_unique($productsCodes);
            // if(count($productsCodes) == 0) {
            //     array_push($productColors, str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', 'Без цвета')));
            // }

            foreach ($productSet as $productSetItem) {

                if ($productSetItem['color'] == "") {
                    $productSetItem['color'] = "Без цвета";
                }

                if ($productSetItem['size'] == "") {
                    $productSetItem['size'] = "Без размера";
                }

                $product = Product::where('code', $productSetItem['code'])->first();
                $color = Color::where('slug', str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', $productSetItem['color'])))->first();
                $size = Size::where('slug', str_slug(preg_replace('/^[A-ZА-Яa-zа-я0-9_]$/u', '', $productSetItem['size'])))->first();

                $colorVariation = ColorVariation::updateOrCreate([
                    'color_id' => $color->id,
                    'product_id' => $product->id
                ]);

                $sizeVariation = SizeVariation::where('size_id', $size->id)->where('color_variation_id', $colorVariation->id)->first();
                if($sizeVariation) {
                    $sizeVariation->update([
                        'price' => $productSetItem['price'],
                        'stock' => $productSetItem['stock']
                    ]);
                } else {
                    $sizeVariation = SizeVariation::create([
                        'size_id' => $size->id,
                        'color_variation_id' => $colorVariation->id,
                        'price' => $productSetItem['price'],
                        'stock' => $productSetItem['stock']
                    ]);
                } 
            }
        }
    }
}
