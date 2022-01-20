<?php

namespace App\Tests\Controller;

use App\Repository\LocationCostsRepository;
use App\Repository\TripDestinationRepository;
use App\Tests\Entity\Mother\WordMother;
use App\Tests\Entity\TripDestinationMother;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class TripDestinationControllerTest extends BaseControllerWebCase
{
    const LIST_ITEMS_PATH = '/backoffice/trip-destination/list';
    const CREATE_ITEM_PATH = '/backoffice/trip-destination/new';
    const CHECK_FIST_RADIO_BUTTON = 0;
    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = $this->client();

        parent::setUp();
    }

    /** @test */
    public function it_should_create_a_tripDestination(): void
    {
        $tripDestination = $this->tripDestination();

        /* save a locationCosts before getting content from url  */
        $this->service(LocationCostsRepository::class)->save($tripDestination->getLocationCosts());

        $crawler = $this->onPage($this->client, self::CREATE_ITEM_PATH);

        $form = $crawler->selectButton('submitBtn')->form();

        $this->client->submit($form, [
            'trip_destination[name]' => $tripDestination->getName(),
            'trip_destination[locationCosts]' => self::CHECK_FIST_RADIO_BUTTON
        ]);

        $this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
    }

    /** @test */
    public function it_should_update_a_tripDestination()
    {
        $tripDestination = $this->tripDestination();

        $this->repository()->save($tripDestination);

        $crawler = $this->onPage($this->client,
            '/backoffice/trip-destination/' . $tripDestination->getId() . '/edit');

        $form = $crawler->selectButton('submitBtn')->form();

        $this->client->submit($form, [
            'trip_destination[name]' => WordMother::random(),
            'trip_destination[locationCosts]' => self::CHECK_FIST_RADIO_BUTTON
        ]);

        $this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
    }

    /** @test */
    public function it_should_find_sometripDestinations()
    {
        $tripDestination = $this->tripDestination();

        $anotherTripDestination = TripDestinationMother::withLocationCost($tripDestination->getLocationCosts());
        $someOtherTripDestination = TripDestinationMother::withLocationCost($tripDestination->getLocationCosts());
        $this->repository()->save($tripDestination);
        $this->repository()->save($anotherTripDestination);
        $this->repository()->save($someOtherTripDestination);

        $this->onPage($this->client, self::LIST_ITEMS_PATH);

        $this->shouldFindOnThePage(
            $this->client,
            $tripDestination->getName()
        );

        $this->shouldFindOnThePage(
            $this->client,
            $anotherTripDestination->getName()
        );

        $this->shouldFindOnThePage(
            $this->client,
            $someOtherTripDestination->getName()
        );
    }

    /** @test */
    public function it_should_delete_a_tripDestination(): void
    {
        $tripDestination = $this->tripDestination();

        $this->repository()->save($tripDestination);

        $crawler = $this->onPage($this->client, self::LIST_ITEMS_PATH);

        $form = $crawler->selectButton('deleteBtn')->form();

        // Modify the attribute action because this value is set by js
        $form->getNode(0)->setAttribute('action',
            '/backoffice/trip-destination/list/' . $tripDestination->getId());

        $this->client->submit($form);

        $this->shouldPageRedirectsTo($this->client, self::LIST_ITEMS_PATH);
    }

    public function tripDestination()
    {
        $tripDestination = TripDestinationMother::random();

        $this->service(LocationCostsRepository::class)->save($tripDestination->getLocationCosts());

        return $tripDestination;
    }

    public function locationCostsRepository(): LocationCostsRepository
    {
        return $this->service(LocationCostsRepository::class);
    }

    public function repository(): TripDestinationRepository
    {
        return $this->service(TripDestinationRepository::class);
    }
}
