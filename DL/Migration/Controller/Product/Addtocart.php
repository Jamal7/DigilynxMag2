<?php

namespace DL\Migration\Controller\Product;
 
use Magento\Framework\App\Action\Context;
 
class Addtocart extends \Magento\Framework\App\Action\Action
{
    
 
    
 
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $imageHelper  = $objectManager->get('\Magento\Catalog\Helper\Image');
        $stockItemRepository  = $objectManager->get('\Magento\CatalogInventory\Api\StockRegistryInterface');
        $request  = $objectManager->get('\Magento\Framework\App\Request\Http');
        $product  = $objectManager->get('\Magento\Catalog\Model\Product');
        $cart  = $objectManager->get('\Magento\Checkout\Model\Cart');
        $productId = $request->getParam('id');
        $productQty = $request->getParam('qty');
        if (!ctype_digit($productId))
            die('not int');
        if (!ctype_digit($productQty))
            die('qty not int');
        
        try {
         $params = array();
         $params['qty'] = $productQty;//product quantity
         /*get product id*/
         
         $_product = $product->load($productId);

            $productStock = $stockItemRepository->getStockItem($productId);
            if (!$productStock->getIsInStock())
            {
                echo 'stock';
                return;
            }
            if ($productStock->getQty()<$productQty)
            {
                echo 'qty';
                return;
            }



         if ($_product) {
             $cart->addProduct($_product, $params);
             $cart->save();
         }

             $this->messageManager->addSuccess(__('Product '.$_product->getName().' added to cart successfully'));
             echo 'ok';
         } catch (\Magento\Framework\Exception\LocalizedException $e) {
            echo $e->getMessage();
            
         } catch (\Exception $e) {
             echo $e->getMessage();
         }
                 /*cart page*/
                 

         






        //$resultPage = $this->_resultPageFactory->create();
        //return $resultPage;
    }
}