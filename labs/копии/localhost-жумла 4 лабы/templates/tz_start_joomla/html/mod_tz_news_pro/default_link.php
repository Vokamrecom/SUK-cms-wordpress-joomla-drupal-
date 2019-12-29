<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 2/27/14
 * Time: 11:21 AM
 */
?>
<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    <div class="blog blog<?php echo $i + 1; ?>">
        <a class="title" href="<?php echo $item->link_url; ?>"
           target="<?php echo $item->link_target; ?>"
           rel="<?php echo $item->link_follow; ?>">
            <?php echo $item->link_title ?>
        </a>

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
                    endif;?>
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

                    <?php if ($hits == 1) : ?>
                        <li>
                            <div class="hits">
                                <?php echo JText::sprintf('MOD_TZ_NEWS_HIST_LIST', $item->hit) ?>
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

                    <?php if ($count_comment == 1): ?>
                        <li>
                            <div class="comment">
                                <?php echo JText::sprintf('MOD_TZ_NEWS_COMMENT_COUNT', $item->commentCount); ?>
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