<?php 
/**
 * I am the applications controller.
 *
 * @package com
 * @author John Allen
 * @version 1.0
 */
class Controller {
	
	// object properties
	var $ToDoService;

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 *
	 * @param object $ToDoService  I am the ToDoService. I am required.
	 */
	public function Controller( $ToDoService ){
		
		$this->ToDoService = $ToDoService;
	}

	/**
	 * I delete a ToDo by ID.
	 *
	 * @param string $id  I am the id of the ToDo to delete.  I am required.
	 * @return void
	 */
	public function deleteToDo( $id ){
		
		$this->ToDoService->deleteToDo( $id );
	}

	/**
	 * I delete all of the completed ToDos.
	 *
	 * @return void
	 */
	public function deleteCompleted(){
		
		$this->ToDoService->deleteCompleted();
	}

	/**
	 * I return a ToDo by ID.
	 *
	 * @param string $id  I am the ID of the ToDo to get.  I am required.
	 * @return object
	 */
	public function getToDo( $id ){
		
		return $this->ToDoService->getToDo( $id );
	}

	/**
	 * I get all of the ToDos.
	 *
	 * @return array
	 */
	public function listToDo(){
		
		return $this->ToDoService->listToDo();
	}

	/**
	 * I save a ToDo and return the saved ToDo.
	 *
	 * @param string $id  I am the ID of the ToDo to save.  I am required.
	 * @param string $task  I am the task of the ToDo - the descriptive text.  I am required.
	 * @param boolean $complete  I a flag to indicate if the ToDo is completed.  I am required.
	 * @return object
	 */
	public function saveToDo($data){

		return $this->ToDoService->saveToDo(
									$data['id'], 
									$data['task'], 
									$data['complete']
									);
	}

	// ****************************** PRIVATE ****************************** //
}
?>