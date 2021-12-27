<?php
  
  namespace App\Form\EmployeesType;
  
  use App\Entity\Employee;
  use App\Entity\Travel;
  use App\Entity\TripDestination;
  use Doctrine\ORM\EntityManagerInterface;
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
  
  class EmployeesType extends AbstractType {
  

    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
              ->add('employees', EntityType::class, [
                'class' => Employee::class,
                'multiple' => TRUE,
                'required' => TRUE,
                'attr' => [
                  'placeholder' => '- Required -',
                ],
                'label' => FALSE
              ]);
    }
  
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Travel::class
      ));
    }
  }
