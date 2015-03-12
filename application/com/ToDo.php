<?php
/**
 * I model a ToDo object.
 *
 * @package com
 * @author John Allen
 * @version 1.0
 */
class ToDo {

	// object properties
	var $id;
	var $task;
	var $complete;

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	function ToDo( $task = "What to do", $complete = false ) {
		
		$this->id = $this->gen_uuid();
		$this->task = $task;
		$this->complete = $complete;
	}

	/**
	 * I return my ID.
	 *
	 * @return string
	 */
	public function getID() {
		
		return $this->id;
	}	

	/**
	 * I return if I am a completed ToDo task.
	 *
	 * @return boolean
	 */
	public function getComplete() {
		
		return $this->complete;
	}

	/**
	 * I set the complete status of the ToDo.
	 *
	 * @param boolean $complete  I am a flag to indicate if I am completed
	 * @return void
	 */
	public function setComplete( $complete ) {
		
		$this->complete = $complete;
	}

	/**
	 * I return the task of the ToDo.
	 *
	 * @return string
	 */
	public function getTask() {
		
		return $this->task;
	}

	/**
	 * I set teh task of the ToDo.
	 *
	 * @param string $task  I am the human readable description of the ToDo
	 * @return void
	 */
	public function setTask( $task ){
		
		$this->task = $task;
	}

	// ****************************** PRIVATE ****************************** //

	/**
	 * I generate and return an ID. The code is from here:
	 * http://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
	 *
	 * @return string
	 */
	private function gen_uuid() {
	    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	        // 32 bits for "time_low"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

	        // 16 bits for "time_mid"
	        mt_rand( 0, 0xffff ),

	        // 16 bits for "time_hi_and_version",
	        // four most significant bits holds version number 4
	        mt_rand( 0, 0x0fff ) | 0x4000,

	        // 16 bits, 8 bits for "clk_seq_hi_res",
	        // 8 bits for "clk_seq_low",
	        // two most significant bits holds zero and one for variant DCE1.1
	        mt_rand( 0, 0x3fff ) | 0x8000,

	        // 48 bits for "node"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    	);
	}
}
?>