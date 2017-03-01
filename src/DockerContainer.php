<?php

class DockerContainer {
    protected $imageName;
    
    public function __construct($imageName) {
        $this->imageName = $imageName;
    }
    
    public function start() {
        $output = "";
        
        exec("docker run -d ".$this->imageName, $output, $return);
        
        if ($return !== 0) {
            throw new Exception("Something went wrong");
        } else {
            var_dump($output);
        }
    }
    
    public function stop() {
        
    }
    
    public function getIpAddress() {
        
    }
    
    public function getExposedPort($port) {
        
    }
}
