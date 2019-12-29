<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 6/16/14
 * Time: 11:57 AM
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
$use_icon = $params->get('use_icon', 1);
$col = $params->get('column_df', 4);
$col_table = $params->get('column_df_table', 4);
$col_mobile = $params->get('column_df_mobile', 12);
$bg_offer = $params->get('bg_offer');
if ($bg_offer) {
    $bg_customer = '
    .customer_bg{
    background: url("' . JUri::base() . $bg_offer . '") no-repeat scroll center top  rgba(0, 0, 0, 0);
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
$m = 1;
$count_list = count($list);
$col_display = floor(12 / $col);
$check_bt = 0;
if ($m == $col_display) {
    $check_bt = 1;
}
?>

<div class="overlay"></div>
<div class="overlay-color"></div>
<div class="customer_bg"></div>
<div class="container">
    <?php $offer_title = $params->get('set_title_offer');
    if ($offer_title): ?>
    <div class="row title">
        <?php echo $offer_title; ?>
    </div>
    <?php endif; ?>
    <?php
    foreach ($list as $key => $arr) {
        if ($key == 0 || $key % 2 == 0) {
            echo '<div class="row">';

        }
        echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 offer-box">';
        echo '<div class="row">';

        $id_group = $arr->group;
        $list_field_id = modTZMultipurposeHelper::getFieldGroup($id_group, '');
        $i = 0;
        foreach ($list_field_id as $f => $v_id_f) {
            foreach ($arr as $n => $value) {
                $a = (int)$n;
                if ($n != 'group' && $a == $v_id_f) {
                    if (is_numeric($a)) {
                        if ($value != "") {
                            $field = modTZMultipurposeHelper::getField($a);
                            $value_field = $field->value;
                            $type_field = $field->type;

                            ?>
                            <?php
                            if ($key % 2 == 0) {
                                $icon_right = 'pull-right';
                            } else {
                                $icon_right = '';
                            }
                            if ($type_field == 'textfield') {
                                if ($use_icon == 1 && preg_match('/fa fa-*.?/i', $value) == 1) {
                                    echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">';
                                    echo '<div class="icon-border ' . $icon_right . '">';
                                    echo '<span class="fa-stack fa-lg"><i class="' . $value . ' fa-stack-2x fa-inverse fa-fw"></i></span>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                if (preg_match('/fa fa-/i', $value) == 0) {
                                    echo '<h4>' . $value . '</h4>';
                                }
                            }
                            if ($key % 2 != 0) {
                                $class = 'pull-right';
                            } else {
                                $class = '';
                            }
                            if ($type_field == 'textarea') {
                                echo '<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 ' . $class . '  ">';
                                echo '<p>' . $value . '</p>';
                                echo '</div>';
                            }
                            ?>
                        <?php

                        }

                    }
                }
            }
        }
        echo '</div>';
        echo '</div>';

        $m++;
        if ($key != 0 && $key % 2 != 0) {

            echo '</div>';
        }
    }
    if ($m % $col_display != 1 && $check_bt == 0) echo "</div>";
    ?>
</div>