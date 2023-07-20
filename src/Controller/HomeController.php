<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\Type\ReviewType;
use App\Repository\ReviewRepository;
use App\Repository\SchedulesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(ReviewRepository $reviewRepository, SchedulesRepository $schedulesRepository, Request $request, EntityManagerInterface $em): Response
    {
        $review = new Review();

        $reviewForm = $this->createForm(ReviewType::class, $review);
        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'reviews' => $reviewRepository->findby(['isOnline' => true]),
            'schedules' => $schedulesRepository->findAll(),
            'reviewForm' => $reviewForm->createView()
        ]);
    }
}
