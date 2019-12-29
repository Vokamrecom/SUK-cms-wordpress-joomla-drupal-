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

class EasyFrontendSeoViewEasyFrontendSeo extends JViewLegacy
{
    protected $state;
    protected $items;
    protected $pagination;
    protected $pluginState;
    protected $donationCodeMessage;

    public function display($tpl = null)
    {
        JToolbarHelper::title(JText::_('COM_EASYFRONTENDSEO') . " - " . JText::_('COM_EASYFRONTENDSEO_SUBMENU_ENTRIES'), 'easyfrontendseo');
        JToolbarHelper::addNew();
        JToolbarHelper::deleteList();
        JToolbarHelper::editList();

        $layout = new JLayoutFile('joomla.toolbar.batch');
        $bar = JToolbar::getInstance('toolbar');
        $bar->appendButton('Custom', $layout->render(array('title' => JText::_('JTOOLBAR_BATCH'))), 'batch');

        JToolbarHelper::preferences('com_easyfrontendseo');
        JFactory::getDocument()->addStyleSheet('components/com_easyfrontendseo/css/easyfrontendseo.css');

        $this->items = $this->get('Data');
        $this->pagination = $this->get('Pagination');
        $this->pluginState = $this->get('PluginStatus');
        $this->state = $this->get('State');
        $this->donationCodeMessage = EasyFrontendSeoHelper::getDonationCodeMessage();

        parent::display($tpl);
    }

    public function escape($string, $doubleEncode = false)
    {
        return htmlspecialchars($string, ENT_COMPAT, 'UTF-8', $doubleEncode);
    }
}
