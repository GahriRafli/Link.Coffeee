<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="new_users">
		<div class="form-group">
			<label for="" class="control-label">Nama</label>
			<input type="text" name="name" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Username</label>
			<input type="text" name="username" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
		</div>
		<button class="button btn btn-info btn-sm">Buat</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>
<script>
	$('#new_users').submit(function(e){
		e.preventDefault()
		$('#new_users button[type="submit"]').attr('disabled',true).html('Saving...');
		if($(this).find('.alert-success').length > 0 )
			$(this).find('.alert-success').remove();
		$.ajax({
			url:'ajax.php?action=new_users',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#new_users button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'new_user.php?redirect=users.php' ?>';
				}else{
					$('#new_users').prepend('<div class="alert alert-success">Berhasil Membuat User Baru, Silakan Refresh Halaman</div>')
					$('#new_users button[type="submit"]').removeAttr('disabled').html('Create');
				}
			}
		})
	})
</script>