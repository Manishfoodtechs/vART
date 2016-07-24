<div id="contentContainer">
    
    <div id="titleContainer">
        <h3>Admin Panel</h3>
    </div>
    <div id="loginContainer">

        <?php
        if ($loginError == 1) {
            echo "<span class='loginError'>Username or password was incorrect. Please try again.</span>";	
        }
        ?>
        
        <p />

        <form name="loginForm" method="post" action="admin.php">
            <span class='username'>username: <input name="username" type="text"></span>
            <span class='password'>password: <input name="password" type="password"></span>
            </br>
            <span class='login'><input type="submit" name="Login" value="Login"></span>
        </form>

    </div>
</div>