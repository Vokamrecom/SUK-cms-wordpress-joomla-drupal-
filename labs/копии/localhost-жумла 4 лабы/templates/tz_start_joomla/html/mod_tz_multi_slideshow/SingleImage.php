<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 6/24/14
 * Time: 11:20 AM
 */
defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . 'templates/' . JFactory::getApplication()->getTemplate() . '/js/resizeimage.js');
$img_bg = $list[0]->image;
if ($img_bg) {
    $css_bg = '#homepage {
   background: url("' . JUri::base() . $img_bg . '") no-repeat scroll center top / cover  rgba(0, 0, 0, 0);
    }';
    $doc->addStyleDeclaration($css_bg);
}
?>
<script type="text/javascript">
    jQuery(window).bind('load resize', function () {
        var image = new Image();
        image.src = jQuery('#big-image-wrap').find('img').attr('src');
        h_image = image.height;
        w_image = image.width;
        var m_resize = new resizeImage(w_image, h_image, jQuery(window).width(), jQuery(window).height());
        jQuery('#big-image-wrap img').css({top: m_resize.top, left: m_resize.left, width: m_resize.width, height: m_resize.height});
    });
</script>