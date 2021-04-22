<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.article.index')->with([
            'articles' => $this->articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create')->with([
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

        $article = Article::create($data);
        foreach ($request->input('localization', []) as $k => $i) {
            $local = $article->localizations()
                ->create($i + ['lang' => $k]);
        }

        if ($article) {
            return redirect()->route('articles.index')->with('success', __('adminpanel.action_success'));
        } else {
            return redirect()->route('articles.index')->with('error', __('adminpanel.action_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_article = Article::find($id);

        $lang_field_sets = collect();
        foreach ($this->locales as $locale) {
            $lang_field_sets->add($current_article
                ->localization()
                ->where('lang', $locale)
                ->first());
        }

        return view('admin.article.edit')->with([
            'current_article' => $current_article,
            'lang_field_sets' => $lang_field_sets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $haveBeenUpdated = $article->update($request->all());
        foreach ($request->input('localization', []) as $k => $i) {
            $locale = $article->localizations()->where('lang', $k)
                ->update($i + ['lang' => $k]);
        }
        if ($haveBeenUpdated) {
            return redirect()->route('articles.index')->with('success', __('adminpanel.action_success'));
        } else {
            return redirect()->route('articles.index')->with('error', __('adminpanel.action_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_article = Article::find($id);
        $current_article->delete();
        return redirect()->route('articles.index')->with('success', __('adminpanel.action_success'));
    }

    public function replicate($id)
    {
        $article = Article::with('localizations')->find($id);
        $newArticle = $article->replicate(); 
        // $replicatedCategory = $newCategory->push();
        $replicatedArticle = Article::create($newArticle->toArray());

        foreach ($article->localizations as $localization) {
            $locArray = $localization->toArray();
            if($locArray['lang'] == 'ru') {
                $locArray['title'] = $locArray['title'] . ' - копия';
            } else {
                $locArray['title'] = $locArray['title'] . ' - copy';
            }
            $local = $replicatedArticle->localizations($locArray)
                ->create($locArray);
        }

        if($replicatedArticle) {
            return redirect()->route('articles.index')->with('error', __('adminpanel.action_error'));
        } else {
            return redirect()->route('articles.index')->with('success', __('adminpanel.action_success'));
        }
    }
}
