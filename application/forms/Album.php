<?php

class Application_Form_Album extends Zend_Form
{  

	// Initialisatioon du formulaire d'ajout ou de modification d'un album

    public function init()
    {
        

        $this->setName('album');


        //ajout de l'id caché 
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');


        // Ajout d'une zone texte  pour le nom d'artiste 

        $artiste = new Zend_Form_Element_Text('artiste');
        $artiste->setLabel('Artiste')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        //Ajout d'un objet zend texte sur le formulaire 
        $titre = new Zend_Form_Element_Text('titre');
        $titre->setLabel('Titre')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        // Ajout d'un bouton envoyer sur le formulaire 
        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($id, $artiste, $titre, $envoyer));
    }
    


}

