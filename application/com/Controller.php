<?php
/**
 * I am the applications controller.
 */
class Controller {
	
	// object properties
	var $ToDoService;

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	public function Controller( $ToDoService ){
		
		$this->ToDoService = $ToDoService;
	}

	/**
	 * I delete a ToDo by ID.
	 */
	public function deleteToDo( $id ){
		
		$this->ToDoService->deleteToDo( $id );
	}

	/**
	 * I delete all of the completed ToDos.
	 */
	public function deleteCompleted(){
		
		$this->ToDoService->deleteCompleted();
	}

	/**
	 * I get and return a ToDo by ID.
	 */
	public function getToDo( $id ){
		
		return $this->ToDoService->getToDo( $id );
	}

	/**
	 * I get all of the ToDos.
	 */
	public function listToDo(){
		
		return $this->ToDoService->listToDo();
	}

	/**
	 * I save a ToDo.
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