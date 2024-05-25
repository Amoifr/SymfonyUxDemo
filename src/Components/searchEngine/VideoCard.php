<?php

namespace App\Components\searchEngine;

use Google\Service\YouTube\SearchResult;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('video_card', template : 'components/searchEngine/video_card.html.twig')]
class VideoCard
{
    public SearchResult $video;
}
