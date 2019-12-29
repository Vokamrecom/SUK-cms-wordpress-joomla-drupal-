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
define('EASYFRONTENDSEO_VERSION', '3.4.1');

require_once JPATH_COMPONENT . '/controller.php';
require_once JPATH_COMPONENT . '/helpers/easyfrontendseo.php';

if ($controller = JFactory::getApplication()->input->getWord('controller', '')) {
    $path = JPATH_COMPONENT . '/controllers/' . $controller . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
}

$className = 'EasyFrontendSeoController' . $controller;
$controller = new $className();
$controller->execute(JFactory::getApplication()->input->get('task', ''));
$controller->redirect();
