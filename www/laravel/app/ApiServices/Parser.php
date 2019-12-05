<?php

namespace App\ApiServices;

use App\Consts\HttpStatuses;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use PHPHtmlParser\Dom;
use Psr\Http\Message\StreamInterface;

class Parser implements ParserInterface
{
    protected string $link;
    protected string $HttpClient;
    protected string $dom;
    protected $request;
    protected StreamInterface $body;


    public function __construct($client = null, $dom = null)
    {
        $this->setClient($client);
        $this->setDom($dom);
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    public function parse($method, $link = null)
    {
        $link = $link ?: $this->link;

        $request = $this->getRequest($method, $link);

        if ($request->getStatusCode() !== HttpStatuses::OK) {
            return [];
        }

        $result = $request
            ->getBody();

        $this->body = $result;

        return $result;
    }

    protected function getRequest($method, $link)
    {
        $this->request = $this->getClient()
            ->request($method, $link);

        return $this->request;
    }

    public function getContents($method = 'GET', $assoc = true)
    {
        $this->parse($method);

        $contents = $this->body
            ->getContents();

        $decodeContent = \GuzzleHttp\json_decode($contents, $assoc);

        return $decodeContent;
    }


    /**
     * @return Client|mixed
     */
    protected function getClient()
    {
        return app($this->HttpClient);
    }

    /**
     * @return Dom|mixed
     */
    protected function getDom()
    {
        return app($this->dom);
    }

    protected function setDom($dom)
    {
        if (!empty($dom)) {
            $this->dom = $dom;
        } else {
            $this->dom = Dom::class;
        }
    }

    protected function setClient($client): void
    {
        if (!empty($client)) {
            $this->HttpClient = $client;
        } else {
            $this->HttpClient = Client::class;
        }
    }

}
