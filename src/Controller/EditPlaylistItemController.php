<?php

namespace App\Controller;

use App\Repository\PlaylistItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditPlaylistItemController extends AbstractController
{
    #[Route('/api/edit-playlist-item/{videoId}', name: 'api_edit_playlist_item', methods: ['GET'])]
    public function index(
        string $videoId,
        PlaylistItemRepository $playlistItemRepository,
    ): Response {
        $playlistItem = $playlistItemRepository->findOneBy(['videoId' => $videoId]);

        return $this->render('edit_playlist_item.html.twig', ['playlistItem' => $playlistItem]);
    }
}
