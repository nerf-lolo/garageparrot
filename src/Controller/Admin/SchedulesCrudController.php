<?php

namespace App\Controller\Admin;

use App\Entity\Schedules;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SchedulesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Schedules::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('day');
        yield TextField::new('openTime');
    }
}
