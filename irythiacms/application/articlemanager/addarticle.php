<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Article Manager - Add Article</h1>

    <form action="index.php?module=articlemanager&action=add_submit" method="post">
        <input type="submit" value="Submit" title="Process the data." /><input type="button" onclick="window.location='index.php?module=articlemanager&action=view'" value="Cancel" title="Return to previous page." />
        <div>Alias:</div><input type="text" maxlength="100" name="addalias" value="<?php echo $data["alias"]; ?>" />
        <div>Title:</div><input type="text" maxlength="100" name="addtitle" value="htmlentities(<?php echo $data["title"]); ?>" />
        <div>Content:</div><textarea rows="20" cols="50" name="addcontent"><?php echo htmlentities($data["content"]); ?></textarea>
    </form>
</div>