<?php

namespace App\Form;

use App\Entity\Dirigeant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirigeantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_prenom')
            ->add('sexe',ChoiceType::class, [
               'label' => 'Sexe',
               'choices' => [
                   'H' => true,
                   'F' => false
               ],
                'expanded' => true,
                'data' => true
            ])
            ->add('email', EmailType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dirigeant::class,
        ]);
    }
}
