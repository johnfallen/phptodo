<?php
/**
 * I am a simple object that contains required data needed by the views.
 */
class ViewState {

	// object properties
	var $data;
	var $view;
	var $applicationSystemPath;
	var $response = array();

	// ****************************** PUBLIC ******************************* //
	/**
	 * I am the constructor.
	 */
	function ViewState( $applicationSystemPath ){
		$this->applicationSystemPath = $applicationSystemPath;
	}

	/**
	 * I return the data provided by the controller nessary for the view to 
	 * display.
	 */
	public function getData(){
		return $this->data;
	}

	/**
	 * I set the data nessary for the view to display.
	 */
	public function setData( $data ){
		$this->data = $data;
	}


	/**
	 * I return a response to display to a user.
	 */
	public function getResponse(){
		return $this->response;
	}

	/**
	 * I set a responce to display to the user.
	 */
	public function setResponse( $message = 'Oops! No message given!', $type = 'success' ){
		$this->response['message'] = $message;
		$this->response['type'] = $type;
	}



	/**
	 * I set what view to display.
	 */
	public function getView(){
		return $this->applicationSystemPath . '/public/view/' . $this->view;
	}

	/**
	 * I return what view to display.
	 */
	public function setView( $view ){
		$this->view = $view;	
	}

	// ****************************** PRIVATE ****************************** //
}
?>