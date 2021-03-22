<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slider;
use App\Article;
use App\Video;

use DB;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::select('title', 'description', 'link')->orderBy('id', 'desc')->get();

        $articles = Article::join('users', 'articles.user_id', '=', 'users.id')
                    ->select('articles.id', 'articles.title', 'articles.link', 'articles.created_at as date', 'users.name as user')->orderBy('id', 'desc')->limit(3)->get();

        $videos = Video::select('id', 'title', 'thumbnail_link', 'link', 'created_at as date')->orderBy('id', 'desc')->limit(2)->get();

        foreach($articles AS $article){ $article->date = $this->get_time_ago(strtotime($article->date)); }

        foreach($videos AS $video){ $video->date = $this->get_time_ago(strtotime($video->date)); }

        return view('frontend.index', compact('sliders', 'articles', 'videos'));
    }

    public function single($id)
    {
        $article = Article::join('article_options', 'articles.article_option_id', '=', 'article_options.id')
                        ->join('users', 'articles.user_id', '=', 'users.id')
                        ->select('articles.id', 'article_options.name as category', DB::raw("DATE_FORMAT(articles.created_at, '%Y-%m-%d') as date"), 'articles.created_at', 'articles.title', 'articles.content', 'users.name as user', 'articles.link')->orderBy('id', 'desc')->where('articles.id', $id)->first();

        $articles = Article::select('id', 'title', 'link',DB::raw("DATE_FORMAT(articles.created_at, '%Y-%m-%d') as date"))->orderBy('id', 'desc')->limit(4)->get();

        foreach($articles AS $data){
            $data->date = $this->get_time_ago(strtotime($data->date));
        }

        return view('frontend.single', compact('article', 'articles'));
    }

    public function articles()
    {
        $articles = Article::select('id', 'title', 'link', 
        //DB::raw("DATE_FORMAT(articles.created_at, '%Y-%m-%d') as date"
        "created_at as date", "content")->orderBy('id', 'desc')->paginate(2);

        foreach($articles AS $data){
            $data->date = $this->get_time_ago(strtotime($data->date));
        }

        return view('frontend.articles', compact('articles'));
    }

    public function videos()
    {
        $articles = Article::select('id', 'title', 'link', DB::raw("DATE_FORMAT(articles.created_at, '%Y-%m-%d') as date"))->orderBy('id', 'desc')->limit(5)->get();

        foreach($articles AS $data){
            $data->date = $this->get_time_ago(strtotime($data->date));
        }

        $videos = Video::join('users', 'videos.user_id', '=', 'users.id')->select('videos.id', 'title', 'users.name as user', 'description', 'thumbnail_link', 'link', 'videos.created_at as date')->orderBy('id', 'desc')->paginate(5);

        foreach($videos AS $data){
            $data->date = $this->get_time_ago(strtotime($data->date));
        }

        return view('frontend.videos', compact('articles', 'videos'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function about()
    {
        return view('frontend.about');
    }

    function get_time_ago( $time )
    {
        $time_difference = time() - $time;

        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
}
