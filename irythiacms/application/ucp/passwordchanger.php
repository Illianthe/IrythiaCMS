<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>User Control Panel - Password Changer</h1>
    
    <form action="index.php?module=ucp&action=change_password_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=ucp&action=view'" value="Cancel" title="Return to previous page." />
        <div>Current Password:</div><input type="password" maxlength="20" name="currentpass" />
        <div>New Password:</div><input type="password" maxlength="20" name="newpass" />
        <div>Confirm New Password:</div><input type="password" maxlength="20" name="confirmpass" />
    </form>
</div>