<?php

namespace App\Tests;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripDestinationControllerTest extends WebTestCase
{
    public static function getKernelClass(): string
    {
        return Kernel::class;
    }

    public function testSomething(): void
    {
        /* Symfony\Component\Config\Exception\LoaderLoadException :
         There is no extension able to load the configuration for "web_profiler" (in "/www/var/app/config/packages/test/web_profiler.yaml").
         Looked for namespace "web_profiler", found ""framework", "sensio_framework_extra", "twig", "monolog", "doctrine",
         "doctrine_migrations", "security", "twig_extra", "knp_paginator", "bazinga_js_translation""
         in /www/var/app/config/packages/test/web_profiler.yaml (which is being imported from "/www/var/app/src/Kernel.php").*/


        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
