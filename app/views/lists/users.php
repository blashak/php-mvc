<?php 
	$users = userController::getCollUsers();
?>

<?php foreach ($users as $k => $v):?>
	<tr id="tr_<?php echo $users[$k]->getId();?>">
		<td><?php echo $users[$k]->getId();?></td>
		<td><?php echo $users[$k]->getName();?></td>
		<td>
			<a href="<?php echo ABSOLUTE_URL.'/usuarios/'.$users[$k]->getId().'.html'; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-pencil" /></i></a >
			<a href="javascript:void(0);" id="user_<?php echo $users[$k]->getId();?>" class="btn btn-danger btn-user-delete"><i class=" glyphicon glyphicon-trash" /></i></a>
		</td>
	</tr>
<?php endforeach;?>


<script type="text/javascript">

var page = '<?php echo ABSOLUTE_URL.'/usuarios.html';?>';
var id;

$('.btn-user-delete').on('click', function() {
	id = $(this).attr('id').split('_')[1];
	if(id !== '') enviar('action=delete&id='+id);
});

function enviar(d) {
	$.ajax({
		type:'POST',
		url:page,
		data:d,
		success:function(data) {
			if (data == '')  $("#tr_"+id).remove();
		}

	});
}

</script>