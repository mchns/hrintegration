<?php

/**
 * @file
 * This template is used to print a single grouping in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $grouping: The grouping instruction.
 * - $grouping_level: Integer indicating the hierarchical level of the grouping.
 * - $rows: The rows contained in this grouping.
 * - $title: The title of this grouping.
 * - $content: The processed content output that will normally be used.
 */
$colors = array("yellow", "red", "green", "blue", "lightblue", "purple");
if (in_array($title, $colors)) {
?>
<div class="team team-<?php print $title; ?>">
    <?php print $content; ?>
</div>
<?php  
}
else if (substr($title,0,4) == '<img'){
?>
<div class="logo"><?php print $title; ?></div>
<?php print $content; ?>
<?php  
}
else {
?>
<?php if(!empty($title)): ?><h2 class="view-grouping-header"><?php print $title; ?></h2><?php endif; ?>
<?php print $content; ?>
<?php
}
?>