<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Article Manager - Edit Article</h1>

    <form action="index.php?module=articlemanager&action=edit_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=articlemanager&action=view'" value="Cancel" title="Return to previous page." />
        <input type="hidden" name="id" value="<?php echo $data["id"]; ?>" />
        <div>Alias:</div><input type="text" maxlength="100" name="editalias" value="<?php echo $data["alias"]; ?>" />
        <div>Title:</div><input type="text" maxlength="100" name="edittitle" value="<?php echo htmlentities($data["title"]); ?>" />
        <div>Content:</div><textarea rows="20" cols="50" name="editcontent"><?php echo htmlentities($data["content"]); ?></textarea>
    </form>
</div>