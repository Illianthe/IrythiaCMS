<?php
/**
 * Purpose: Creates a dynamic navigation bar based on permissions
 **/

global $userlevel;

// Quick way to determine whether to show a top level menu (i.e.
// when a submenu/subcategory exists)
foreach ($userlevel[$_SESSION["level"]] as $id) {
    $menucategories[] = floor($id / 100);
}

// Output a link if category is in array
function outputlink($category, $menucategories, $name, $link) {
    if (in_array($category, $menucategories)) {
        $string = "<li><a href=\"" . $link . "\">" . $name . "</a></li>";
        echo $string;
    }
}
?>

<ul class="navigation">
    <li>
        <div class="navheader">CMS</div>
        <ul>
            <li><a href="index.php">Main</a></li>
            <li><a href="<?php echo SITE_PATH; ?>" target="_blank">Launch Site</a></li>
            <li><a href="index.php?module=auth&action=logout">Logout</a></li>
        </ul>
    </li>
    
    <li>
        <div class="navheader">Content</div>
        <ul>
            <?php outputlink(2, $menucategories, "Articles", "index.php?module=articlemanager&action=view"); ?>
            <?php outputlink(3, $menucategories, "Stylesheets", "index.php?module=stylesheetmanager&action=view"); ?>
            <?php outputlink(4, $menucategories, "Templates", "index.php?module=templatemanager&action=view"); ?>
        </ul>
    </li>
    
    <li>
        <div class="navheader">Settings</div>
        <ul>
            <?php outputlink(5, $menucategories, "User Control Panel", "index.php?module=ucp&action=view"); ?>
            <?php outputlink(6, $menucategories, "Admin Control Panel", "index.php?module=acp&action=view"); ?>
        </ul>
    </li>
</ul>