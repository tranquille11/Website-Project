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


class Mailer
{
    private $clientFirstName;
    private $clientSurname;
    private $phoneNumber;
    private $clientEmail;
    private $careerOption;
    private $path;
    private $twig;

    private static $handler = 'vladenache93@gmail.com';
    private static $admin = 'evlad3201@gmail.com';
    private static $password = 'Axtb670990!';
    private static $host = 'smtp.gmail.com';
    private static $security = 'tls';
    private static $port = 587;

    public function __construct(Environment $twig)
    {

        $this->twig = $twig;

    }

    public function sendCareerEmailToClient()
    {
        $transport = (Swift_Smtptransport::newInstance(self::$host, self::$port,
        self::$security))
            ->setUsername(self::$admin)
            ->setPassword(self::$password);
        $mailer = Swift_Mailer::newInstance($transport);

        try {
            $message = (new Swift_Message('Your Vlad Ltd. Job Application'))
                ->setFrom(self::$admin, 'Vlad Ltd.')
                ->setTo($this->clientEmail)
                ->setBody($this->twig->render('career_client_email.html.twig',
                    ['clientFirstName' => $this->clientFirstName]),

                    'text/html'
                );
            $mailer->send($message);
        } catch (LoaderError $e) {
            echo $e->getMessage();
        } catch (RuntimeError $e) {
            echo $e->getMessage();
        } catch (SyntaxError $e) {
            echo $e->getMessage();
        }
    }

    public function sendCareerEmailToHandler()
    {
        $transport = (Swift_Smtptransport::newInstance(self::$host, self::$port,
            self::$security))
            ->setUsername(self::$admin)
            ->setPassword(self::$password);
        $mailer = Swift_Mailer::newInstance($transport);

        try {
            $message = (new Swift_Message('Web Job Application'))
                ->setFrom(self::$admin, 'Vlad Ltd.')
                ->setTo(self::$handler)
                ->attach(Swift_Attachment::fromPath($this->path))
                ->setBody($this->twig->render('career_admin_email.html.twig',
                    [
                     'clientFirstName' => $this->clientFirstName,
                     'clientLastName' => $this->clientSurname,
                     'clientEmail' => $this->clientEmail,
                     'careerOption'=> $this->careerOption,
                     'phoneNumber' => $this->phoneNumber
                    ]),

                    'text/html'
                );
            $mailer->send($message);
        } catch (LoaderError $e) {
            echo $e->getMessage();
        } catch (RuntimeError $e) {
            echo $e->getMessage();
        } catch (SyntaxError $e) {
            echo $e->getMessage();
        }
    }

    public function setClientFirstName($clientFirstName)
    {
        $this->clientFirstName = $clientFirstName;
    }

    public function setClientSurname($clientSurname)
    {
        $this->clientSurname = $clientSurname;
    }

    public function setClientEmail($clientEmail) {
        $this->clientEmail = $clientEmail;
    }

    public function setCareerOption($careerOption)
    {
        $this->careerOption = $careerOption;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setAttachmentPath($path)
    {
        $this->path = $path;
    }

}