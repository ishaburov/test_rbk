<?php

namespace App\Http\Controllers\Api;

use App\ApiServices\Rbc;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /*** @var Rbc */
    protected $rbcApi;

    public function __construct()
    {
        $this->rbcApi = app(Rbc::class);
    }

    public function index()
    {
        $articles = $this->rbcApi
            ->getArticles();

        return $this->getJson($articles);
    }

    public function show()
    {

    }
}
