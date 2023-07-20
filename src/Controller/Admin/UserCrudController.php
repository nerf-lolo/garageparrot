<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield EmailField::new('email');
        yield TextField::new('plainPassword')->onlyOnForms();
        yield ChoiceField::new('roles')
            ->allowMultipleChoices() // Active le choix de plusieurs valeurs
            ->setChoices(['ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN', 'ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER',]);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Hasher le mot de passe avant de sauvegarder l'entité
        if ($entityInstance instanceof User) {
            $plainPassword = $entityInstance->getPlainPassword();
            if ($plainPassword && strlen($plainPassword) > 0) {
                $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $plainPassword);
                $entityInstance->setPassword($hashedPassword);
            }
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Hasher le mot de passe avant de sauvegarder l'entité
        if ($entityInstance instanceof User) {
            $plainPassword = $entityInstance->getPlainPassword();
            if ($plainPassword && strlen($plainPassword) > 0) {
                $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $plainPassword);
                $entityInstance->setPassword($hashedPassword);
            }
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
