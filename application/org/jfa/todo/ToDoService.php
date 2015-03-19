<?php
namespace org\jfa\todo;
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

	// **************************** PROPERTIES ***************************** //
	/**
	 * @var array collection I am the colleciton of all the ToDos.
	 * @access private
	 */
	private $collection = array();

	/**
	 * @var string jsonFileName I am the name of the json file where I persist 
	 * things. 
	 * @access private
	 */
	private $storageFileFullPath;

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	function __construct(){
		// must be set first cause loadData uses the property.
		// Why dont PHP let me put dirname(__FILE__) in the property 
		// declaration!!?!? That's iratating
		$this->storageFileFullPath = dirname(__FILE__) . '/data/storage.json';

		$this->loadData();
	}

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

		$this->saveCollection();
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

		$this->saveCollection();
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
	public function saveToDo( $ToDo ) {

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

		$this->saveCollection();

		// return the saved object
		return $ToDo;
	}

	// ****************************** PRIVATE ****************************** //
	
	/**
	 * I am the method that initalizes the memeory collection on object 
	 * creation.
	 *
	 * @return void
	 */
	private function loadData(){

		$filename = $this->storageFileFullPath;

		if ( ! file_exists( $filename ) ) {
		   $this->saveCollection(); 
		}

		$this->loadCollection();
		
	}

	/**
	 * I load the data from disk into the memory collection.
	 *
	 * @return void
	 */
	private function loadCollection(){

		// wipe out the current memory collection
		$this->collection = array();

		$fileData = file_get_contents( $this->storageFileFullPath );

		if ( strlen( $fileData ) ){

			$JSONData = json_decode($fileData, true);

			foreach ($JSONData as $value){

				$obj = $this->getToDo('');

				$obj->setID($value['id']);
				$obj->setComplete($value['complete']);
				$obj->setTask($value['task']);

				$this->saveToDo($obj);
			}

		}
	}

	/**
	 * I save the memory collection to disk.
	 *
	 * @return void
	 */
	private function saveCollection(){

		$filename = $this->storageFileFullPath;
		
		// delete the file if it's there
		if ( file_exists( $filename ) ) {
			unlink( $filename );
		}

		// now rewrite it
		file_put_contents( $filename, json_encode( $this->collection ) );
	}
}
?>