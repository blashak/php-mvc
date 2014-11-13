<?php $user = userController::getUser(); ?>
<form class="form-horizontal" role="form" action="<?php echo ABSOLUTE_URL.'/usuarios.html'; ?>" method="post">
  <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="name"
             placeholder="nombre" value="<?php if(isset($user) && count($user) == 1) echo $user[0]->getName();?>">
    </div>
  </div>
  <?php if(isset($user) && count($user) == 1): ?>
  	<input type="hidden" class="form-control" name="id" value="<?php echo $user[0]->getId();?>">
  	<input type="hidden" class="form-control" name="action" value="update">
  <?php else:?>
  	<input type="hidden" class="form-control" name="action" value="save">
  <?php endif;?>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="submit" class="btn btn-success" value="Guardar" />
    </div>
  </div>
</form>