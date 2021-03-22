<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\ArticleOption;

use DB;
use Exception;
use Auth;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('article.all');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::join('article_options', 'articles.article_option_id', '=', 'article_options.id')
                        ->select('articles.id', 'article_options.name as category', DB::raw("DATE_FORMAT(articles.created_at, '%Y-%m-%d') as date"), 'articles.title')
                        ->orderBy('id', 'desc')
                        ->get();

        return response()
        ->json(array("data" => $articles))
        ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article_options = ArticleOption::select('id', 'name')->get();

        return view('article.new', compact('article_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();

            $name = uniqid()."-".$name;
            $file->move(public_path().'/uploads/articles/', $name );

            $url = url('/').'/uploads/articles/' . $name;

            $article = new Article;
            $article->user_id = Auth::user()->id;
            $article->article_option_id = $request->article_option;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->file_name       = $name;
            $article->link            = $url;
            $article->save();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'New article successfully created!');

        return "Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $article = Article::join('article_options', 'articles.article_option_id', '=', 'article_options.id')
    //                     ->select('articles.id', 'article_options.name as category', DB::raw("DATE_FORMAT(articles.created_at, '%Y-%m-%d') as date"), 'articles.title', 'articles.content')->orderBy('id', 'desc')->where('articles.id', $id)->first();

    //     return response()->json(array("data" => $article))->header('Content-Type', 'application/json');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::select('id', 'article_option_id', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"), 'title', 'content', 'file_name', 'link')
        ->orderBy('id', 'desc')
        ->where('articles.id', $id)->first();

        $article->file_name = substr($article->file_name, 14);

        $article_options = ArticleOption::select('id', 'name')->get();

        return view('article.edit', compact('article', 'article_options'));
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
        DB::beginTransaction();  
        try 
        {
            $article = Article::find($id);
            $article->article_option_id = $request->article_option;
            $article->title = $request->title;
            $article->content = $request->content;

            if(!is_null($request->file('file'))){

                $previous = Article::select('file_name')
                ->where('id', $id)
                ->first();

                unlink(public_path().'/uploads/articles/' . $previous->file_name);

                $file = $request->file('file');
                $name = $file->getClientOriginalName();
                $extention = $file->getClientOriginalExtension();

                $name = uniqid()."-".$name;
                $file->move(public_path().'/uploads/articles/', $name );

                $url = url('/').'/uploads/articles/' . $name;

                $article->file_name       = $name;
                $article->link            = $url;
            }

            $article->save();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([ "error" => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
        DB::commit();

        $request->session()->flash('success', 'New article successfully edited!');

        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $previous = Article::select('file_name')
                ->where('id', $request->id)
                ->first();

        unlink(public_path().'/uploads/articles/' . $previous->file_name);

        Article::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'Article successfully deleted!');

        return "Success";
    }
}
