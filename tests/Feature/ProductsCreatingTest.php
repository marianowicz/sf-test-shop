<?php

namespace Tests\Feature\ProductsCreatingTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductsCreatingTest extends WebTestCase
{
    /**
     * @test
     */
    public function user_can_open_a_new_product_page()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/new_product');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

