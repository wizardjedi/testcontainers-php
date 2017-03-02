<?php

use Docker\Docker;

class ContainerTest extends PHPUnit_Framework_TestCase {
    /**
     *
     * @var DockerContainer 
     */
    protected $container;
        
    /**
     * @beforeClass
     */
    public function setUp() {
        echo "Setup";
        
        /*$this->container = new DockerContainer("percona:5.5.42");
        
        $this->container->addEnvironment("MYSQL_ROOT_PASSWORD", "123456");
        
        $this->container->start();*/
    }
    
    /**
     * @test
     */
    public function testContainer() {
        

        $docker = new Docker();
        
        $containerManager = $docker->getContainerManager();
        
        $all = $containerManager->findAll();
        
        foreach ($all as $container) {
            var_dump($container->getId());
            var_dump($container->getPorts());
            
            $config = $container->getNetworkSettings();
            
            var_dump($config->getIPAddress());
        }
        
        //print_r($all);
    }
    

    public function tearDown() {
        /*echo "tear down";
        
        $this->container->stop();*/
    }
}