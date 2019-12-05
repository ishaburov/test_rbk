<?php

namespace App\Models;

use App\Helpers\Truncate;
use App\Http\Resources\ArticleIndexResource;
use App\Http\Resources\ArticleShowResource;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'external_id',
        'external_type_id',
        'title',
        'description',
        'link',
        'image',
        'published_at',
    ];

    public function getShortDescriptionAttribute()
    {
        $description = $this->description;

        return Truncate::run($description, 200);
    }

    public function getArticle($articleId)
    {
        return $this->select([
            'id',
            'title',
            'description',
            'image',
            'published_at',
        ])->find($articleId);

        return new ArticleShowResource($article);
    }

    public function createArticlesFromResource($articles)
    {
        $articlesArray = [];
        foreach ($articles as $article) {
            $existsArticle = $this->where('external_id', $article['external_id'])
                ->exists();

            if (!$existsArticle) {
                $articlesArray[] = $this->create($article);
            }
        }

        return $articlesArray;
    }

    public function getLatestArticles($limit = 15)
    {
        $articles = $this->select([
            'id',
            'title',
            'description',
            'image',
            'published_at',
        ])->latest()
            ->limit($limit)
            ->get();


        foreach ($articles as $article) {
            $article->setAppends(['short_description']);
        }

        return ArticleIndexResource::collection($articles);
    }

}
