<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Admin Control Panel - User Management - Modify User</h1>
    
    <form action="index.php?module=acp&action=edit_user_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=acp&action=user_manager'" value="Cancel" title="Return to previous page." />
        <input type="hidden" name="id" value="<?php echo $data["id"]; ?>" />
        <div>Username:</div><input type="text" maxlength="20" name="user" value="<?php echo $data["username"]; ?>" />
        <div>Password:</div><a href="index.php?module=acp&action=reset_password&id=<?php echo $data["id"]; ?>">Reset this user's password</a>
        <div>Level:</div><input type="text" maxlength="3" name="level" value="<?php echo $data["level"]; ?>" />
    </form>
</div>