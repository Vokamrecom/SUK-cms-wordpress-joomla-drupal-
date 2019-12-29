<?php
/**
 * Created by PhpStorm.
 * User: Thuong
 * Date: 5/7/14
 * Time: 10:49 AM
 */

defined('_JEXEC') or die();
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
$document = JFactory::getDocument();
require_once(JPATH_SITE . DS . 'modules' . DS . 'mod_tz_multipurpose' . DS . 'helper.php');
$document->addStyleSheet('modules/mod_tz_multipurpose/css/ourteam.css');

$font_as = $params->get('fontas_ot', 0);
$responsive = $params->get('add_css_rps_ut', 0);
if ($responsive) {
    $document->addStyleSheet('modules/mod_tz_multipurpose/css/tz_style.css');
}
if ($font_as == 1) {
    $document->addStyleSheet('modules/mod_tz_multipurpose/css/font-awesome.min.css');
}

$field_name = $params->get('ut_name', '');
$field_dsc = $params->get('ut_desc', '');
$field_social = $params->get('ut_social', '');
$field_job = $params->get('ut_job', '');
$field_background = $params->get('ut_background', '');
$field_social_arr = explode(',', $field_social);

// column bootstrap
$col = 12 / $params->get('column_ut', 4);
$col_table = 12 / $params->get('column_ut_table', 4);
$col_mobile = 12 / $params->get('column_ut_mobile', 12);

$m = 1;
$count_list = count($list);
$col_display = floor(12 / $col);
$check_bt = 0;
if ($m == $col_display) {
    $check_bt = 1;
}
?>

<?php
echo '<div class="row">';
foreach ($list as $key => $arr) {

    echo '<div class=" col-lg-' . $col . ' col-md-' . $col_table . ' col-sm-' . $col_table . ' col-xs-' . $col_mobile . ' team_animation">' .
        '<div class="member">';

    $id_group = $arr->group;
    $list_field_id = modTZMultipurposeHelper::getFieldGroup($id_group, '');
    $count_list_field = count($list_field_id);
    $socialFields = null;
    $i1 = 0;
    $j = 0;
    $j1 = 0;
    $b = 0;
    foreach ($list_field_id as $f => $v_id_f) {
        $i = 0;
        $j1++;
        foreach ($arr as $n => $value) {

            $a = (int)$n;
            if ($n != 'group' && $a == $v_id_f) {
                if (is_numeric($a)) {
                    if ($value != "") {
                        $field = modTZMultipurposeHelper::getField($a);
                        $value_field = $field->value;
                        $type_field = $field->type;
                        $id_field = $field->id;
                        // type Image

                        if ($type_field == 'image' || $type_field == 'link') {
                            if ($b == 0) {
                                echo '<figure>';
                                echo '<div class="member-mask"></div>';
                                echo '<div class="border-wrap">';
                                echo '<div class="icon-border">';
                                echo '<span class="fa-stack fa-lg">';
                                echo '<i class="fa fa-share fa-inverse fa-fw"></i>';
                                echo '</span>';
                                echo '</div>';
                                echo '</div>';

                            }
                            $b++;
                            if ($type_field == 'image') {
                                echo '<img src="' . $value . '" alt="' . $field->title . '" />';
                            }
                            if ($type_field == 'link' && preg_match('/fa fa-*.?/i', $value) == 1) {
                                $i++;
                                if ($i == 1 && in_array($id_field, $field_social_arr)) {
                                    if ($j == 0) {
                                        echo '<div class="team-social-icons">';
                                    }
                                    $j++;
                                    $link_option = modTZMultipurposeHelper::getlink($arr, $a);
                                    if ($font_as == 1) {
                                        echo '<a ' . $link_option->link_o . ' href="' . $link_option->link . '"><i class="' . $link_option->title_link . '"></i></a>';
                                    } else {
                                        echo '<a ' . $link_option->link_o . ' href="' . $link_option->link . '"><img src="' . $link_option->img . '" alt="' . $link_option->title_link . '"></a>';
                                    }

                                    $field2 = modTZMultipurposeHelper::getField($list_field_id[$f + 1]);
                                    if (isset($list_field_id[$f + 1]) && $field2->type != 'link') {
                                        echo '</div>';
                                    }

                                }
                            }


                            $field2 = modTZMultipurposeHelper::getField($list_field_id[$f + 1]);
                            if (isset($list_field_id[$f + 1]) && $field2->type != 'link' && $field2->type != 'image') {
                                echo '</figure>';
                            }


                        } else {
                            if ($i1 == 0) {
                                echo '<div class="member-content">';
                                $i1++;
                            }
                            // type radio, checkbox, multipleSelect, select
                            if ($type_field == 'radio' || $type_field == 'checkbox' || $type_field == 'multipleSelect' || $type_field == 'select') {
                                $get_value_f = modTZMultipurposeHelper::getFieldValue($value_field, $value, $option_stm);
                                if (isset($get_value_f)) {
                                    echo $get_value_f;
                                }
                            }
                            if ($field_background == $id_field) {
                                echo '<i class="' . $value . ' decor"></i>';
                            }
                            // type textarea, textfield
                            if ($type_field == 'textarea' || ($type_field == 'textfield' && $field_background != $id_field)) {
                                if ($field_name == $id_field) {
                                    $first_attr = 'h4 class="name"';
                                    $last_attr = '/h4';
                                } else {
                                    if ($field_job == $id_field) {
                                        $first_attr = 'div class="job"';
                                        $last_attr = '/div';
                                    } else {
                                        if ($field_dsc == $id_field) {
                                            $first_attr = 'p';
                                            $last_attr = '/p';
                                        } else {
                                            $first_attr = 'p';
                                            $last_attr = '/p';
                                        }
                                    }
                                }


                                echo '<' . $first_attr . '>' . $value . '<' . $last_attr . '>';
                            }

                            if ($j1 == $count_list_field) {
                                echo '</div>'; // end div ourteam_desc
                                $j1 = 0;
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
echo '</div>';
if ($m % $col_display != 1 && $check_bt == 0) echo "</div>";
?>