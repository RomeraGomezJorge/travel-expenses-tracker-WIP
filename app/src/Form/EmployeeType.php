<?php
  
  namespace App\Form;
  
  use App\Entity\Employee;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\IntegerType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  
  class EmployeeType extends AbstractType {
    
    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
        ->add('name', TextType::class, [
          'required' => TRUE,
          'attr' => [
            'class' => 'form-control',
            'placeholder' => '- Required -',
            'autofocus' => TRUE
          ],
          'label' => 'Name ( * )',
        ])
        ->add('surname', TextType::class, [
          'required' => TRUE,
          'attr' => [
            'class' => 'form-control',
            'placeholder' => '- Required -',
          ],
          'label' => 'Surname ( * )',
        ])
        ->add('identityCard', IntegerType::class, [
          'required' => FALSE,
          'attr' => [
            'class' => 'form-control',
            'placeholder' => '- Optional -',
            'maxlength' => '8'
          ],
          'label' => 'Identity Card',
        ])
        ->add('save', SubmitType::class, [
          'attr' => [
            'class' => 'btn btn-success col-12 col-sm-4 col-md-2 col-lg-2',
            'id'=> 'id="submitBtn',
            ]
          ,
          'label_html' => TRUE,
          'label' => '<span class="btn-label"><i class="fas fa-save"></i></span> Save',
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
      $resolver->setDefaults([
        'data_class' => Employee::class,
      ]);
    }
    
  }
