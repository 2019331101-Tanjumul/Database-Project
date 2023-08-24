<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');
?>
<h2>Dashboard</h2>

<table>
	<tr>
		<td>Today's Expense</td>
		<td>
		<?php echo getDashboardExpense('today')?>
		</td>
	</tr>
	<tr>
		<td>Yesterday's Expense</td>
		<td>
		<?php echo getDashboardExpense('yesterday')?>
		</td>
	</tr>
	<tr>
		<td>This Week Expense</td>
		<td>
		<?php echo getDashboardExpense('week')?>
		</td>
	</tr>
	<tr>
		<td>This Month Expense</td>
		<td>
		<?php echo getDashboardExpense('month')?>
		</td>
	</tr>
	<tr>
		<td>This Year Expense</td>
		<td>
		<?php echo getDashboardExpense('year')?>
		</td>
	</tr>
	<tr>
		<td>Total Expense</td>
		<td>
		<?php echo getDashboardExpense('total')?>
		</td>
	</tr>
</table>


<?php
include('footer.php');
?>