<?php

namespace App\Components\form;

use App\Entity\PlaylistItem as PlaylistItemEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;

#[AsLiveComponent('edit_modal_content', template : 'components/form/edit_modal_content.html.twig')]
class EditModalContent
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;

    #[LiveProp(writable: ['alternativeName', 'start', 'stop', 'category'])]
    #[Assert\Valid]
    public ?PlaylistItemEntity $playlistItem;
    #[LiveProp]
    public bool $isEditing = true;

    #[LiveAction]
    public function activateEditing()
    {
        $this->isEditing = true;
    }

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager)
    {
        $this->validate();
        $entityManager->persist($this->playlistItem);
        $entityManager->flush();
        $this->isEditing = false;
    }

    #[LiveAction]
    public function remove(EntityManagerInterface $entityManager)
    {
       if($this->playlistItem !== null) {
           $entityManager->remove($this->playlistItem);
           $entityManager->flush();
       }
       $this->isEditing = false;
    }
}
