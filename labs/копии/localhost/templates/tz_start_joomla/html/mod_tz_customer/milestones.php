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
if ($list): ?>
    <div class="customers">
        <?php foreach ($list as $i => $item): ?>
            <div class="customer-wrap customer<?php echo $i + 1; ?> ">
                <div class="customer">
                    <img src="<?php echo $item->customer_image; ?>" alt="" class="img-circle">

                    <div class="data">
                        <i class="arrow-up"></i>EARNED $
                        <span class="m<?php echo $i + 1; ?>" data-from="0" data-to="<?php echo $item->customer_price ?>"
                              data-speed="6000"
                              data-refresh-interval="50"><?php echo $item->customer_price ?></span>K
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>