<?php

namespace App\Form;

use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('start', DateTimeType::class, [
            'widget' => 'single_text'
        ])
        ->add('end', DateTimeType::class, [
            'widget' => 'single_text'
        ])
        ->add('all_Day')
        ->add('background_color', ColorType::class)
        ->add('border_color', ColorType::class)
        ->add('text_color', ColorType::class)
        ->add('cours', EntityType::class, [
            'class' => 'App\Entity\Cours',
            'choice_label' => 'title',
        ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
        ]);
    }
}
