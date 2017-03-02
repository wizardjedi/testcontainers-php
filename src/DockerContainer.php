<?php

class DockerContainer {
    protected $imageName;
    
    protected $containerId;
    
    protected $env = array();

    protected $inspections;
    
    public function __construct($imageName) {
        $this->imageName = $imageName;
    }
    
    public function addEnvironment($key, $value) {        
        $this->env[$key] = $value;
        
        return $this;
    }
    
    public function start() {
        $output = "";
        
        $envStr = '';
        
        if (!empty($this->env)) {
            $envValues = array();
            
            foreach ($this->env as $key => $value) {
                $envValues[] = $key .'=' . $value;
            }                     
            
            $envStr = "-e ".implode(' ', $envValues);
        }
        
        $command = "docker run -d ".$envStr." ".$this->imageName;
        
        fputs(STDERR, $command."\n");
        $output = system($command, $return);
        
        if ($return !== 0) {
            throw new Exception("Something went wrong");
        } else {
            $this->containerId = $output;
        }
        
        $this->inspectContainer();
    }
    
    public function inspectContainer() {
        exec("docker inspect ".$this->containerId, $output);
        
        $data = json_decode(implode("\n",$output), true);
        
        $this->inspections = $data;
    }
    
    public function stop() {
        exec("docker kill ".$this->containerId);
        exec("docker rm ".$this->containerId);
    }
    
    public function getIpAddress() {
        return $this->inspections[0]['NetworkSettings']['IPAddress'];
    }
    
    public function getExposedPort($port) {
        return $this->inspections[0]['NetworkSettings']['Ports'];
    }
}
