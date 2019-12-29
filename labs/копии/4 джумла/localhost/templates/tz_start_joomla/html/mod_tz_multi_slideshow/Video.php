<?php
/*------------------------------------------------------------------------
    # (TZ Module, TZ Plugin, TZ Component)
    # ------------------------------------------------------------------------
    # author    Sunland .,JSC
    # copyright Copyright (C) 2011 Sunland .,JSC. All Rights Reserved.
    # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
    # Websites: http://www.TemPlaza.com
    # Technical Support:  Forum - http://www.TemPlaza.com/forums/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
$url = JURI::base();

$choose_video_mp4 = $params->get('choose_video_mp4');
$choose_video_ogv = $params->get('choose_video_ogv');
$choose_image = $params->get('choose_image');
if ($choose_video_mp4==-1 && $choose_video_ogv==-1 && $choose_image==-1) return;
$videopath  =   '';
if (!file_exists(JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$choose_video_mp4) && !file_exists(JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$choose_video_ogv)) {
    $videopath  =   'videos/';
}
$url_link = JUri::root() . 'images/'.$videopath . $choose_image;
$url_video_mp4 = JUri::root() . 'images/'.$videopath . $choose_video_mp4;
$url_video_ogv = JUri::root() . 'images/'.$videopath . $choose_video_ogv;
$document = JFactory::getDocument();
$document->addScript($url . 'modules/mod_tz_multi_slideshow/js/bigvideo.js');
$document->addScript($url . 'modules/mod_tz_multi_slideshow/js/video.js');
$bg = '
    .wrapper-bg-x{
    background: url("' .$url_link . '") no-repeat scroll center top / cover  rgba(0, 0, 0, 0);
    display: block;
    height: 100%;
    position: fixed;
    width: 100%;
    z-index: 4;
    }
    ';
$document->addStyleDeclaration($bg);
?>
<div class="wrapper-bg"></div>
<script type="text/javascript">
    jQuery(function () {
        var BV = new jQuery.BigVideo({

            useFlashForFirefox: false,
            forceAutoplay: true,
            controls: false,
            doLoop: true
        });
        BV.init();
        var Opera = (navigator.userAgent.match(/Opera|OPR\//) ? true : false);
        if (Modernizr.touch) {
            BV.show('<?php echo $url_link; ?>');
        }

        else if (jQuery(window).width() < 1025) {
            jQuery(".wrapper-bg").addClass("wrapper-bg-x");
        }

        else if (Opera) {
            jQuery(".wrapper-bg").addClass("wrapper-bg-x");
        }

        else {
            BV.show('<?php echo $url_video_mp4;?>', {altSource: '<?php echo $url_video_ogv;?>'});
        }

    });
</script>


