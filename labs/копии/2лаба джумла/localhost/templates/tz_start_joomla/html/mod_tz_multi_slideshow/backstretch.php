<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 6/13/14
 * Time: 10:59 AM
 */
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . 'templates/' . JFactory::getApplication()->getTemplate() . '/js/backstretch.js');

?>
<script type="text/javascript">
    jQuery(window).ready(function () {
        jQuery.backstretch([
            <?php $j = count($list) - 1;
            for ($i = 0; $i <= $j; $i++) {
            if(isset($list[$i]->image) && $list[$i]->image){
            ?>
            "<?php echo JUri::root() . $list[$i]->image; ?>"
            <?php }?>
            <?php if($i < $j):?>
            ,
            <?php endif;?>
            <?php } ?>
        ], {duration: 5000, fade: 'slow'});
    });
</script>