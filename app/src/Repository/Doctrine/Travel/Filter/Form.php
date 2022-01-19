<?php
  
  namespace App\Repository\Doctrine\Travel\Filter;
  
  
  use App\Entity\Employee;
  use App\Entity\TripDestination;
  use Symfony\Bridge\Doctrine\Form\Type\EntityType;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\DateType;
  use Symfony\Component\Form\Extension\Core\Type\IntegerType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  
  class Form extends AbstractType {
    
    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
        ->add('departureDateFrom', DateType::class, [
          'widget' => 'single_text',
          'required' => FALSE,
          'label' => 'From',
          'format' => 'yyyy-MM-dd',
        ])
        ->add('departureDateTill', DateType::class, [
          'widget' => 'single_text',
          'required' => FALSE,
          'label' => 'Till',
          'format' => 'yyyy-MM-dd',
        ])
        ->add('arrivalDateFrom', DateType::class, [
          'widget' => 'single_text',
          'required' => FALSE,
          'label' => 'From',
          'format' => 'yyyy-MM-dd',
        ])
        ->add('arrivalDateTill', DateType::class, [
          'widget' => 'single_text',
          'required' => FALSE,
          'label' => 'Till',
          'format' => 'yyyy-MM-dd',
        ])
        ->add('expenses', IntegerType::class, [
          'required' => FALSE,
          'attr' => [
            'maxlength' => '8',
          ],
          'label' => 'Expenses',
        ])
        ->add('resolutionName', TextType::class, [
          'required' => FALSE,
          'attr' => [
            'maxlength' => '8',
          ],
          'label' => 'Resolution',
        ])
        ->add('travellersNames', EntityType::class, [
          'class' => Employee::class,
          'required' => FALSE,
          'label' => 'Employee'
        ])
        ->add('tripDestination', EntityType::class, [
          'class' => TripDestination::class,
          'required' => FALSE,
          'label' => 'Trip Destination',
        ])
        ->add('save', SubmitType::class, [
          'attr' => [
            'class' => 'btn btn-black',
            'id' => 'id="submit',
          ]
          ,
          'label_html' => TRUE,
          'label' => '<span class="btn-label">
                           <i class="fas fa-search"></i>
                      </span> Filter',
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => Filter::class,
        'method' => 'GET',
        'csrf_protection' => FALSE,
      ]);
    }
    
  }
