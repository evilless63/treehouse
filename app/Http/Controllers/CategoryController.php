<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')->with([
            'categories' => $this->categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create')->with([
            'categories' => $this->categories,
            'locales' => $this->locales
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug(request()->get('localization')['ru']['title']);

        $category = Category::create($data);
        foreach ($request->input('localization', []) as $k => $i) {
            $local = $category->localizations()
                ->create($i + ['lang' => $k]);
        }

        if ($category) {
            return redirect()->route('categories.index')->with('success', __('adminpanel.action_success'));
        } else {
            return redirect()->route('categories.index')->with('error', __('adminpanel.action_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_category = Category::find($id);

        $lang_field_sets = collect();
        foreach ($this->locales as $locale) {
            $lang_field_sets->add($current_category
                ->localization()
                ->where('lang', $locale)
                ->first());
        }

        return view('admin.category.edit')->with([
            'categories' => $this->categories,
            'current_category' => $current_category,
            'selected_category' => Category::find($current_category->parent_id),
            'lang_field_sets' => $lang_field_sets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $haveBeenUpdated = $category->update($request->all());
        foreach ($request->input('localization', []) as $k => $i) {
            $locale = $category->localizations()->where('lang', $k)
                ->update($i + ['lang' => $k]);
        }
        if ($haveBeenUpdated) {
            return redirect()->route('categories.index')->with('success', __('adminpanel.action_success'));
        } else {
            return redirect()->route('categories.index')->with('error', __('adminpanel.action_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_category = Category::find($id);
        if ($current_category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', __('adminpanel.action_error'));
        } else {
            $current_category->delete();
            return redirect()->route('categories.index')->with('success', __('adminpanel.action_success'));
        }
    }

    public function replicate($id)
    {
        $category = Category::with('localizations')->find($id);
        $newCategory = $category->replicate(); 
        // $replicatedCategory = $newCategory->push();
        $replicatedCategory = Category::create($newCategory->toArray());

        foreach ($category->localizations as $localization) {
            $locArray = $localization->toArray();
            if($locArray['lang'] == 'ru') {
                $locArray['title'] = $locArray['title'] . ' - копия';
            } else {
                $locArray['title'] = $locArray['title'] . ' - copy';
            }
            $local = $replicatedCategory->localizations($locArray)
                ->create($locArray);
        }

        if($replicatedCategory) {
            return redirect()->route('categories.index')->with('error', __('adminpanel.action_error'));
        } else {
            return redirect()->route('categories.index')->with('success', __('adminpanel.action_success'));
        }
    }
}
