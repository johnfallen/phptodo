<?php
namespace org\jfa\todo;
/**
 * I model a ToDo object.
 *
 * @package com
 * @author John Allen
 * @version 1.0
 */
class ToDo {

	// **************************** PROPERTIES ***************************** //
	/**
	 * @var string id I am the ID of the ToDo object.
	 * @access public
	 */
	public $id;

	/**
	 * @var string task I am the human readable description of the ToDo.
	 * @access public
	 */
	public $task;

	/**
	 * @var boolean complete I am the flag indicating if I am finished completed.
	 * @access public
	 */
	public $complete;

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 * @param string $task  I am the human readable description of the ToDo. I default to 'What to do'.
	 * @param boolean $id  I am a flag to indicate if I am completed.  I default to false.
	 */
	function __construct( $task = "What to do", $complete = false ) {
		
		$this->id = uniqid();
		$this->setTask($task);
		$this->setComplete($complete);
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
	 * I set my ID.
	 *
	 * @param string $id  I am the id. I am required.
	 * @return void
	 */
	public function setID( $id ) {
		
		$this->id = $id;
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
	 * I set the complete status of the ToDo. I am required.
	 *
	 * @param boolean $complete  I am a flag to indicate if I am completed. I am required.
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
	 * @param string $task  I am the human readable description of the ToDo. I am required.
	 * @return void
	 */
	public function setTask( $task ){
		
		$this->task = $task;
	}

	// ****************************** PRIVATE ****************************** //
}
?>