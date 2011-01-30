<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Admin Control Panel - User Management - Create User</h1>
    
    <form action="index.php?module=acp&action=add_user_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=acp&action=user_manager'" value="Cancel" title="Return to previous page." />
        <div>Username:</div><input type="text" maxlength="20" name="user" />
        <div>Password:</div><input type="password" maxlength="20" name="pass" />
        <div>Level:</div><input type="text" maxlength="3" name="level" />
    </form>
</div>