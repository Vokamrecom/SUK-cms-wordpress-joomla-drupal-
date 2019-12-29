<?php
/**
 * @Copyright
 * @package     EFSEO - Easy Frontend SEO for Joomal! 3.x
 * @author      Viktor Vogel <admin@kubik-rubik.de>
 * @version     3.4.1 - 2019-06-29
 * @link        https://kubik-rubik.de/efseo-easy-frontend-seo
 *
 * @license     GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') || die('Restricted access');

class EasyFrontendSeoControllerEntry extends JControllerLegacy
{
    protected $input;

    public function __construct()
    {
        parent::__construct();

        $this->registerTask('add', 'edit');
        $this->registerTask('apply', 'save');
        $this->input = JFactory::getApplication()->input;
    }

    /**
     * Loads the edit view
     */
    public function edit()
    {
        $this->input->set('view', 'entry');
        $this->input->set('layout', 'form');
        $this->input->set('hidemainmenu', 1);
        parent::display();
    }

    /**
     * Saves the entered data to the database and redirects the request correctly
     */
    public function save()
    {
        JSession::checkToken() || jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('entry');
        $message = JText::_('COM_EASYFRONTENDSEO_ENTRY_SAVED');
        $type = 'message';

        if (!$model->store()) {
            $message = JText::_('COM_EASYFRONTENDSEO_ERROR_SAVING_ENTRY');
            $type = 'error';

            // Save the entered data to avoid loss
            $model->storeInputSession($this->input);

            if ($model->getError() == 'duplicate') {
                $message = JText::_('COM_EASYFRONTENDSEO_ERROR_SAVING_ENTRY_DUPLICATE');
            }

            // If an error occurred, then always redirect back to the edit form
            if (!$model->getId()) {
                $this->input->set('url_current', 'option=com_easyfrontendseo&controller=entry&task=edit');
                $this->setRedirect('index.php?' . $this->input->getString('url_current'), $message, $type);

                return;
            }

            $this->setRedirect('index.php?' . $this->input->getString('url_current'), $message, $type);

            return;
        }

        if ($this->task == 'apply') {
            $this->setRedirect('index.php?' . $this->input->getString('url_current'), $message, $type);

            return;
        }

        $this->setRedirect('index.php?option=com_easyfrontendseo', $message, $type);
    }

    /**
     * Deletes selected entries from the database
     */
    public function remove()
    {
        JSession::checkToken() || jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('entry');
        $message = JText::_('COM_EASYFRONTENDSEO_ENTRY_DELETED');
        $type = 'message';

        if (!$model->delete()) {
            $message = JText::_('COM_EASYFRONTENDSEO_ERROR_ENTRY_COULD_NOT_BE_DELETED');
            $type = 'error';
        }

        $this->setRedirect(JRoute::_('index.php?option=com_easyfrontendseo', false), $message, $type);
    }

    /**
     * Aborts an operation and redirects to the main view
     */
    public function cancel()
    {
        $message = JText::_('COM_EASYFRONTENDSEO_OPERATION_CANCELLED');
        $this->setRedirect('index.php?option=com_easyfrontendseo', $message, 'notice');
    }

    /**
     * Executes the batch method
     */
    public function batch()
    {
        JSession::checkToken() || jexit(JText::_('JINVALID_TOKEN'));

        $model = $this->getModel('entry');
        $message = JText::_('COM_EASYFRONTENDSEO_SUCCESS_BATCH_SAVE_PROCESS');
        $type = 'message';

        if (!$model->batch()) {
            $message = JText::_('COM_EASYFRONTENDSEO_ERROR_BATCH_SAVE_PROCESS');
            $type = 'error';
        }

        $this->setRedirect(JRoute::_('index.php?option=com_easyfrontendseo', false), $message, $type);
    }
}
