<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Form\Type\CarImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('brand');
        yield TextField::new('model');
        yield IntegerField::new('price');
        yield IntegerField::new('year');
        yield IntegerField::new('car_km');
        yield TextField::new('energy');
        yield TextEditorField::new('description');
        yield CollectionField::new('carImages')
            ->setEntryType(CarImageType::class);
    }
}
