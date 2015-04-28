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
        $this->extension->load(array($config), $container = $this->getEmptyTestContainer());
    }

    public function testHipChatServiceIsDefined()
    {
        $config = array(
            'auth_token' => uniqid()
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);
        $containerHasDefinitionForHipchatService = $container->hasDefinition('hipchat');

        $this->assertTrue($containerHasDefinitionForHipchatService);
    }

    public function testLoadConfigWithAuthToken()
    {
        $testToken = 'testtoken';
        $config = array(
            'auth_token' => $testToken
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);

        $this->assertContainerParameterEquals($container, 'auth_token', $testToken);
    }

    public function testLoadConfigWithVerifySSLOption()
    {
        $verifySSL = false;
        $config = array(
            'verify_ssl' => $verifySSL,
            'auth_token' => uniqid(),
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);

        $this->assertContainerParameterEquals($container, 'verify_ssl', $verifySSL);
    }

    public function testLoadConfigWithProxyAddressOption()
    {
        $proxyAddress = 'http://127.0.0.1:8888';
        $config = array(
            'proxy_address' => $proxyAddress,
            'auth_token'    => uniqid(),
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);

        $this->assertContainerParameterEquals($container, 'proxy_address', $proxyAddress);
    }

    public function testLoadConfigWithoutProxyAddressOption()
    {
        $config = array(
            'auth_token' => uniqid(),
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);

        $this->assertContainerParameterEquals($container, 'proxy_address', null);
    }

    public function testLoadConfigWithRequestTimeoutOption()
    {
        $timeout = 60;
        $config = array(
            'request_timeout'   => $timeout,
            'auth_token'        => uniqid(),
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);

        $this->assertContainerParameterEquals($container, 'request_timeout', $timeout);
    }

    public function testLoadConfigWithoutRequestTimeoutOption()
    {
        $config = array(
            'auth_token'        => uniqid(),
        );
        $container = $this->getEmptyTestContainer();
        $this->loadConfigIntoContainer($config, $container);

        $this->assertContainerParameterEquals($container, 'request_timeout', null);
    }

    /**
     * @param ContainerBuilder $container
     * @param string $parameterName
     * @param mixed $value
     */
    protected function assertContainerParameterEquals( ContainerBuilder $container, $parameterName, $value )
    {
        $parameterValue = $container->getParameter('mannew_hipchat.' . $parameterName);
        $this->assertEquals($value, $parameterValue);
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
    protected function getEmptyTestContainer()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.cache_dir', sys_get_temp_dir());
        $container->setParameter('kernel.bundles', array());

        return $container;
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    protected function loadConfigIntoContainer( array $config, ContainerBuilder $container )
    {
        $this->extension->load(array($config), $container);
    }
}
