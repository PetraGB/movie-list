<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function findAllMovies(): ?array
    {
        try {
            $repo = $this->getEntityManager()->getRepository(Movie::class);
            return $repo->findAll();
        } catch (\Throwable $t) {
            return null;
        }
    }

    public function getMovie($id): ?object
    {
        try {
            $em = $this->getEntityManager();
            return $em->find(Movie::class, $id);
        } catch (\Throwable $t) {
            return null;
        }
    }

    public function findMovieByTitle($title): ?array
    {
        try {
            $repo = $this->getEntityManager()->getRepository(Movie::class);
            return $repo->findBy([
                'title' => $title
            ]);
        } catch (\Throwable $t) {
            return null;
        }
    }

//    rename to saveMovie
    public function addMovie($movie): ?object
    {
        try {
            $em = $this->getEntityManager();
            $em->persist($movie);
            $em->flush();
            return $movie;
        } catch (\Throwable $t) {
            return null;
        }
    }

    public function deleteMovie($id): ?bool
    {
        try {
            $movie = $this->getMovie($id);
            $manager = $this->getEntityManager();
            $manager->remove($movie);
            $manager->flush();
            return true;
        } catch (\Throwable $t) {
            return null;
        }
    }
}