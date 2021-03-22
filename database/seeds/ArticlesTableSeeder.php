<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = array(
            [ 'title' => "PM highlights the importance of securing a 2/3rd majority", 'content' => "This is the content<br>" ],
            [ 'title' => "Opposition says, Government is using the recordings to evade their promises", 'content' => "This is the content<br>" ],
            [ 'title' => "IUSF march demanding Mahapola Scholarship be increased", 'content' => "This is the content<br>" ],
            [ 'title' => "Consequences of entering into agreements with US", 'content' => "This is the content<br>" ],
        );

        foreach($articles AS $data){
            $article = new \App\Article;
            $article->user_id = 1;
            $article->article_option_id = 1;
            $article->title = $data['title'];
            $article->content = $data['content'];
            $article->file_name       = '5e17908ab33c2-seed.png';
            $article->link            = url('/').'/uploads/articles/' . '5e17908ab33c2-seed.png';
            $article->save();
        }
    }
}
