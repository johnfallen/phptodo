<?php
/**
 * I model a ToDo object.
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
	 */
	public function getID() {
		return $this->id;
	}	

	/**
	 * I return if I am a completed ToDo task.
	 */
	public function getComplete() {
		return $this->complete;
	}

	/**
	 * I set the complete status of the ToDo.
	 */
	public function setComplete( $complete ) {
		$this->complete = $complete;
	}

	/**
	 * I return the task of the ToDo.
	 */
	public function getTask() {
		return $this->task;
	}

	/**
	 * I set teh task of the ToDo.
	 */
	public function setTask( $task ){
		$this->task = $task;
	}

	// ****************************** PRIVATE ****************************** //

	/**
	 * I return an ID
	 * http://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
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