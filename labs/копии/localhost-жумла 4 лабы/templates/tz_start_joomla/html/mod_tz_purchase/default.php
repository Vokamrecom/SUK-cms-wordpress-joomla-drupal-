<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();

$column = $params->get('column_lg');
$col = 12 / $column;
if ($column % 2 == 1) {
    $col_center = (int)($column / 2) + 1;
} else {
    $col_center = 0;
}
if ($list):
    ?>
    <div class="iphones">
        <div class="container">
            <div class="row">
                <?php foreach ($list as $i => $item): ?>
                    <?php
                    $class = '';
                    if ($col_center != 0 && ($i + 1) == $col_center) {
                        $class = 'col_center';
                    } else {
                        $class = '';
                    }
                    ?>
                    <div
                        class="col-lg-<?php echo $col; ?> col-md-<?php echo $col; ?> col-sm-<?php echo $col; ?> col-xs-12 <?php echo $class; ?> ">
                        <img class="img-responsive" src="<?php echo $item->purchase_image; ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>