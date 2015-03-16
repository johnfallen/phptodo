<?php
namespace org\jfa\todo;
/**
 * I am a simple object that contains required data needed by the views.
 *
 * @package com
 * @author John Allen
 * @version 1.0
 */
class ViewState {

	// **************************** PROPERTIES ***************************** //
	/**
	 * @var any data I am data for views to use.
	 * @access public
	 */
	public $data;

	/**
	 * @var string view I am the name of the view to render.
	 * @access public
	 */
	public $view;

	/**
	 * @var string applicationSystemPath I am the full system path to director 
	 * with witch to render a view.
	 * @access public
	 */
	public $applicationSystemPath;

	/**
	 * @var object response I am the response associative array.
	 * @access public
	 */
	public $response = array();

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	function __construct( $applicationSystemPath ){
		
		$this->applicationSystemPath = $applicationSystemPath;
	}

	/**
	 * I return the data provided by the controller nessary for the view to 
	 * display.
	 *
	 * @return any
	 */
	public function getData(){
		
		return $this->data;
	}

	/**
	 * I set the data nessary for the view to display.
	 *
	 * @param any $data  I am the data to store. I am required.
	 * @return void
	 */
	public function setData( $data ){
		
		$this->data = $data;
	}

	/**
	 * I return a response to display to a user.
	 *
	 * @return array
	 */
	public function getResponse(){
		
		return $this->response;
	}

	/**
	 * I set a response to display to the user.
	 *
	 * @param string $message  I am the message to display. I default to an empty string.
	 * @param string $type  I am the type of alert to show. I default to 'success'.
	 * @return void
	 */
	public function setResponse( $message = '', $type = 'success' ){
		
		$this->response['message'] = $message;
		$this->response['type'] = $type;
	}

	/**
	 * I return a string of the php file that gets rendered.
	 *
	 * @return string
	 */
	public function getView(){
		
		return $this->applicationSystemPath . '/public/view/' . $this->view;
	}

	/**
	 * I set what view/php file to display.
	 *
	 * @param string $view  I am the name of the php file to render. I am required.
	 * @return void
	 */
	public function setView( $view ){
		
		$this->view = $view;	
	}

	// ****************************** PRIVATE ****************************** //
}
?>