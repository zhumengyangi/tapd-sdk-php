<?php

namespace Tapd;

class TapdResponse implements TapdResponseInterface
{
    public function parse($content)
    {
        if (!is_array($content)) {
            throw new TapdException((string) $content);
        }

        if (isset($content['status']) && $content['status'] != 1) {
            throw new TapdException(
                isset($content['info']) ? $content['info'] : '',
                $content['status']
            );
        }

        if (!isset($content['data'])) {
            return [];
        }

        foreach ($content['data'] as $k => $v) {
            $this->$k = $v;
        }
        return $content['data'];
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}