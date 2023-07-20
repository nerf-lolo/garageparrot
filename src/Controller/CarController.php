<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Car;
use App\Form\SearchType;
use App\Repository\CarImageRepository;
use App\Repository\CarRepository;
use App\Repository\SchedulesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car', name: 'app_car')]
    public function index(CarRepository $carRepository, CarImageRepository $carImageRepository, SchedulesRepository $schedulesRepository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $cars = $carRepository->findSearch($data);
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'images' => $carImageRepository->findAll(),
            'schedules' => $schedulesRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
