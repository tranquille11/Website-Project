<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/women")
 */
class WomenController extends Controller
{
    /**
     * @Route("/", name="women-all")
     */

    public function indexAction()
    {
        $path = 'sm.jpg';
        $sku = 'FEM';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProducts($sku, $path);

        return $this->render('WebsiteBundle:More:women_all.html.twig', ['products' =>
            $products]);
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
            $url = $this->generateUrl('women-all');
            return $this->redirect($url);
        }

        if ($request->getMethod() === 'POST') {

            $name = trim($request->request->get('name'));
            $price = trim($request->request->get('price'));
            $path = $request->request->get('path');
            $prodId = $request->request->get('id');
            $picPath = 'bundles/website/images/female/'.$path;
            $cart = $session->get('shopping_cart');

            if(!isset($cart[$name])) {
                $cart[$name] = [
                    'name' => $name,
                    'price' => $price,
                    'qty' => 1,
                    'path'=> $picPath,
                    'id'=>$prodId
                ];
            } else {
                $cart[$name]['qty'] += 1;
            }
            $session->set('shopping_cart',$cart);

        }

        return $this->render('WebsiteBundle:More:women_individual_prod.html.twig', ['products' =>
            $product]);
    }


    /**
     * @Route("/booties", name="women-booties")
     */

    public function bootiesAction()
    {
        $categoryId = 2;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return $this->render('WebsiteBundle:More:women_booties.html.twig', ['products' =>
            $products]);
    }

    /**
     * @Route("/sandals", name="women-sandals")
     */

    public function sandalsAction()
    {
        $categoryId = 3;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return $this->render('WebsiteBundle:More:women_sandals.html.twig', ['products' =>
            $products]);
    }

    /**
     * @Route("/sneakers", name="women-sneakers")
     */

    public function sneakersAction()
    {
        $categoryId = 4;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return $this->render('WebsiteBundle:More:women_sneakers.html.twig', ['products' =>
            $products]);
    }

    /**
     * @Route("/boots", name="women-boots")
     */

    public function bootsAction()
    {
        $categoryId = 5;
        $path = 'sm.jpg';

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getProductsByCategory($categoryId, $path);

        return $this->render('WebsiteBundle:More:women_boots.html.twig', ['products' =>
            $products]);
    }

    /**
     *@Route("/newest", name="women-newest")
     */

    public function whatsNewAction()
    {
        $category = 'FEM';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $newProducts = $repo->getNewestProducts($category);

        return $this->render('WebsiteBundle:More:women_new.html.twig',['products' =>
            $newProducts]);
    }

}
