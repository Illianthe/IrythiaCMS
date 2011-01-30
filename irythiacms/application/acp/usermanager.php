<div class="<?php echo $messagetype; ?>"><?php echo $message; ?></div>

<div class="contentwrapper">
    <h1>Admin Control Panel - User Management</h1>
        
    <div class="addbutton"><a href="index.php?module=acp&action=add_user">Add New User</a></div>
    
    <table class="usermanager">
        <tr>
            <th>Name</th>
            <th>Access Level</th>
            <th>Options</th>
        </tr>
        <?php foreach ($list as $user): ?>
        <tr>
            <td><?php echo $user["username"]; ?></td>
            <td><?php echo $user["level"]; ?></td>
            <td>
                <div class="editbutton"><a href="index.php?module=acp&action=edit_user&id=<?php echo $user["id"]; ?>">Edit</a></div>
                <div class="deletebutton"><a href="index.php?module=acp&action=delete_user&id=<?php echo $user["id"]; ?>">Delete</a></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>