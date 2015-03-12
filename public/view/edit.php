<?php
/**
 * I display the edit form for a ToDo.
 *
 * @author John Allen
 * @version 1.0
 */
$formData = getViewState()->getData();
?>
<h1>Edit</h1>
<form action="<?= buildLink('savetodo') ?>" method="post" role="form" >
  <input type="hidden" name="id" value="<?= $formData->getID() ?>" />
  <div class="form-group">
    <label for="task">Task:</label>
    <input class="form-control" name="task" id="task" value="<?= $formData->task ?>">
  </div>
  <div class="checkbox">
    <label>
    	<input 
    		type="checkbox" 
    		name="complete" 
    		id="complete" 
    		<?php if($formData->getComplete()){ ?>checked<?php } ?> 
    	/>
    	Completed?
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>