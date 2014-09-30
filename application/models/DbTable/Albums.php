<?php

class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{
    
    // Cette variable permet de recupérer le nom de la table albums de la BD
    protected $_name = 'albums';


    /**
     * [obtenirAlbum Cette fonction permet de retourner un album selon un id passer en paramètre]
     * @param  [type] $id [id de l'album qu'on recherche]
     * @return [type]     [toutes les informations sur l'album]
     */
    public function obtenirAlbum($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);

        //on retourne un message d'erreur en cas d'echec 
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }
     
    /**
     * [ajouterAlbum Cette fonction permet d'ajouter un album ]
     * @param  [type] $artiste [nom de l'artiste ]
     * @param  [type] $titre   [titre de l'album]
     * @return [type]          [true si l'insertion c'est bien derouler]
     */
    public function ajouterAlbum($artiste, $titre)
    {
        $data = array(
            'artiste' => $artiste,
            'titre' => $titre,
        );
        $this->insert($data);
    }
    
    /**
     * [modifierAlbum Cette fonction permet de mettre à jour les informations d'un album ]
     * @param  [type] $id      [Id de l'album]
     * @param  [type] $artiste [Nom de l'artiste]
     * @param  [type] $titre   [Titre de l'album]
     * @return [type]          [true si l'insertion c'est bien dérouler]
     */
    public function modifierAlbum($id, $artiste, $titre)
    {
        $data = array(
            'artiste' => $artiste,
            'titre' => $titre,
        );
        $this->update($data, 'id = '. (int)$id);
    }


    /**
     * [supprimerAlbum Cette fonction permet de supprimer un album ]
     * @param  [type] $id [id de l'album qu'on veut supprimer]
     * @return [type]     [True : si la suppression a reussi et false sinon]
     */
    public function supprimerAlbum($id)
    {
        $this->delete('id =' . (int)$id);
    }


}

