<?php
/*
 * I render responses from the application. Types set in the front controller
 * in the application.php file corispond to BootStrap alert class types.
 *
 * @author John Allen
 * @version 1.0
 */

$viewState = getViewState();
$response = $viewState->getResponse();
$showResponce = false;
$responseType = '';
$responseMessage = '';

if ( count( $response ) > 0 ){
	
	$showResponce = true;
	$responseMessage = $response['message'];

	switch ( $response['type'] ) {

		case 'success':

			$responseType = 'success';
			break;

		case 'info':

			$responseType = 'info';
			break;

		case 'warning':

			$responseType = 'warning';
			break;

		case 'danger':

			$responseType = 'danger';
			break;
	}
}
?>
<?php if( $showResponce ){ ?>
	<div class="alert alert-<?= $responseType ?>  alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?= $responseMessage ?>
	</div>
<? } ?>
