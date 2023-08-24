<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');
$from='';
$to='';
$sub_sql="";
if(isset($_GET['from'])){
	$from=get_safe_value($_GET['from']);
}
if(isset($_GET['to'])){
	$to=get_safe_value($_GET['to']);
}

if($from!=='' && $to!=''){
	$sub_sql.=" and expense.expense_date between '$from' and '$to' ";
}


$res=mysqli_query($con,"select expense.price,category.name,expense.item,expense.expense_date from expense,category where expense.category_id=category.id  and expense.added_by='".$_SESSION['UID']."' $sub_sql");
?>
<h2>Dashboard Reports</h2>

<?php if($from!='' && $to!=''){ ?>
From <?php echo $from?>
To <?php echo $to?>
<?php } ?>

<?php
if(mysqli_num_rows($res)>0){
?>
<br/><br/>
<table border="1">
	<tr>
		<th>Category</th>
		<th>Item</th>
		<th>Expense Date</th>
		<th>Price</th>
	</tr>
	
	<?php 
	$final_price=0;
	while($row=mysqli_fetch_assoc($res)){
	$final_price=$final_price+$row['price'];	
	?>
	<tr>
		<td><?php echo $row['name']?></td>
		<td><?php echo $row['item']?></td>
		<td><?php echo $row['expense_date']?></td>
		<td><?php echo $row['price']?></td>
		
	</tr>
	<?php } ?>
	
	<tr>
		<th></th>
		<th></th>
		<th>Total</th>
		<th><?php echo $final_price?></th>
	</tr>
	
</table>
<?php } else {
	echo "<b>No data found</b>";
}
?>

<?php
include('footer.php');
?>