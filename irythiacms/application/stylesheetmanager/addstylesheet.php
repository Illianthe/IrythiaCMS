<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Stylesheet Manager - Add Stylesheet</h1>

    <form action="index.php?module=stylesheetmanager&action=add_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=stylesheetmanager&action=view'" value="Cancel" title="Return to previous page." />
        <div>Name:</div><input type="text" maxlength="100" name="addname" value="<?php echo htmlentities($data["name"]); ?>" />
        <div>Content:</div><textarea rows="20" cols="50" name="addcontent"><?php echo htmlentities($data["content"]); ?></textarea>
    </form>
</div>