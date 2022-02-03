<?php
	
	namespace App\Form\Travel;
	
	use App\Entity\Travel;
	use App\Entity\TripDestination;
	use App\Repository\TripDestinationRepository;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\DateType;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class TravelType extends AbstractType
	{
		/**
		 * @var TripDestinationRepository
		 */
		private TripDestinationRepository $tripDestinationRepository;
		
		public function __construct(TripDestinationRepository $tripDestinationRepository)
		{
			$this->tripDestinationRepository = $tripDestinationRepository;
		}
		
		public function buildForm(
			FormBuilderInterface $builder,
			array $options
		): void {
			$builder
				->add('travellersNames', CollectionType::class, [
					'entry_type' => TravellersNameType::class,
					'entry_options' => ['label' => false],
					'allow_add' => true,
					'allow_delete' => true,
					'prototype' => true,
					'by_reference' => false,
					'label' => false
				
				])
				->add('tripDestinations', EntityType::class, [
					'class' => TripDestination::class,
					'multiple' => true,
					'required' => true,
					'empty_data' => '',// fix rendering errors replace the default value ( [] )
					'choices' => $this->tripDestinationRepository->findByLocationCostsNotNull(),
					'choice_attr' => function (TripDestination $tripDestination, $key, $index) {
						return ['data-cost' => $tripDestination->getLocationCosts()->getCost()];
					},
					'label' => 'Destinations',
					'label_attr' => ['class' => 'w-100'],
					'attr' => [
						'required' => 'required'
					],
					'placeholder' => 'Required'
				])
				->add('departureDate', DateType::class, [
					'widget' => 'single_text',
					'required' => true,
					'label' => 'Departure Date',
					'empty_data' => '',
				])
				->add('arrivalDate', DateType::class, [
					'widget' => 'single_text',
					'required' => true,
					'label' => 'Arrival Date',
				])
				->add('resolution', ResolutionType::class, [
					'label' => false
				])
				->add('expenses', IntegerType::class, [
					'required' => true,
					'attr' => [
						'placeholder' => '- Required -',
					],
					'label' => 'Expenses',
				])
				->add('save', SubmitType::class, [
					'attr' => ['class' => 'btn btn-success col-12 col-sm-4 col-md-2 col-lg-2'],
					'label' => 'Save',
				]);
		}
		
		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults([
				'data_class' => Travel::class,
				'attr' => ['id' => 'form', 'novalidate' => 'novalidate']
			]);
		}
	}
