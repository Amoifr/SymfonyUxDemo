<?php

namespace App\Controller;

use App\Entity\PlaylistItem;
use App\Repository\PlaylistItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AddToPlaylistController extends AbstractController
{
    #[Route('/api/add-to-playlist', name: 'api_add_to_playlist', methods: ['POST'])]
    public function index(
        Request $request,
        PlaylistItemRepository $playlistItemRepository,
    ): JsonResponse {
        $jsonData = json_decode($request->getContent(), true);
        if (isset($jsonData['video'])) {
            $playListItem = new PlaylistItem();
            $playListItem->setVideoId($jsonData['videoId'])
                ->setChannelId($jsonData['channel'])
                ->setDescription($jsonData['description'])
                ->setName($jsonData['name'])
                ->setPicture($jsonData['picture'])
                ->setCreatedAt(new \DateTimeImmutable());
            $playlistItemRepository->save($playListItem);

            return new JsonResponse(['status' => 'ok']);
        }

        return new JsonResponse(['status' => 'ko'], 400);
    }
}
