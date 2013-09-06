<?php

// Command class
class ko3_command{
    public function help(){
        Log::info("Provides help/usage about ".substr(get_called_class(), 4)." command");
    } 
    public function run($params = array()){
        if(count($params)<1){
            Log::error("Sub-commnad not provided");
            exit(1);
        } 
        // get the method name. it should be the first parameter
        $method_name = $params[0];

		if(!method_exists($this, $method_name)){
			Log::error("Sub-commnad '$method_name' does not exist.");
			exit(1);
		}

        // get the parameters of the method
        $args = array_slice($params, 1);

        // argument count
        $argc = count($args);

        // check if all needed parameters are provided
        $method = new ReflectionMethod($this, $method_name);
        $required_params_count = $method->getNumberOfRequiredParameters();

        if($required_params_count > $argc){
            Log::error("'$method_name' requires $required_params_count parameters, but $argc given");
            exit(1);
        }

        // invoke method
        $method->invokeArgs($this, $args);
    }
}

