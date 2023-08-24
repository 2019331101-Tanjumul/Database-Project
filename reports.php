<?php
   include('header.php');
   checkUser();
   userArea();
   
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
<script>
   setTitle("Reports");
   selectLink('reports_link');
</script>
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="filter_form">
                  <form type="get">
                     From <input type="date" name="from" value="<?php echo $from?>" max="<?php echo date('Y-m-d')?>" onchange="set_to_date()" id="from_date" class="form-control w250">
                     &nbsp;&nbsp;&nbsp;
                     To <input type="date" name="to"  value="<?php echo $to?>"  max="<?php echo date('Y-m-d')?>"  id="to_date" class="form-control w250">
                     <?php echo getCategory($cat_id,'reports');?>
                     <input type="submit" name="submit" value="Submit" class="btn btn-lg btn-info btn-block">
                     <a href="reports.php">Reset</a>
                  </form>
               </div>
               <?php
                  if(mysqli_num_rows($res)>0){
                  ?>
               <br/><br/>
               <div class="table-responsive table--no-card m-b-30">
                  <table class="table table-borderless table-striped table-earning">
                     <tr>
                        <th>Category</th>
                        <th>Price</th>
                     </tr>
                     <tbody>
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
                     </tbody>
                  </table>
               </div>
               <?php } else {
                  echo "<b>No data found</b>";
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   include('footer.php');
   ?>