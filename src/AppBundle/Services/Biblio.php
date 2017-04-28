<?php
/**
 * Created by PhpStorm.
 * User: D.ANNEBICQUE
 * Date: 21/04/2017
 * Time: 11:45
 */

namespace AppBundle\Services;


use Doctrine\ORM\EntityManager;

class Biblio
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var  Html */
    protected $html;

    public function __construct($_entityManager, $_html)
    {
        $this->entityManager = $_entityManager;
        $this->html = $_html;
    }

    public function formatIEEE($entity)
    {
        if ($entity !== null)
        {
            $result = '';

            $auteurs = $this->getAuteursIEEE($entity);
            $result .= $auteurs.', "'.$entity->getTitre().'"';


            switch ($this->getTypeOfEntity($entity))
            {
                case 'PublicationsBrevets':
                    if ($entity->getPays() !== null)
                    {
                        $result .= ', '.$entity->getPays()->getNomEn().' Patent';
                    }

                    if ($entity->getNumeroDelivrance() != '' && $entity->getNumeroDelivrance() != Null)
                    {
                        $result .= ', '.$entity->getNumeroDelivrance();
                    }

                    if ($entity->getMoisPublicationAbbrev() != '')
                    {
                        $result .= ', '.$entity->getMoisPublicationAbbrev();
                    }

                    if ($entity->getAnneePublication() != '' && $entity->getAnneePublication() != 0)
                    {
                        $result .= ', '.$entity->getAnneePublication();
                    }

                    break;
                case 'PublicationsTheses':
                    $result .= 'M.S. thesis';
                    if ($entity->getAbbrevDepartement() != '')
                    {
                        $result .= ', '.$entity->getAbbrevDepartement();
                    } elseif ($entity->getDepartement() != '')
                    {
                        $result .= ', '.$entity->getDepartement();
                    }

                    if ($entity->getAbbrevUniversite() != '')
                    {
                        $result .= ', '.$entity->getAbbrevUniversite();
                    } elseif ($entity->getUniversite() != '')
                    {
                        $result .= ', '.$entity->getUniversite();
                    }

                    if ($entity->getVille() != '')
                    {
                        $result .= ', '.$entity->getVille();
                    }

                    if ($entity->getPays() != null)
                    {
                        $result .= ', '.$entity->getPays()->getNomEn();
                    }

                    if ($entity->getAnneePublication() != '' && $entity->getAnneePublication() != 0)
                    {
                        $result .= ', '.$entity->getAnneePublication();
                    } else if ($entity->getDateSoutenance() != null && $entity->getDateSoutenance() != '' &&  $entity->getDateSoutenance() != '0000-00-00')
                    {
                        $result .= ', '.$entity->getDateSoutenance()->format('Y');
                    }
                    break;
                case 'PublicationsChapitres':

                    break;
                case 'PublicationsConferences':
                    if ($entity->getConference() !== null)
                    {
                        $result .= ' in <i>'.$entity->getConference()->getSigleConference().'</i>';

                        if ($entity->getConference()->getVille() != '')
                        {
                            $result .= ', '.$entity->getConference()->getVille();
                        }

                        if ($entity->getConference()->getPays() != null)
                        {
                            $result .= ', '.$entity->getConference()->getPays()->getNomEn();
                        }

                        if ($entity->getAnneePublication() != '' && $entity->getAnneePublication() != 0)
                        {
                            $result .= ', '.$entity->getAnneePublication();
                        }

                        if ($entity->getPagination() != '')
                        {
                            $result .= ', '.$entity->getPagination();
                        }
                    } else
                    {
                        $result .= '#erreur conf#';
                    }
                    break;
                case 'PublicationsOuvrages':
                    $result .= ' in <i>'.$entity->getTitreOuvrage().'</i>, x th ed.';
                    if ($entity->getEditeur() !== null)
                    {
                        if ($entity->getEditeur()->getVille() != '')
                        {
                            $result .= ', '.$entity->getEditeur()->getVille();
                        }

                        if ($entity->getEditeur()->getPays() !== null)
                        {
                            $result .= ', '.$entity->getEditeur()->getPays()->getNomEn();
                        }

                        if ($entity->getEditeur()->getNom() != '')
                        {
                            $result .= ': '.$entity->getEditeur()->getNom();
                        }
                    } else
                    {
                        $result .= ' #err. editeur# ';
                    }

                    if ($entity->getAnneePublication() != '' && $entity->getAnneePublication() != 0)
                    {
                        $result .= ', '.$entity->getAnneePublication();
                    }

                    if ($entity->getPagination() != '')
                    {
                        $result .= ', '.$entity->getPagination();
                    }

                    break;
                case 'PublicationsRapports':
                    if ($entity->getAbbrevCompany() != '')
                    {
                        $result .= ', '.$entity->getAbbrevCompany();
                    }

                    if ($entity->getVille() != '')
                    {
                        $result .= ', '.$entity->getVille();
                    }

                    if ($entity->getAnneePublication() != '' && $entity->getAnneePublication() != 0)
                    {
                        $result .= ', '.$entity->getAnneePublication();
                    }
                    break;
                case 'PublicationsRevues':
                    if ($entity->getRevue() != null)
                    {

                        //A.J. Jakeman, Elsevier, Environmental Modelling & Software

                        if ($entity->getRedacteurChef() != '')
                        {
                            $result .= ', '.$entity->getRedacteurChef();
                        }

                        if ($entity->getRevue()->getEditeur() != null)
                        {
                            $result .= ', '.$entity->getRevue()->getEditeur()->getNom();
                        }

                        if ($entity->getRevue()->getSigleRevue() != '')
                        {
                            $result .= ', '.$entity->getRevue()->getSigleRevue();
                        } else
                        {
                            $result .= ', '.$entity->getRevue()->getTitreRevue();
                        }

                        if ($entity->getVolume() != '')
                        {
                            $result .= ', '.$entity->getVolume();

                            if ($entity->getNumero() != '')
                            {
                                $result .= '('.$entity->getNumero().')';
                            }

                            if ($entity->getPagination() != '')
                            {
                                $result .= ':'.$entity->getPagination();
                            }
                        } else
                        {
                            if ($entity->getPagination() != '')
                            {
                                $result .= ', pp. '.$entity->getPagination();
                            }
                        }





                        if ($entity->getMoisPublicationAbbrev() != '')
                        {
                            $result .= ', '.$entity->getMoisPublicationAbbrev();
                            if ($entity->getAnneePublication() != '')
                            {
                                $result .= ' '.$entity->getAnneePublication();
                            }
                        } else
                        {
                            if ($entity->getAnneePublication() != '')
                            {
                                $result .= ', '.$entity->getAnneePublication();
                            }
                        }


                    } else
                    {
                        $result .= '#erreur Revue#';
                    }
                    break;
            }
            $result .= '.';

            return $result;
        } else
        {
            return '#-#';
        }
    }

    private function getAuteursIEEE($entity)
    {
        $result = '';

        $array_auteurs = $this->getAuteurs($entity);

        if (array_key_exists ('auteur' , $array_auteurs))
        {
            $auteurs = $array_auteurs['auteur'];
            if (count($auteurs) > 2)
            {
                $result =  $auteurs[0].', '.$auteurs[1].', <i> et al.</i>';
            }
            else
            {
                $result = implode(', ', $auteurs);
            }
        }
        return $result;
    }

    private function getAuteurs($entity)
    {
        $auteurs = $this->entityManager->getRepository('AppBundle:PublicationsHasMembres')->findBy(array('publication' => $entity->getId()), array('position' => 'ASC'));
        $tAuteurs = array();
        $i = 0;
        foreach ($auteurs as $auteur)
        {
            if ($auteur->getMembreCrestic() !== null && $auteur->getMembreExterieur() === null)
            {
                $tAuteurs['auteur'][$i]     = $this->html->linkAuteur($auteur->getMembreCrestic(), $auteur->getMembreCrestic()->getAuteurIEEE());
                $tAuteurs['auteurLien'][$i] = $this->html->linkAuteur($auteur->getMembreCrestic());
                $i++;
            } elseif ($auteur->getMembreExterieur() !== null && $auteur->getMembreCrestic() === null)
            {
                $tAuteurs['auteur'][$i]     = $auteur->getMembreExterieur()->getAuteurIEEE();
                $tAuteurs['auteurLien'][$i] = $auteur->getMembreExterieur()->getAuteurIEEE();
                $i++;
            } else
            {
                $tAuteurs[] = '#-#';
            }

        }

        // a tester la taille, uniquement deux auteurs
        return $tAuteurs;
    }

    /**
     * @param $entity
     * @return null|string
     */
    private function getTypeOfEntity ($entity)
    {

        $result = null;

        $type = str_replace ( "Proxies\\__CG__\\","",get_class($entity));

        switch ($type)
        {


            case 'AppBundle\Entity\PublicationsBrevets' :
            {
                $result = 'PublicationsBrevets';
                break;
            }

            case 'CAppBundle\Entity\PublicationsChapitres' :
            {
                $result = 'PublicationsChapitres';
                break;
            }

            case 'AppBundle\Entity\PublicationsConferences' :
            {
                $result = 'PublicationsConferences';
                break;
            }

            case 'AppBundle\Entity\PublicationsOuvrages':
            {
                $result = 'PublicationsOuvrages';
                break;
            }

            case 'AppBundle\Entity\PublicationsRapports' :
            {
                $result = 'PublicationsRapports';
                break;
            }

            case 'AppBundle\Entity\PublicationsRevues' :
            {
                $result = 'PublicationsRevues';
                break;
            }

            case 'AppBundle\Entity\PublicationsTheses' :
            {
                $result = 'PublicationsTheses';
                break;
            }

            default:
            {
                echo 'kernel.types : getTypeOfEntity '.$type.' incconu !!!';
                break;
            }


        }
        return $result;
    }

    public function formatBibtex($publication)
    {
        return 'bibtex';
    }

    public function getAllAuteurs()
    {

    }
}