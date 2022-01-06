<?php
  
  namespace App\Form\EmployeesType;
  
  use App\Entity\Employee;
  use App\Entity\TravellersName;
  use Symfony\Bridge\Doctrine\Form\Type\EntityType;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Form\Extension\Core\Type\CollectionType;
  use Symfony\Component\Form\Extension\Core\Type\DateType;
  use Symfony\Component\Form\Extension\Core\Type\EmailType;
  use Symfony\Component\Form\Extension\Core\Type\IntegerType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  
  class TravellersNameType extends AbstractType {
  

    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
              ->add('employee', EntityType::class, [
                'class' => Employee::class,
                'multiple' => FALSE,
                'required' => TRUE,
                'attr' => [
                  'placeholder' => '- Required -',
                  'class' => 'row col-12',
                  'autofocus' => 'autofocus',
                ],
                'label' => 'Employee',
                'label_attr' => ['class' => 'row col-12'],
              ])
              ->add('replacement', EntityType::class, [
                'class' => Employee::class,
                'multiple' => FALSE,
                'required' => FALSE,
                'attr' => [
                  'placeholder' => '- Optional -',
                  'class' => 'row col-12'
                ],
                'label' => 'Replacement',
                'label_attr' => ['class' => 'row col-12'],
              ]);
    }
  
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => TravellersName::class
      ));
    }
  }
