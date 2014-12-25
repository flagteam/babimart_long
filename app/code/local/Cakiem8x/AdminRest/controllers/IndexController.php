<?php

class Cakiem8x_AdminRest_IndexController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
        $this->loadLayout();

        $this->_addLeft($this->getLayout()->createBlock('core/text')->setText('Left block'));
        $block = $this->getLayout()->createBlock('core/text')
                ->setText('<h1>Main block</h1>');

        $this->_addContent($block);

//        $blockJs = $this->getLayout()->createBlock('core/text')->setText('<script type="text/javascript">alert("foo");</script>');
//        $this->_addJs($blockJs);

        $this->_setActiveMenu('tutorial_menu/first_page');

        $this->renderLayout();
    }

    public function aclAction() {
        $resources = Mage::getModel('admin/roles')->getResourcesTree();
        $nodes = $resources->xpath('//*[@aclpath]');

        echo '<dl>';
        foreach ($nodes as $node) {
            echo '<dt>' . strval($node->title) . '</dt>';
            echo '<dd>' . $node->getAttribute('aclpath') . '</dd>';
        }
        echo '</dl>';
    }

}
