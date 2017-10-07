<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$selectSchools=array("International Community School","Halcyon London International School","Cookery School at Little Portland Street", "London School of Economics");
?>
<!DOCTYPE html>
<html>  
<head>  
	<title>List of candidates</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css" >  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
</head>  
<body> 
<div class="container">   
	<h2 align="center">List of candidates</h3>
	<form method="post" action="<?php echo base_url()?>index.php/school/form_validation">  
		<?php  
		if($this->uri->segment(2) == "inserted")  
		{   
			echo '<p class="text-success">Data Inserted</p>';  
		}  
		if($this->uri->segment(2) == "updated")  
		{  
			echo '<p class="text-success">Data Updated</p>';  
		}  
		?>  
		<?php  
		if(isset($user_data))  
		{  
			foreach($user_data->result() as $row)  
			{  
		?>
		<div class="row"> 
			<div class="form-group">  
				<label>Enter Name</label>  
				<input type="text" name="user" value="<?php echo $row->user; ?>" class="form-control" />  	
			</div>  
			<div class="form-group">  
				<label>Enter Mail</label>  
				<input type="text" name="mail" value="<?php echo $row->mail; ?>" class="form-control" />  
			</div>
		</div>
		<div class="row">
			<div class="form-group">  
				<label>Enter School</label>  
				<?php 
				$schoolArray = explode("<br>",$row->school);
				$schoolArrayLength = count($schoolArray)-1;  
					for ($y = 0; $y < $schoolArrayLength; $y++) { ?>
						<div class="updateField">
						<select name="school[]" class="form-control">
							<option><?php echo $schoolArray[$y]; ?></option>
						<?php foreach ($selectSchools as $selectSchool):?>
							<option><?php echo $selectSchool?></option>
						<?php endforeach; ?>
						</select>
						<?php if($y > 0){ ?>
							<a href="javascript:void(0);" class="removeButton" title="Remove field">Remove field</a>
						<?php } ?>
						</div>
					<?php } ?>
			</div>
			<div class="extraField"></div>
		</div>
		<div class="row">
			<a href="javascript:void(0);" class="addButton" title="Add field">Add more schools</a>
		</div>    
		<div class="form-group buttonForm">  
			<input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>" />  
			<input type="submit" name="update" value="Update" class="btn buttonUpdate" />  
		</div>       
		<?php       
			}  
		}  
		else  
		{  
		?>
		<div class="row">  
			<div class="form-group">  
				<label>Enter Name</label>  
				<input type="text" name="user" class="form-control" />
				<span class="text-danger"><?php echo form_error('user'); ?></span>  
			</div> 
			<div class="form-group">  
				<label>Enter Mail</label>  
				<input type="text" name="mail" class="form-control" /> 
				<span class="text-danger"><?php echo form_error('mail'); ?></span>  
			</div> 
		</div>
		<div class="row">
			<div class="form-group">  
				<label>Enter School</label>
				<select name="school[]" class="form-control">
					<?php foreach ($selectSchools as $selectSchool):?>
						<option><?php echo $selectSchool?></option>
					<?php endforeach; ?>  
				</select>
			</div>
			<div class="extraField"></div>
		</div>
		<div class="row">
			<a href="javascript:void(0);" class="addButton" title="Add field">Add more schools</a>
		</div>
		<div class="form-group buttonForm">  
			<input type="submit" name="insert" value="Insert" class="btn btn-info" />  
		</div>       
		<?php } ?>  
	</form>
	<div class="text-right">
		<select name="school[]" id="selectSchool">
			<option value="">All schools</option>
			<?php foreach ($selectSchools as $selectSchool):?>
				<option><?php echo $selectSchool?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="usersTable table-responsive">  
		<table class="table table-hover table-bordered">  
			<tr>  
				<th>ID</th>  
				<th>Name</th>  
				<th>Email</th>
				<th>School</th>
				<th>Update</th>  
				<th>Delete</th>    
			</tr>  
		<?php  
		if($fetch_data->num_rows() > 0)  
		{  
			foreach($fetch_data->result() as $row)  
			{  
		?>  
			<tr>  
				<td class="dataId"><?php echo $row->id; ?></td>  
				<td><?php echo $row->user; ?></td>  
				<td><?php echo $row->mail; ?></td> 
				<td><?php echo $row->school; ?></td>
				<td class="tableTextCenter"><a class="buttonUpdate" href="<?php echo base_url(); ?>index.php/school/update_data/<?php echo $row->id; ?>">Edit</a></td>
				<td class="tableTextCenter"><a href="#" class="deleteData buttonDelete" id="<?php echo $row->id; ?>">X</a></td>    
			</tr>  
		<?php       
			}  
		}  
		else  
		{  
		?>  
			<tr>  
				<td colspan="5">No Data Found</td>  
			</tr>  
		<?php  
		}  
		?>  
		</table>  
	</div> 
</div>
<script type="text/javascript">
	$("#selectSchool").change(function(e){
		$.ajax({
		type: "POST",
		url:'<?php echo base_url(); ?>index.php/school/filter',
		data:{'selectvalue': $('#selectSchool').val()},
		cache: false,
		success: function(result){
			resultJSON = $.parseJSON(result);
				$( ".table" ).find( ".dataId" ).each(function(index){$( this ).parent().hide();});
				$( ".table" ).find( ".dataId" ).each(function(index)
				{ 
				var tableLength = resultJSON.length;
					for (var x = 0; x < tableLength; x++) 
					{
						if($( this ).text() == resultJSON[x])
						{
							$( this ).parent().show();
						}
					}
				});
		},
		error: function(result){
			console.log(result);
		}
		});
	});
	$('.deleteData').click(function(){  
		var id = $(this).attr("id");  
		if(confirm("Are you sure you want to delete this?"))  
		{  
			window.location="<?php echo base_url(); ?>index.php/school/delete_data/"+id;  
		}  
		else  
		{  
			return false;  
		}  
	});    

	$(document).ready(function(){
		var maxField = 10;
		var fieldHTML = `
			<div>
			<select name="school[]" class="form-control">
				<?php foreach ($selectSchools as $selectSchool):?>
					<option><?php echo $selectSchool?></option>
				<?php endforeach; ?> 
			</select>
			<a href="javascript:void(0);" class="removeButton" title="Remove field">Remove field</a> 
			</div>`; 
		var x = 1;
		$('.addButton').click(function(){
			if(x < maxField){
				x++;
				$('.extraField').append(fieldHTML);
			}
		});
		$('.extraField').on('click', '.removeButton', function(e){
			e.preventDefault();
			$(this).parent().remove();
			x--;
		});
		$('.updateField').on('click', '.removeButton', function(e){
			e.preventDefault();
			$(this).parent().remove();
			x--;
		});
	});
</script>    
</body>  
</html>  
