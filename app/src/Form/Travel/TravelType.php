<?php
  
  namespace App\Form\Travel;
  
  use App\Entity\Employee;
  use App\Entity\Resolution;
  use App\Entity\Travel;
  use App\Entity\TripDestination;
  use Doctrine\ORM\EntityManagerInterface;
  use phpDocumentor\Reflection\Types\False_;
  use Symfony\Bridge\Doctrine\Form\Type\EntityType;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\CollectionType;
  use Symfony\Component\Form\Extension\Core\Type\DateType;
  use Symfony\Component\Form\Extension\Core\Type\IntegerType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  
  class TravelType extends AbstractType {
    
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em) {
      $this->em = $em;
    }
    
    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
        ->add('travellersNames',CollectionType::class,[
          'entry_type' => TravellersNameType::class,
          'entry_options' => ['label' => FALSE],
          'allow_add' => TRUE,
          'prototype' => TRUE,
          'by_reference' => FALSE,
          'label'=> FALSE
  
        ])
        ->add('tripDestinations', EntityType::class, [
          'class' => TripDestination::class,
          'multiple' => TRUE,
          'required' => TRUE,
          'empty_data' => '',// fix rendering errors replace the default value ( [] )
          'choice_attr' => function (TripDestination $product, $key, $index) {
            return ['data-cost' => $product->getLocationCosts()->getCost() ];
          },
          'label' => 'Destinations',
          'label_attr' =>['class'=>'w-100'],
          'attr'=>[
            'required'=>'required'
          ],
          'placeholder' => 'Required'
        ])
        ->add('departureDate', DateType::class, [
          'widget' => 'single_text',
          'required' => TRUE,
          'label' => 'Departure Date',
          'empty_data' => '',
        ])
        ->add('arrivalDate', DateType::class, [
          'widget' => 'single_text',
          'required' => TRUE,
          'label' => 'Arrival Date',
        ])
        ->add('resolution',ResolutionType::class,[
          'label' => FALSE
        ])
        ->add('expenses', IntegerType::class, [
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'label' => 'Expenses',
        ])
        ->add('save', SubmitType::class, [
          'attr' => ['class' => 'btn btn-success col-12 col-sm-4 col-md-2 col-lg-2'],
          'label' => 'Save',
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => Travel::class,
        'attr' => ['id' => 'form', 'novalidate' => 'novalidate']
      ]);
    }
    
  }
