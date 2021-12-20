<?php
  
  namespace App\Form;
  
  
  use App\Entity\TripDestination;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  
  class TripDestinationType extends AbstractType {
    
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em) {
      $this->em = $em;
    }
    
    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
        ->add('name')
        ->add('locationCosts', ChoiceType::class, [
          'expanded' => 'radio',
          'choices' => $this->em->getRepository("App:LocationCosts")->findAll(),
          'choice_label' => 'location',
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => TripDestination::class,
      ]);
    }
    
  }
