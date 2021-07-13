<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Societe;
use App\Entity\TypeSociete;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('type',EntityType::class, [
                'class' => TypeSociete::class,
                'choice_label' => 'designation',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('postal', EntityType::class, [
                'class' => CodePostal::class,
                'choice_label' => 'code',
            ])
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
