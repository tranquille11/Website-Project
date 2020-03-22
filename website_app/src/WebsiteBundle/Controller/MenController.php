<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/men")
 */
class MenController extends Controller
{

    /**
     * @Route("/", name="men-all")
     * @Template("WebsiteBundle:Men:men_all.html.twig")
     */

    public function indexAction()
    {
        $path = 'sm.jpg';
        $sku = 'MEN';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProducts($sku, $path);

        return
            [
                'products' => $products
            ];
    }

    /**
     * @Route("/products/{productName}", methods={"GET", "POST"})
     * @Template("WebsiteBundle:Men:men_individual_prod.html.twig")
     * @param $productName
     * @param Request $request
     * @param SessionInterface $session
     * @return RedirectResponse|array
     */

    public function productAction($productName , Request $request, SessionInterface $session)
    {

        $path = 'big.jpg';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $product = $repo->getIndividualProducts($productName, $path);

        if (empty($product)) {
            $url = $this->generateUrl('men-all');
            return $this->redirect($url);
        }

        if ($request->isXmlHttpRequest()) {

            $name = trim($request->request->get('name'));
            $price = trim($request->request->get('price'));
            $path = $request->request->get('path');
            $picPath = 'bundles/website/images/men/'.$path;
            $prodId = $request->request->get('id');
            $cart = $session->get('shopping_cart');
            if(!isset($cart[$name])) {
                $cart[$name] = [
                    'name'  => $name,
                    'price' => $price,
                    'qty'   => 1,
                    'path'  => $picPath,
                    'id'    => $prodId
                ];
            } else {
                $cart[$name]['qty'] += 1;
            }
            $session->set('shopping_cart',$cart);

        }

        return
            [
                'products' => $product
            ];
    }

    /**
     * @Route("/boots", name="men-boots")
     * @Template("WebsiteBundle:Men:men_boots.html.twig")
     */

    public function bootsAction()
    {
        $categoryId = 10;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return
            [
                'products' => $products
            ];

    }

    /**
     * @Route("/sneakers", name="men-sneakers")
     * @Template("WebsiteBundle:Men:men_sneakers.html.twig")
     */

    public function sneakersAction()
    {
        $categoryId = 11;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return
            [
                'products' => $products
            ];
    }

    /**
     * @Route("/dress", name="men-dress")
     * @Template("WebsiteBundle:Men:men_dress.html.twig")
     */

    public function dressAction()
    {
        $categoryId = 12;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return
            [
                'products' => $products
            ];
    }

    /**
     *@Route("/newest", name="men-newest")
     * @Template("WebsiteBundle:Men:men_new.html.twig")
     */

    public function whatsNewAction()
    {
        $category = 'MEN';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $newProducts = $repo->getNewestProducts($category);

        return
            [
                'products' => $newProducts
            ];
    }


}
