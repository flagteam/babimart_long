<?php

/**
 * Admin News controller
 * 
 * @author Van NH <hoangvan87@gmail.com>
 */
class Cakiem8x_News_adminhtml_NewsController extends Mage_Adminhtml_Controller_Action {

    /**
     * Init actions
     * 
     * @return \Cakiem8x_News_adminhtml_NewsController
     */
    protected function _initAction() {
        // Load layout, set active menu and breadcrumbs
        $this->loadLayout()
                ->_setActiveMenu('news/first_child')
                ->_addBreadcrumb(
                        Mage::helper('cakiem8x_news')->__('News')
                        , Mage::helper('cakiem8x_news')->__('News')
                )
                ->_addBreadcrumb(
                        Mage::helper('cakiem8x_news')->__('Manage News')
                        , Mage::helper('cakiem8x_news')->__('Manage News')
        );

        return $this;
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->_title($this->__('News'))
                ->_title($this->__('News'));
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * Create new News item
     */
    public function newAction() {
        // The same form is used to create and edit
        $this->_forward('edit');
    }

    public function editAction() {
        $this->_title($this->__('News'))->_title($this->__('Manage News'));

        // 1. Instance news model
        /* @var $model Cakiem8x_News_Model_News */
        $model = Mage::getModel("cakiem8x_news/news");

        // 2. If ID exists, check it and load data
        $newsId = $this->getRequest()->getParam('id');
        if ($newsId) {
            $model->load($newsId);
            if (!$model->getId()) {
                $this->_getSession()
                        ->addError(Mage::helper('cakiem8x_news')
                                ->__('News item does not exists.'));
                return $this->_redirect('*/*/');
            }
            // Prepare title
            $this->_title($model->getTitle());
            $breadCrumb = Mage::helper('cakiem8x_news')->__('Edit Item');
        } else {
            $this->_title(Mage::helper('cakiem8x_news')->__('New News Item'));
            $breadCrumb = Mage::helper('cakiem8x_news')->__('New News Item');
        }

        // Init breadCrumbs
        $this->_initAction()->addBreadcrumb($breadCrumb, $breadCrumb);

        // 3. Set entered data if there  was an error drung save
        $data = Mage::getSingleton('adminhtml/sesion')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('news_item', $model);

        // 5. Render layout
        $this->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction() {
        $redirectPath = '*/*/';
        $redirectParams = array();

        // Check if data sent
        $data = $this->getRequest()->getPost();
        if ($data) {
            $data = $this->_filterPostData($data);
            // Init model and set data
            /* @var $model Cakiem8x_News_Model_News */
            $model = Mage::getModel('cakiem8x_news/news');
            // If news item exists, try to load it
            $newsId = $this->getRequest()->getParam('news_id');
            if ($newsId) {
                $model->load($newsId);
            }

            // Save image data and remove from data array
            if (isset($data['image'])) {
                $imageData = $data['image'];
                unset($data['image']);
            } else {
                $imageData = array();
            }

            $model->addData($data);
            try {
                $hasError = false;
                /* @var $imageHelper Cakiem8x_News_Helper_Image */
                $imageHelper = Mage::helper('cakiem8x_news/image');
                // Remove image
                if (isset($data['delete']) && $model->getImage()) {
                    if ($model->getImage()) {
                        $imageHelper->removeImage($model->getImage());
                    }
                    $model->setImage(null);
                }

                // Upload new image
                $imageFile = $imageHelper->uploadImage('image');
                if ($imageFile) {
                    if ($model->getImage()) {
                        $imageHelper->removeImage($model->getImage());
                    }
                    $model->setImage($imageFile);
                }

                // Save the data
                $model->save();

                // Display success message
                $this->_getSession()
                        ->addSuccess(Mage::helper('cakiem8x_news')->__('The news item has been saved.'));

                //Check if 'Save an continue'
                if ($this->getRequest()->getParam('back')) {
                    $redirectPath = '*/*/edit';
                    $redirectParams = array('id' => $model->getId());
                }
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $hasError = true;
                $this->_getSession()
                        ->addException($e, Mage::helper('cakiem8x_news')
                                ->__('An error occurred while saving the news item.'));
            }
        }

        $this->_redirect($redirectPath, $redirectParams);
    }

    /**
     * Delete action
     * 
     */
    public function deleteAction() {
        // Check if we know what should be deleted
        $newsId = $this->getRequest()->getParam('id');
        if ($newsId) {
            try {
                // Init model and delete
                /* @var $model Cakiem8x_News_Model_News */
                $model = Mage::getModel('cakiem8x_news/news');
                $model->load($newsId);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('cakiem8x_news')->__('Unable to find a news item'));
                }

                $imageFile = $model->getImage();
                $model->delete();
                // Remove image
                if ($imageFile) {
                    $imageHelper = Mage::helper('cakiem8x_news/image');
                    $imageHelper->removeImage($imageFile);
                }
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()
                        ->addException($e, Mage::helper('cakiem8x_news')
                                ->__('An error occurred while delete the news item'));
            }
        }
    }

    /**
     * Check the permission to run it
     * 
     * @return boolean
     */
    protected function _isAllowed() {
        switch ($this->getRequest()->getActionName()) {
            case 'new':
            case 'save':
                return Mage::getSingleton('Admin/session')->isAllowed('news/first_child/save');
                break;
            case 'delete':
                return Mage::getSingleton('Admin/session')->isAllowed('news/first_child/delete');
                break;
            default:
                return Mage::getSingleton('Admin/session')->isAllowed('news/first_child');
                break;
        }
    }

    /**
     * Filtering posted data. Converting localized data if needed
     * 
     * @param array $data
     * @return array
     */
    protected function _filterPostData($data) {
        $data = $this->_filterDates($data, array('time_published'));
        return $data;
    }

    /**
     * Grid ajax action
     * 
     */
    public function gridAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Flush News Posts Images Cache action
     */
    public function flushAction() {
        if (Mage::helper('cakiem8x_news/image')->flushImagesCache()) {
            $this->_getSession()->addMessages(Mage::helper('cakiem8x_news')->__('Cache successfully flushed'));
        } else {
            $this->_getSession()->addError('There was error during flushing cache');
        }

        $this->_forward('index');
    }

}