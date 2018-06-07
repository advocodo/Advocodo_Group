<?php
/**
 * Test that the module is configured correctly
 * Config_ConfigTest Model
 */
class Advocodo_Group_Test_Config_ConfigTest extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * Ensure the module is in the right code pool
     */
    public function testShouldBeInCommunityPool()
    {
        $this->assertModuleCodePool('community');
    }
}
