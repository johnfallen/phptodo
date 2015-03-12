<?php 
/**
 * Factory.php
 *
 * I am a simple factory for this application.
 *
 * @package com
 * @author John Allen
 * @version 1.0
 */
include 'ToDoService.php';
include 'Controller.php';
include 'ViewState.php';

class Factory {

	// the cache for singletons
	var $singletonCache = array();

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	public function Factory (){
		
		// create all the singletons
		$this->singletonCache['ToDoService'] = new ToDoService();
		$this->singletonCache['Controller'] = new Controller( $this->singletonCache['ToDoService']);
	}

	/**
	 * I return a ready to use Object based on name. THROWS ERROR when a bean
	 * is not found.
	 *
	 * @param string $name  I am the name of the bean to get
	 * @return object
	 */
	public function getBean( $name ){
		
		$result = '';

		switch ( $name ) {
		    
			case 'Controller':

				$result = $this->singletonCache['Controller'];
		        
		    	break;

			case 'ToDoService':

				$result = $this->singletonCache['ToDoService'];
		        
		    	break;

		    case 'ViewState':

		    	$result = new ViewState( getcwd() );
		    	break;

		default:
			throw new Exception( $name . ' is not a defined bean in the facotry.'); 
		}

		return $result;
	}

	// ****************************** PRIVATE ****************************** //
}
?>