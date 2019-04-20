<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD Task</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/crud.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/crud.js"></script>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Employees</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" id="add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
			
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Email</th>
						<th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody  >
					 <?php $coun=0 ?> 
					 @foreach($persons as $person)
					<tr>
					<?php $coun=$coun+1 ?>
					<td>{{$person->name}}</td>
					<td>{{$person->email}}</td>
					<td>{{$person->address}}</td>
					<td>{{$person->phone}}</td>
					<td>
                            <a  onclick="editfun({{$person->id}})" href="#editEmployeeModal"  class="edit" data-toggle="modal"><i  class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a  onclick="deletefun({{$person->id}})" href="#deleteEmployeeModal"  class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
					</tr>
                    					
					@endforeach 
					
                </tbody>
            </table>
			<div class="clearfix">
			<div class="hint-text">Showing <b>{{$coun}}</b> out of <b>{{$person->count()}}</b> entries</div>
                <ul class="pagination">
                    
					{{$persons->links()}}
                </ul>
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form role="form"  action="/insert" method="POST">
				{{ csrf_field() }}	
				
					<div class="modal-header">						
						<h4 class="modal-title">Add Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
									
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required name="name">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required name="email">
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required name="address"></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required name="phone">
						</div>	
						<?php $num=0 ?>
						@if(count($errors)>0)
						<?php $num=1 ?>
						@foreach($errors->all() as $error)
						<div class="col-alert alert-danger">{{$error}}</div>
						@endforeach
						@endif				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input onclick="show({{$num}})" type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form role="form"  action="/edit"  method="get">
				
					<div class="modal-header">						
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">	
						<input id="edit_id" type="text" class="form-control" required style="display:none" name="id">				
						<div class="form-group">
							<label>Name</label>
							<input id="edit_name" type="text" class="form-control" required name="name">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input id="edit_email" type="email" class="form-control" required name="email">
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea id="edit_Address" class="form-control" required name="address"></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" id="edit_Phone" class="form-control" required name="phone">
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form role="form" action='/delete'  method="get">
				<input id="delete_id" style="display:none" name="delete_id">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input id="del" type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>                                		                            