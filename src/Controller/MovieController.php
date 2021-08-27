<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Type\MovieType;
use App\Form\Type\MovieRateType;
use App\Form\Type\MovieDeletionType;

class MovieController extends AbstractController
{
    private function getRepo()
    {
        return $this->getDoctrine()->getRepository(Movie::class);
    }

    public function getMoviesList(): Response
    {
        try {
            $movies = $this->getRepo()->findAllMovies();
            return $this->render('movie/index.html.twig', [
                'movies' => $movies
            ]);
        } catch (\Throwable $t) {
            return new Response((string) $t, 400);
        }
    }

    public function getMovie($movieId): Response
    {
        try {
            $movie = $this->getRepo()->getMovie($movieId);
            return $this->render('movie/details.html.twig', [
                'movie' => $movie
            ]);
        } catch (\Throwable $t) {
            return new Response((string) $t, 400);
        }
    }

    public function addMovie(?string $movieId, Request $request): Response
    {
        try {
            $movie = new Movie();
            if($movieId){
                $movie = $this->getRepo()->getMovie($movieId);
            }

            $form = $this->createForm(MovieType::class, $movie);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $newMovie= $form->getData();
                $this->getRepo()->addMovie($newMovie);

                return $this->redirectToRoute('movie_list');
            }

            return $this->render('movie/add.html.twig', [
                'form' => $form->createView()
            ]);
        } catch (\Throwable $t) {
            return new Response((string) $t, 400);
        }
    }

    public function deleteMovie(string $movieId, Request $request): Response
    {
        try {
            $movie = $this->getRepo()->getMovie($movieId);
            if (!$movie){
                $this->redirectToRoute('movie_list');
            }

            $form = $this->createForm(MovieDeletionType::class, $movie);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getRepo()->deleteMovie($movieId);
                return $this->redirectToRoute('movie_list');
            }

            return $this->render('movie/delete.html.twig', [
                'form' => $form->createView(),
                'title' => $movie->getTitle()
            ]);
        } catch (\Throwable $t) {
            return new Response((string) $t, 400);
        }
    }

    public function rateMovie(string $movieId, Request $request): Response
    {
        try {
            $movie = $this->getRepo()->getMovie($movieId);
            if (!$movie){
                $this->redirectToRoute('movie_list');
            }

            $form = $this->createForm(MovieRateType::class, $movie);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getRepo()->addMovie($movie);
                return $this->redirectToRoute('movie', array('movieId' => $movieId));
            }

            return $this->render('movie/rate.html.twig', [
                'form' => $form->createView(),
                'title' => $movie->getTitle()
            ]);
        } catch (\Throwable $t) {
            return new Response((string) $t, 400);
        }
    }
}