<?php
/**
 * This file is part of Advocodo_Group for Magento.
 *
 * @license All rights reserved, Advocodo
 * @author Advocodo <dev@advocodo.com> <@AdvocodoCompany>
 * @category Advocodo
 * @package Advocodo_Group
 * @copyright Copyright (c) 2017 Advocodo (http://www.Advocodo.com)
 */

/**
 * Group Block
 * @package Advocodo_Group
 */
class Advocodo_Group_Block_Group extends Mage_Core_Block_Template
{
    /**
     * Input name for custom customer group
     *
     * @return string
     */
    public static function getCustomGroupInputName()
    {
        return Mage::helper('advocodo_group')->getCustomGroupInputName();
    }

    /**
     * Get Magento group
     *
     * @return array
     */
    public function getGroup()
    {
        /** @var Mage_Customer_Helper_Data $groups */
        $groups = Mage::helper('customer')->getGroups();

        $groups = $groups->toOptionArray();

        usort($groups, function($a, $b) {
            return strcmp($a['label'], $b['label']);
        });

        return $groups;
    }

    /**
     * Get school from url param
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->getRequest()->getParam('ecole');
    }
}
