<?php
/**
 * Created by PhpStorm.
 * User: davidannebicque
 * Date: 03/07/2017
 * Time: 22:14
 */

namespace DA\KernelBundle\Entity;

/**
 * Class Configuration
 * @package DA\KernelBundle\Entity
 */
class Data
{


    const TAB_STATUS = array(
        array('code' => 'PR', 'libelle' => 'Professeurs'),
        array('code' => 'MCF', 'libelle' => 'Maîtres de Conférences'),
        array('code' => 'PUPH', 'libelle' => 'Prof. Praticien Hospitalier'),
        array('code' => 'MCUPH', 'libelle' => 'MCF Praticien Hospitalier'),
        array('code' => 'CAS', 'libelle' => 'Chercheurs Associés'),
        array('code' => 'ING', 'libelle' => 'Ingénieurs et techniciens'),
        array('code' => 'PAST', 'libelle' => 'PAST/MAST'),
        array('code' => 'PDOC', 'libelle' => 'ATER, Post-Doctorants, Ingénieurs contractuels'),
        array('code' => 'DOC', 'libelle' => 'Doctorants'),
        array('code' => 'ADM', 'libelle' => 'Personnels administratifs'),
    );

}
