<?php

namespace App\Form\Type;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('subject', TextType::class, [
            'label' => 'Sujet',
        ])

            ->add('last_name', TextType::class, [
                'label' => 'Nom',
            ])

            ->add('first_name', TextType::class, [
                'label' => 'Prénom',
            ])

            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])

            ->add('tel_number', IntegerType::class, [
                'label' => 'Téléphone',
            ])

            ->add('content', TextareaType::class, [
                'label' => 'Message',
            ])

            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class
        ]);
    }
}
