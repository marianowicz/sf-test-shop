<?php

namespace App\Tests\Feature;

class ProductsCreatingTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function a_guest_cannot_open_a_new_product_page()
    {
        $this->client->request('GET', '/admin/new_product');

        $this->assertTrue(
            $this->client->getResponse()->isRedirection()
        );
    }

    /**
     * @test
     */
    public function a_guest_cannot_add_a_new_product()
    {
        $this->client->request('POST', '/admin/new_product');

        $this->assertTrue(
            $this->client->getResponse()->isRedirection()
        );
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_open_a_new_product_page()
    {
        $this->logIn();

        $this->client->request('GET', '/admin/new_product');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_add_a_new_product()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/admin/new_product');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form([
            'product[name]' => 'Brand new product',
            'product[description]' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mattis nunc eget neque egestas finibus. Ut ac turpis nulla.',
            'product[price]' => '20.50'
        ]);

        $this->client->submit($form);

        $this->assertTrue(
            $this->client->getResponse()->isRedirect('/')
        );

        $products = $this->em
            ->getRepository('App\Entity\Product')
            ->findAll()
        ;

        $this->assertCount(1, $products);
    }

}

