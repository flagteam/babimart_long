<?php

class Cakiem8x_Weblog_IndexController extends Mage_Core_Controller_Front_Action {

    public function testModelAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        echo get_class($blogpost);
    }

    public function testResourceAction() {
        $params = $this->getRequest()->getParams();

        $blogpost = Mage::getModel('weblog/blogpost');
        echo("Loading the blogpost with an ID of " . $params['id']);

        $blogpost->load($params['id']);
        $data = $blogpost->getOrigData();
        var_dump($data);
    }

    public function createNewPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');

        $blogpost->setTitle('The three post');
        $blogpost->setPost('This post was created from code!');
        $blogpost->save();

        echo 'Post with ID ' . $blogpost->getId() . ' created';
    }

    public function editFirstPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');

        $blogpost->load(2);
        #$blogpost->setTitle('The First post');
        $blogpost->setDate(date('Y-m-d H:i:s'));
        $blogpost->save();

        echo 'Post edited';

        var_dump($blogpost->getData());
    }

    public function deletePostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');

        $blogpost->load(4);
        $rs = $blogpost->delete();

        var_dump($rs);

        echo 'post removed';
    }

    public function testCollectionAction() {

        $collection = Mage::getModel('weblog/blogpost')->getCollection();
        $collection->addFieldToFilter('blogpost_id', array('in' => array(1, 2)));
        $collection->load();

        foreach ($collection as $post)
            var_dump($post->getData());
    }

    public function index() {
        echo 'Xin chao';
    }

}