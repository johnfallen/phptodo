<?php
namespace org\jfa\todo;  
/** 
 * I am the footer view
 *
 * @author John Allen
 * @version 1.0
 */
?>
<hr />
<footer>
	<p>Today is <?= date( 'l jS \of F Y' ) ?></p>
</footer>

<?php dumpApplicationDiagnostics(); ?>