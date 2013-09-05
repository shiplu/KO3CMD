<?php

// A test command
class ko3_test extends ko3_command{
	public function method($param1, $param2){
		Log::info("Test response");
		Log::info("Params:");
		Log::info("1] $param1");
		Log::info("2] $param2");
	}
}

