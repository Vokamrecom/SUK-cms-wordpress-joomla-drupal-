<?php

/*------------------------------------------------------------------------

# MOD_TZ_NEW_PRO Extension

# ------------------------------------------------------------------------

# author    tuyennv

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'modules/mod_tz_news_pro/css/default.css');
$document->addScript(JUri::base() . 'templates/' . JFactory::getApplication()->getTemplate() . '/js/resizeimage.js');
?>

<div id="reBlog" class="row">
    <?php if (isset($list) && !empty($list)) :
        foreach ($list as $i => $item) : ?>
            <?php if ($item->type_media != 'quote' AND $item->type_media != 'link' AND $item->type_media != 'audio'): ?>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog blog<?php echo $i + 1; ?>">
                        <?php
                        if ($item->type_media == 'image'):
                            $icon = 'fa fa-share';
                            $icon1 = 'fa fa-share-square-o';
                        endif;
                        if ($item->type_media == 'imageGallery'):
                            $icon = 'fa fa-plane';
                            $icon1 = $icon;
                        endif;
                        if ($item->type_media == 'video'):
                            $icon = 'fa fa-calendar';
                            $icon1 = $icon;
                        endif; ?>
                        <?php if ($image == 1): ?>
                            <div class="image">
                                <figure>
                                    <div class="mask"></div>
                                    <?php if ($image == 1 AND $item->image != null) : ?>
                                        <?php $title_image = $item->title; ?>
                                        <a href="<?php echo $item->fullLink; ?>">
                                            <img src="<?php echo $item->image; ?>"
                                                 title="<?php echo $title_image; ?>"
                                                 alt="<?php echo $title_image; ?>"/>
                                        </a>
                                    <?php endif; ?>
                                </figure>

                                <a href="<?php echo $item->link; ?>" class="blog-icon-border-wrap" target="_blank">
                                    <div class="icon-border">
									<span class="fa-stack fa-lg">
										<i class="<?php echo $icon; ?> fa-inverse fa-fw"></i>
									</span>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($date == 1 or $hits == 1 or $author_new == 1 or $cats_new == 1 or $des == 1 or $title == 1 or $readmore == 1): ?>
                            <div class="blog-content">
                                <?php if ($title == 1) : ?>
                                    <div class="blog-title">
                                        <a href="<?php echo $item->link; ?>"
                                           title="<?php echo $item->title; ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($des == 1): ?>
                                    <?php if ($limittext) :
                                        echo substr($item->intro, 3, $limittext);
                                    else :
                                        echo $item->intro;
                                    endif; ?>
                                    <i class="<?php echo $icon1; ?> decor"></i>
                                <?php endif; ?>

                                <?php if ($date == 1 or $hits == 1 or $author_new == 1 or $cats_new == 1 or $readmore == 1): ?>
                                <ul class="data">

                                    <?php if ($date == 1) : ?>
                                        <li>
                                            <div class="date">
                                                <?php echo JText::sprintf(JHtml::_('date', $item->created, JText::_('MOD_TZ_NEWS_DATE_FOMAT'))); ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($author_new == 1): ?>
                                        <li>
                                            <div class="author">
                                                <?php echo JText::sprintf('MOD_TZ_NEWS_AUTHOR', $item->author); ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($cats_new == 1): ?>
                                        <li>
                                            <div class="category">
                                                <?php echo JText::sprintf('MOD_TZ_NEWS_CATEGORY', $item->category); ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($count_comment == 1 && isset($item->commentCount) && $item->commentCount): ?>
                                        <li>
                                            <div class="comment">
                                                <?php echo JText::sprintf('MOD_TZ_NEWS_COMMENT_COUNT', $item->commentCount); ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($hits == 1) : ?>
                                        <li>
                                            <div class="hits">
                                                <i class="fa fa-heart"></i><?php echo JText::sprintf($item->hit) ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($readmore == 1) : ?>
                                        <li>
                                            <div class="readmore">
                                                <a href="<?php echo $item->link; ?>">
                                                    <?php echo JText::_('MOD_TZ_NEWS_READ_MORE') ?>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endif; ?>
            <!--use tz -portfolio-->
            <?php if ($item->type_media == 'quote'): ?>
                <?php require JModuleHelper::getLayoutPath('mod_tz_news_pro', $params->get('layout', 'default') . '_quote'); ?>
            <?php endif; ?>

            <?php if ($item->type_media == 'link'): ?>
                <?php require JModuleHelper::getLayoutPath('mod_tz_news_pro', $params->get('layout', 'default') . '_link'); ?>
            <?php endif; ?>

            <?php if ($item->type_media == 'audio'): ?>
                <?php require JModuleHelper::getLayoutPath('mod_tz_news_pro', $params->get('layout', 'default') . '_audio'); ?>
            <?php endif; ?>

        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script type="text/javascript">
    function news_resize() {
        jQuery('#reBlog > div ').map(function () {
            if (jQuery(this).find('img')) {
                widthStage = jQuery(this).width();
                heightStage = jQuery(this).find('.image').outerHeight();

                tzimage = new Image();
                tzimage.src = jQuery(this).find('img').attr('src');
                widthImage = tzimage.width;
                heightImage = tzimage.height;

                var tzimg = new resizeImage(widthImage, heightImage, widthStage, heightStage);
                // Set attribtes for the image tag html
                jQuery(this).find('img').css({top: tzimg.top, left: 0, width: tzimg.width, height: tzimg.height});
            }
        });
    }
    jQuery(window).bind("load resize", function () {
        news_resize();
    });

</script>