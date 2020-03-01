<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use WebsiteBundle\Entity\User;
use WebsiteBundle\WebsiteBundle;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AuthenticationController extends Controller
{

    /**
     * @Route("/login", name="login", methods={"GET"})
     * @Template("WebsiteBundle:Default:login.html.twig")
     */

    public function loginViewAction()
    {
    }

    /**
     * @Route("/login", methods={"POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */

    public function loginAction(Request $request, SessionInterface $session)
    {
        $email = trim($request->request->get('email'));
        $password = trim($request->request->get('password'));
        $encryptedPass = md5($password);

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:User');
        $user = $repo->findOneBy(
            [
                'email' => $email,
             'password' => $encryptedPass

            ]);

        if (!$user) {
            $success = false;
            return $this->render('WebsiteBundle:Default:login.html.twig',['success'=>$success]);
        }

        $session->set('user', $user->getId());

        $url = $this->generateUrl('home');
        return $this->redirect($url);
    }

    /**
     * @Route("/register", name="register", methods={"GET"})
     * @Template("WebsiteBundle:Default:register.html.twig")
     *
     */

    public function registerViewAction()
    {
    }

    /**
     * @Route("/register", methods={"POST"})
     * @param Request $request
     * @return Response
     */

    public function registerAction(Request $request)
    {
        $name = trim($request->request->get('name'));
        $surname = trim($request->request->get('surname'));
        $email = trim($request->request->get('email'));
        $password = trim($request->request->get('password'));


        if (preg_match('/(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W)/',
                $password) && $name !=
            '' &&
            filter_var($email, FILTER_VALIDATE_EMAIL) && $surname != '') {
            $encryptedPass = md5($password);
            $user = new User();
            $user->setName($name);
            $user->setSurname($surname);
            $user->setEmail($email);
            $user->setPassword($encryptedPass);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $url = $this->generateUrl('login');
            return $this->redirect($url);
        }

        return $this->render('WebsiteBundle:Default:register.html.twig');
    }
}
