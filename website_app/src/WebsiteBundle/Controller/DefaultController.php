<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use WebsiteBundle\DependencyInjection\Converter;
use WebsiteBundle\DependencyInjection\Mailer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WebsiteBundle\Entity\Orders;
use WebsiteBundle\Entity\Orders_Items;


class DefaultController extends Controller
{
    /**
     * @Route("/",name="home")
     * @Template("WebsiteBundle:Default:index.html.twig")
     */

    public function indexAction()
    {
    }

    /**
     * @Route("/about", name="about")
     * @Template("WebsiteBundle:Default:about.html.twig")
     */

    public function aboutAction()
    {
    }

    /**
     * @Route("/contact", name="contact")
     * @Template("WebsiteBundle:Default:contact.html.twig")
     */
    public function contactAction()
    {
    }

    /**
     * @Route("/faq", name="faq")
     * @Template("WebsiteBundle:Default:faq.html.twig")
     */

    public function faqAction()
    {
    }

    /**
     * @Route("/shipping-policy", name="shipping-policy")
     * @Template("WebsiteBundle:Default:shipping_policy.html.twig")
     */

    public function shippingPolicyAction()
    {
    }

    /**
     * @Route("/return-policy", name="return-policy")
     * @Template("WebsiteBundle:Default:return_policy.html.twig")
     */

    public function returnPolicyAction()
    {
    }

    /**
     * @Route("/size-chart", name="size-chart")
     * @Template("WebsiteBundle:Default:size_chart.html.twig")
     */

    public function sizeChartAction()
    {

        $womenSizes = new Converter(__DIR__ . "../../Resources/public/sizechart/women-sizes.txt");
        $size1 = $womenSizes->convert()->getData();
        $header = $womenSizes->getHeader();
        $menSizes = new Converter(__DIR__ . "../../Resources/public/sizechart/men-sizes.txt");
        $size2 = $menSizes->convert()->getData();

        return
            [
                'womensizes' => $size1,
                'mensizes' => $size2,
                'header' => $header
            ];
    }


    /**
     * @Route("/careers", name="careers", methods={"GET"})
     * @Template("WebsiteBundle:Default:careers.html.twig")
     */

    public function careersAction()
    {
    }

    /**
     * @Route("/careers", methods={"POST"})
     * @param Request $request
     * @return Response
     */

    public function careersSubmitAction(Request $request)
    {

        $name = trim($request->request->get('firstName'));
        $surname = trim($request->request->get('lastName'));
        $clientEmail = trim($request->request->get('email'));
        $phoneNumber = trim($request->request->get('phoneNumber'));
        $careerOption = $request->request->get('options');

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        if (!empty($uploadedFile)) {
            $destination = $this->getParameter('upload_directory');
            $extension = $uploadedFile->guessExtension();
            $fileName = "CV" . "_" . $name . "_" . $surname . "_" . uniqid() . '.' . $extension;
            $uploadedFile->move($destination, $fileName);
        }

        if ($request->getMethod() === 'POST' &&
            strlen($name) > 0 &&
            strlen($surname) > 0 &&
            strlen($clientEmail) > 5 &&
            strlen($phoneNumber) > 0 &&
            $careerOption != '' &&
            !empty($uploadedFile)) {

            $loader = new FilesystemLoader('bundles/website/email_twigs');
            $twig = new Environment($loader);
            $email = (new Mailer($twig,$this->container))->getSwiftInstance();
            $email->setEmail($clientEmail);
            $email->setName($name);
            $email->setSurname($surname);
            $email->setPhone($phoneNumber);
            $email->setCareerOption($careerOption);
            $email->sendToClient();
            $email->setPath($destination . "/" . $fileName);
            $email->sendToHandler();
            unlink($destination . "/" . $fileName);

            return $this->render('WebsiteBundle:Default:careers.html.twig');
        }

        return $this->render('WebsiteBundle:Default:careers.html.twig');
    }

    /**
     * @Route("/terms-of-use", name="terms-of-use")
     * @Template("WebsiteBundle:Default:terms_of_use.html.twig")
     */

    public function termsOfUseAction()
    {
    }

    /**
     * @Route("/terms-of-sale", name="terms-of-sale")
     * @Template("WebsiteBundle:Default:terms_of_sale.html.twig")
     */

    public function termsOfSaleAction()
    {
    }

    /**
     * @Route("/privacy-policy", name="privacy-policy")
     * @Template("WebsiteBundle:Default:privacy_policy.html.twig")
     */

    public function privacyPolicyAction()
    {
        ;
    }

