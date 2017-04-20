<?php


namespace AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;

class ConfigurationManager {

    protected $em;
    protected $data = array();

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
        $configs = $this->em->getRepository('AppBundle:Configuration')->findAll();
        foreach ($configs as $c)
        {
            $this->data[$c->getCle()] = $c->getValue();
        }
    }

    public function getTelephonePrincipal()
    {
        return $this->getData('telephonePrincipal');
    }

    public function getFaxPrincipal()
    {
        return $this->getData('faxPrincipal');
    }

    public function getMail()
    {
        return $this->getData('mail');
    }

    public function getAdresse()
    {
        return $this->getData('adresse');
    }

    private function getData($cle)
    {
        if (array_key_exists($cle, $this->data))
        {
            return $this->data[$cle];
        } else
        {
            return '-';
        }
    }

//    public function getAdresse()
//    {
//        $config = $this->em->getRepository('AppBundle:Configuration')->findOneBy(array('cle'=>'adresse'));
//        $result = $config->getValue();
//        return $result;
//    }
//
//    public function getMail()
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'mail'));
//        $result = $config->getValue();
//        return $result;
//    }
//
//    public function getTexteAccueil()
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'texte-accueil'));
//        $result = $config->getValue();
//        return $result;
//    }
//
//    public function getTelephonePrincipale()
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'telephone_principale'));
//        $result = $config->getValue();
//        return $result;
//    }
//
//    public function getFaxPrincipal()
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'fax'));
//        $result = $config->getValue();
//        return $result;
//    }
//
//    public function getTypeStatusMembres()
//    {
//        $result = array();
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'type_status_membres'));
//        $array = json_decode($config->getValue());
//        foreach ($array as $key=>$value)
//        {
//            $result[$value] = $value;
//        }
//        return $result;
//    }
//
//    public function getIndexStatusMembres($status)
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'type_status_membres'));
//        $result = json_decode($config->getValue());
//        return array_search($status , $result);
//    }
//
//    public function getTypeResponsabilitesFonctions()
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'membresCrestic_responsabilite'));
//        $result = json_decode($config->getValue());
//        return $result;
//    }
//
//    public function getIndexResponsabilitesFonctions($status)
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'membresCrestic_responsabilite'));
//        $result = json_decode($config->getValue());
//        return array_search($status , $result);
//    }
//
//    public function getTypeDiplomesJuryRoles()
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'diplomes_diplomesJuryRoles'));
//        $result = json_decode($config->getValue());
//        return $result;
//    }
//
//    public function getArrayAgendaType()
//    {
//        $result = array();
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'agenda-type'));
//        $array = json_decode($config->getValue());
//        foreach ($array as $key=>$value)
//        {
//            $result[$value] = $value;
//        }
//        return $result;
//    }
//
//    public function getIndexArrayAgendaType($type)
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'agenda-type'));
//        $result = json_decode($config->getValue());
//        return array_search($type , $result);
//    }
//
//    public function getColorArrayAgendaType($type)
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'agenda-type-color'));
//        $result = json_decode($config->getValue());
//        return $result[$this->getIndexArrayAgendaType($type)];
//    }
//
//    public function getArrayDemandeOMEtatType()
//    {
//        $result = array();
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'demandeOM-type'));
//        $array = json_decode($config->getValue());
//        foreach ($array as $key=>$value)
//        {
//            $result[$value] = $value;
//        }
//        return $result;
//    }
//
//    public function getIndexArrayDemandeOMEtatType($type)
//    {
//        $config = $this->em->getRepository('CRESTICKernelBundle:Configuration')->findOneBy(array('cle'=>'demandeOM-type'));
//        $result = json_decode($config->getValue());
//        return $result[$this->getIndexArrayAgendaType($type)];
//    }
//
//    public function getOrganigramme()
//    {
//        $result = array(
//            'directeur'                 => $this->em->getRepository('CRESTICKernelBundle:Organigramme')->findAllOrganigramme('Directeur'),
//            'directeurAdjoint'          => $this->em->getRepository('CRESTICKernelBundle:Organigramme')->findAllOrganigramme('Directeur Adjoint'),
//            'conseilLaboratoire'        => $this->em->getRepository('CRESTICMembresBundle:MembresCrestic')->findAllConseilLaboratoire(),
//            'departement'               => $this->em->getRepository('CRESTICDepartementsBundle:Departements')->findAllDepartements(),
//            'equipe'                    => $this->em->getRepository('CRESTICEquipesBundle:Equipes')->findAllEquipes(),
//            'secretaire'                => $this->em->getRepository('CRESTICKernelBundle:Organigramme')->findAllOrganigramme('Secrétaire'),
//            'assistante'                => $this->em->getRepository('CRESTICKernelBundle:Organigramme')->findAllOrganigramme('assistante'),
//            'technicien'                => $this->em->getRepository('CRESTICKernelBundle:Organigramme')->findAllOrganigramme('Technicien'),
//        );
//        return $result;
//    }
}