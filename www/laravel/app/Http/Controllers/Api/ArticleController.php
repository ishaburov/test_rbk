<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Artisan;

class ArticleController extends Controller
{


    public function index(Article $model)
    {
        $articles = $model->getLatestArticles();

        return $this->getJson($articles);
    }

    public function show($articleId, Article $model)
    {
        $article = $model->getArticle($articleId);

        return $this->getJson($article);
    }
}
