<?php
   include('header.php');
   checkUser();
   adminArea();
   
   if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
   	mysqli_query($con,"delete from users where id=$id");
   	
   	mysqli_query($con,"delete from expense where added_by=$id");
   	echo "<br/>Data deleted<br/>";
   }
   
   $res=mysqli_query($con,"select * from users where role='User' order by id desc");
   ?>
<script>
   setTitle("Users");
   selectLink('users_link');
</script>
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <h2>Users</h2>
               <a href="manage_user.php">Add User</a>
               <br/><br/>
               <div class="table-responsive table--no-card m-b-30">
                  <table class="table table-borderless table-striped table-earning">
                     <thead>
                        <?php
                           if(mysqli_num_rows($res)>0){
                           ?>
                        <tr>
                           <th>ID</th>
                           <th>Username</th>
                           <th></th>
                        </tr>
                     <tbody>
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
                     </tbody>
                  </table>
                  <?php } 
                     else{
                     	echo "No data found";
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   include('footer.php');
   ?>