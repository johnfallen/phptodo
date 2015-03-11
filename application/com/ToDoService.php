<?
/**
 * I am the ToDoService object. I provide access and CRUD functionality for 
 * ToDo objects.
 */

include 'ToDo.php';

class ToDoService {

	// object properties 
	// the colleciton of all the ToDos
	var $collection = array();

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	function ToDoService(){}

	/**
	 * I remove a ToDo from the collection.
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
	 * I return the collection of all ToDos
	 */
	public function listToDo() {
		return $this->collection;
	}


	/**
	 * I return the collection of all ToDos
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