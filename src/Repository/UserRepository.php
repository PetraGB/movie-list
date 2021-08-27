<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function saveNewUser($user)
    {
        try {
            $em = $this->getEntityManager();
            $em->persist($user);
            $em->flush();
            return $user;
        } catch (\Throwable $t) {
            return null;
        }
    }
}