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
 * @Route("/kids")
 */

class KidsController extends Controller
{

    /**
     * @Route("/", name="kids-all")
     */

    public function indexAction ()
    {
        $url = $this->generateUrl('kids-girls');
        return $this->redirect($url);
    }

    /**
     * @Route("/products/{productName}", methods={"GET", "POST"})
     * @Template("WebsiteBundle:Kids:kids_individual_prod.html.twig")
     * @param $productName
     * @param Request $request
     * @param SessionInterface $session
     * @return array|RedirectResponse
     */

    public function productAction($productName , Request $request, SessionInterface $session)
    {

        $path = 'big.jpg';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $product = $repo->getIndividualProducts($productName, $path);

        if (empty($product)) {
            $url = $this->generateUrl('kids-all');
            return $this->redirect($url);
        }

        if ($request->getMethod() === 'POST') {

            $name = trim($request->request->get('name'));
            $price = trim($request->request->get('price'));
            $path = $request->request->get('path');
            $prodId = $request->request->get('id');
            $picPath = 'bundles/website/images/kids/'.$path;
            $cart = $session->get('shopping_cart');
            if(!isset($cart[$name])) {
                $cart[$name] = [
                    'name' => $name,
                    'price' => $price,
                    'qty' => 1,
                    'path'=> $picPath,
                    'id'=> $prodId
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
     * @Route("/boys", name="kids-boys")
     * @Template("WebsiteBundle:Kids:kids_boys.html.twig")
     */


    public function boysAction()
    {
        $path = 'sm.jpg';
        $sku = 'KDB';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProducts($sku,$path);

        return
            [
            'products' => $products
            ];
    }

    /**
     * @Route("/girls", name="kids-girls")
     * @Template("WebsiteBundle:Kids:kids_girls.html.twig")
     */

    public function girlsAction()
    {
        $path = 'sm.jpg';
        $sku = 'KDG';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProducts($sku, $path);

        return
            [
            'products' => $products
            ];
    }

    /**
     *@Route("/newest", name="kids-newest")
     * @Template("WebsiteBundle:Kids:kids_new.html.twig")
     */

    public function whatsNewAction()
    {
        $category = 'KD';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $newProducts = $repo->getNewestProducts($category);

        return
            [
            'products' => $newProducts
            ];
    }
}
