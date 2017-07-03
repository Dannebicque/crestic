<?php
/**
 * Created by PhpStorm.
 * User: D.ANNEBICQUE
 * Date: 31/05/2017
 * Time: 10:30
 */

namespace AppBundle\Services;

use AppBundle\Entity\MembresCrestic;
use Symfony\Component\Templating\EngineInterface;

class MyMailer
{
    protected $mailer;
    protected $templating;
    protected $from = 'intranet@crestic.univ-reims.fr';
    protected $name = 'Intranet CReSTIC';

    /**
     * MyMailer constructor.
     * @param \Swift_Mailer   $mailer
     * @param EngineInterface $templating
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;

        // Create the Transport
        //$transport = new \Swift_SmtpTransport('smtps.univ-reims.fr', 465, 'ssl');
        //        $transport->setUsername('annebi01@univ-reims.fr');
        //$transport->setPassword('krause59');

// Create the Mailer using your created Transport
        //$this->mailer = new \Swift_Mailer($transport);
    }

    protected function sendMessage(array $to, $subject, $template)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->from, $this->name)
            ->setTo($this->checkTo($to))
            ->setSubject($subject)
            ->setBody($template);
            //->setReplyTo($this->reply,$name)
            //->setContentType('text/html');
        $this->mailer->send($mail);

    }

    private function checkTo(array $mails)
    {
        $to = array();

        foreach ($mails as $m)
        {
            if (trim($m) != '' && $m !== null)
            {
                $to[] = trim($m);
            }
        }

        return $to;
    }

    public function sendMailFirstConnexion(MembresCrestic $user, $password)
    {
        $template = $this->templating->render('@App/Mails/login.txt.twig', array('user' =>$user));
        $this->sendMessage(array($user->getEmail()), 'Votre Login pour le site du CReSTIC', $template );
        $template = $this->templating->render('@App/Mails/password.txt.twig', array('user' =>$user, 'password' => $password));
        $this->sendMessage(array($user->getEmail()), 'Votre mot de passe pour le site du CReSTIC', $template );
    }
}