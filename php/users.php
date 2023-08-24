<?php
include('header.php');
checkUser();
adminArea();
include('user_header.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	mysqli_query($con,"delete from users where id=$id");
	
	mysqli_query($con,"delete from expense where added_by=$id");
	echo "<br/>Data deleted<br/>";
}

$res=mysqli_query($con,"select * from users where role='User' order by id desc");
?>
<h2>Category</h2>
<a href="manage_user.php">Add User</a>
<br/><br/>
<?php
if(mysqli_num_rows($res)>0){
?>

<table border="1">
	<tr>
		<td>ID</td>
		<td>Username</td>
		<td></td>
	</tr>
	<?php while($row=mysqli_fetch_assoc($res)){?>
	<tr>
		<td><?php echo $row['id'];?></td>
		<td><?php echo $row['username']?></td>
		<td>
			<a href="manage_user.php?id=<?php echo $row['id'];?>">Edit</a>&nbsp;
			
			<a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','users.php')">Delete</a>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } 
	else{
		echo "No data found";
	}
?>


<?php
include('footer.php');
?>