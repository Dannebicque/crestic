<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MembresCrestic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UtilisateurController
 * @Route(path="/espace-utilisateur")
 */
class UtilisateurController extends Controller
{
    /**
     * @Route(path="/", name="homepage_utilisateur")
     */
    public function indexAction()
    {
        /** @var MembresCrestic $user */
        $user      = $this->getUser();
        $activites = $this->getDoctrine()->getRepository('AppBundle:Activites')->findLastActiviteMembre($user->getId());
        return $this->render('AppBundle:Utilisateur:index.html.twig', [
            'user'      => $user,
            'activites' => $activites
        ]);
    }
}
