<?php 
	error_reporting(E_ALL); ini_set("display_errors", 1);
	include('../app/app.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<?php echo file_get_contents(ABSOLUTE_URL."/public/includes/head.php"); ?>
	</head>
<body>


<div class="container">
	<div class="panel panel-default">
  		<!-- Default panel contents -->
  		<div class="panel-heading">Users</div>
  		<div class="panel-body">
    		<a href="<?php echo ABSOLUTE_URL.'/usuarios.html'; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus" /></i></a>
    		<a href="javascript:void(0);" id="getMore" class="btn btn-success"><i class="glyphicon glyphicon-chevron-down" /></i></a>
  		</div>

		<!-- Table -->
		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>First Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="userTbody">
				
			</tbody>
		</table>
	</div>
</div> <!-- /container -->

<script type="text/javascript">

var page = '<?php echo ABSOLUTE_URL.'/usuarios.html';?>';

enviar('action=get');

$('#getMore').on('click', function() {
	var nRegistre = $('#userTbody tr').length;
	var data = 'action=getMore&nRegistre='+nRegistre;
	enviar(data);
});

function enviar(d) {
	$.ajax({
		type:'POST',
		url:page,
		data:d,
		success:function(data) {
			//$("#userTbody").empty();
			$("#userTbody").append(data);
		}

	});
}

</script>

</body>
</html>