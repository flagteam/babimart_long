<?php

Class Cakiem8x_Mto_Helper_Event extends Mage_Core_Helper_Abstract {

    public static function cartBeforeSave($observer) {

        $event = $observer->getEvent();

        $req = Mage::app()->getRequest();
        $items = $event->getQuote()->getItemsCollection();

        $mto_length = $req->get('user_length');
        $product_id = $req->get('product');

        if ($mto_length and $product_id) {
            foreach ($items as $item) {
                if ($item->getProductId() === $product_id) {
                    $item->setMtoLength($mto_length);
                    break;
                }
            }
        }
    }

    public static function attachSpecialOrderAttribs($observer) {
        $event = $observer->getEvent();
        $orderItem = $event->getOrderItem();
        $quoteItem = $event->getItem();

        $orderItem->setMtoLength($quoteItem->getMtoLength());
    }

}