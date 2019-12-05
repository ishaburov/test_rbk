<?php

namespace App\Console\Commands;

use App\ApiServices\Rbc;
use App\Models\Article;
use Illuminate\Console\Command;

class AddNews extends Command
{
    protected $signature = 'news:add';
    protected $description = 'Добавление новости';
    /*** @var Rbc */
    protected $rbcApi;

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->rbcApi = app(Rbc::class);
    }


    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle(Article $model)
    {
        $articlesFromRbc = $this->rbcApi
            ->getArticles();

        $addedArticles = $model->createArticlesFromResource($articlesFromRbc);
        echo "article added ".count($addedArticles);
    }

}
