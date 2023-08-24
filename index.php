
<?php
include('header.php'); 
if(isset($_POST['login'])){
  $username=get_safe_value($_POST['username']);
  $password=get_safe_value($_POST['password']);
  $res=mysqli_query($con, "select * from users where username = '$username'
  and password= '$password'");
  if(mysqli_num_rows($res)>0) { 

    $row= mysqli_fetch_assoc($res); 
    $_SESSION['UID']= $row['id']; 
    $_SESSION['UNAME']= $row['username']; 
    redirect('dashboard.php'); 
  }else { 
    echo "Please enter valid login details"; 
  }
}
?> 
<h2>Login</h2>
<form method="post"> 
<table>
    <tr>
        <td>
         Username  <!--Here starts the login inputs-->
        </td>
        <td><input type="text" name="username" required></td> 
    </tr>
    <td>
         Password
        </td>
        <td><input type="password" name="password" required></td>
    </tr>
        <td><input type="submit" name="login" value="Login"></td> <!--Here ends the login inputs-->
    </tr>

</table>
</form>

<?php 

include("footer.php"); 

?>