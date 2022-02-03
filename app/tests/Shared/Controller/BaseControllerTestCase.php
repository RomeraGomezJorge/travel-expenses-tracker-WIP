<?php


namespace App\Tests\Shared\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseControllerTestCase extends WebTestCase
{
    protected static function KernelClass()
    {
        return \App\Kernel::class;
    }

    protected function setUp(): void
    {
        $_SERVER['KERNEL_CLASS'] = $this->kernelClass();

        self::bootKernel(['environment' => 'test']);

        parent::setUp();
    }

    public function isOnPage($client, $page)
    {
        return $client->request('GET', $page);
    }

    public function shouldPageRedirectsTo($client, $route)
    {
        $this->assertTrue(
            $client->getResponse()->isRedirect($route)
        );
    }

    public function shouldFindOnThePage($client, $contentToFind)
    {
        $this->assertStringContainsString(
            $contentToFind,
            $client->getResponse()->getContent()
        );
    }

    public function clickAndFollowTheLink($client, $crawler, $linkSelector)
    {
        $createItemLink = $crawler->filter($linkSelector)->link();

        return $client->click($createItemLink);
    }


}