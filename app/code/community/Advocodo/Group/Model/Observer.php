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
 * Advocodo Model
 * @package Advocodo_Group
 */
class Advocodo_Group_Model_Observer extends Mage_Core_Model_Abstract
{
    protected static $generalGroup = 1;
    protected static $taxClass = 3;

    public function createGroupForNewCustomer(Varien_Event_Observer $observer)
    {
        try {
            $customer = $observer->getEvent()->getCustomer();

            $customerGroupId = $customer->getGroupId();

            if ($this::$generalGroup !== (int)$customerGroupId) {
                return;
            }

            $customGroupInputName = Mage::helper('advocodo_group')->getCustomGroupInputName();
            if (empty($newCustomerGroupName = strtoupper(Mage::app()->getRequest()->getParam($customGroupInputName)))) {
                return;
            }

            // Get name group for checking exists group
            $customerGroup = Mage::getModel('customer/group');
            $customerGroupData = $customerGroup->getCollection()->getData($customGroupInputName);
            $flagCheck = false;
            foreach ($customerGroupData as $groupData) {
                if (in_array($newCustomerGroupName, $groupData)) $flagCheck = true;
            }

            // If not found customer group then create it
            if ($flagCheck == false) {
                $customerGroup->setCode($newCustomerGroupName);
                $customerGroup->setTaxClassId(self::$taxClass);
                $customerGroup->save();
            }

            // Get id group
            $customerGroupData = $customerGroup->getCollection()->getData();
            foreach ($customerGroupData as $groupData) {
                if (in_array($newCustomerGroupName, $groupData)) $newCustomerGroupId = $groupData['customer_group_id'];
            }

            // Assign created group to customer created before
            if ($newCustomerGroupId) {
                $currentCustomerGroupCode = $customerGroup->load($customerGroupId)->getCode();
                if ($currentCustomerGroupCode !== $newCustomerGroupName) {
                    $customer->setGroupId($newCustomerGroupId);
                    $customer->save();
                }
            }
        } catch (Exception $e) {
            Mage::log("customer_register_success observer failed: " . $e->getMessage());
        }
    }
}
