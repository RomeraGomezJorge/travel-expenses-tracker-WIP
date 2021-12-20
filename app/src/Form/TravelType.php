<?php
  
  namespace App\Form;
  
  use App\Entity\Employee;
  use App\Entity\Travel;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Bridge\Doctrine\Form\Type\EntityType;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Form\Extension\Core\Type\DateType;
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
        ->add('departureDate', DateType::class, ['widget' => 'single_text',])
        ->add('arrivalDate', DateType::class, ['widget' => 'single_text',])
        ->add('travelExpenses')
        ->add('resolutionNumber')
        ->add('tripDestination', ChoiceType::class, [
          'choices' => $this->em->getRepository("App:TripDestination")->findAll(),
          'choice_label' => 'name',
        ])
        ->add('employees', EntityType::class, array(
          'class'     => Employee::class,
          'expanded'  => true,
          'multiple'  => true,
        ));

    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => Travel::class,
      ]);
    }
    
  }
