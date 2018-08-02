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
        $articles = ArticleController::search(5);
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

    public function search(int $page_count)
    {
        $articles = array();

        #htmlの取得
        for ($i=1;$i<$page_count+1;$i++){
          if ($i == 1){
            $html = file_get_contents("http://computermusic.jp/category/%e3%82%bb%e3%83%bc%e3%83%ab/");
          }
          else{
            $html = file_get_contents("http://computermusic.jp/category/%e3%82%bb%e3%83%bc%e3%83%ab/page/$i/");
          }
          $dom = phpQuery::newDocument($html);

          #記事ごとに処理をループ
          foreach($dom["article"] as $post){
            #見出しの取得
            $title = pq($post)->find("h1")->text();

            #製品名の取得　（だいたい「」に囲まれている。）
            preg_match("/.*(「.*」).*/",$title ,$arr);
            if (count($arr) >= 1) {
              $product = $arr[1];
            }
            else {
              $product = "";
            }

            #割引に関する記述　（$、¥、円、%などを検索し、その前後の数字を取得）
            preg_match("/[0-9,]*[\$¥円%]/",$title ,$arr);
            if (count($arr) >= 1) {
              $discount = $arr[0];
            }
            else {
              $discount = "";
            }

            #投稿日付の取得
            $posting_date = pq($post)->find(".date")->text();

            # urlの取得
            $url = pq($post)->find("a")->attr("href");

            $p = array(
              'title' => $title,
              'product' => $product,
              'discount' => $discount,
              'posting_date' => $posting_date,
              'url' => $url
            );
            array_push($articles, $p);
          }
        }
        return $articles;
    }
}
