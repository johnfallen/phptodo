<?php
namespace org\jfa\todo\simple;
/**
 * I am the ToDoService object. I provide access and CRUD functionality for 
 * ToDo objects.
 *
 * @package com
 * @author John Allen
 * @version 1.0
 */
include 'ToDo.php';

class ToDoService {

	// object properties 
	// the colleciton of all the ToDos
	private $collection = array();

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	function __construct(){}

	/**
	 * I remove a ToDo from the collection.
	 *
	 * @param string $id  I am the ID of the ToDo to delete. I am required.
	 * @return void
	 */
	public function deleteToDo( $id ){

		$index = 0;

		foreach ($this->collection as $value){
			
			if ( $value->getID() === $id ){
				
				unset( $this->collection[$index] );
				
				break;
			}

			$index++;
		}
	}

	/**
	 * I remove all the ToDo that are completed.
	 *
	 * @return void
	 */
	public function deleteCompleted(){

		$index = 0;

		foreach ($this->collection as $value){
			
			if ( $value->getComplete() ){
				
				unset( $this->collection[$index] );
			}

			$index++;
		}
	}

	/**
	 * I return a ToDo by ID. If the ID is not found I return a new ToDo object. 
	 *
	 * @param string $id  I am the ID of the ToDo to return. I am required.
	 * @return object
	 */
	public function getToDo( $id ){

		$result = '';

		foreach ($this->collection as $value){
			
			if ( $value->getID() === $id ){

				$result = $value;
				break;
			}
		}

		// if we didn't find one create and return a new one
		if ($result === ''){
			$result = new ToDo;
		}

		return $result;
	}

	/**
	 * I return the collection of all ToDos.
	 *
	 * @return array
	 */
	public function listToDo() {
		return $this->collection;
	}


	/**
	 * I save a ToDo object and return it.
	 *
	 * @param string $id  I am the ID of the ToDo to save. I am required.
	 * @param string $task  I am the task of the ToDo - the descriptive text. I am required.
	 * @param boolean $complete  I a flag to indicate if the ToDo is completed. I am required.
	 * @return object
	 */
	public function saveToDo( $id, $task, $complete ) {

		$ToDo = $this->getToDo( $id );

		$ToDo->setTask( $task );
		$ToDo->setComplete( $complete );

		// was the ToDo saved in the collection?
		$wasInCollection = false;
		
		// update the collection
		foreach ($this->collection as $value){
			
			if ( $value->getID() === $ToDo->getID() ){

				$value = $ToDo;

				$wasInCollection = true;
				break;
			}
		}

		// it was never persisted so push it into the collection
		if ( !$wasInCollection ){
			array_push($this->collection, $ToDo);	
		}

		// return the saved object
		return $ToDo;
	}

	// ****************************** PRIVATE ****************************** //
}
?>