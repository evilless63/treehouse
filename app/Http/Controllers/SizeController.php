<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.size.index')->with([
            'sizes' => $this->sizes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_size = Size::find($id);
        $lang_field_sets = collect();
        foreach ($this->locales as $locale) {
            $lang_field_sets->add($current_size
                ->localization()
                ->where('lang', $locale)
                ->first());
        }

        return view('admin.size.edit')->with([
            'current_size' => $current_size,
            'lang_field_sets' => $lang_field_sets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $haveBeenUpdated = $size->update($request->all());
        foreach ($request->input('localization', []) as $k => $i) {
            $locale = $size->localizations()->where('lang', $k)
                ->update($i + ['lang' => $k]);
        }
        if ($haveBeenUpdated) {
            return redirect()->route('sizes.index')->with('success', __('adminpanel.action_success'));
        } else {
            return redirect()->route('sizes.index')->with('error', __('adminpanel.action_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        //
    }
}
