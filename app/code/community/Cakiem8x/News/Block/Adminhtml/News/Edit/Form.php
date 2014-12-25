<?php

/**
 * News List Admin edit form
 * 
 * @author Van Nh <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Block_Adminhtml_News_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Prepare form action
     * 
     * @return Cakiem8x_News_Block_Adminhtml_News_Form
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form'
            , 'action' => $this->getUrl('*/*/save')
            , 'method' => 'post'
            , 'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}