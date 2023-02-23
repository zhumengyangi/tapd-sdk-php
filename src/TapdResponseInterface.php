<?php

namespace Tapd;

interface TapdResponseInterface
{
    public function parse($content);
}