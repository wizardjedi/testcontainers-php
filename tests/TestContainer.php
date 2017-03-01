<?php

class TestContainer extends PHPUnit_Framework_TestCase {
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
        
        $this->container = new DockerContainer("percona:5.5.42");
        
        $this->container->addEnvironment("MYSQL_ROOT_PASSWORD", "123456");
        
        $this->container->start();
    }
    
    public function testContainer() {
        echo "test";
        print_r($this->container);
        
        if ($this->container != null) {
            var_dump($this->container->getIpAddress());
             var_dump($this->container->getExposedPort(11));
        }
    }
    

    public function tearDown() {
        echo "tear down";
        
        $this->container->stop();
    }
}