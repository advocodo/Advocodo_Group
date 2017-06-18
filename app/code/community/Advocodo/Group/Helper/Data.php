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
 * Data Helper
 * @package Advocodo_Group
 */
class Advocodo_Group_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Input name for custom customer group
     *
     * @return string
     */
    public static function getCustomGroupInputName()
    {
        return 'custom_customer_group';
    }
}
