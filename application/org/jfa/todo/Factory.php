<?php
namespace org\jfa\todo;
/**
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

	// **************************** PROPERTIES ***************************** //
	/**
	 * @var array singletonCache I am the the cache for singletons.
	 * @access private
	 */
	private $singletonCache = array();

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	public function __construct (){
		
		// create all the singletons
		$this->singletonCache['ToDoService'] = new ToDoService();
		$this->singletonCache['Controller'] = new Controller( $this->singletonCache['ToDoService']);
	}

	/**
	 * I return a ready to use Object based on name. 
	 *
	 * @param string $name  I am the name of the bean to get. I am required.
	 * @throws string I throw an error when a bean is not found.
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