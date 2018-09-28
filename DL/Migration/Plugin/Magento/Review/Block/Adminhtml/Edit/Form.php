<?php

namespace DL\Migration\Plugin\Magento\Review\Block\Adminhtml\Edit;

class Form extends \Magento\Review\Block\Adminhtml\Edit\Form
{
    public function beforeSetForm(\Magento\Review\Block\Adminhtml\Edit\Form $object, $form) {

        $review = $object->_coreRegistry->registry('review_data');

        $fieldset = $form->addFieldset(
            'review_details_extra',
            ['legend' => __('Review Details Extra Data'), 'class' => 'fieldset-wide']
        );

        $fieldset->addField(
            'email',
            'text',
            ['label' => __('E-mail'), 'required' => false, 'name' => 'email']
        );
        $fieldset->addField('recommend', 'select', array(
            'label' => 'Would you Recommend this Item?',
            'required' => true,
            'name' => 'recommend',           
            'values' => array(
                array(
                    'value' => 0,
                    'label' => 'Yes, Would Recommend',
                ),
                array(
                    'value' => 1,
                    'label' => "No, Wouldn't Recommend" ,
                ),
            )
        ));


        $form->setValues($review->getData());

        return [$form];
    }
}