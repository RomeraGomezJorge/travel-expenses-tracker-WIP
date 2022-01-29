<?php
	
	namespace App\Tests\Controller;
	
	use App\Entity\LocationCosts;
	use App\Repository\LocationCostsRepository;
	use App\Tests\Entity\LocationCostsMother;
	use App\Tests\Entity\Mother\IntegerMother;
	use App\Tests\Entity\Mother\WordMother;
	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	
	class LocationCostsControllerTest extends BaseControllerWebCase
	{
		const LIST_ITEMS_PATH = '/backoffice/location-costs/list';
		const CREATE_ITEM_PATH = '/backoffice/location-costs/new';
		const EDIT_ITEM_PATH = '/backoffice/location-costs//edit';
		const LABEL_TO_CREATE_ITEMS = 'Crear Provincia';
		const LABEL_TO_UPDATE_ITEMS = 'Actualizar Provincia';
		private KernelBrowser $client;
		private LocationCosts $locationCosts;
		
		public function setUp(): void
		{
			$this->client = $this->client();
			
			$this->locationCosts = LocationCostsMother::random();
			
			parent::setUp();
		}
		
		/** @test */
		public function it_should_create_a_location_costs(): void
		{
			$crawler = $this->onPage($this->client, self::CREATE_ITEM_PATH);
			
			$form = $crawler->selectButton('submitBtn')->form();
			
			$this->client->submit($form, [
				'location_costs[location]' => $this->locationCosts->getLocation(),
				'location_costs[cost]' => $this->locationCosts->getCost()
			]);
			
			$this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
		}
		
		/** @test */
		public function it_should_update_a_location_costs()
		{
			$this->repository()->save($this->locationCosts);
			
			$crawler = $this->onPage($this->client,
				'/backoffice/location-costs/' . $this->locationCosts->getId() . '/edit');
			
			$form = $crawler->selectButton('submitBtn')->form();
			
			$this->client->submit($form, [
				'location_costs[location]' => WordMother::random(),
				'location_costs[cost]' => IntegerMother::lessThan(10000)
			]);
			
			
			$this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
		}
		
		/** @test */
		public function it_should_find_some_locationsCosts()
		{
			$anotherLocationCosts = LocationCostsMother::random();
			$someOtherLocationCosts = LocationCostsMother::random();
			$this->repository()->save($this->locationCosts);
			$this->repository()->save($anotherLocationCosts);
			$this->repository()->save($someOtherLocationCosts);
			
			$this->onPage($this->client, self::LIST_ITEMS_PATH);
			
			$this->shouldFindOnThePage(
				$this->client,
				$this->locationCosts->getLocation()
			);
			
			$this->shouldFindOnThePage(
				$this->client,
				$anotherLocationCosts->getLocation()
			);
			
			$this->shouldFindOnThePage(
				$this->client,
				$someOtherLocationCosts->getLocation()
			);
		}
		
		/** @test */
		public function it_should_delete_a_location_costs(): void
		{
			$this->repository()->save($this->locationCosts);
			
			$crawler = $this->onPage($this->client, self::LIST_ITEMS_PATH);
			
			$form = $crawler->selectButton('deleteBtn')->form();
			
			// Modify the attribute action because this value is set by js
			$form->getNode(0)->setAttribute('action',
				'/backoffice/location-costs/list/' . $this->locationCosts->getId());
			
			$this->client->submit($form);
			
			$this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
		}
		
		public function repository(): LocationCostsRepository
		{
			return $this->service(LocationCostsRepository::class);
		}
	}
