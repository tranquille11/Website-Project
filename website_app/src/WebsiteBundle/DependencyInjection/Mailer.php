<?php

namespace WebsiteBundle\DependencyInjection;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Environment;
use Swift_Attachment;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Mailer
{
    private $name;
    private $surname;
    private $phone;
    private $email;
    private $careerOption;
    private $path;
    private $twig;
    private $container;
    private $mailer;

    private static $handler = 'vladenache93@gmail.com';
    private $admin;
    private $password;
    private $host;

    public function __construct(Environment $twig, ContainerInterface $container)
    {
        $this->twig = $twig;
        $this->container = $container;
        $this->host = $this->container->getParameter('mailer_host');
        $this->admin = $this->container->getParameter('mailer_user');
        $this->password = $this->container->getParameter('mailer_password');
    }

    public function getSwiftInstance()
    {
        $transport = (Swift_Smtptransport::newInstance(
            $this->host, '587', 'tls'))
            ->setUsername($this->admin)
            ->setPassword($this->password);
        $this->mailer = Swift_Mailer::newInstance($transport);
        return $this;
    }

    public function sendToClient()
    {
        try {
            $message = (new Swift_Message('Your Vlad Ltd. Job Application'))
                ->setFrom($this->admin, 'Vlad Ltd.')
                ->setTo($this->email)
                ->setBody($this->twig->render('career_client_email.html.twig',
                    ['clientFirstName' => $this->name]),

                    'text/html'
                );
            $this->mailer->send($message);
        } catch (LoaderError $e) {
            echo $e->getMessage();
        } catch (RuntimeError $e) {
            echo $e->getMessage();
        } catch (SyntaxError $e) {
            echo $e->getMessage();
        }
    }

    public function sendToHandler()
    {
        try {
            $message = (new Swift_Message('Web Job Application'))
                ->setFrom($this->admin, 'Vlad Ltd.')
                ->setTo(self::$handler)
                ->attach(Swift_Attachment::fromPath($this->path))
                ->setBody($this->twig->render('career_admin_email.html.twig',
                    [
                        'clientFirstName' => $this->name,
                        'clientLastName' => $this->surname,
                        'clientEmail' => $this->email,
                        'careerOption' => $this->careerOption,
                        'phoneNumber' => $this->phone
                    ]),

                    'text/html'
                );

            $this->mailer->send($message);
        } catch (LoaderError $e) {

            echo $e->getMessage();
        } catch (RuntimeError $e) {
            echo $e->getMessage();
        } catch (SyntaxError $e) {
            echo $e->getMessage();
        }
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setCareerOption(string $careerOption)
    {
        $this->careerOption = $careerOption;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
    }




}