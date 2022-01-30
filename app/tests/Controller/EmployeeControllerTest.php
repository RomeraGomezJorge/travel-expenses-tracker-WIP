<?php
	
	namespace App\Tests\Controller;
	
	use App\Entity\Employee;
    use App\Repository\EmployeeRepository;
    use App\Tests\Entity\EmployeeMother;
	use App\Tests\Entity\Mother\IntegerMother;
	use App\Tests\Entity\Mother\WordMother;
	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	
	class EmployeeControllerTest extends BaseControllerWebCase
	{
		const LIST_ITEMS_PATH = '/backoffice/employee/list';
		const CREATE_ITEM_PATH = '/backoffice/employee/new';
		const EDIT_ITEM_PATH = '/backoffice/employee//edit';
		private KernelBrowser $client;
		private Employee $employee;
		
		public function setUp(): void
		{
			$this->client = $this->client();
			
			$this->employee = EmployeeMother::random();
			
			parent::setUp();
		}
		
		/** @test */
		public function it_should_create_an_employee(): void
		{
			$crawler = $this->onPage($this->client, self::CREATE_ITEM_PATH);
			
			$form = $crawler->selectButton('submitBtn')->form();
			
			$this->client->submit($form, [
				'employee[name]' => $this->employee->getName(),
				'employee[surname]' => $this->employee->getSurname(),
				'employee[identityCard]' => $this->employee->getIdentityCard()
			]);
			
			$this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
		}
		
		/** @test */
		public function it_should_update_an_employee()
		{
			$this->repository()->save($this->employee);
			
			$crawler = $this->onPage($this->client,
				'/backoffice/employee/' . $this->employee->getId() . '/edit');
			
			$form = $crawler->selectButton('submitBtn')->form();
			
			$this->client->submit($form, [
                'employee[name]' => WordMother::random(),
                'employee[surname]' => WordMother::random(),
                'employee[identityCard]' => IntegerMother::lessThan(99999999)
			]);

			var_dump($this->client->getResponse()->getContent());
			
			$this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
		}
		
		/** @test */
		public function it_should_find_some_employees()
		{
			$anotherEmployee = EmployeeMother::random();
			$someOtherEmployee = EmployeeMother::random();
			$this->repository()->save($this->employee);
			$this->repository()->save($anotherEmployee);
			$this->repository()->save($someOtherEmployee);
			
			$this->onPage($this->client, self::LIST_ITEMS_PATH);
			
			$this->shouldFindOnThePage(
				$this->client,
				$this->employee->getName()
			);
			
			$this->shouldFindOnThePage(
				$this->client,
				$anotherEmployee->getName()
			);
			
			$this->shouldFindOnThePage(
				$this->client,
				$someOtherEmployee->getName()
			);
		}
		
		/** @test */
		public function it_should_delete_an_employee(): void
		{
			$this->repository()->save($this->employee);
			
			$crawler = $this->onPage($this->client, self::LIST_ITEMS_PATH);
			
			$form = $crawler->selectButton('deleteBtn')->form();
			
			// Modify the attribute action because this value is set by js
			$form->getNode(0)->setAttribute('action',
				'/backoffice/employee/list/' . $this->employee->getId());
			
			$this->client->submit($form);
			
			$this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
		}
		
		public function repository(): EmployeeRepository
		{
			return $this->service(EmployeeRepository::class);
		}
	}
