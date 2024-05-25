<?php

namespace App\Components\playlist;

use App\Entity\PlaylistItem as PlaylistItemEntity;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('playlist_item', template : 'components/playlist/playlist_item.html.twig')]
class PlaylistItem
{
    public PlaylistItemEntity $playlistItem;
}
