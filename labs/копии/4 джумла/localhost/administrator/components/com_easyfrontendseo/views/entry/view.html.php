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

class EasyFrontendSeoViewEntry extends JViewLegacy
{
    protected $entry;
    protected $charactersLength;
    protected $robotsArray;
    protected $donationCodeMessage;

    function display($tpl = null)
    {
        $entry = $this->get('Data');
        $charactersLength = $this->get('CharactersLength');
        $robotsArray = array('', 'index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow');

        if (empty($entry->id)) {
            JToolbarHelper::title(JText::_('COM_EASYFRONTENDSEO') . ' - ' . JText::_('COM_EASYFRONTENDSEO_NEWENTRY'), 'easyfrontendseo-add');
            JToolbarHelper::save('save');
            JToolbarHelper::cancel('cancel');
        } else {
            JToolbarHelper::title(JText::_('COM_EASYFRONTENDSEO') . ' - ' . JText::_('COM_EASYFRONTENDSEO_EDITENTRY'), 'easyfrontendseo-edit');
            JToolbarHelper::apply('apply');
            JToolbarHelper::save('save');
            JToolbarHelper::cancel('cancel', 'Close');
        }

        $document = JFactory::getDocument();
        $document->addStyleSheet('components/com_easyfrontendseo/css/easyfrontendseo.css', 'text/css');
        $document->addScript('components/com_easyfrontendseo/js/wordcount.jquery.js', 'text/javascript');

        $output = "window.addEvent('domready', function(){";
        $output .= "new WordCount('counter_title', {inputName:'title', wordText:'" . JText::_('COM_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('COM_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});\n";
        $output .= "new WordCount('counter_description', {inputName:'description', wordText:'" . JText::_('COM_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('COM_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});\n";
        $output .= "new WordCount('counter_keywords', {inputName:'keywords', wordText:'" . JText::_('COM_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('COM_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});\n";
        $output .= "new WordCount('counter_generator', {inputName:'generator', wordText:'" . JText::_('COM_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('COM_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});\n";
        $output .= " });";

        $document->addScriptDeclaration($output, 'text/javascript');

        $this->entry = $entry;
        $this->charactersLength = $charactersLength;
        $this->robotsArray = $robotsArray;
        $this->donationCodeMessage = EasyFrontendSeoHelper::getDonationCodeMessage();

        parent::display($tpl);
    }
}
