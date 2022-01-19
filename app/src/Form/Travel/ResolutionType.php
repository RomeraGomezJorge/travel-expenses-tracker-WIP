<?php
  
  namespace App\Form\Travel;
  
  use App\Entity\Resolution;
  use Symfony\Bridge\Doctrine\Form\Type\EntityType;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Form\Extension\Core\Type\CollectionType;
  use Symfony\Component\Form\Extension\Core\Type\DateType;
  use Symfony\Component\Form\Extension\Core\Type\EmailType;
  use Symfony\Component\Form\Extension\Core\Type\FileType;
  use Symfony\Component\Form\Extension\Core\Type\IntegerType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  use Symfony\Component\Validator\Constraints\File;

  class ResolutionType extends AbstractType {
  

    public function buildForm(
      FormBuilderInterface $builder,
      array $options
    ): void {
      $builder
        ->add('name', TextType::class, [
          'required' => FALSE,
          'attr' => [
            'placeholder' => '- Optional -',
          ],
          'label' => 'Name',
        ])
        ->add('file',CollectionType::class,[
          'entry_type' => FileType::class,
          'entry_options' =>
            [
              'data_class' => NULL,
              'label'=> FALSE,
              'attr' => ['class' => 'col-3'],
              'mapped' => FALSE,
              'required' => FALSE,
              'constraints' => [
                new File([
                  'maxSize' => '5024k',
                  'mimeTypes' => [
                    'application/pdf',
                    'application/x-pdf',
                  ],
                  'mimeTypesMessage' => 'Please upload a valid PDF document',
                ])
              ],
            ],
          'allow_add' => TRUE,
          'prototype' => TRUE,
          'by_reference' => FALSE,
          'required' => FALSE,
          'label'=>  FALSE
        ]);
    }
  
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => Resolution::class
      ));
    }
  }
