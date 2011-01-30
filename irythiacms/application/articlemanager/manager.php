<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Article Manager</h1>
        
    <div class="addbutton"><a href="index.php?module=articlemanager&action=add">Add New Article</a></div>
    
    <table class="articlemanager">
        <tr>
            <th>Alias</th>
            <th>Title</th>
            <th>Options</th>
        </tr>
        <?php foreach ($list as $article): ?>
        <tr>
            <td><?php echo $article["alias"]; ?></td>
            <td><?php echo $article["title"]; ?></td>
            <td>
                <div class="editbutton"><a href="index.php?module=articlemanager&action=edit&id=<?php echo $article["id"]; ?>">Edit</a></div>
                <div class="deletebutton"><a href="index.php?module=articlemanager&action=delete&id=<?php echo $article["id"]; ?>">Delete</a></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>