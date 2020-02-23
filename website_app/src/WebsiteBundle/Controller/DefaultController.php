<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @return Response
     */

    public function indexAction()
    {
        return $this->render('WebsiteBundle:Default:index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     *
     */

    public function aboutAction()
    {
        return $this->render('WebsiteBundle:Default:about.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     *
     */
    public function contactAction()
    {
        return $this->render('WebsiteBundle:Default:contact.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     *
     */

    public function faqAction()
    {
        ;
        return $this->render('WebsiteBundle:Default:faq.html.twig');
    }

    /**
     * @Route("/shipping-policy", name="shipping-policy")
     */

    public function shippingPolicyAction()
    {
        return $this->render('WebsiteBundle:Default:shipping_policy.html.twig');
    }

    /**
     * @Route("/return-policy", name="return-policy")
     */

    public function returnPolicyAction()
    {
        return $this->render('WebsiteBundle:Default:return_policy.html.twig');
    }

    /**
     * @Route("/size-chart", name="size-chart")
     *
     */

    public function sizeChartAction()
    {

        $womenSizes = new Converter(__DIR__ . "../../Resources/public/sizechart/women-sizes.txt");
        $size1 = $womenSizes->convert()->getData();
        $header = $womenSizes->getHeader();
        $menSizes = new Converter(__DIR__ . "../../Resources/public/sizechart/men-sizes.txt");
        $size2 = $menSizes->convert()->getData();

        return $this->render('WebsiteBundle:Default:size_chart.html.twig',
            [
                'womensizes' => $size1,
                'mensizes'   => $size2,
                'header'     => $header
            ]);
    }


    /**
     * @Route("/careers", name="careers", methods={"GET"})
     */

    public function careersAction()
    {

        return $this->render('WebsiteBundle:Default:careers.html.twig');
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
            $email = new Mailer($twig);
            $email->setClientEmail($clientEmail);
            $email->setClientFirstName($name);
            $email->setClientSurname($surname);
            $email->setPhoneNumber($phoneNumber);
            $email->setCareerOption($careerOption);
            $email->sendCareerEmailToClient();
            $email->setAttachmentPath($destination . "/" . $fileName);
            $email->sendCareerEmailToHandler();
            $success = 'Thank you for submitting your application!';
            unlink($destination . "/" . $fileName);

            return $this->render('WebsiteBundle:Default:careers.html.twig',
                ['success', $success]);
        }

        return $this->render('WebsiteBundle:Default:careers.html.twig', ['success' => $success]);

    }

    /**
     * @Route("/terms-of-use", name="terms-of-use")
     */

    public function termsOfUseAction()
    {

        return $this->render('WebsiteBundle:Default:terms_of_use.html.twig');
    }

    /**
     * @Route("/terms-of-sale", name="terms-of-sale")
     */

    public function termsOfSaleAction()
    {
        return $this->render('WebsiteBundle:Default:terms_of_sale.html.twig');
    }

    /**
     * @Route("/privacy-policy", name="privacy-policy")
     */

    public function privacyPolicyAction()
    {
        return $this->render('WebsiteBundle:Default:privacy_policy.html.twig');
    }

    /**
     * @Route("/promotion-rules", name="promotion-rules")
     */
    public function promotionRulesAction()
    {
        return $this->render('WebsiteBundle:Default:promotion_rules.html.twig');
    }

    /**
     * @Route("/consent-and-release-agreement", name="consent-and-release-agreement")
     */

    public function consentAgreementAction()
    {
        return $this->render('WebsiteBundle:Default:consent_agreement.html.twig');
    }

    /**
     * @Route("/search", name="search", methods={"POST"})
     * @param Request $request
     * @return Response
     */

    public function searchAction(Request $request)
    {
        $searchParam = $request->request->get('search');

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Product');
        $products = $repo->searchProducts($searchParam);

        return $this->render('WebsiteBundle:Default:search.html.twig', ['products' =>
            $products]);
    }

    /**
     * @Route("/account", name="account")
     * @param SessionInterface $session
     * @return Response
     */

    public function myAccountAction(SessionInterface $session)
    {
        $userId = $session->get('user');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:Orders');
        
        return $this->render('WebsiteBundle:Default:my_account.html.twig');
    }

    /**
     * @Route("/shopping-cart", name="shopping-cart" , methods={"GET", "POST"})
     * @param SessionInterface $session
     * @param Request $request
     * @return Response
     */

    public function shoppingCartAction(SessionInterface $session, Request $request)
    {
        $data = $session->get('shopping_cart');


        if (isset($_POST['delete'])) {
            $session->remove('shopping_cart');
            $deleteItem = strtoupper($request->request->get('productName'));
            unset($data[$deleteItem]);
            $session->set('shopping_cart', $data);
        }

        return $this->render('WebsiteBundle:Default:shopping_cart.html.twig',
            ['cart' => $data]);
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
     * @param SessionInterface $session
     * @param Request $request
     * @return Response
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
        return $this->render('WebsiteBundle:Default:checkout.html.twig', ['cart' => $data]);
    }

    /**
     * @Route("/best-sellers", name="best-sellers")
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

        foreach($bestSellers as $item) {
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

        return $this->render('WebsiteBundle:More:best_sellers.html.twig', ['items'=>$itemList]);
    }
}
