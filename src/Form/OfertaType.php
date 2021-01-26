<?php

namespace App\Form;

use App\Entity\Oferta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfertaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('empresa')
            ->add('dnicuit')
            ->add('email')
            ->add('telefono')
            ->add('ofertado')
            ->add('status')
            ->add('fecha')
            ->add('token')
            ->add('lote')
            ->add('toro')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oferta::class,
        ]);
    }
}
