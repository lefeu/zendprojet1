<?php

class CRUDController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        

          $albums = new Application_Model_DbTable_Albums();

          // je crée une variable albums sur ma vue index auqxquelles j'affecte la liste des albums
          $this->view->albums = $albums->fetchAll();
    }

    public function ajouterAction()
    {
        
              // Instantiation du formulaire 
              $form = new Application_Form_Album();
              $form->envoyer->setLabel('Ajouter');

              //creation d'une variable form sur nla vue ajouter
              $this->view->form = $form;
               
               // Si le méthod du formualrre est post 
               
              if ($this->getRequest()->isPost()) {
                     $formData = $this->getRequest()->getPost();
                     // verification si toutes les chmaps obigtoires sont remplis
                     if ($form->isValid($formData)) {
                        // recupération des valeurs du formulaires 
                         $artiste = $form->getValue('artiste');
                         $titre = $form->getValue('titre');
                        // on fait apple au model qui va permettre d'insérer les données en base 
                        $albums = new Application_Model_DbTable_Albums();
                        $albums->ajouterAlbum($artiste, $titre);
                        
                        // redirection vers la vue index
                        $this->_helper->redirector('index');
                    } else {

                     // Si les données du formulaire ne sont pas valides, nous le remplissons avec 
                     // les données fournies et nous l'affichons à nouveau
                     $form->populate($formData);
                    }
             }   // end if ($this->getRequest()->isPost())

    }

    public function modifierAction()
    {
        

        $form = new Application_Form_Album();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $artiste = $form->getValue('artiste');
                $titre = $form->getValue('titre');
                $albums = new Application_Model_DbTable_Albums();
                $albums->modifierAlbum($id, $artiste, $titre);

               $this->_helper->redirector('index');
            } else {
               $form->populate($formData);
              }
       } else {
             $id = $this->_getParam('id', 0);
             if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->obtenirAlbum($id));
             }
        }
    }

    public function supprimerAction()
    {
         if ($this->getRequest()->isPost()) {
                $supprimer = $this->getRequest()->getPost('supprimer');
               if ($supprimer == 'Oui') {
                   $id = $this->getRequest()->getPost('id');
                   $albums = new Application_Model_DbTable_Albums();
                   $albums->supprimerAlbum($id);
               }

               $this->_helper->redirector('index');
        } else {
               $id = $this->_getParam('id', 0);
               $albums = new Application_Model_DbTable_Albums();
              $this->view->album = $albums->obtenirAlbum($id);
            }
    }


}







