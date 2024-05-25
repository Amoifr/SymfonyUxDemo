<?php

namespace App\Repository;

use App\Entity\PlaylistItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaylistItem>
 *
 * @method PlaylistItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistItem[]    findAll()
 * @method PlaylistItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistItem::class);
    }

    public function save(PlaylistItem $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function findByCategory(string $category): array
    {
        if ('all' === $category) {
            return $this->findAll();
        }

        return $this->findBy(['category' => $category]);
    }
}
