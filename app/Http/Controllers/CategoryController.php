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
            'categories' => $this->categories
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
        if(Category::create($request->all())) {
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
        return view('admin.category.edit')->with([
            'categories' => $this->categories,
            'current_category' => $current_category,
            'selected_category' => Category::find($current_category->parent_id)
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
        if($category->update($request->all())) {
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
        if($current_category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', __('adminpanel.action_error'));
        } else {
            $current_category->delete();
            return redirect()->route('categories.index')->with('success', __('adminpanel.action_success'));  
        }
    }
}
