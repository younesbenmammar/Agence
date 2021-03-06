<?php

namespace App\Form;

use App\Entity\Biens;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'required' => false,
                'multiple' => true
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
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
