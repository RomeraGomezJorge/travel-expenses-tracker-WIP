<?php

namespace App\Form;

use App\Entity\LocationCosts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationCostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('location', TextType::class, [
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
            'autofocus' => TRUE
          ],
          'label' => 'Location',
        ])
        
        ->add('cost', IntegerType::class, [
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'label' => 'Cost',
        ])
        ->add('save', SubmitType::class, [
          'attr' => ['class' => 'btn btn-success col-12 col-sm-4 col-md-2 col-lg-2',],
          'label' => 'Save',
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LocationCosts::class,
            'attr' => ['id' => 'form', 'novalidate' => 'novalidate']
        ]);
    }
}
