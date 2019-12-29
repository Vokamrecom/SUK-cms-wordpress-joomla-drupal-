<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="category-module<?php echo $moduleclass_sfx; ?>">
    <?php if ($grouped) : ?>
        <?php foreach ($list as $group_name => $group) : ?>
            <div class="group__header">
                <div class="mod-articles-category-group"><?php echo $group_name; ?></div>
            </div>
            <div class="group__content blogs ">
                <?php foreach ($group as $i => $item) : $images = json_decode($item->images); ?>
                    <div class="article__item blog blog<?php echo $i; ?>">
                        <div class="tz__media">
                            <div class="tz__image">
                                <img src="<?php echo $images->image_intro; ?>" alt="<?php echo $item->title; ?>"/>
                                <div class="mask"></div>
                            </div>

                            <a href="<?php echo $item->link; ?>" class="blog-icon-border-wrap" target="_blank">
                                <span class="icon-border">
									<span class="fa-stack fa-lg">
										<i class="fa fa-share fa-inverse fa-fw animated bounceIn"></i>
									</span>
                                </span>
                            </a>
                        </div>
                        <div class="tz__content  ">
                            <?php if ($params->get('link_titles') == 1) : ?>
                            <div class="tz__Title">
                                <a class="mod-articles-category-title <?php echo $item->active; ?> tz__title"
                                   href="<?php echo $item->link; ?>">
                                    <?php echo $item->title; ?>
                                </a>
                                <?php if ($item->displayCategoryTitle) : ?>
                                    <span class="mod-articles-category-category">
                                        <?php echo '(' . $item->displayCategoryTitle . ')'; ?>
                                    </span>
                                <?php endif; ?>
                                <?php else : ?>
                                    <a class="mod-articles-category-title <?php echo $item->active; ?> tz__title">
                                        <?php echo $item->title; ?>
                                    </a>
                                    <?php if ($item->displayCategoryTitle) : ?>
                                        <span class="mod-articles-category-category">
                                        <?php echo '(' . $item->displayCategoryTitle . ')'; ?>
                                    </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <i class="fa fa-share-square-o decor"></i>
                            <?php if ($params->get('show_introtext')) : ?>
                                <p class="mod-articles-category-introtext tz__intro">
                                    <?php echo $item->displayIntrotext; ?>
                                </p>
                            <?php endif; ?>
                            <ul class="data">
                                <?php if ($item->displayHits) : ?>
                                    <li class="mod-articles-category-hits">
                                        <i class="fa fa-eye"></i> <?php echo $item->displayHits; ?>
                                    </li>
                                <?php endif; ?>

                                <?php if ($params->get('show_author')) : ?>
                                    <li class="mod-articles-category-writtenby">
                                        <?php echo $item->displayAuthorName; ?>
                                    </li>
                                <?php endif; ?>



                                <?php if ($item->displayDate) : ?>
                                    <li class="mod-articles-category-date"><?php echo $item->displayDate; ?></li>
                                <?php endif; ?>
                            </ul>
                            <?php if ($params->get('show_readmore')) : ?>
                                <p class="mod-articles-category-readmore">
                                    <a class="mod-articles-category-title <?php echo $item->active; ?>"
                                       href="<?php echo $item->link; ?>">
                                        <?php if ($item->params->get('access-view') == false) : ?>
                                            <?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
                                        <?php elseif ($readmore = $item->alternative_readmore) : ?>
                                            <?php echo $readmore; ?>
                                            <?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                                            <?php if ($params->get('show_readmore_title', 0) != 0) : ?>
                                                <?php echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit')); ?>
                                            <?php endif; ?>
                                        <?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
                                            <?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
                                        <?php else : ?>
                                            <?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
                                            <?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                                        <?php endif; ?>
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endforeach; ?>
    <?php else : ?>
        <div class="group__content">
            <?php foreach ($list as $i=> $item) : $images = json_decode($item->images); ?>
                <div class="article__item blog blog<?php echo $i; ?>">
                    <div class="tz__media">
                        <div class="tz__image">
                            <img src="<?php echo $images->image_intro; ?>" alt="<?php echo $item->title; ?>"/>
                            <div class="mask"></div>
                        </div>

                        <a href="<?php echo $item->link; ?>" class="blog-icon-border-wrap" target="_blank">
                                <span class="icon-border">
									<span class="fa-stack fa-lg">
										<i class="fa fa-share fa-inverse fa-fw animated bounceIn"></i>
									</span>
                                </span>
                        </a>
                    </div>
                    <div class="tz__content  ">
                        <?php if ($params->get('link_titles') == 1) : ?>
                        <div class="tz__Title">
                            <a class="mod-articles-category-title <?php echo $item->active; ?> tz__title"
                               href="<?php echo $item->link; ?>">
                                <?php echo $item->title; ?>
                            </a>
                            <?php if ($item->displayCategoryTitle) : ?>
                                <span class="mod-articles-category-category">
                                        <?php echo '(' . $item->displayCategoryTitle . ')'; ?>
                                    </span>
                            <?php endif; ?>
                            <?php else : ?>
                                <a class="mod-articles-category-title <?php echo $item->active; ?> tz__title">
                                    <?php echo $item->title; ?>
                                </a>
                                <?php if ($item->displayCategoryTitle) : ?>
                                    <span class="mod-articles-category-category">
                                        <?php echo '(' . $item->displayCategoryTitle . ')'; ?>
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <i class="fa fa-share-square-o decor"></i>
                        <?php if ($params->get('show_introtext')) : ?>
                            <p class="mod-articles-category-introtext tz__intro">
                                <?php echo $item->displayIntrotext; ?>
                            </p>
                        <?php endif; ?>
                        <ul class="data">
                            <?php if ($item->displayHits) : ?>
                                <li class="mod-articles-category-hits">
                                    <i class="fa fa-eye"></i> <?php echo $item->displayHits; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($params->get('show_author')) : ?>
                                <li class="mod-articles-category-writtenby">
                                    <?php echo $item->displayAuthorName; ?>
                                </li>
                            <?php endif; ?>



                            <?php if ($item->displayDate) : ?>
                                <li class="mod-articles-category-date"><?php echo $item->displayDate; ?></li>
                            <?php endif; ?>
                        </ul>
                        <?php if ($params->get('show_readmore')) : ?>
                            <p class="mod-articles-category-readmore">
                                <a class="mod-articles-category-title <?php echo $item->active; ?>"
                                   href="<?php echo $item->link; ?>">
                                    <?php if ($item->params->get('access-view') == false) : ?>
                                        <?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
                                    <?php elseif ($readmore = $item->alternative_readmore) : ?>
                                        <?php echo $readmore; ?>
                                        <?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                                        <?php if ($params->get('show_readmore_title', 0) != 0) : ?>
                                            <?php echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit')); ?>
                                        <?php endif; ?>
                                    <?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
                                        <?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
                                    <?php else : ?>
                                        <?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
                                        <?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                                    <?php endif; ?>
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
