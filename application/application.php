<?php
/**
 * I am the main application code. I define all configuration, build all the
 * applications objects, store them in the session scope for persistance,
 * handle the front controller logic, and reload the application as nessary.
 * I am also the applications API.
 *
 * @author John Allen
 * @version 1.0
 */

// inlucdes
include 'com/HelperFunction.php';
include 'com/Factory.php';

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
 * I am a method that should be fired on every request. I check if the
 * application needs to be set up, I initalize the requests ViewState object,
 * I call the handleAction() method (the front controller), and render the
 * views
 *
 * @return void
 */
function onRequest(){

	// check if we need to reload the application
	checkApplicationState();

	// initialize the ViewSate for every request
	setViewState( getFactory()->getBean( 'ViewState' ) );

	// decide what to do, the front controller
	handleAction();

	// render the application
	renderApplication();
}

/**
 * I decide what methods to call on the controller and do so. I also
 * set what view should be rendered.
 *
 * @return void
 */
function handleAction(){
	
	$controller = getController();
	$viewState = getViewState();	

	// ************************ THE FRONT CONTROLLER *********************** //
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
 * I return a string to use as a link with it's action
 *
 * @param string $action  I am the action to be taken. I am required.
 * @return string
 */
function buildLink( $action ){

	return getBaseURI() . '/index.php?action=' . $action;
}

/**
 * I return a string of the base URI of the application.
 *
 * @return string
 */
function getBaseURI(){
	
	return "http://" . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] );
}

/**
 * I return the applications base system path.
 *
 * @return string
 */
function getApplicationSystemPath(){
	return $_SESSION[ SESSION_NAME_SPACE ][ 'systemPath' ];
}

/**
 * I check the state of the application. If needed I will reload it.
 *
 * @return void
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
 * I return the curent requests ViewState object.
 *
 * @return object
 */
function getViewState(){
	return $_SESSION[ SESSION_NAME_SPACE ][ 'viewSate' ];	
}

/**
 * I set the current requests ViewState object.
 *
 * @param object $ViewState  I am the requests ViewState object. I am required.
 * @return void
 */
function setViewState( $ViewState ){
	$_SESSION[ SESSION_NAME_SPACE ][ 'viewSate' ] = $ViewState;
}

/**
 * I return the applications Controller object.
 *
 * @return object
 */
function getController(){
	return getFactory()->getBean( 'Controller' );
}

/**
 * I return the applications Factory object.
 *
 * @return object
 */
function getFactory(){
	return $_SESSION[ SESSION_NAME_SPACE ][ 'factory' ];
}

/**
 * I start the application.
 *
 * @return void
 */
function startApplication(){

	// name space all the stuff for the application
	$_SESSION[ SESSION_NAME_SPACE ] = array();
	$_SESSION[ SESSION_NAME_SPACE ][ 'systemPath' ] = getcwd();
	$_SESSION[ SESSION_NAME_SPACE ][ 'factory' ] = new Factory();

	print_r( 'Application Started at: ' . date( 'l jS \of F Y h:i:s A' ) );
};

/**
 * I render the main layout/application.
 *
 * @return void
 */
function renderApplication(){
	include getApplicationSystemPath() . "/public/layout/layout.php";	
}

/**
 * I render a view.
 *
 * @return void
 */
function view( $view ){
	include getApplicationSystemPath() . "/public/view/" . $view;	
}
?>