<?php

namespace Tapd\Stories;

use Tapd\Tapd;
use Tapd\TapdResponse;

class Story extends Tapd
{
    const TAPD_STORIES = '/stories';
    const TAPD_STORIES_COUNT = '/stories/count';
    const TAPD_STORIES_FIELDS = '/stories/custom_fields_settings';
    const TAPD_LINK_STORIES = '/stories/get_link_stories';
    const TAPD_CHANGES_HISTORY = '/story_changes';
    const TAPD_CHANGES_COUNT = '/story_changes/count';

    public function lists()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_STORIES);
    }

    public function count()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_STORIES_COUNT);
    }

    public function create()
    {
        $result = new TapdResponse();
        return $this->httpPOST($result, self::TAPD_STORIES);
    }

    public function update()
    {
        $result = new TapdResponse();
        return $this->httpPOST($result, self::TAPD_STORIES);
    }

    public function fields()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_STORIES_FIELDS);
    }

    public function linkStories()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_LINK_STORIES);
    }

    public function changesHistory()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_CHANGES_HISTORY);
    }

    public function changesCount()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_CHANGES_COUNT);
    }
}