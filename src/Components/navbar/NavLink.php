<?php

namespace App\Components\navbar;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('nav_link', template : 'components/navbar/nav_link.html.twig')]
class NavLink
{
    public string $label;

    public string $value;
}
