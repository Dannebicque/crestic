<?php

namespace AppBundle\Controller\Visiteur;

use AppBundle\Entity\Agenda;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class PublicAgendaController
 * @package AppBundle\Controller
 * @Route("/agenda")
 */
class PublicAgendaController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="public_agenda")
     */
    public function indexAction()
    {
        $evt = $this->getDoctrine()->getRepository('AppBundle:Agenda')->findAll();
        return $this->render('@App/PublicAgenda/index.html.twig', [
            'evenements' => $evt
        ]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}", name="public_agenda_show")
     */
    public function showAction(Agenda $id)
    {
        return $this->render('AppBundle:PublicAgenda:show.html.twig', [
            'agenda' => $id
        ]);
    }
}
