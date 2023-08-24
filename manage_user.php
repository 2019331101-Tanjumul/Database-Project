<?php
   include('header.php');
   checkUser();
   adminArea();
   $msg="";
   $username="";
   $password="";
   $label="Add";
   if(isset($_GET['id']) && $_GET['id']>0){
   	$label="Edit";
   	$id=get_safe_value($_GET['id']);
   	$res=mysqli_query($con,"select * from users where id=$id");
   	if(mysqli_num_rows($res)==0){
   		redirect('users.php');
   		die();
   	}
   	$row=mysqli_fetch_assoc($res);
   	$username=$row['username'];
   	$password=$row['password'];
   }
   
   if(isset($_POST['submit'])){
   	$username=get_safe_value($_POST['username']);
   	$password=get_safe_value($_POST['password']);
   	$type="add";
   	$sub_sql="";
   	if(isset($_GET['id']) && $_GET['id']>0){
   		$type="edit";
   		$sub_sql="and id!=$id";
   	}
   	
   	$res=mysqli_query($con,"select * from users where username='$username' $sub_sql");
   	if(mysqli_num_rows($res)>0){
   		$msg="Username already exists";
   	}else{
   		
   		$password=password_hash($password,PASSWORD_DEFAULT);
   		
   		$sql="insert into users(username,password,role) values('$username','$password','User')";
   		if(isset($_GET['id']) && $_GET['id']>0){
   			$sql="update users set username='$username',password='$password' where id=$id";
   		}
   		mysqli_query($con,$sql);
   		redirect('users.php');
   	}
   }
   ?>
<script>
   setTitle("Manage Users");
   selectLink('users_link');
</script>
<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<h2><?php echo $label?> User</h2>
<a href="users.php">Back</a>
<div class="card">
<div class="card-body card-block">
<form method="post" class="form-horizontal">
   <div class="form-group">												<label class="control-label mb-1">Username</label>
      <input type="text" name="username" required value="<?php echo $username?>" class="form-control" rquired>
   </div>
   <div class="form-group">												<label class="control-label mb-1">Password</label>
      <input type="text" name="password" required value="<?php echo $password?>" class="form-control" rquired>
   </div>
   <div class="form-group">												
      <input type="submit" name="submit" value="Submit"  class="btn btn-lg btn-info btn-block">                          
   </div>
   <div id="msg"><?php echo $msg?></div>
</form>
<?php
   include('footer.php');
   ?>