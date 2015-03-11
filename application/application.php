<?php
/**
 * I am the main application code. I define all configuration, build all the
 * applications objects, store them in the session scope for persistance,
 * handle the front controller logic, and reload the application as nessary.
 * I am also the applications API.
 */

// inlucdes
include 'com/HelperFunction.php';
include 'com/ToDoService.php';
include 'com/Controller.php';
include 'com/ViewState.php';

// Global variables / settings
define( 'APP_TITLE', 'My ToDo' );
define( 'VIEW_KEY', 'view' );
define( 'RELOAD_KEY', 'reload' );
define( 'RELOAD_KEY_VALUE', 'true' );
define( 'ACTION_KEY', 'action' );
define( 'SESSION_NAME_SPACE' , 'myToDoApp' );

// using sessions to keep state
session_start();

// MUST fire on every request
onRequest();

/**
 * I am fired on every request.
 */
function onRequest(){

	// check if we need to reload the application
	checkApplicationState();

	// initialize the ViewSate for every request
	setViewState( new ViewState( getApplicationSystemPath() ) );

	// decide what to do
	handleAction();

	// render the application
	renderApplication();
}

/**
 * I return a string to use as a link with it's action
 */
function buildLink( $action ){

	return getBaseURI() . '/index.php?action=' . $action;
}

/**
 * I return a string of the base URR of the application
 */
function getBaseURI(){
	
	return "http://" . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] );
}

/**
 * I return the applications base system path
 */
function getApplicationSystemPath(){
	return $_SESSION[ SESSION_NAME_SPACE ][ 'systemPath' ];
}

/**
 * I check the state of the application. If needed I will reload it.
 */
function checkApplicationState(){
	// if the session var isn't there OR if we're reloading from a URL var
	if ( !isset ( $_SESSION[ SESSION_NAME_SPACE ] )
		or 
		isset( $_GET[ RELOAD_KEY ] ) && trim( $_GET[ RELOAD_KEY ] ) == RELOAD_KEY_VALUE ) {

		startApplication();	
	}
}

/**
 * I decide what methods to call on the controller and do so. I also
 * set what view should be rendered.
 */
function handleAction(){

	$controller = getController();
	$viewState = getViewState();	

	if ( isset ($_GET[ ACTION_KEY ]) ){

		switch ($_GET[ ACTION_KEY ]) {
		    
		    case 'deletetodo':
		        
		        $controller->deleteToDo( $_GET[ 'id' ] );

		        $viewState->setView('list.php');
		    	$viewState->setData( $controller->listToDo() );

		    	$viewState->setResponse('ToDo Deleted', 'success');
		        
		        break;

		    case 'edittodo':

		    	$viewState->setView('edit.php');
		    	$viewState->setData( $controller->getToDo( $_GET[ 'id' ] ) );

		        break;

		    case 'savetodo':

		    	// handle the checkbox
		    	if( !isset( $_POST['complete'] ) ){
		    		$_POST['complete'] = false;
		    	} else {
		    		$_POST['complete'] = true;
		    	}

		    	$controller->saveToDo($_POST);

		        $viewState->setView('list.php');
		    	$viewState->setData( $controller->listToDo() );

		    	$viewState->setResponse('ToDo Saved', 'success');

		        break;

		    case 'deletecompleted':

		    	$controller->deleteCompleted();

		    	$viewState->setView('list.php');
		    	$viewState->setData( $controller->listToDo() );

		    	$viewState->setResponse('Completed ToDos Cleared', 'info');

		    	break;
		    
	    default:
	        
	        $viewState->setView('list.php');
		    $viewState->setData( $controller->listToDo() );
		}
	} else {

		$viewState->setView('list.php');
		$viewState->setData( $controller->listToDo() );	
	}
}

/**
 * I return the curent requests ViewState object.
 */
function getViewState($value=''){
	return $_SESSION[ SESSION_NAME_SPACE ][ 'viewSate' ];	
}

/**
 * I set the current requests ViewState object.
 */
function setViewState( $ViewState ){
	$_SESSION[ SESSION_NAME_SPACE ][ 'viewSate' ] = $ViewState;
}

/**
 * I return the applications Controller object.
 */
function getController(){
	return $_SESSION[ SESSION_NAME_SPACE ]['controller'];
}

/**
 * I start the application.
 */
function startApplication(){

	$ToDoService = new ToDoService;

	// name space all the stuff for this application
	$_SESSION[ SESSION_NAME_SPACE ] = array();
	$_SESSION[ SESSION_NAME_SPACE ]['systemPath'] = getcwd();

	// inject (IOC) the ToDoService into the controller
	$_SESSION[ SESSION_NAME_SPACE ]['controller'] = new Controller( $ToDoService );

	print_r( 'Application Started at: ' . date( 'l jS \of F Y h:i:s A' ) );
};

/**
 * I render the main layout/application.
 */
function renderApplication(){
	include getApplicationSystemPath() . "/public/layout/layout.php";	
}

/**
 * I render a view.
 */
function view( $view ){
	include getApplicationSystemPath() . "/public/view/" . $view;	
}
?>