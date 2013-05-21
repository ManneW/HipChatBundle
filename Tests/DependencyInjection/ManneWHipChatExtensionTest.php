<?php

namespace ManneW\HipChatBundle\Tests\DependencyInjection;

use ManneW\HipChatBundle\DependencyInjection\ManneWHipChatExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ManneWHipChatExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MannewHipChatExtension
     */
    private $extension;

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLoadConfigThrowsExceptionOnMissingAuthToken()
    {
        $config = array();
        $this->extension->load(array($config), $container = $this->getContainer());
    }

    public function testLoadConfigWithAuthToken()
    {
        $testToken = 'testtoken';
        $config = array(
            'auth_token' => $testToken
        );
        $this->extension->load(array($config), $container = $this->getContainer());

        $this->assertEquals($testToken, $container->getParameter('mannew_hipchat.auth_token'));
        $this->assertTrue($container->hasDefinition('hipchat'));
    }

    protected function setUp()
    {
        $this->extension = new ManneWHipChatExtension();
    }

    private function getContainer()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.cache_dir', sys_get_temp_dir());
        $container->setParameter('kernel.bundles', array());

        return $container;
    }
}
