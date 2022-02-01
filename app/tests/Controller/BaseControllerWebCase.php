<?php
	
	
	namespace App\Tests\Controller;
	
	
	use App\Tests\Entity\Doctrine\MySqlDatabaseCleaner;
	use Doctrine\ORM\EntityManager;
	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	
	abstract class BaseControllerWebCase extends WebTestCase
	{
		protected function setUp(): void
		{
			self::bootKernel(['environment' => 'test', 'debug' => false]);
			
			parent::setUp();
		}
		
		protected function tearDown(): void
		{
			$mySqlDatabaseCleaner = new MySqlDatabaseCleaner();

			$mySqlDatabaseCleaner->__invoke($this->service(EntityManager::class));
			
			parent::tearDown();
		}
		
		/** @return mixed */
		protected function service($id)
		{
			if ($id !== EntityManager::class) {
				$container = static::getContainer();
				
				return $container->get($id);
			}
			
			$kernel = self::bootKernel();
			
			return $kernel->getContainer()
				->get('doctrine')
				->getManager();
		}
		
		protected function client(): KernelBrowser
		{
			self::ensureKernelShutdown();
			
			return static::createClient();
		}
		
		public function onPage($client, $page)
		{
			return $client->request('GET', $page);
		}
		
		public function shouldPageRedirectsTo($client, $route): void
		{
			self::assertTrue(
				$client->getResponse()->isRedirect($route)
			);
		}
		
		public function shouldFindOnThePage($client, $contentToFind): void
		{
			self::assertStringContainsString(
				$contentToFind,
				$client->getResponse()->getContent()
			);
		}
	}