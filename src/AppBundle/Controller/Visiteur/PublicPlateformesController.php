<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PublicPlateformesController
 * @package AppBundle\Controller
 * @Route("/plateformes")
 */
class PublicPlateformesController extends Controller
{
    /**
     * @Route("/{slug}", name="public_plateformes_profil")
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilAction($slug)
    {
        $plateforme = $this->getDoctrine()->getRepository('AppBundle:Plateformes')->findOneBy(array('slug' => $slug));

        if ($plateforme)
        {
            $sliders = $this->getDoctrine()->getRepository('AppBundle:PlateformesHasSliders')->findAllSliderFromPlateforme($plateforme->getId());
            $projets = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPlateformes')->findAllProjetsFromPlateforme($plateforme->getId());
            $publications = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasPlateformes')->findLastPublicationsFromPlateforme($plateforme->getId(), 3);

            return $this->render('AppBundle:PublicPlateformes:profil.html.twig', array(
                'plateforme' => $plateforme,
                'sliders'    => $sliders,
                'projets'    => $projets,
                'publications' => $publications
            ));
        } else
        {
            throw new NotFoundHttpException("Page not found");
        }

    }

}
