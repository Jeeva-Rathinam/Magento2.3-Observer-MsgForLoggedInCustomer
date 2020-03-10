<?php
namespace Gta\CustomerMsgPdp\Observer\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class Data implements ObserverInterface
    {
        /**
         * Below is the method that will fire whenever the event runs!
         *
         * @param Observer $observer
         */
            public function execute(Observer $observer)
            {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $customerSession = $objectManager->get('Magento\Customer\Model\Session');
                if($customerSession->isLoggedIn()) 
                {

                    $product = $observer->getProduct();
                    $originalName = $product->getName();
                    $price = $product->getPrice();
                    if($price >= '50')
                    {
                        $modifiedName = $originalName . ' - Premium Products';
                    }
                    elseif($price <= '50')
                    {
                        $modifiedName = $originalName . ' - Non Premium Products';
                    }
                    // $modifiedName = $originalName . ' - Modified by Magento 2 Events and Observers';
                    $product->setName($modifiedName);
                }
            }
    }