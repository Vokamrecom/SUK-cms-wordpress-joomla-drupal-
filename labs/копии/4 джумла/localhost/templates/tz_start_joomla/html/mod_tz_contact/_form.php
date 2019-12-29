<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die;
JFactory::getLanguage()->load('com_contact');

?>
<?php if ($params->get('show_email_form', 1)): ?>
    <div class="error-color">
        <div id="message-sent-false">

        </div>

        <div id="message-sent">
            <?php echo JText::_('TPL_TZ_START_SENT_SUCCESSFULLY'); ?>
        </div>
    </div>
    <form class="form-validate form-horizontal"
          method="post"
          action="<?php echo JRoute::_('index.php'); ?>"
          id="contact-form">

        <fieldset>

            <div class="col-sm-6">
                <input type="text"
                       required="required"
                       class="form-control"
                       id="jform_contact_name"
                       name="jform[contact_name]"
                       placeholder="FullName">
            </div>

            <div class="col-sm-6">
                <input type="email"
                       required="required"
                       placeholder="EmailAddress"
                       id="jform_contact_email"
                       class="form-control"
                       name="jform[contact_email]">
            </div>

            <?php if ($params->get('show_subject', 1)): ?>
                <div class="col-sm-6">
                    <input type="text"
                           required="required"
                           class="form-control"
                           placeholder="Subject"
                           id="jform_contact_emailmsg"
                           name="jform[contact_subject]">
                </div>
            <?php endif; ?>

            <div class="col-sm-12">
                <textarea required="required"
                          class="form-control"
                          placeholder="Messeage"
                          id="jform_contact_message"
                          name="jform[contact_message]"></textarea>
            </div>

            <?php if ($params->get('show_email_copy', 1)): ?>
                <div class="col-sm-12">
                    <input type="checkbox"
                           value="1"
                           id="jform_contact_email_copy"
                           name="jform[contact_email_copy]"
                           class="form-control">
                </div>
            <?php endif; ?>

            <?php if ($params->get('show_captcha', 1)): ?>
                <?php   JPluginHelper::importPlugin('captcha');
                $dispatcher = JDispatcher::getInstance();
                $dispatcher->trigger('onInit', 'dynamic_recaptcha_1');?>
                <div id="dynamic_recaptcha_1"></div>
            <?php endif; ?>

            <div class="col-sm-12">
                <button type="button" class="button"
                        id="tz-contact-send"><?php echo JText::_('MOD_TZ_CONTACT_SEND'); ?>
                </button>
            </div>

            <div class="col-sm-12">

                <input type="hidden"
                       value="com_contact"
                       name="option">

                <input type="hidden"
                       value="contact.submit"
                       name="task">

                <input type="hidden"
                       value=""
                       name="return">

                <input type="hidden"
                       value="<?php echo $contact->id . ':' . $contact->alias; ?>"
                       name="id">

                <?php echo JHtml::_('form.token'); ?>
            </div>

        </fieldset>
    </form>
<?php endif; ?>