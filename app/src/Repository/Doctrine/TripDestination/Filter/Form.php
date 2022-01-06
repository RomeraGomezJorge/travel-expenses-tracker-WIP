<?php
  
  namespace App\Repository\Doctrine\TripDestination\Filter;
  
  
  use App\Repository\Doctrine\TripDestination\Filter\Filter;
  use Symfony\Component\Form\AbstractType;
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
        ->add('name', TextType::class, [
          'required' => FALSE,
          'attr' => ['class' => 'form-control',],
          'label' => 'Name',
        ])
        ->add('save', SubmitType::class, [
          'attr' => [
            'class' => 'btn btn-black',
            'id'=> 'id="submit',
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
        'csrf_protection' => false,
      ]);
    }
  

    
  }
