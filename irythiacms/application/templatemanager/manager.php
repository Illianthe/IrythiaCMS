<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Template Manager</h1>
        
    <div class="addbutton"><a href="index.php?module=templatemanager&action=add">Add New Stylesheet</a></div>
    
    <table class="templatemanager">
        <tr>
            <th>Name</th>
            <th>Options</th>
        </tr>
        <?php foreach ($list as $article): ?>
        <?php echo ($article["loaded"] == 1) ? "<tr class=\"loaded\">" : "<tr>"; ?>
            <td><?php echo $article["name"]; ?></td>
            <td>
                <?php if ($article["loaded"] == 0): ?>
                    <div class="loadbutton"><a href="index.php?module=templatemanager&action=load&id=<?php echo $article["id"]; ?>">Load</a></div>
                <?php endif; ?>
                <div class="editbutton"><a href="index.php?module=templatemanager&action=edit&id=<?php echo $article["id"]; ?>">Edit</a></div>
                <div class="deletebutton"><a href="index.php?module=templatemanager&action=delete&id=<?php echo $article["id"]; ?>">Delete</a></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>