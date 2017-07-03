<?php

namespace AppBundle\Controller\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PublicProjetsController
 * @package AppBundle\Controller
 * @Route("/projets")
 */
class PublicProjetsController extends Controller
{
    /**
     * @Route("/{slug}", name="public_projet_profil")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilAction($slug)
    {
        $projet = $this->getDoctrine()->getRepository('AppBundle:Projets')->findOneBy(array('slug' => $slug));

        if ($projet)
        {
            $membres      = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasMembres')->findAllMembresFromProjet($projet->getId());
            $partenaires  = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasPartenaires')->findAllPartenairesFromProjet($projet->getId());
            $sliders      = $this->getDoctrine()->getRepository('AppBundle:ProjetsHasSliders')->findAllSliderFromProjet($projet->getId());
            $publications = $this->getDoctrine()->getRepository('AppBundle:PublicationsHasProjets')->findAllPublicationsFromProjet($projet->getId());

            return $this->render('AppBundle:PublicProjets:profil.html.twig', array(
                'projet'       => $projet,
                'membres'      => $membres,
                'partenaires'  => $partenaires,
                'sliders'      => $sliders,
                'publications' => $publications
            ));
        } else
        {
            throw new NotFoundHttpException("Page not found");
        }
    }

}
