<?php

namespace App\Form;

use App\Entity\Biens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('pieces')
            ->add('chambres')
            ->add('etage')
            ->add('prix')
            ->add('chauffage', ChoiceType::class, array(
                'choices'  => array(
                    'éléctrique' => 0,
                    'gaz' => 1,
                   
                )))
            ->add('ville')
            ->add('code_postale')
            ->add('disponible')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Biens::class,
        ]);
    }
}
