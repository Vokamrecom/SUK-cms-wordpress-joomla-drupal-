<?php 
  
 /**
 * @package Form Maker
 * @author Web-Dorado
 * @copyright (C) 2011 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');

class Tableformmaker_blocked extends JTable

{

var $id = null;

var $ip = null;


function __construct(&$db)

{

parent::__construct('#__formmaker_blocked','id',$db);

}

}

?>