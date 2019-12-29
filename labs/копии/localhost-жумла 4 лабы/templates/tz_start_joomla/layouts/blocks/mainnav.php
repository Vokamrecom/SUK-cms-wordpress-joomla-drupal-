<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<!-- MAIN NAVIGATION -->
<nav id="plazart-mainnav" class="wrap plazart-mainnav navbar-collapse-fixed-top navbar navbar-default">
    <div class="navbar-inner">
        <div class="navbar-header">
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse"
                    data-target=".nav-collapse">
                <i class="fa fa-list-ul fa-fw fa-2x"></i>
            </button>
        </div>
        <div
            class="nav-collapse navbar-collapse collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?>">
            <?php if ($this->getParam('navigation_type') == 'megamenu') : ?>
                <?php ob_start(); ?>
                <?php $this->megamenu($this->getParam('mm_type', 'mainmenu')) ?>
                <?php
                $content = ob_get_contents();
                ob_end_clean();
                if(preg_match('/(<a.*?href=".*?#)(.*?<\/a>)/msi', $content)){
                    $content = preg_replace('/(<a.*?href=".*?#)(.*?<\/a>)/msi','$1tz-$2',$content);
                }
                echo $content;

                ?>
            <?php else : ?>
                <jdoc:include type="modules" name="menu" style="raw"/>
            <?php endif ?>

        </div>
    </div>
</nav>
<!-- //MAIN NAVIGATION -->