<?php
/**
 * Created by PhpStorm.
 * User: davidannebicque
 * Date: 03/07/2017
 * Time: 22:14
 */

namespace AppBundle\Entity;

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
        array('code' => 'MCUP', 'libelle' => 'MCF Praticien Hospitalier'),
        array('code' => 'CAS', 'libelle' => 'Chercheurs Associés'),
        array('code' => 'ING', 'libelle' => 'Ingénieurs et techniciens'),
        array('code' => 'PAST', 'libelle' => 'PAST/MAST'),
        array('code' => 'PDOC', 'libelle' => 'ATER, Post-Doctorants, Ingénieurs contractuels'),
        array('code' => 'DOC', 'libelle' => 'Doctorants URCA'),
        array('code' => 'DOCH', 'libelle' => 'Doctorants Hors URCA'),
        array('code' => 'ADM', 'libelle' => 'Personnels administratifs'),
    );

    const TAB_STATUS_FORM = array(
        '' => '',
        'Professeurs' => 'PR',
        'Maîtres de Conférences' => 'MCF',
        'Prof. Praticien Hospitalier' => 'PUPH',
        'MCF Praticien Hospitalier' => 'MCUP',
        'Chercheurs Associés' => 'CAS',
        'Ingénieurs et techniciens' => 'ING',
        'PAST/MAST' => 'PAST',
        'ATER, Post-Doctorants, Ingénieurs contractuels' => 'PDOC',
        'Doctorants URCA' => 'DOC',
        'Doctorants Hors URCA' => 'DOCH',
        'Personnels administratifs' => 'ADM',
    );

    const TAB_ORGANIGRAMME = array(
        "Directeur" => "Directeur",
        "Directeur Adjoint" => "Directeur Adjoint",
        "Secrétaire" => "Secrétaire",
        "Technicien" => "Technicien"
    );


}
