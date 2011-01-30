<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Admin Control Panel - User Management - Password Reset</h1>
    
    <form action="index.php?module=acp&action=reset_password_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=acp&action=edit_user&id=<?php echo $data["id"]; ?>'" value="Cancel" title="Return to previous page." />
        <input type="hidden" name="id" value="<?php echo $data["id"]; ?>" />
        <div>Username:</div><?php echo $data["username"]; ?>
        <div>New Password:</div><input type="password" maxlength="20" name="newpass" />
        <div>Confirm New Password:</div><input type="password" maxlength="20" name="confirmpass" />
    </form>
</div>