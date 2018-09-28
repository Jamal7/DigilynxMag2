<?php
namespace DL\Migration\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
 
        //handle all possible upgrade versions
 
        if(!$context->getVersion()) {
            //no previous version found, installation, InstallSchema was just executed
            //be careful, since everything below is true for installation !
        }
 
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            //code to upgrade to 1.0.1
            $installer->getConnection()->addColumn(
                $installer->getTable('review_detail'),
                'email',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Email address'
                ]
            );

            

        }
        if (version_compare($context->getVersion(), '1.0.3') < 0) {
            //code to upgrade to 1.0.1
            $installer->getConnection()->addColumn(
                $installer->getTable('review_detail'),
                'recommend',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 2,
                    'nullable' => false,
                    'default' => '0',
                    'comment' => 'Recommendation'
                ]
            );

            

        }
 
        
 
        $setup->endSetup();
    }
}