<?php

namespace Tapd\Workspace;

use Tapd\Tapd;
use Tapd\TapdResponse;

class Workspace extends Tapd
{
    const TAPD_WS_LIST = '/workspaces';
    const TAPD_SUBWS_LIST = '/workspaces/sub_workspaces';
    const TAPD_WS_COUNT = '/workspaces/count';

    public function lists()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_WS_LIST);
    }

    public function sublists()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_SUBWS_LIST, []);
    }

    public function count()
    {

    }
}