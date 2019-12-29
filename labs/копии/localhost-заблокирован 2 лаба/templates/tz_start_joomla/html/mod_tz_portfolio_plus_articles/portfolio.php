<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    TuanNATemPlaza

# copyright Copyright (C) 2015 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . '/components/com_tz_portfolio_plus/js/tz_portfolio_plus.min.js');
$doc->addScript(JUri::root() . '/components/com_tz_portfolio_plus/js/jquery.isotope.min.js');
$doc->addStyleSheet(JUri::base(true) . '/components/com_tz_portfolio_plus/css/isotope.min.css');
//$doc->addStyleSheet(JUri::base(true) . '/modules/mod_tz_portfolio_plus_articles/css/style.css');

if ($params->get('load_style', 0)) {
    $doc->addStyleSheet(JUri::base(true) . '/modules/mod_tz_portfolio_plus_articles/css/basic.css');
}

if ($params->get('height_element')) {
    $doc->addStyleDeclaration('
        #portfolio' . $module->id . ' .TzInner{
            height:' . $params->get('height_element') . 'px;
        }
    ');
}
if ($params->get('enable_resize_image', 0)) {
    $doc->addScript(JUri::base(true) . '/modules/mod_tz_portfolio_plus_articles/js/resize.js');
    if ($params->get('height_element')) {
        $doc->addStyleDeclaration('
        #portfolio' . $module->id . ' .tzpp_media img{
            max-width: none;
        }
        #portfolio' . $module->id . ' .tzpp_media{
            height:' . $params->get('height_element') . 'px;
        }
    ');
    }
}
$doc->addScriptDeclaration('
jQuery(function($){
    $(document).ready(function(){
        $("#portfolio' . $module->id . '").tzPortfolioPlusIsotope({
            "mainElementSelector"       : "#TzContent' . $module->id . '",
            "containerElementSelector"  : "#portfolio' . $module->id . '",
            "sortParentTag"             : "filter' . $module->id . '",
            "isotope_options"                   : {
                "core"  : {
                   "getSortData": null
                }
            },
            "params"                    : {
                "tz_column_width"               : ' . $params->get('width_element') . ',
                "tz_filter_type"        : "tags"
            },
            "afterColumnWidth" : function(newColCount,newColWidth){
                ' . ($params->get('enable_resize_image', 0) ? 'TzPortfolioPlusArticlesResizeImage($("#portfolio' . $module->id . ' > .element .tzpp_media"));' : '') . '
            }
        });
    });
    $(window).load(function(){
        var $tzppisotope    = $("#portfolio' . $module->id . '").data("tzPortfolioPlusIsotope");
        if(typeof $tzppisotope === "object"){
            $tzppisotope.imagesLoaded(function(){
                $tzppisotope.tz_init();
            });
        }
    });
});
');

if ($list):
    ?>
    <div id="TzContent<?php echo $module->id; ?>"
         class="tz_portfolio_plus_articles<?php echo $moduleclass_sfx; ?> TzContent">
        <?php if ($show_filter && isset($filter_tag)): ?>
            <div id="tz_options" class="clearfix">
                <div class="option-combo">
                    <!--                    <div class="filter-title TzFilter">-->
                    <?php //echo JText::_('MOD_TZ_PORTFOLIO_PLUS_ARTICLES_FILTER'); ?><!--</div>-->
                    <div id="filter<?php echo $module->id; ?>" class="option-set clearfix text-center center-block"
                         data-option-key="filter">
                        <a href="#show-all" data-option-value="*"
                           class="btn btn-default btn-small selected"><i
                                    class="fa fa-th-large">&nbsp;</i><?php echo JText::_('MOD_TZ_PORTFOLIO_PLUS_ARTICLES_SHOW_ALL'); ?>
                        </a>
                        <?php if ($filter_tag): ?>
                            <?php foreach ($filter_tag as $i => $itag): //var_dump($itag->title); die;?>
                                <a href="#<?php echo $itag->alias; ?>"
                                   class="btn btn-default btn-small"
                                   data-option-value=".<?php echo $itag->alias; ?>">
                                    <?php echo $itag->title; ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div id="portfolio<?php echo $module->id; ?>" class="masonry row ">
            <?php foreach ($list as $i => $item) : ?>
                <?php
                $item_tags_alias = array();
                if (isset($tags[$item->content_id]) && !empty($tags[$item->content_id])) {
                    $item_tags_alias = JArrayHelper::getColumn($tags[$item->content_id], 'alias');
                }
                ?>
                <div class="element <?php echo implode(' ', $item_tags_alias) ?>">
                    <div class="TzInner">
                        <?php
                        if (isset($item->event->onContentDisplayMediaType)) {
                            ?>
                            <div class="tzpp_media">
                                <?php echo $item->event->onContentDisplayMediaType; ?>
                            </div>
                            <?php
                        } ?>

                        <?php if (!isset($item->mediatypes) || (isset($item->mediatypes) && !in_array($item->type, $item->mediatypes))) {
                            ?>
                            <div class="cover TzPortfolioDescription ">
                                <div class="cover-inner">
                                    <?php
                                    echo '<h5 class="photo-name">' . $item->title . '</h5>';
                                    if ($params->get('show_category', 1)) {
                                        if (isset($categories[$item->content_id]) && $categories[$item->content_id]) {
                                            echo '<h6 class="photo-cat">';
                                            foreach ($categories[$item->content_id] as $c => $category) {
                                                echo $category->title;
                                                if ($c != count($categories[$item->content_id]) - 1) {
                                                    echo ', ';
                                                }
                                            }
                                            echo '</h6>';
                                        }
                                    }
                                    ?>
                                </div>
                                <?php $media = $item->media;

                                if ($item->type == 'image') {

                                    $image_url_ext = JFile::getExt($media->image->url);
                                    $image_url = str_replace('.' . $image_url_ext, '_' . $params->get('mt_image_size') . '.'
                                        . $image_url_ext, $media->image->url);
                                    $image = JURI::root() . $image_url;
                                    echo '<a href="' . $image . '" data-rel="prettyPhoto[gallery]" class="zoom">+</a>';
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".zoom[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animationSpeed: 'slow',
            slideshow: false,
            overlay_gallery: false,
            social_tools: false,
            deeplinking: false
        });
    });
</script>
