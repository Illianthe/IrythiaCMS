<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Template Manager - Edit Template</h1>

    <form action="index.php?module=templatemanager&action=edit_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=templatemanager&action=view'" value="Cancel" title="Return to previous page." />
        <input type="hidden" name="id" value="<?php echo $data["id"]; ?>" />
        <div>Name:</div><input type="text" maxlength="100" name="editname" value="<?php echo htmlentities($data["name"]); ?>" />
        <div>Content:</div><textarea rows="20" cols="50" name="editcontent"><?php echo htmlentities($data["content"]); ?></textarea>
    </form>
</div>