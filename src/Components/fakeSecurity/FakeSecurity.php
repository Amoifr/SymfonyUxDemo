<?php

namespace App\Components\fakeSecurity;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('fake_security', template : 'components/fakeSecurity/fake_security.html.twig')]
class FakeSecurity
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $password = '';

    #[LiveProp(writable: true)]
    public string $label = 'Enter password';

    #[LiveProp(writable: true)]
    public ?string $error = null;

    #[LiveProp]
    public bool $displayLink = false;

    #[LiveProp(writable: true)]
    public int $state = 0;

    #[LiveAction]
    public function passwordChange(): int
    {
        switch ($this->state) {
            case 0:
                if ('password' === $this->password) {
                    $this->state = 1;
                    $this->error = 'Password is incorrect';
                    $this->password = '';
                } else {
                    $this->error = 'Enter password';
                }
                break;
            case 1:
                if ('incorrect' === $this->password) {
                    $this->state = 2;
                    $this->error = 'Try again';
                    $this->password = '';
                } else {
                    $this->error = 'Password is incorrect';
                }
                break;
            case 2:
                if ('again' === $this->password) {
                    $this->state = 3;
                    $this->error = 'Try again later';
                    $this->password = '';
                } else {
                    $this->error = 'Try again';
                }
                break;
            case 3:
                if ('again later' === $this->password) {
                    $this->state = 0;
                    $this->password = '(｡◕‿‿◕｡)';
                    $this->error = null;
                    $this->displayLink = true;

                } else {
                    $this->error = 'Try again later';
                }
        }

        return $this->state;
    }
}