    /**
     * @Route("/promotion-rules", name="promotion-rules")
     * @Template("WebsiteBundle:Default:promotion_rules.html.twig")
     */
    public function promotionRulesAction()
    {
    }

    /**
     * @Route("/consent-and-release-agreement", name="consent-and-release-agreement")
     * @Template("WebsiteBundle:Default:consent_agreement.html.twig")
     */

    public function consentAgreementAction()
    {
    }

    /**
     * @Route("/search", name="search", methods={"POST"})
     * @Template("WebsiteBundle:Default:search.html.twig")
     * @param Request $request
     * @return array
     */

    public function searchAction(Request $request)
    {
        $searchParam = $request->request->get('search');

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->searchProducts($searchParam);

        return
            [
                'products' => $products
            ];
    }

    /**
     * @Route("/account", name="account")
     * @Template("WebsiteBundle:Default:my_account.html.twig")
     */

    public function myAccountAction()
    {
    }

    /**
     * @Route("/shopping-cart", name="shopping-cart" , methods={"GET", "POST"})
     * @Template("WebsiteBundle:Default:shopping_cart.html.twig")
     * @param SessionInterface $session
     * @param Request $request
     * @return array|Response
     */

    public function shoppingCartAction(SessionInterface $session, Request $request)
    {
        $data = $session->get('shopping_cart');


        if ($request->isXmlHttpRequest()) {

            $session->remove('shopping_cart');
            $deleteItem = strtoupper($request->request->get('productName'));
            unset($data[$deleteItem]);
            $session->set('shopping_cart', $data);
        }

        return
            [
                'cart' => $data
            ];
    }

    /**
     * @Route("/logout", name="logout")
     * @param SessionInterface $session
     * @return Response
     */

    public function logoutAction(SessionInterface $session)
    {
        $session->remove('user');
        $session->remove('shopping_cart');
        $url = $this->generateUrl('home');
        return $this->redirect($url);
    }

    /**
     * @Route("/checkout", name="checkout", methods={"GET","POST"})
     * @Template("WebsiteBundle:Default:checkout.html.twig")
     * @param SessionInterface $session
     * @param Request $request
     * @return array|RedirectResponse
     */

    public function checkoutAction(SessionInterface $session, Request $request)
    {
        $data = $session->get('shopping_cart');
        $userId = $session->get('user');

        if ($request->getMethod() === 'POST') {

            $entMan = $this->getDoctrine()->getManager();
            $user = $entMan->getRepository('WebsiteBundle:User')->find($userId);

            $name = trim($request->request->get('firstName'));
            $surname = trim($request->request->get('lastName'));
            $email = trim($request->request->get('email'));
            $address1 = $request->request->get('address1');
            $address2 = $request->request->get('address2');
            $city = $request->request->get('city');
            $state = $request->request->get('state');
            $zipcode = trim($request->request->get('zipcode'));

            $order = new Orders();
            $order->setName($name);
            $order->setSurname($surname);
            $order->setEmail($email);
            $order->setAddress1($address1);
            $order->setAddress2($address2);
            $order->setCity($city);
            $order->setState($state);
            $order->setZipcode($zipcode);
            $order->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();


            foreach ($data as $value) {
                $item = new Orders_Items();
                $item->setOrder($order);
                $item->setQuantity($value['qty']);
                $item->setProductId($value['id']);
                $item->setPrice($value['price']);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($item);
                $entityManager->flush();

            }
            $session->remove('shopping_cart');
            $url = $this->generateUrl('home');
            return $this->redirect($url);

        }
        return
            [
                'cart' => $data
            ];
    }

    /**
     * @Route("/best-sellers", name="best-sellers")
     * @Template("WebsiteBundle:More:best_sellers.html.twig")
     * @return array
     */

    public function bestSellersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Orders_Items');
        $data = $repo->getBestTen();

        $bestSellers = [];

        foreach ($data as $value) {
            $obj = [];
            foreach ($value as $k => $v) {
                if ($k == 'product_id') {
                    $obj[$k] = $v;
                }
            }
            $bestSellers[] = $obj;
        }

        $info = [];

        foreach ($bestSellers as $item) {
            foreach ($item as $val) {
                $entityManager = $this->getDoctrine()->getManager();
                $repo = $entityManager->getRepository('WebsiteBundle:Product');
                $info [] = $repo->getBestSellers($val);
            }
        }

        $itemList = [];

        foreach ($info as $value) {
            foreach ($value as $v) {
                $itemList[] = $v;
            }
        }

        return
            [
                'items' => $itemList
            ];
    }
}
