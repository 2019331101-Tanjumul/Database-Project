<?php
include('header.php'); 
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
        <td><input type="text" name="password" required></td>
    </tr>
        <td><input type="button" name="login" value="Login"></td> <!--Here ends the login inputs-->
    </tr>

</table>
</form>

<?php 

include("footer.php"); 

?>