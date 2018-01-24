<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends BaseController
{
    /**
     * @Route("admin/new_product", name="product_create")
     * @Method({"GET"})
     */
    public function create(): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, ['action' => $this->generateUrl('product_store')]);
        return $this->render('product\create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("admin/new_product", name="product_store")
     * @Method({"POST"})
     */
    public function store(Request $request, Swift_Mailer $mailer): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render('product\create.html.twig', ['form' => $form->createView()]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($form->getData());
        $em->flush();

        $message = (new \Swift_Message('Product notification'))
            ->setFrom('send@example.com')
            ->setBody('A new product has been added')
        ;
        $mailer->send($message);

        return $this->redirect($this->generateUrl('homepage'));
    }
}
