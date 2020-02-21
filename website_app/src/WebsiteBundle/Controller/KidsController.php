<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


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
     * @param $productName
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
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

        return $this->render('WebsiteBundle:More:kids_individual_prod.html.twig', ['products' =>
            $product]);
    }

    /**
     * @Route("/boys", name="kids-boys")
     */


    public function boysAction()
    {
        $path = 'sm.jpg';
        $sku = 'KDB';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProducts($sku,$path);

        return $this->render('WebsiteBundle:More:kids_boys.html.twig', ['products' =>
            $products]);
    }

    /**
     * @Route("/girls", name="kids-girls")
     */

    public function girlsAction()
    {
        $path = 'sm.jpg';
        $sku = 'KDG';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProducts($sku, $path);

        return $this->render('WebsiteBundle:More:kids_girls.html.twig', ['products' =>
            $products]);
    }

    /**
     *@Route("/newest", name="kids-newest")
     */

    public function whatsNewAction()
    {
        $category = 'KD';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $newProducts = $repo->getNewestProducts($category);

        return $this->render('WebsiteBundle:More:kids_new.html.twig',['products' =>
            $newProducts]);
    }
}
