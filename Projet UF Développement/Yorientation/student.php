<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<title>Student List</title>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div style="padding-top:0 ;margin-top:0" class="container-fluid admin">
		<div class="col-md-12 alert alert-dark">Student List</div>
		<button class="btn btn-dark bt-sm" id="new_student"><i class="fa fa-plus"></i>	Add New</button>
		<br>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="5%">
						<col width="25%">
						<col width="10%">
						<col width="12%">
						<col width="12%">
						<col width="10%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Year</th>
							<th>CyberSecurity</th>
							<th>Dev</th>
							<th>CS Appreciation</th>
							<th>Dev Appreciation</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = $conn->query("SELECT s.*,u.name from students s left join users u  on s.user_id = u.id order by u.name asc ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
						?>
					<tr>
						<td><?php echo $row['id'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td><?php echo $row['level_section'] ?></td>
						<td><?php echo $row['cs_mark'] ?></td>
						<td><?php echo $row['dev_mark'] ?></td>
						<td><?php echo $row['cs_appreciation'] ?></td>
						<td><?php echo $row['dev_appreciation'] ?></td>
						<td>
							<center>
							 <button class="btn btn-sm btn-outline-dark edit_student" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i> Edit</button>
							<button class="btn btn-sm btn-outline-danger remove_student" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i> Delete</button>
							</center>
						</td>
					</tr>
					<?php
					}}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="manage_student" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add New student</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='student-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<label>Name</label>
									<input type="hidden" name="id" />
									<input type="hidden" name="uid" />
									<input type="hidden" name="user_type" value = '3' />
									<input type="text" name="name" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Year</label>
									<input type="text" name ="level_section" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>CyberSecurity</label>
									<input type="number" min="0" max="20" name ="cs_mark" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>Dev</label>
									<input type="number" min="0" max="20" name ="dev_mark" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>CS Appreciation</label>
									<input type="number" min="0" max="5" name ="cs_appreciation" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>Dev Appreciation</label>
									<input type="number" min="0" max="5" name ="dev_appreciation" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name ="username" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" required="required" class="form-control" />
								</div>
							</div>
							<div class="modal-footer">
								<button  class="btn btn-dark" name="save"><span class="glyphicon glyphicon-save"></span>Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_student').click(function(){
			$('#msg').html('')
			$('#manage_student .modal-title').html('Add New student')
			$('#manage_student #student-frm').get(0).reset()
			$('#manage_student').modal('show')
		})
		$('.edit_student').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_student.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="uid"]').val(resp.uid)
						$('[name="name"]').val(resp.name)
						$('[name="level_section"]').val(resp.level_section)
						$('[name="cs_mark"]').val(resp.cs_mark)
						$('[name="dev_mark"]').val(resp.dev_mark)
						$('[name="cs_appreciation"]').val(resp.cs_appreciation)
						$('[name="dev_appreciation"]').val(resp.dev_appreciation)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('#manage_student .modal-title').html('Edit Student')
						$('#manage_student').modal('show')

					}
				}
			})

		})
		$('.remove_student').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure to delete this data.');
			if(conf == true){
				$.ajax({
				url:'./delete_student.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#student-frm').submit(function(e){
			e.preventDefault();
			$('#student-frm [name="submit"]').attr('disabled',true)
			$('#student-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_student.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#student-frm [name="submit"]').removeAttr('disabled')
					$('#student-frm [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							alert('Data successfully saved');
							location.reload()
						}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

						}
					}
				}
			})
		})
	})
</script>
</html>