<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WebsiteBundle\DependencyInjection\Converter;


class DefaultController extends Controller
{
    /**
     * @Route("/",name="home")
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
        $menSizes= new Converter(__DIR__ . "../../Resources/public/sizechart/men-sizes.txt");
        $size2 = $menSizes->convert()->getData();

        return $this->render('WebsiteBundle:Default:size_chart.html.twig',
            ['womensizes'=>$size1,
             'mensizes'=>$size2]);
    }


    /**
     * @Route("/careers", name="careers")
     */

    public function careersAction ()
    {
        return $this->render('WebsiteBundle:Default:careers.html.twig');
    }

    /**
     * @Route("/terms-of-use", name="terms-of-use")
     */

    public function termsOfUseAction() {

        return $this->render('WebsiteBundle:Default:terms_of_use.html.twig');
    }

    /**
     * @Route("/terms-of-sale", name="terms-of-sale")
     */

    public function termsOfSaleAction() {
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
    public function promotionRulesAction ()
    {
        return $this->render('WebsiteBundle:Default:promotion_rules.html.twig');
    }

    /**
     * @Route("/consent-and-release-agreement", name="consent-and-release-agreement")
     */

    public function consentAgreementAction() {
        return $this->render('WebsiteBundle:Default:consent_agreement.html.twig');
    }
}
