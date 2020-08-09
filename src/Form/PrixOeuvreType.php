<?php

namespace App\Form;

use App\Entity\PrixOeuvre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixOeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPrixOeuvre', null, ['label' => 'Nom'])
            ->add('idOeuvre', null, ['label' => 'Lauréats'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrixOeuvre::class,
        ]);
    }
}
