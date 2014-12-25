<?php

class Cakiem8x_NewProduct_Block_ProductViewCase extends Mage_Catalog_Block_Product_View {

    public function getCaseCount() {
        $product = $this->getProduct();
        return intval($product->getCaseCount());
    }

    public function hasCaseCount() {
        $product = $this->getProduct();
        return $product->getCaseCount() > 1;
    }

    public function getMaximumQty() {
        $product = $this->getProduct();
        $stock = $product->getStockItem();        
        return $stock->getMaxSaleQty();
    }

}