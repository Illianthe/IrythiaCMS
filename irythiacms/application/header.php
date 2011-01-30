<?php
/**
 * Purpose: Creates and outputs a header for the CMS.
 **/
?>

<div class="header">
    <div class="cmsinfo">
        <?php echo CMS_NAME; ?><br />
        Theme: <?php echo ucwords(THEME_NAME); ?> | Version: <?php echo CMS_VERSION; ?>
    </div>
    Hey, <?php echo $_SESSION["user"]; ?>!<br />
    <em>"Let the world tremble as they hear you roar..."</em>
    <div class="clear"></div>
</div>