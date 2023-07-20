<?php

namespace App\Form\Type;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('last_name', TextType::class, [
            'label' => 'Votre nom',

        ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre avis',

            ])
            ->add('mark', ChoiceType::class, [
                'label' => 'Votre note',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'multiple' => false,

            ])
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class
        ]);
    }
}
