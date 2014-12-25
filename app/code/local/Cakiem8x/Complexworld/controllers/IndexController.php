<?php

class Cakiem8x_Complexworld_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $blogpost = Mage::getModel('complexworld/eavblogpost');
        $blogpost->load(1);
        var_dump($blogpost);
    }

    public function populateEntriesAction() {
        for ($i = 0; $i < 10; $i++) {
            $weblog2 = Mage::getModel('complexworld/eavblogpost');
            $weblog2->setTitle('This is a test ' . $i);
            $weblog2->save();
        }

        echo 'Done';
    }

    public function showCollectionAction() {
        $weblogpost = Mage::getModel('complexworld/eavblogpost');

        $entities = $weblogpost->getCollection()->addAttributeToSelect('title');
        $entities->load();

        foreach ($entities as $entity) {
            echo '<h3>' . $entity->getTitle() . '</h3>';
        }

        echo '<br/>Done</br/>';
    }

}