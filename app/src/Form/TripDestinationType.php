<?php
  
  namespace App\Form;
  
  
  use App\Entity\TripDestination;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        ->add('name', TextType::class, [
          'required' => TRUE,
          'attr' => [
            'placeholder' => '- Required -',
            'autofocus' => TRUE
          ],
          'label' => 'Name',
        ])
        ->add('locationCosts', ChoiceType::class, [
          'expanded' => 'radio',
          'choices' => $this->em->getRepository("App:LocationCosts")->findAll(),
          'choice_label' => 'locationAndCost',
          'label' => 'Location Costs',
        ])
        ->add('save', SubmitType::class, [
          'attr' => [
            'class' => 'btn btn-success col-12 col-sm-4 col-md-2 col-lg-2',
            'id'=> 'id="submitBtn',
          ]
          ,
          'label' => 'Save',
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => TripDestination::class,
      ]);
    }
    
  }
