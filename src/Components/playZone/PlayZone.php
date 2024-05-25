<?php

namespace App\Components\playZone;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('play_zone', template : 'components/playZone/play_zone.html.twig')]
class PlayZone
{
    public function __construct(
    ) {
    }
}
