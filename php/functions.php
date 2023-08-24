<?php
function prx($data){
	echo '<pre>';
	print_r($data);
	die();
}

function get_safe_value($data){
	global $con;
	if($data){
		return mysqli_real_escape_string($con,$data);
	}
}

function redirect($link){
	?>
	<script>
	window.location.href="<?php echo $link?>";
	</script>
	<?php
}

function checkUser(){
	if(isset($_SESSION['UID']) && $_SESSION['UID']!=''){
	
		
	}else{
		redirect('index.php');
	}
}

function getCategory($category_id='',$page=''){
	global $con;
	$res=mysqli_query($con,"select * from category order by name asc");
	$fun="required";
	if($page=='reports'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="category_id" id="category_id">';
		$html.='<option value="">Select Category</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($category_id>0 && $category_id==$row['id']){
				$html.='<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			}else{
				$html.='<option value="'.$row['id'].'">'.$row['name'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}

function getDashboardExpense($type){
	global $con;
	$today=date('Y-m-d');
	if($type=='today'){
		$sub_sql=" and expense_date='$today'";
		$from=$today;
		$to=$today;
	}
	elseif($type=='yesterday'){
		$yesterday=date('Y-m-d',strtotime('yesterday'));
		$sub_sql=" and expense_date='$yesterday'";
		$from=$yesterday;
		$to=$yesterday;
	}elseif($type=='week' || $type=='month' || $type=='year'){
		$from=date('Y-m-d',strtotime("-1 $type"));
		$sub_sql=" and expense_date between '$from' and '$today'";
		$to=$today;
	}else{
		$sub_sql=" ";
		$from='';
		$to='';
	}
	
	$res=mysqli_query($con,"select sum(price) as price from expense where added_by='".$_SESSION['UID']."' $sub_sql");
	
	$row=mysqli_fetch_assoc($res);
	$p=0;
	$link="";
	if($row['price']>0){
		$p=$row['price'];
		$link="&nbsp;<a href='dashboard_report.php?from=".$from."&to=".$to."' target='_blank'>Details</a>";
	}
	
	return $p.$link;	
}

function adminArea(){
	if($_SESSION['UROLE']!='Admin'){
		redirect('dashboard.php');
	}
}

function userArea(){
	if($_SESSION['UROLE']!='User'){
		redirect('category.php');
	}
}
?>