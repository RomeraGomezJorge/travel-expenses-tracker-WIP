<?php
  
  namespace App\Form;
  
  use App\Entity\Employee;
  use App\Entity\Travel;
  use App\Entity\TripDestination;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Bridge\Doctrine\Form\Type\EntityType;
  use Symfony\Component\Form\AbstractType;
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

        ->add('resolution', IntegerType::class, [
          'required' => FALSE,
          'attr' => [
            'placeholder' => '- Optional -',
          ],
          'label' => 'Resolution',
        ])
        ->add('departureDate', DateType::class, [
          'widget' => 'single_text',
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'label' => 'Departure Date ( * )',
        ])
        ->add('arrivalDate', DateType::class, [
          'widget' => 'single_text',
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'label' => 'Arrival Date ( * )',
        ])

        ->add('employees', EntityType::class, [
          'class' => Employee::class,
          'multiple' => TRUE,
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'label' => 'Employees ( * )'
        ])
        ->add('tripDestinations', EntityType::class, [
          'class' => TripDestination::class,
          'multiple' => TRUE,
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'choice_attr' => function (TripDestination $product, $key, $index) {
            return ['data-cost' => $product->getLocationCosts()->getCost() ];
          },
          'label' => 'Trip Destinations ( * )',
        ])
        ->add('expenses', IntegerType::class, [
          'required' => FALSE,
          'attr' => [
            'placeholder' => '- Required -',
          ],
          'label' => 'Expenses ( * )',
        ])
        ->add('save', SubmitType::class, [
          'attr' => [
            'class' => 'btn btn-success col-12 col-sm-4 col-md-2 col-lg-2',
            'id' => 'id="submitBtn',
          ]
          ,
          'label_html' => TRUE,
          'label' => '<span class="btn-label"><i class="fas fa-save"></i></span> Save',
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => Travel::class,
      ]);
    }
    
  }
