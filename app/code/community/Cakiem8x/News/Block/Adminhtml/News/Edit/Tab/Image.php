<?php

class Cakiem8x_News_Block_Adminhtml_News_Edit_Tab_Image extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface {

    protected function _prepareForm() {

        if (Mage::helper('cakiem8x_news/Admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('news_image_');

        $model = Mage::getModel('cakiem8x_news')->getNewsItemInstance();
        $fieldset = $form->addFieldset('image_fieldset', array(
            'legend' => Mage::helper('cakiem8x_news')->__('Image thumbnail')
            , 'class' => 'field-wide'
        ));

        $this->_addElementTypes($fieldset);
        $fieldset->addField('image', 'image', array(
            'name' => 'image'
            , 'label' => Mage::helper('cakiem8x_news')->__('Image')
            , 'title' => Mage::helper('cakiem8x_news')->__('Image')
            , 'required' => false
            , 'disabled' => $isElementDisabled
        ));

        Mage::dispatchEvent('adminhtml_news_edit_tab_image_prepare_form', array('form' => $form));
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Return status flag about this tab can be show or not
     * 
     * @return boolean
     */
    public function canShowTab() {
        return true;
    }

    /**
     * Prepare label for tab
     * 
     * @return string
     */
    public function getTabLabel() {
        return Mage::helper('cakiem8x_news')->__('Image Thumbnail');
    }

    /**
     * Prepare title for tab
     * 
     * @return string
     */
    public function getTabTitle() {
        return Mage::helper('cakiem8x_news')->__('Image Thumbnail');
    }

    /**
     * Return flag status about thi tab hidden or not
     * 
     * @return boolean
     */
    public function isHidden() {
        return false;
    }

    /**
     * Retrieve predefined additional element types
     * 
     * @return array
     */
    protected function _getAdditionalElementTypes() {
        return array(
            'image' => Mage::getConfig()
                    ->getBlockClassName('cakiem8x_news/adminhtml_news_edit_form_element_image')
        );
    }

}