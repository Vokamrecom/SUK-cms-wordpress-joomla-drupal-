<?php
/**
 *
 * Plazart framework layout
 *
 * @version             1.0.0
 * @package             Plazart Framework
 * @copyright            Copyright (C) 2012 - 2013 TemPlaza. All rights reserved.
 *
 */

// no direct access
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="<?php $this->bodyClass(); ?>">
<head>
    <jdoc:include type="head"/>
    <?php $this->loadBlock('head'); ?>
</head>

<body<?php if ($this->browser->get("tablet") == true) echo ' data-tablet="true"'; ?><?php if ($this->browser->get("mobile") == true) echo ' data-mobile="true"'; ?>
        class="<?php echo $this->bodyClass() ?>">
<div class="loading">
    <div id="loading"><img src="images/loading-pink.gif" alt="Loading..." width="64" height="64"/></div>
</div>
<?php
if ($this->getParam('layout_enable', 0)) {
    $this->layout();
} else {
    $this->loadBlock('body');
}
$this->loadBlock('utilities');
?>

</body>
</html>