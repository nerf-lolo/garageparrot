<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\CarImage;
use App\Entity\ContactForm;
use App\Entity\Review;
use App\Entity\Schedules;
use App\Entity\Service;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController

{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(CarCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage Parrot');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-undo', 'app_home');

        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::subMenu('Annonces', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Toutes les annonces', 'fas fa-car', Car::class),
            MenuItem::linkToCrud('Images', 'fas fa-image', CarImage::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Car::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Avis Client', 'fas fa-comment')->setSubItems([
            MenuItem::linkToCrud('Toutes les avis', 'fas fa-comments', Review::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Review::class)->setAction(Crud::PAGE_NEW)
        ]);

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::subMenu('Services', 'fas fa-list')->setSubItems([
                MenuItem::linkToCrud('Toutes les services', 'fas fa-key', Service::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Service::class)->setAction(Crud::PAGE_NEW)
            ]);
        }

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::subMenu('Horaires', 'fas fa-clock')->setSubItems([
                MenuItem::linkToCrud('Toutes les horaires', 'fa fa-clock-o', Schedules::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Schedules::class)->setAction(Crud::PAGE_NEW)
            ]);
        }

        yield MenuItem::subMenu('Demande de contact', 'fas fa-envelope')->setSubItems([
            MenuItem::linkToCrud('Demandes', 'fas fa-telefone', ContactForm::class)
        ]);

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {

            yield MenuItem::subMenu('Employés', 'fas fa-users')->setSubItems([
                MenuItem::linkToCrud('Toutes les employés', 'fas fa-user', User::class),
                MenuItem::linkToCrud('Ajouter un employé', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
            ]);
        }
        yield MenuItem::linkToRoute('Déconnexion', 'fa fa-undo', 'app_logout');
    }
}
