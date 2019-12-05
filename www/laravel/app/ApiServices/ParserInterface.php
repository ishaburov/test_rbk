<?php

namespace App\ApiServices;

use Illuminate\Support\Collection;

interface ParserInterface
{
    public function setLink($link);

    public function parse($method, $link = null);

    public function getContents($method);
}
