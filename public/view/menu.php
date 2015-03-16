<?php
namespace org\jfa\todo;
/** 
 * I am the menu view.
 *
 * @author John Allen
 * @version 1.0
 */
?>
<nav class="navbar navbar-default">
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?= buildLink('list') ?>">Home</a></li>
        <li><a href="<?= buildLink('edittodo') ?>&id=0">New ToDo &raquo;</a></li>
        <li><a href="<?= buildLink('deletecompleted') ?>">Clear Completed</a></li>
        <li><a href="<?= getBaseURI() ?>?reload=true">Reload Application</a></li>
      </ul>
    </div>
</nav>