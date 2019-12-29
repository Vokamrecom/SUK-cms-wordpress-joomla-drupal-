<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 5/7/14
 * Time: 10:49 AM
 */

defined('_JEXEC') or die();
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
$document = JFactory::getDocument();
require_once(JPATH_SITE . DS . 'modules' . DS . 'mod_tz_multipurpose' . DS . 'helper.php');
$document->addStyleSheet('modules/mod_tz_multipurpose/css/style.css');

$responsive = $params->get('add_css_rps_df', 0);
if ($responsive) {
    $document->addStyleSheet('modules/mod_tz_multipurpose/css/tz_style.css');
}
$field_title = $params->get('fs_title', '');
$field_links = $params->get('fs_links', '');
$field_description = $params->get('fs_desc', '');
$field_icon = $params->get('fs_icon', '');
$field_button = $params->get('fs_button', '');
$field_class_image = $params->get('fs_class_image', '');
$m = 1;
$count_list = count($list);
$bg_feature = $params->get('bg_feature_slide');
if($bg_feature){
    $bg_customer = '
    .customer_bg_feature{
    background: url("' . JUri::base() . $bg_feature . '") no-repeat scroll center top rgba(0, 0, 0, 0);
    background-size: cover;
    display: block;
    height: 100%;
    position: absolute;
    width: 100%;
    z-index: 3;
    }
    ';
    $document->addStyleDeclaration($bg_customer);
}


?>
<?php
$title_total = '';
$content_total = '';
$content_body = '';
$html = '';
$id_html ='';

foreach ($list as $key => $arr) {
    $itemHtml = '';
    $id_group = $arr->group;
    $list_field_id = modTZMultipurposeHelper::getFieldGroup($id_group, '');
    $i = 0;
    $class = '';
    foreach ($list_field_id as $f => $v_id_f) {
        foreach ($arr as $n => $value) {
            $a = (int)$n;
            if ($n != 'group' && $a == $v_id_f) {
                if (is_numeric($a)) {
                    if ($value != "") {
                        $field = modTZMultipurposeHelper::getField($a);
                        $value_field = $field->value;
                        $type_field = $field->type;
                        $id_field = $field->id;
                        if ($field_links != $id_field) {
                            if ($type_field != 'link') {
                                if ($field_title == $id_field) {
                                    $itemHtml .= '<div class="col-lg-5 col-lg-offset-7 col-md-9 col-sm-12 col-xs-12 feature-content">';
                                }

                                if ($field_class_image == $id_field) {
                                    $class = $value;
                                }
                                if ($field_icon == $id_field) {
                                    $icon = '<i class="' . $value . '"></i>';
                                } else {
                                    $icon = '';
                                }
                                if ($type_field == 'image') {
                                    $itemHtml .= '<img src="' . $value . '" alt="' . $field->title . '" class="' . $class . ' hidden-md hidden-sm hidden-xs" />';
                                } else {
                                    if ($field_icon != $id_field && $field_class_image != $id_field) {
                                        if ($field_title == $id_field) {
                                            $attr_first = '<h1>';
                                            $attr_last = '</h1><hr>';
                                        } else {
                                            $attr_first = '';
                                            $attr_last = ' <hr>';
                                        }
                                        $itemHtml .= $attr_first . $value . $attr_last;
                                    }
                                }

                            } else {
                                $i++;
                                if ($i == 1) {
                                    $link_option = modTZMultipurposeHelper::getlink($arr, $a);
                                    $itemHtml .= '<button class="button"><a ' . $link_option->link_o . ' href="' . $link_option->link . '">' . $link_option->title_link . '</a>' . $icon . '</button></div>';
                                }

                            }
                        } else {
                            $id_html = $value;
                            $title_body = '<span class="feature-name">' . $value . '</span>';
                            $title_first = '<a href="#' . JApplication::stringURLSafe($value) . '"><i class="fa fa-circle-o"></i><i class="fa fa-circle fa-fw active-point"></i>';
                            $title_last = '</a><hr>';
                            $title_total .= $title_first . $title_body . $title_last;
                        }
                    }

                }
            }

        }
    }
    $content_first = '<li id="' . JApplication::stringURLSafe($id_html) . '" class="row feature ">';
    $content_last = '</li>';
    $html .= $content_first . $itemHtml . $content_last;
    $m++;
}
?>
<div class="overlay"></div>
<div class="overlay-color"></div>
<div class="customer_bg_feature"></div>
<div class="container">
    <div class="links">
        <?php echo $title_total; ?>
    </div>
    <div class="content-slider">
        <ul class="slides">
            <?php echo $html; ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".content-slider ul li, i.active-point").hide();
        jQuery(".content-slider ul li:eq(2), i.active-point:eq(2)").show();

        jQuery(".links a").click(function () {
            "use strict";
            var que;
            que = jQuery(this).index();
            jQuery(".content-slider ul li, i.active-point").fadeOut(500);
            jQuery(".content-slider ul li:eq(" + que / 2 + "), i.active-point:eq(" + que / 2 + ")").fadeIn(350);
            return false;
        });
    });
</script>