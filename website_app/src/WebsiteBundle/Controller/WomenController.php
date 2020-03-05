<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @Template("WebsiteBundle:Women:women_all.html.twig")
     */

    public function indexAction()
    {
        $path = 'sm.jpg';
        $sku = 'FEM';

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
     * @Template("WebsiteBundle:Women:women_individual_prod.html.twig")
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
            $url = $this->generateUrl('women-all');
            return $this->redirect($url);
        }

        if ($request->isXmlHttpRequest()) {

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

        return
            [
                'products' => $product
            ];
    }


    /**
     * @Route("/booties", name="women-booties")
     * @Template("WebsiteBundle:Women:women_booties.html.twig")
     */

    public function bootiesAction()
    {
        $categoryId = 2;
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
     * @Route("/sandals", name="women-sandals")
     * @Template("WebsiteBundle:Women:women_sandals.html.twig")
     */

    public function sandalsAction()
    {
        $categoryId = 3;
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
     * @Route("/sneakers", name="women-sneakers")
     * @Template("WebsiteBundle:Women:women_sneakers.html.twig")
     */

    public function sneakersAction()
    {
        $categoryId = 4;
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
     * @Route("/boots", name="women-boots")
     * @Template("WebsiteBundle:Women:women_boots.html.twig")
     */

    public function bootsAction()
    {
        $categoryId = 5;
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
     *@Route("/newest", name="women-newest")
     * @Template("WebsiteBundle:Women:women_new.html.twig")
     */

    public function whatsNewAction()
    {
        $category = 'FEM';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $newProducts = $repo->getNewestProducts($category);

        return
            [
                'products' => $newProducts
            ];
    }

}
