<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\Type\ContactFormType;
use App\Repository\ContactFormRepository;
use App\Repository\SchedulesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_form')]
    public function index(SchedulesRepository $schedulesRepository, Request $request, EntityManagerInterface $em): Response
    {
        $form = new ContactForm();
        $contactForm = $this->createForm(ContactFormType::class, $form);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $em->persist($form);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact_form/index.html.twig', [
            'schedules' => $schedulesRepository->findAll(),
            'contactForm' => $contactForm->createView(),


        ]);
    }
}
