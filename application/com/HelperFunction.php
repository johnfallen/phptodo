<?php
/**
 * I contain misc helper functions.
 */

/**
 * I dump out data in a readable format
 *
 * @param any $value  I am the data to dump to the screen
 * @return void
 */
function dump( $value ){
	echo '<pre>'; var_dump($value); echo '</pre>';
}
?>