<?php
namespace org\jfa\todo;

/**
 * I contain misc helper functions.
 *
 * @author John Allen
 * @version 1.0
 */

/**
 * I dump out data in a readable format
 *
 * @param any $value  I am the data to dump to the screen. I am required.
 * @return void
 */
function dump( $value ){
	echo '<pre>'; var_dump($value); echo '</pre>';
}
?>