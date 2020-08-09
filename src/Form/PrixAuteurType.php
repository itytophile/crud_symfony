<?php

namespace App\Form;

use App\Entity\PrixAuteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixAuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPrixAuteur', null, ['label' => 'Nom'])
            ->add('idAuteur', null, ['label' => 'Lauréats'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrixAuteur::class,
        ]);
    }
}
