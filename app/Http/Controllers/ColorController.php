<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.color.index')->with([
            'colors' => $this->colors
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
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_color = Color::find($id);
        $lang_field_sets = collect();
        foreach ($this->locales as $locale) {
            $lang_field_sets->add($current_color
                ->localization()
                ->where('lang', $locale)
                ->first());
        }

        return view('admin.color.edit')->with([
            'current_color' => $current_color,
            'lang_field_sets' => $lang_field_sets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $haveBeenUpdated = $color->update($request->all());
        foreach ($request->input('localization', []) as $k => $i) {
            $locale = $color->localizations()->where('lang', $k)
                ->update($i + ['lang' => $k]);
        }
        if ($haveBeenUpdated) {
            return redirect()->route('colors.index')->with('success', __('adminpanel.action_success'));
        } else {
            return redirect()->route('colors.index')->with('error', __('adminpanel.action_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
    }
}
