<?php

class Cakiem8x_HelloWorld_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function goodbyeAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function paramsAction() {

        $a = $this->getRequest()->getParam('a');
        var_dump($a) . '<br/>';

        echo '<dl>';
        foreach ($this->getRequest()->getParams() as $key => $value) {
            echo '<dt><strong>Param: </strong> ' . $key . '</dt>';
            echo '<dt><strong>Value: </strong> ' . $value . '</dt>';
        }
        echo '</dl>';
    }

}