<?php

namespace WebsiteBundle\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use WebsiteBundle\Entity\Photo;
use WebsiteBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{

    /**
     * @Route("/", name="login")
     */

    public function loginAction()
    {
        return $this->render('WebsiteBundle:Admin:login.html.twig');
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function indexAction()
    {
        return $this->render('WebsiteBundle:Admin:dashboard.html.twig');
    }

    /**
     * @return Response
     * @Route("/orders", name="orders")
     */

    public function ordersAction()
    {
        return $this->render('WebsiteBundle:Admin:orders.html.twig');
    }

    /**
     * @Route("/products", name="products")
     */

    public function productsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->getAllProducts();
        return $this->render('WebsiteBundle:Admin:products.html.twig', ['products'=>$products]);

    }

    /**
     * @Route("/products/edit/{prodName}", methods={"GET","POST"}, defaults={"prodName"="ANSARI"}, name="edit-product")
     * @Template("WebsiteBundle:Admin:individual_prod.html.twig")
     * @param Request $request
     * @param $prodName
     * @return array
     */
    public function oneProductAction(Request $request, $prodName)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $product = $repo->findOneBy([
            'name'=>$prodName
        ]);

        if (isset($_POST['save_changes'])) {
            $name = strtoupper(trim($request->request->get('name')));
            $price = trim($request->request->get('price'));
            $sku = trim($request->request->get('SKU'));
            $desc = $request->request->get('description');

            $product->setSku($sku);
            $product->setName($name);
            $product->setPrice($price);
            $product->setDescription($desc);
            $em->flush();

            $url = $this->generateUrl('edit-product');
            $this->redirect($url);
        }

        if (isset($_POST['delete_button'])) {
            $em->remove($product);
            $em->flush();

            $url = $this->generateUrl('products');
            $this->redirect($url);
        }

        return ['product'=>$product];
    }

    /**
     * @Route("/products/create", name="create-products", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */

    public function createProductsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Categories');
        $data = $repo->findAll();

        $newRepo = $em->getRepository('WebsiteBundle:Product');
        $lastSKU = $newRepo->getLastItem();

        if ($request->getMethod() === 'POST') {
            $name = strtoupper(trim($request->request->get('name')));
            $price = trim($request->request->get('price'));
            $sku = trim($request->request->get('SKU'));
            $description = $request->request->get('description');
            $categoryId = $request->request->get('category');
            $entityManager = $this->getDoctrine()->getManager();
            $repo = $entityManager->getRepository('WebsiteBundle:Categories');
            $category = $repo->find($categoryId);
            $now = new \DateTime();

            $product = new Product();
            $product->setName($name);
            $product->setPrice($price);
            $product->setDescription($description);
            if ($categoryId > 0 && $categoryId < 6) {
                $product->setSku('FEM' . $sku);
            } elseif ($categoryId == 7) {
                $product->setSku('KDB' . $sku);
            } elseif ($categoryId == 8) {
                $product->setSku('KDG' . $sku);
            } elseif ($categoryId > 9) {
                $product->setSku('MEN' . $sku);
            }
            $product->setCategory($category);

            $product->setCREATEDAT($now);

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $productId = $product->getId();

            $lastEm = $this->getDoctrine()->getManager();
            $lastRepo = $lastEm->getRepository('WebsiteBundle:Product');
            $newProduct = $lastRepo->find($productId);

            for ($i=0; $i<=1; $i++) {
                if ($i==0) {
                    $photo = new Photo();
                    $photo->setPath($name.'-sm.jpg');
                    $photo->setProduct($newProduct);
                    $lastEm->persist($photo);
                    $lastEm->flush();

                }
                else {
                    $photo = new Photo();
                    $photo->setPath($name . '-big.jpg');
                    $photo->setProduct($newProduct);
                    $lastEm->persist($photo);
                    $lastEm->flush();
                }
            }

            $url = $this->generateUrl('create-products');
            return $this->redirect($url);

        }

        return $this->render('WebsiteBundle:Admin:create_products.html.twig',
            ['categories' => $data,
             'lastSKU'=>$lastSKU]);

    }

    /**
     * @Route("/discounts", name="discounts")
     */

    public function discountsAction()
    {

        return $this->render('WebsiteBundle:Admin:discounts.html.twig');
    }

    /**
     * @Route("/reports", name="reports")
     */

    public function reportsAction()
    {

        return $this->render('WebsiteBundle:Admin:reports.html.twig');
    }


}
