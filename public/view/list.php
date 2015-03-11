<?php 
/**
 * I display a list of all the ToDos.
 */
$list = getViewState()->getData();
?>
<?php if ( count($list) > 0 ) { ?>
<h1>List of Things To Do</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>Task</th>
			<th>Completed?</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php  foreach ($list as $value) { ?>
			<tr>
				<td><a href="<?= buildLink('edittodo') ?>&id=<?= $value->getID();?>">Edit</a></td>
				<td><?php echo $value->getTask(); ?></td>
				<td>
					<?php 
						$displayValue = 'no';
						if ( $value->getComplete() ){
							$displayValue = 'yes';
						} 
					?>
					<?php echo $displayValue; ?>
				</td>
				<td><a href="<?= buildLink('deletetodo') ?>&id=<?= $value->getID();?>">Delete</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php } else { ?>
	<h1>No To Dos! Add One.</h1>
<?php } ?>