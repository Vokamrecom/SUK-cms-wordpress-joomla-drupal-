<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    TemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
$link = $params->get('tag-link');

?>
<div class="side-box tags">
    <h4 class="boxtitle"><?php echo($module->title); ?></h4>
    <hr>
    <?php

    foreach ($list as $tag) {
        ?>
        <?php if ($link == 'yes') { ?>
            <button class="button button-inverse">
                <a href="<?php echo $tag->taglink; ?>"><?php echo $tag->tagname; ?></a>
            </button>

        <?php } else { ?>
            <button class="button button-inverse">
                <span><?php echo $tag->tagname; ?></span>
            </button>
        <?php
        }
    } ?>
</div>