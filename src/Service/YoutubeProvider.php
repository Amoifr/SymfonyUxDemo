<?php

namespace App\Service;

use Google\Service\YouTube\SearchResult;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class YoutubeProvider
{
    private $apiKey;
    private \Google_Service_YouTube $youtubeService;

    public function __construct(
        string $apiKey,
        private CacheInterface $cache,
        private SluggerInterface $slugger,
    ) {
        $this->apiKey = $apiKey;
        $client = new \Google_Client();
        $client->setDeveloperKey($this->apiKey);

        $this->youtubeService = new \Google_Service_YouTube($client);
    }

    /**
     * @return SearchResult
     */
    public function searchVideos(string $query, int $maxResults = 9): array
    {
        $cacheKey = 'youtube_video_search_'.$this->slugger->slug($query);

        $searchResponse = $this->getOrFetch($cacheKey, function () use ($query, $maxResults) {
            return $this->youtubeService->search->listSearch('id,snippet', [
                'q' => $query,
                'maxResults' => $maxResults,
            ]);
        });

        return $searchResponse->getItems();
    }

    public function getOrFetch(string $cacheKey, callable $fetchCallback, int $ttl = 3600)
    {
        return $this->cache->get($cacheKey, $fetchCallback, $ttl);
    }
}
