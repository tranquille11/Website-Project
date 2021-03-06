<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @Template("WebsiteBundle:Default:login.html.twig")
     * @param Request $request
     * @param SessionInterface $session
     * @return array|RedirectResponse
     */

    public function loginAction(Request $request, SessionInterface $session)
    {
        $email = trim($request->request->get('email'));
        $password = trim($request->request->get('password'));


        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('WebsiteBundle:User');
        $user = $repo->findOneBy(
            [
                'email' => $email,

            ]);

        if (!$user) {
            $success = false;
            return
                [
                    'success' => $success
                ];
        }
        elseif (password_verify($password, $user->getPassword())) {
            $session->set('user', $user->getId());

            $url = $this->generateUrl('home');
            return $this->redirect($url);
        }

        return
            [
                'message'=>'Please enter correct password'
            ];

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
     * @Template("WebsiteBundle:Default:register.html.twig")
     * @param Request $request
     * @return array|RedirectResponse
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
            $encryptedPass = password_hash($password, PASSWORD_BCRYPT);
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

        return [];
    }
}
