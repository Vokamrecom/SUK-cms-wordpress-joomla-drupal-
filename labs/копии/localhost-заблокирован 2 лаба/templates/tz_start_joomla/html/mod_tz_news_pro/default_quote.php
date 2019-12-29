<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 2/27/14
 * Time: 11:20 AM
 */
?>


<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    <div class="blog blog<?php echo $i + 1; ?>">
        <i class="icon-quote"></i>
        <?php echo $item->quote_text ?>
        <div class="dv1">
            <div class="muted author"><?php echo $item->quote_author; ?></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>