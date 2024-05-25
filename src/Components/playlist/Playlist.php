<?php

namespace App\Components\playlist;

use App\Repository\PlaylistItemRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('playlist', template : 'components/playlist/playlist.html.twig')]
class Playlist
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $trigger = 0;

    #[LiveProp(writable: true)]
    public string $category = '';

    public function __construct(
        private readonly PlaylistItemRepository $playlistItemRepository
    ) {
    }

    #[LiveListener('playlistChange')]
    public function getPlaylistItems(): array
    {
        return $this->playlistItemRepository->findByCategory($this->category);
    }

    #[LiveAction]
    public function updateTrigger(): void
    {
        ++$this->trigger;
    }
}
