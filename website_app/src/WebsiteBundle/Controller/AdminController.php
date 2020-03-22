<?php

namespace WebsiteBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @Template("WebsiteBundle:Admin:login.html.twig")
     */

    public function loginAction()
    {
    }

    /**
     * @Route("/dashboard", name="dashboard")
     * @Template("WebsiteBundle:Admin:dashboard.html.twig")
     * @throws Exception
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Orders');

        $year = date('Y');
        $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        $monthNames = [];
        foreach ($months as $month) {
            $revenue[$month] = $repo->getOrderTotal($year, $month);
            $dateObj =\DateTime::createFromFormat('!m',$month);
            $mName = $dateObj->format('M');
            $monthNames[] = $mName;
        }

        $monthTotal = [];

        foreach ($revenue as $key=>$month) {
            foreach ($month as $val) {
                if ($key == substr($val['CREATED_AT'], 5, 2)) {
                    if (!isset($monthTotal[$key])) {
                        $monthTotal[$key] = $val['total'];
                    }
                    else {
                        $monthTotal[$key] += $val['total'];
                    }
                }

            }
            if (empty($month)) {
                $monthTotal[$key] = 0;
            }
        }


        foreach ($monthNames as $k=>$v) {
            if ($k<9) {
                $data[$k] = [$v, $monthTotal['0'. strval($k+1)]];

            }

            elseif ($k == 9) {
                $data[$k] = [$v, $monthTotal['0'.strval($k)]];
            }

            else {
                $data[$k] = [$v, $monthTotal[$k]];
            }
        }

        //Fake data from previous year

        $lineChart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\LineChart();
        $lineChart->getData()->setArrayToDataTable(
            [
                ['Months', $year, strval($year-1)],
                [$monthNames[0], $monthTotal['01'], 200],
                [$monthNames[1], $monthTotal['02'], 356],
                [$monthNames[2], $monthTotal['03'], 500],
                [$monthNames[3], $monthTotal['04'], 104],
                [$monthNames[4], $monthTotal['05'], 180],
                [$monthNames[5], $monthTotal['06'], 832],
                [$monthNames[6], $monthTotal['07'], 1290],
                [$monthNames[7], $monthTotal['08'], 2500],
                [$monthNames[8], $monthTotal['09'], 4000],
                [$monthNames[9], $monthTotal['10'], 1235],
                [$monthNames[10], $monthTotal['11'], 5890],
                [$monthNames[11], $monthTotal['12'], 4500]
            ]
        );

        $lineChart->getOptions()->setTitle('Sales report');
        $lineChart->getOptions()->getTitleTextStyle()
                                ->setFontSize(16)
                                ->setColor('gray')
                                ->setBold(false);
        $lineChart->getOptions()->setHeight(400)
                                ->setWidth(700);
        $lineChart->getOptions()->getAnimation()
                                ->setStartup(true)
                                ->setDuration(300)
                                ->setEasing(1);
        $lineChart->getOptions()->getLegend()->setAlignment('top');
        $lineChart->getOptions()->getVAxis()
                                ->setFormat('currency');

        return
            [
                'linechart' => $lineChart
            ];
    }

    /**
     * @Route("/orders", name="orders")
     * @Template ("WebsiteBundle:Admin:orders.html.twig")
     */

    public function ordersAction()
    {
    }

    /**
     * @Route("/products", name="products")
     * @Template("WebsiteBundle:Admin:products.html.twig")
     * @param Request $request
     * @return array|RedirectResponse|JsonResponse
     */

    public function productsAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
            $q = $request->query->get('q');
            if ($q != '') {
                $em = $this->getDoctrine()->getManager();
                $repo = $em->getRepository('WebsiteBundle:Product');
                $result = $repo->searchProducts($q);

                return new JsonResponse(
                    [
                        'result' => $result
                    ]
                );
            }
        }

        $page = $request->query->get('page');

        if (isset($page) && is_numeric($page) && $page > 0) {
            $limit = 5;
            $start = ($page - 1) * $limit;
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('WebsiteBundle:Product');
            $products = $repo->getAllProducts($start, $limit);

            $numberOfProducts = $repo->createQueryBuilder('prod')
                                     ->select('count(prod.id)')
                                     ->getQuery()
                                     ->getSingleScalarResult();

            $numberOfPages = ceil($numberOfProducts / $limit);
            if ($page > $numberOfPages) {
                $url = $this->generateUrl('products');
                return $this->redirect($url . "?page=$numberOfPages");
            }
            return
                [
                    'products' => $products,
                    'totalPages' => $numberOfPages
                ];
        }
        $url = $this->generateUrl('products');
        return $this->redirect($url . "?page=1");

    }

    /**
     * @Route("/products/{prodName}", methods={"GET","POST"}, defaults={"prodName"="ANSARI"}, name="edit-product")
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
            'name' => $prodName
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

        return
            [
                'product' => $product
            ];
    }

    /**
     * @Route("/create-product", name="create-products", methods={"GET", "POST"})
     * @Template ("WebsiteBundle:Admin:create_products.html.twig")
     * @param Request $request
     * @return array|RedirectResponse
     * @throws Exception
     */

    public function createProductsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Categories');
        $data = $repo->getSubcategories();

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

            for ($i = 0; $i <= 1; $i++) {
                if ($i == 0) {
                    $photo = new Photo();
                    $photo->setPath($name . '-sm.jpg');
                    $photo->setProduct($newProduct);
                    $lastEm->persist($photo);
                    $lastEm->flush();

                } else {
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

        return
            [
                'subcategories' => $data,
                'lastSKU' => $lastSKU
            ];

    }

    /**
     * @Route("/discounts", name="discounts")
     * @Template("WebsiteBundle:Admin:discounts.html.twig")
     */

    public function discountsAction()
    {
    }

    /**
     * @Route("/reports", name="reports")
     * @Template("WebsiteBundle:Admin:reports.html.twig")
     */

    public function reportsAction()
    {
    }
}
