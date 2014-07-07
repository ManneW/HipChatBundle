<?php

namespace Mannew\HipchatBundle\Tests\DependencyInjection;

use Mannew\HipchatBundle\DependencyInjection\MannewHipchatExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MannewHipchatExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MannewHipchatExtension
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

    public function testHipChatServiceIsDefined()
    {
        $config = array('auth_token' => uniqid());
        $container = $this->getContainer();
        $this->extension->load(array($config), $container);

        $this->assertTrue($container->hasDefinition('hipchat'));
    }

    public function testLoadConfigWithAuthToken()
    {
        $testToken = 'testtoken';
        $this->assertContainerParameterValueEquals('auth_token', $testToken);
    }

    public function testLoadConfigWithVerifySSLOption()
    {
        $this->assertContainerParameterValueEquals('verify_ssl', false);
        $this->assertContainerParameterValueEquals('verify_ssl', true);
    }

    public function testLoadConfigWithProxyAddressOption()
    {
        $this->assertContainerParameterValueEquals('proxy_address', '127.0.0.1:8888');
    }

    public function testLoadConfigWithoutProxyAddressOption()
    {
        $config = array('auth_token' => uniqid());
        $this->extension->load(array($config), $container = $this->getContainer());
        $parameterValue = $container->getParameter('mannew_hipchat.proxy_address');

        $this->assertNull($parameterValue);
    }

    /**
     * @param string $parameterName
     * @param string $expectedValue
     */
    protected function assertContainerParameterValueEquals( $parameterName, $expectedValue )
    {
        $config = array('auth_token' => uniqid());
        $config[$parameterName] = $expectedValue;
        $parameterName = 'mannew_hipchat.' . $parameterName;
        $this->extension->load(array($config), $container = $this->getContainer());

        $parameterValue = $container->getParameter($parameterName);
        $this->assertEquals($expectedValue, $parameterValue);
    }

    /**
     * Initialize the extension.
     */
    protected function setUp()
    {
        $this->extension = new MannewHipchatExtension();
    }

    /**
     * Constructs and returns a ContainerBuilder to be used for testing purposes.
     *
     * @return ContainerBuilder
     */
    private function getContainer()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.cache_dir', sys_get_temp_dir());
        $container->setParameter('kernel.bundles', array());

        return $container;
    }
}
