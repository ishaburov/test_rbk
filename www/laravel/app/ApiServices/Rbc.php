<?php

namespace App\ApiServices;

use App\Consts\ExternalTypes;
use Illuminate\Support\Collection;
use PHPHtmlParser\Dom;

class Rbc extends Parser
{
    protected $limit = 15;

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /*** @param mixed $link */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    public function getArticles($link = null, $limit = 15) // 10 минимум
    {
        $limit = $limit ?: $this->limit;
        $link = $link ?: "https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews.tyumen/limit/{$limit}";

        $this->setLink($link);
        $content = $this->getContents();

        return $this->parseArticles($content)
            ->values();
    }

    public function getArticle($articleId, $link = null) // 5de7e6a59a7947a3dc0df501
    {
        if (!$articleId) {
            return false;
        }
        $link = $link ?: "https://www.rbc.ru/v10/ajax/news/slide/{$articleId}";

        $content = "";

        try {
            $this->setLink($link);
            $content = $this->getContents();
        }
        catch (\Exception $exception) {

        }

        return $content;
    }

    protected function parseArticles($content): Collection
    {
        $articles = isset($content->items)
            ? new Collection($content->items)
            : new Collection($content['items']);

        $dom = $this->getDom();

        $articlesArray = [];

        foreach ($articles as $key => $article) {
            $dom->load($article['html']);

            $title = $dom->find('.news-feed__item__title')
                ->text;

            $type = $dom->find('.news-feed__item__date-text')
                ->text;

            $link = $dom->find('a', 0)
                ->getAttribute('href');

            $paths = explode('/', parse_url($link)['path']);

            $articleId = null;

            foreach ($paths as $path) {
                if (strlen($path) !== 24) {
                    continue;
                }

                if (preg_match("(^[A-Za-z0-9]+$)", $path)) {
                    $articleId = $path;
                }
            }

            if (is_null($articleId)) {
                continue;
            }

            $articleSlide = $this->getArticle($articleId);

            if (empty($articleSlide)) {
                continue;
            }

            $articleSlideLoad = $dom->load($articleSlide['html']);

            $articlesArray[$key]['external_id'] = $articleId;
            $articlesArray[$key]['external_type_id'] = ExternalTypes::RBC;
            $articlesArray[$key]['published_at'] = $article['publish_date_t'];
            $articlesArray[$key]['title'] = $title;
            $articlesArray[$key]['link'] = $link;
            $articlesArray[$key]['description'] = $this->getArticleDescription($articleSlideLoad);
            $articlesArray[$key]['image'] = $this->getArticleImage($articleSlideLoad);
        }

        return collect($articlesArray);
    }

    protected function getArticleImage($articleSlideLoad)
    {
        $image = $articleSlideLoad
            ->find('.article__main-image__image');

        if (count($image) == 0) {
            return null;
        }

        $imageSrc = $image
            ->getAttribute('src');

        return $imageSrc;
    }

    /**
     * @param $articleSlideLoad Dom
     * @param $articleId
     * @return string
     */
    protected function getArticleDescription($articleSlideLoad)
    {
        $articleTexts = $articleSlideLoad
            ->find('.article__text', 0)
            ->find('p');

        $description = "";

        foreach ($articleTexts as $text) {
            $description .= "{$text->text} ";
        }

        return $description;
    }


}
