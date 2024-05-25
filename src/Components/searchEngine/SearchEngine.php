<?php

namespace App\Components\searchEngine;

use App\Service\YoutubeProvider;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('search_engine', template : 'components/searchEngine/search_engine.html.twig')]
class SearchEngine
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(
        private readonly YoutubeProvider $youtubeProvider
    ) {
    }

    public function getVideos(): array
    {
        return $this->youtubeProvider->searchVideos($this->query);
    }
}
