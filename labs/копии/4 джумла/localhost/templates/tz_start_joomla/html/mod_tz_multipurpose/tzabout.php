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
$m = 1;
$count_list = count($list);
$col_display = floor(12 / $col);
$check_bt = 0;
if ($m == $col_display) {
    $check_bt = 1;
}
?>

<div class="boxes text-center">
    <div class="row">
        <?php
        foreach ($list as $key => $arr) {
            echo '<div class="col-sm-' . $col_table . ' col-xs-' . $col_mobile . ' col-md-' . $col . ' box">';
            echo '<div class="box-inner">';
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
                                if ($type_field != 'link') {
                                    ?>
                                    <?php
                                    if ($type_field == 'image') {
                                        echo '<img src="' . $value . '" alt="' . $field->title . '" />';
                                    }

                                    if ($type_field == 'radio' || $type_field == 'checkbox' || $type_field == 'multipleSelect' || $type_field == 'select') {
                                        $get_value_f = modTZMultipurposeHelper::getFieldValue($value_field, $value, $option_stm);
                                        if (isset($get_value_f)) {
                                            echo $get_value_f;
                                        }
                                    }

                                    if ($type_field == 'textfield') {
                                        if ($use_icon == 1 && preg_match('/fa fa-*.?/i', $value) == 1) {
                                            echo '<span class="fa-stack fa-lg"><i class="' . $value . ' fa-stack-2x fa-inverse fa-fw"></i></span>';
                                        }
                                        if (preg_match('/fa fa-/i', $value) == 0) {
                                            echo '<h4>' . $value . '</h4>';
                                        }
                                    }
                                    if ($type_field == 'textarea') {

                                        echo '<p>' . $value . '</p>';
                                    }
                                    ?>
                                    <?php
                                } else {
                                    $i++;
                                    if ($i == 1) {
                                        $link_option = modTZMultipurposeHelper::getlink($arr, $a);
                                        echo '<a ' . $link_option->link_o . ' href="' . $link_option->link . '">' . $link_option->title_link . '&nbsp;<i class="fa fa-angle-double-right"></i></a>';
                                    }
                                }
                            }

                        }
                    }
                }
            }
            echo '</div>';
            echo '</div>';
            $m++;
        }
        if ($m % $col_display != 1 && $check_bt == 0) echo "</div>";
        ?>
    </div>
</div>