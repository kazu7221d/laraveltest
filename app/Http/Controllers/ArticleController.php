<?php

namespace App\Http\Controllers;

use App\Article;
use phpQuery;
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
        // データベース内の記事を全選択
        #$articles = Article::all();
        $articles = ArticleController::search();
        return view('articles', compact('articles'));
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
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function search()
    {
        $articles = array();

        #htmlの取得
        $html = file_get_contents("http://computermusic.jp/category/%e3%82%bb%e3%83%bc%e3%83%ab/page/2/");
        $dom = phpQuery::newDocument($html);

        #記事ごとに処理をループ
        foreach($dom["article"] as $post){
          $title = pq($post)->find("h1")->text();
          $product = preg_split("/[「」]/",$title)[0];
          $posting_date = pq($post)->find(".date")->text();
          $p = array('title' => $title, 'product' => $product, 'posting_date' => $posting_date);
          array_push($articles, $p);
        }
        return $articles;
    }
}
