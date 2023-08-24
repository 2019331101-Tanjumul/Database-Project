<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');

$cat_id='';
$sub_sql='';
$from='';
$to='';
if(isset($_GET['category_id']) && $_GET['category_id']>0){
	$cat_id=get_safe_value($_GET['category_id']);
	$sub_sql=" and category.id=$cat_id ";
}

if(isset($_GET['from'])){
	$from=get_safe_value($_GET['from']);
}
if(isset($_GET['to'])){
	$to=get_safe_value($_GET['to']);
}

if($from!=='' && $to!=''){
	$sub_sql.=" and expense.expense_date between '$from' and '$to' ";
}
	

$res=mysqli_query($con,"select sum(expense.price) as price,category.name from expense,category where expense.category_id=category.id and expense.added_by='".$_SESSION['UID']."' $sub_sql  group by expense.category_id");
?>
<h2>Reports</h2>

<form type="get">
	From <input type="date" name="from" value="<?php echo $from?>" max="<?php echo date('Y-m-d')?>" onchange="set_to_date()" id="from_date">
	
	&nbsp;&nbsp;&nbsp;
	To <input type="date" name="to"  value="<?php echo $to?>"  max="<?php echo date('Y-m-d')?>"  id="to_date">
	<?php echo getCategory($cat_id,'reports');?>
	<input type="submit" name="submit" value="Submit">
	<a href="reports.php">Reset</a>
</form>
<?php
if(mysqli_num_rows($res)>0){
?>
<br/><br/>
<table border="1">
	<tr>
		<th>Category</th>
		<th>Price</th>
	</tr>
	
	<?php 
	$final_price=0;
	while($row=mysqli_fetch_assoc($res)){
	$final_price=$final_price+$row['price'];	
	?>
	<tr>
		<td><?php echo $row['name']?></td>
		<td><?php echo $row['price']?></td>
	</tr>
	<?php } ?>
	
	<tr>
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