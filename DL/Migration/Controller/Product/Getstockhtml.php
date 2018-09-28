<?php

namespace DL\Migration\Controller\Product;
 
use Magento\Framework\App\Action\Context;
 
class Getstockhtml extends \Magento\Framework\App\Action\Action
{
    
 
    
 
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $stockItemRepository  = $objectManager->get('\Magento\CatalogInventory\Api\StockRegistryInterface');
        $request  = $objectManager->get('\Magento\Framework\App\Request\Http');
        $productId = $request->getParam('id');
        if (!ctype_digit($productId))
            die(' ');
        $productStock = $stockItemRepository->getStockItem($productId);
        if ($productStock->getIsInStock())
        {
            echo "Stock Availability: In Stock";
            return;
        }
        else
        {
            echo "Stock Availability: Out of Stock";
            return;
        }
    }
}