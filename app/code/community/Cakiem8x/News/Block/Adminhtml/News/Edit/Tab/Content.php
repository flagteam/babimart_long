<?php

/**
 * News List Admin edit form content tab
 * 
 * @author Van NH <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Block_Adminhtml_News_Edit_Tab_Content extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface {

    /**
     * Load WYSIWYG on demand and prepare layout
     * 
     * @return \Cakiem8x_News_Block_Adminhtml_News_Edit_Tab_Content
     */
    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }

        return $this;
    }

    protected function _prepareForm() {
        $model = Mage::getModel('cakiem8x_news')->getNewsItemInstance();
        /**
         * Checking if user have permission to save information
         */
        if (Mage::helper('cakiem8x_news/Admin')->isActionAllowed()) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = New Varien_Data_Form();
        $form->setHtmlIdPrefix('news_content_');
        $fieldset = $form->addFieldset('content_fieldset', array(
            'legend' => Mage::helper('cakiem8x_news')->__('Content')
            , 'class' => 'field-wide'
        ));

        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('tabl_id' => $this->getTabId()));
        $contentField = $fieldset->addField('content', 'editor', array(
            'name' => 'content'
            , 'style' => 'height: 36em'
            , 'require' => true
            , 'disabled' => $isElementDisabled
            , 'config' => $wysiwygConfig
        ));
        $renderer = $this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset_element')
                ->setTemplate('cms/page/edit/form/renderer/content.phtml');
        $contentField->setRenderer($renderer);

        $form->setValues($model->getData());
        $this->setForm($form);
        Mage::dispatchEvent('adminhtml_news_edit_tab_content_prepare_form', array('form' => $form));
        parent::_prepareForm();
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
     * Prepare title for tab
     * 
     * @return string
     */
    public function getTabLabel() {
        return Mage::helper('cakiem8x_news')->__('Content');
    }

    /*
     * Prepare title for tab
     * 
     * @return string
     */

    public function getTabTitle() {
        return Mage::helper('cakiem8x_news')->__('Content');
    }

    /**
     * Return flag about this tab hidden or not
     * 
     * @return boolean
     */
    public function isHidden() {
        return false;
    }

}