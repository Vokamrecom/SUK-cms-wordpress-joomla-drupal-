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

class PlgSystemEasyFrontendSeo extends JPlugin
{
    protected $db;
    protected $app;
    protected $url;
    protected $style;
    protected $urlOld;
    protected $urlToString;
    protected $allowedUserGroups;
    protected $session;
    protected $request;
    protected $articleTitle = '';
    protected $autoloadLanguage = true;
    protected $charactersLengthTitle = 65;
    protected $charactersLengthDefault = 300;

    public function __construct(&$subject, $config)
    {
        // First check whether version requirements are met for this specific version
        if ($this->checkVersionRequirements(false, '3.2', 'Easy Frontend SEO', 'plg_system_easyfrontendseo', JPATH_ADMINISTRATOR)) {
            parent::__construct($subject, $config);
        }
    }

    /**
     * Checks whether all requirements are met for the execution
     * Written generically to be used in all Kubik-Rubik Joomla! Extensions
     *
     * @param $admin
     * @param $versionMin
     * @param $extensionName
     * @param $extensionSystemName
     * @param $jPath
     *
     * @return bool
     * @throws Exception
     */
    private function checkVersionRequirements($admin, $versionMin, $extensionName, $extensionSystemName, $jPath)
    {
        $execution = true;
        $version = new JVersion();

        if (!$version->isCompatible($versionMin)) {
            $execution = false;
            $backendMessage = true;
        }

        if (empty($admin)) {
            if (JFactory::getApplication()->isAdmin()) {
                $execution = false;

                if (!empty($backendMessage)) {
                    $this->loadLanguage($extensionSystemName, $jPath);
                    JFactory::getApplication()->enqueueMessage(JText::sprintf('KR_JOOMLA_VERSION_REQUIREMENTS_NOT_MET', $extensionName, $versionMin), 'warning');
                }
            }
        }

        return $execution;
    }

    /**
     * Sets needed object variables in the trigger onAfterInitialise to avoid triggering the framework too early
     */
    public function onAfterInitialise()
    {
        $this->allowedUserGroups = $this->allowedUserGroups();
        $this->session = JFactory::getSession();
        $this->request = $this->app->input;
        $this->style = $this->params->get('style');

        // Save data to session because some components do a redirection and entered data get lost
        $dataSavedToSession = $this->session->get('save_data_to_session', null, 'easyfrontendseo');

        if ($this->request->get('easyfrontendseo') && $this->allowedUserGroups == true && empty($dataSavedToSession)) {
            $this->saveDataToSession();
        }
    }

    /**
     * Checks permission rights
     *
     * @return boolean
     */
    private function allowedUserGroups()
    {
        $userId = JFactory::getUser()->id;
        $filterGroups = (array) $this->params->get('filter_groups');
        $userGroups = JAccess::getGroupsByUser($userId);

        foreach ($userGroups as $userGroup) {
            foreach ($filterGroups as $filterGroup) {
                if ($userGroup == $filterGroup) {
                    return true;
                }
            }
        }

        if ($this->params->get('allowed_user_ids')) {
            $allowedUserIds = array_map('trim', explode(',', $this->params->get('allowed_user_ids')));

            foreach ($allowedUserIds as $allowedUserId) {
                if ($allowedUserId == $userId) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Saves entered data to session to avoid loss
     */
    private function saveDataToSession()
    {
        $this->session->set('save_data_to_session', true, 'easyfrontendseo');

        if ($this->request->get('delete')) {
            $this->session->set('delete', $this->request->get('delete'), 'easyfrontendseo');

            return;
        }

        if ($this->request->get('title', '', 'STRING')) {
            $this->session->set('title', $this->request->get('title', '', 'STRING'), 'easyfrontendseo');
        }

        if ($this->request->get('description', '', 'STRING')) {
            $this->session->set('description', stripslashes(preg_replace('@\s+(\r\n|\r|\n)@', ' ', $this->request->get('description', '', 'STRING'))), 'easyfrontendseo');
        }

        if ($this->request->get('keywords', '', 'STRING')) {
            $this->session->set('keywords', $this->request->get('keywords', '', 'STRING'), 'easyfrontendseo');
        }

        if ($this->request->get('generator', '', 'STRING')) {
            $this->session->set('generator', $this->request->get('generator', '', 'STRING'), 'easyfrontendseo');
        }

        if ($this->request->get('robots', '', 'STRING')) {
            $this->session->set('robots', $this->request->get('robots', '', 'STRING'), 'easyfrontendseo');
        }
    }

    /**
     * URL handling is done in the core event trigger onAfterRoute
     */
    public function onAfterRoute()
    {
        $tokenRequest = rawurldecode($this->request->get('efseo_batch_token', '', 'RAW'));

        if (!empty($tokenRequest)) {
            $token = $this->params->get('save_data_table_token', '');

            if (!empty($token) && $token == $tokenRequest) {
                $this->tokenDataClose();
            }
        }

        $compatibility = $this->params->get('compatibility');
        $this->getCorrectUrlId($compatibility);

        if ($this->params->get('update') == 1 && $compatibility != 2) {
            $this->updateDatabase($this->url, $this->urlOld);
        }
    }

    private function tokenDataClose()
    {
        header('Content-Type: application/json');

        echo json_encode(array(
            'option' => $this->request->get('option'),
            'view'   => $this->request->get('view'),
            'id'     => $this->request->get('id'),
            'itemid' => $this->request->get('Itemid'),
        ));

        $this->app->close();
    }

    /**
     * Sets the correct URL that is used as the ID in the database
     *
     * @param $compatibility
     */
    private function getCorrectUrlId($compatibility)
    {
        $internalUrl = '';
        $uri = JUri::getInstance();
        $this->urlToString = $uri->toString();
        $relativeUrls = $this->params->get('relative_urls');

        if ($compatibility != 2) {
            $internalUrl = $this->buildInternalUrl($uri);
        }

        if ($compatibility == 0) {
            if (empty($relativeUrls)) {
                $this->url = $internalUrl;
                $this->urlOld = array(
                    $this->urlToString,
                    str_replace(JUri::base(), '', $this->urlToString),
                    str_replace(JUri::base(), '', $internalUrl),
                );

                return;
            }

            $this->url = str_replace(JUri::base(), '', $internalUrl);
            $this->urlOld = array(
                $this->urlToString,
                str_replace(JUri::base(), '', $this->urlToString),
                $internalUrl,
            );
        } elseif ($compatibility == 1) {
            if (empty($relativeUrls)) {
                $this->url = $this->urlToString;
                $this->urlOld = array(
                    $internalUrl,
                    str_replace(JUri::base(), '', $internalUrl),
                    str_replace(JUri::base(), '', $this->urlToString),
                );

                return;
            }

            $this->url = str_replace(JUri::base(), '', $this->urlToString);
            $this->urlOld = array(
                $internalUrl,
                str_replace(JUri::base(), '', $internalUrl),
                $this->urlToString,
            );
        } elseif ($compatibility == 2) {
            $this->url = $this->urlToString;
        }
    }

    /**
     * Builds internal URL - independent of SEF function
     *
     * @param JUri $uri
     *
     * @return string
     */
    private function buildInternalUrl($uri)
    {
        // Clone JUri object to avoid an error because of the method -parse- in the next step
        $uriClone = clone $uri;

        // Reference to JRouter object
        $route = JApplicationSite::getRouter();

        // Get the internal route
        $urlInternalArray = $route->parse($uriClone);

        // Move Itemid to the end
        if (array_key_exists('Itemid', $urlInternalArray)) {
            $itemid = $urlInternalArray['Itemid'];
            unset($urlInternalArray['Itemid']);
            $urlInternalArray['Itemid'] = $itemid;
        }

        // Move lang to the end
        if (array_key_exists('lang', $urlInternalArray)) {
            $lang = $urlInternalArray['lang'];
            unset($urlInternalArray['lang']);
            $urlInternalArray['lang'] = $lang;
        }

        return JUri::base() . 'index.php?' . JUri::buildQuery($urlInternalArray);
    }

    /**
     * Updates all entries if the url identification has been changed
     *
     * @param string $url         The correct URL which is used to identify the loaded page
     * @param array  $urlOldArray All other possible URLs which are not used but could have an entry in the database
     */
    private function updateDatabase($url, $urlOldArray)
    {
        foreach ($urlOldArray as $urlOld) {
            if ($url != $urlOld) {
                // Load saved metadata
                $query = "SELECT * FROM " . $this->db->quoteName('#__plg_easyfrontendseo') . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($urlOld);
                $this->db->setQuery($query);
                $metadata = $this->db->loadAssoc();

                if (!empty($metadata)) {
                    // Check whether the internal url is already in the database
                    $query = "SELECT * FROM " . $this->db->quoteName('#__plg_easyfrontendseo') . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($url);
                    $this->db->setQuery($query);
                    $row = $this->db->loadRow();

                    // Save metadata with internal URL
                    if (!empty($row)) {
                        $query = "UPDATE " . $this->db->quoteName('#__plg_easyfrontendseo') . " SET " . $this->db->quoteName('title') . " = " . $this->db->quote($metadata['title']) . ", " . $this->db->quoteName('description') . " = " . $this->db->quote($metadata['description']) . ", " . $this->db->quoteName('keywords') . " = " . $this->db->quote($metadata['keywords']) . ", " . $this->db->quoteName('generator') . " = " . $this->db->quote($metadata['generator']) . ", " . $this->db->quoteName('robots') . " = " . $this->db->quote($metadata['robots']) . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($url);
                        $this->db->setQuery($query);
                        $this->db->execute();
                    } else {
                        // New entry in the database
                        $query = "INSERT INTO " . $this->db->quoteName('#__plg_easyfrontendseo') . " (" . $this->db->quoteName('url') . ", " . $this->db->quoteName('title') . ", " . $this->db->quoteName('description') . ", " . $this->db->quoteName('keywords') . ", " . $this->db->quoteName('generator') . ", " . $this->db->quoteName('robots') . ") VALUES (" . $this->db->quote($url) . ", " . $this->db->quote($metadata['title']) . ", " . $this->db->quote($metadata['description']) . ", " . $this->db->quote($metadata['keywords']) . ", " . $this->db->quote($metadata['generator']) . ", " . $this->db->quote($metadata['robots']) . ")";
                        $this->db->setQuery($query);
                        $this->db->execute();
                    }

                    // Delete old entry
                    $query = "DELETE FROM " . $this->db->quoteName('#__plg_easyfrontendseo') . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($urlOld);
                    $this->db->setQuery($query);
                    $this->db->execute();
                }
            }
        }
    }

    /**
     * Saves and edits the metadata in the core event trigger onBeforeCompileHead
     */
    public function onBeforeCompileHead()
    {
        $document = JFactory::getDocument();
        $head = $document->getHeadData();

        $dataSavedToSession = $this->session->get('save_data_to_session', null, 'easyfrontendseo');

        if (!empty($dataSavedToSession) && $this->allowedUserGroups == true) {
            $this->saveDataToTable($document);
            $this->app->redirect($this->urlToString);
        }

        $query = "SELECT * FROM " . $this->db->quoteName('#__plg_easyfrontendseo') . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($this->url);
        $this->db->setQuery($query);
        $metadata = $this->db->loadAssoc();

        // Set the saved meta data into the document object
        if (!empty($metadata)) {
            $title = $metadata['title'];
            $description = $metadata['description'];
            $keywords = $metadata['keywords'];
            $generator = $metadata['generator'];
            $robots = $metadata['robots'];

            // Prepare array with new metadata - set title and description
            $metadataNew = array('title' => $title, 'description' => $description, 'metaTags' => array());

            // Set metaTags array of the loaded page first to avoid any data loss
            if (!empty($head['metaTags'])) {
                $metadataNew['metaTags'] = $head['metaTags'];
            }

            // Now overwrite manually set values - robots and keywords
            $metadataNew['metaTags']['name']['robots'] = $robots;
            $metadataNew['metaTags']['name']['keywords'] = $keywords;

            // Fallback for Joomla! versions < 3.6.0 because of changes in the behaviour of JDocument (https://github.com/joomla/joomla-cms/pull/10682)
            $version = new JVersion();

            if (!$version->isCompatible('3.6.0')) {
                $metadataNew['metaTags']['standard']['robots'] = $robots;
                $metadataNew['metaTags']['standard']['keywords'] = $keywords;
            }

            $document->setHeadData($metadataNew);
            $document->setGenerator($generator);
        }

        // Automatic replacement for 3rd party extensions
        $this->automaticReplacement($metadata, $head, $document);

        // Set global title tag
        if ($this->params->get('global_title')) {
            if (empty($metadata['title'])) {
                $globalTitlePattern = array('@\[S\]@', '@\[D\]@', '@\[Y\]@', '@\[A\]@');
                $globalTitleReplacement = array(JFactory::getConfig()->get('sitename'), $head['title'], date('Y'), $this->articleTitle);

                $globalTitle = preg_replace($globalTitlePattern, $globalTitleReplacement, $this->params->get('global_title'));
                $document->setTitle($globalTitle);
            }
        }

        // Set global generator tag
        if ($this->params->get('global_generator')) {
            if (empty($metadata['generator'])) {
                $document->setGenerator($this->params->get('global_generator'));
            }
        }

        // Set global robots tag
        $globalRobots = $this->params->get('global_robots');

        if (!empty($globalRobots)) {
            if (empty($metadata['robots'])) {
                $document->setMetaData('robots', $globalRobots);
            }
        }

        // Set custom metatag
        if ($this->params->get('custom_metatags')) {
            $customMetatags = array_map('trim', explode("\n", $this->params->get('custom_metatags')));

            foreach ($customMetatags as $customMetatag) {
                if (!empty($customMetatag)) {
                    if (preg_match('@\|@', $customMetatag)) {
                        list($metatag, $value) = array_map('trim', explode('|', $customMetatag));

                        if (!empty($metatag) && !empty($value)) {
                            $document->setMetaData($metatag, $value);
                        }
                    }
                }
            }
        }

        // Collect all URLs which are not saved already in the database
        if ($this->params->get('collect_urls') && empty($metadata)) {
            // First check whether the loaded component is not excluded
            $excludeComponent = $this->excludeComponents();
            $excludeUrl = $this->excludeUrl();

            if (empty($excludeComponent) && empty($excludeUrl)) {
                // Reload the head data because they could be updated by the automatic mode
                $head = $document->getHeadData();

                if (empty($head['metaTags']['name']['keywords'])) {
                    $head['metaTags']['name']['keywords'] = '';

                    if (!empty($head['metaTags']['standard']['keywords'])) {
                        $head['metaTags']['name']['keywords'] = $head['metaTags']['standard']['keywords'];
                    }
                }

                if (empty($head['metaTags']['name']['robots'])) {
                    $head['metaTags']['name']['robots'] = '';

                    if (!empty($head['metaTags']['standard']['robots'])) {
                        $head['metaTags']['name']['robots'] = $head['metaTags']['standard']['robots'];
                    }
                }

                $query = "INSERT INTO " . $this->db->quoteName('#__plg_easyfrontendseo') . " (" . $this->db->quoteName('url') . ", " . $this->db->quoteName('title') . ", " . $this->db->quoteName('description') . ", " . $this->db->quoteName('keywords') . ", " . $this->db->quoteName('generator') . ", " . $this->db->quoteName('robots') . ") VALUES (" . $this->db->quote($this->url) . ", " . $this->db->quote($head['title']) . ", " . $this->db->quote($head['description']) . ", " . $this->db->quote($head['metaTags']['name']['keywords']) . ", " . $this->db->quote($document->getGenerator()) . ", " . $this->db->quote($head['metaTags']['name']['robots']) . ")";
                $this->db->setQuery($query);
                $this->db->execute();
            }
        }

        if ($this->allowedUserGroups == true) {
            $document->addStyleSheet('plugins/system/easyfrontendseo/assets/css/easyfrontendseo.css', 'text/css');

            JHtml::_('behavior.framework');

            if ($this->style == 1) {
                $document->addScript('plugins/system/easyfrontendseo/assets/js/simplemodal.js', 'text/javascript');
                $document->addStyleSheet('plugins/system/easyfrontendseo/assets/css/simplemodal.css', 'text/css');
            } elseif ($this->style == 2) {
                $document->addScript('plugins/system/easyfrontendseo/assets/js/featherlight.min.js', 'text/javascript');
                $document->addStyleSheet('plugins/system/easyfrontendseo/assets/css/featherlight.min.css', 'text/css');
            }

            if ($this->params->get('word_count') == 1) {
                if ($this->style == 1) {
                    $document->addScript('plugins/system/easyfrontendseo/assets/js/wordcount.js', 'text/javascript');
                } else {
                    $document->addScript('plugins/system/easyfrontendseo/assets/js/wordcount.jquery.js', 'text/javascript');

                    $counterCode = 'jQuery(document).ready(function() {' . $this->counterCode() . '})';
                    $document->addScriptDeclaration($counterCode, 'text/javascript');
                }
            }

            $js = '';

            if ($this->style == 0) {
                // Load the needed JavaScript for the output in the head section
                JHtml::_('jquery.framework');
                $js .= 'jQuery(document).ready(function()
                        {
                            jQuery("#easyfrontendseo").hide();
                            jQuery("#toggle").click(function() {
                                jQuery("#easyfrontendseo").slideToggle("slow");
                            });
                        });';
            } elseif ($this->style == 1) {
                // Load the needed JavaScript for the output in the head section
                JHtml::_('behavior.framework', 'more');
                $head = $this->currentHeadData($document);
                $js .= "window.addEvent('domready', function(e){
                                $('modal').addEvent('click', function(e){
                                e.stop();
                                var EFSEO = new SimpleModal({'width':600, 'height':400, 'offsetTop': 10,'onAppend':function(){" . $this->counterCode() . "}});
                                    EFSEO.addButton('" . JText::_('PLG_EASYFRONTENDSEO_CANCEL') . "', 'btn');
                                    EFSEO.show({
                                        'model':'modal',
                                        'title':'Easy Frontend SEO - Joomla!',
                                        'contents':'" . $this->buildForm($head['title'], $head['description'], $head['keywords'], $head['generator'], $head['robots']) . "'
                                    });
                                });
                            });";
            }

            if (!empty($js)) {
                $document->addScriptDeclaration($js, 'text/javascript');
            }
        }
    }

    /**
     * Saves entered data to the EFSEO table or deletes data from loaded page
     *
     * @param JDocument $document
     *
     * @throws Exception
     */
    private function saveDataToTable($document)
    {
        $delete = $this->session->get('delete', null, 'easyfrontendseo');

        if (!empty($delete) && $this->params->get('field_delete') == 1) {
            $query = "DELETE FROM " . $this->db->quoteName('#__plg_easyfrontendseo') . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($this->url);
            $this->db->setQuery($query);
            $this->db->execute();

            // Delete stored data from the session
            $this->deleteDataFromSession();

            return;
        }

        $query = "SELECT * FROM " . $this->db->quoteName('#__plg_easyfrontendseo') . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($this->url);
        $this->db->setQuery($query);
        $row = $this->db->loadAssoc();

        $title = $this->session->get('title', null, 'easyfrontendseo');
        $charactersTitle = $this->getCharactersLength('characters_title');

        if (mb_strlen($title) > $charactersTitle) {
            $title = mb_substr($title, 0, $charactersTitle);
        }

        if ($this->params->get('field_title') == 0 || $this->params->get('field_title') == 2) {
            if (!empty($row['title'])) {
                $title = $row['title'];
            } elseif (!empty($head['title'])) {
                $title = $head['title'];
            }
        }

        $description = $this->session->get('description', null, 'easyfrontendseo');
        $charactersDescription = $this->getCharactersLength('characters_description');

        if (mb_strlen($description) > $charactersDescription) {
            $description = mb_substr($description, 0, $charactersDescription);
        }

        if ($this->params->get('field_description') == 0 || $this->params->get('field_description') == 2) {
            if (!empty($row['description'])) {
                $description = $row['description'];
            } elseif (!empty($head['description'])) {
                $description = $head['description'];
            }
        }

        $keywords = $this->session->get('keywords', null, 'easyfrontendseo');

        if ($this->params->get('field_keywords') == 0 || $this->params->get('field_keywords') == 2) {
            if (!empty($row['keywords'])) {
                $keywords = $row['keywords'];
            } elseif (!empty($head['metaTags']['name']['keywords'])) {
                $keywords = $head['metaTags']['name']['keywords'];
            } elseif (!empty($head['metaTags']['standard']['keywords'])) {
                $keywords = $head['metaTags']['standard']['keywords'];
            }
        }

        $generator = $this->session->get('generator', null, 'easyfrontendseo');

        if ($this->params->get('field_generator') == 0 || $this->params->get('field_generator') == 2) {
            $generator = $document->getGenerator();

            if (!empty($row['generator'])) {
                $generator = $row['generator'];
            } elseif ($this->params->get('global_generator')) {
                $generator = $this->params->get('global_generator');
            }
        }

        $robots = $this->session->get('robots', null, 'easyfrontendseo');

        if ($this->params->get('field_robots') == 0 || $this->params->get('field_robots') == 2) {
            $robots = $this->params->get('global_robots');

            if (!empty($row['robots'])) {
                $robots = $row['robots'];
            } elseif (!empty($head['metaTags']['name']['robots'])) {
                $robots = $head['metaTags']['name']['robots'];
            } elseif (!empty($head['metaTags']['standard']['robots'])) {
                $robots = $head['metaTags']['standard']['robots'];
            }
        }

        if (empty($row)) {
            $query = "INSERT INTO " . $this->db->quoteName('#__plg_easyfrontendseo') . " (" . $this->db->quoteName('url') . ", " . $this->db->quoteName('title') . ", " . $this->db->quoteName('description') . ", " . $this->db->quoteName('keywords') . ", " . $this->db->quoteName('generator') . ", " . $this->db->quoteName('robots') . ") VALUES (" . $this->db->quote($this->url) . ", " . $this->db->quote($title) . ", " . $this->db->quote($description) . ", " . $this->db->quote($keywords) . ", " . $this->db->quote($generator) . ", " . $this->db->quote($robots) . ")";
            $this->db->setQuery($query);
            $this->db->execute();
        } else {
            $query = "UPDATE " . $this->db->quoteName('#__plg_easyfrontendseo') . " SET " . $this->db->quoteName('title') . " = " . $this->db->quote($title) . ", " . $this->db->quoteName('description') . " = " . $this->db->quote($description) . ", " . $this->db->quoteName('keywords') . " = " . $this->db->quote($keywords) . ", " . $this->db->quoteName('generator') . " = " . $this->db->quote($generator) . ", " . $this->db->quoteName('robots') . " = " . $this->db->quote($robots) . " WHERE " . $this->db->quoteName('url') . " = " . $this->db->quote($this->url);
            $this->db->setQuery($query);
            $this->db->execute();
        }

        // Save data to core tables
        if ($this->params->get('save_data_table_content', 0) == 1) {
            $this->saveDataToTableContent($description, $keywords);
        }

        if ($this->params->get('save_data_table_menu', 0) > 0 && $this->request->get('Itemid')) {
            $this->saveDataToTableMenu($title, $description, $keywords);
        }

        // Delete stored data from the session
        $this->deleteDataFromSession();
    }

    /**
     * Deletes saved data from session
     */
    private function deleteDataFromSession()
    {
        $dataToClear = array('title', 'description', 'keywords', 'generator', 'robots', 'save_data_to_session', 'delete');

        foreach ($dataToClear as $item) {
            $this->session->clear($item, 'easyfrontendseo');
        }
    }

    /**
     * Gets maximum characters length
     *
     * @param string $fieldName
     *
     * @return int
     */
    private function getCharactersLength($fieldName)
    {
        $charactersLength = $this->params->get($fieldName);

        if (!is_numeric($charactersLength)) {
            if ($fieldName == 'characters_title') {
                return $this->charactersLengthTitle;
            }

            // Return default value (e.g. for description)
            return $this->charactersLengthDefault;
        }

        return $charactersLength;
    }

    /**
     * Saves data to the core content table
     *
     * @param string $description
     * @param string $keywords
     */
    private function saveDataToTableContent($description, $keywords)
    {
        // Only execute if we are in the article view of the content component
        if ($this->request->get('option') == 'com_content' && $this->request->get('view') == 'article') {
            $query = "UPDATE " . $this->db->quoteName('#__content') . " SET " . $this->db->quoteName('metakey') . " = " . $this->db->quote($keywords) . ", " . $this->db->quoteName('metadesc') . " = " . $this->db->quote($description) . " WHERE " . $this->db->quoteName('id') . " = " . $this->db->quote((int) $this->request->get('id'));
            $this->db->setQuery($query);
            $this->db->execute();
        }
    }

    /**
     * Saves data to the core menu table
     *
     * @param string $title
     * @param string $description
     * @param string $keywords
     *
     * @throws Exception
     */
    private function saveDataToTableMenu($title, $description, $keywords)
    {
        $menu = JMenu::getInstance('site')->getActive();

        // Check whether menu entry for the specific item exists - e.g. do not overwrite data of blog entry
        foreach ($menu->query as $key => $value) {
            if ($value != $this->request->get($key, 'cmd')) {
                return;
            }
        }

        $menuParamsArray = JMenu::getInstance('site')->getParams($menu->id)->toArray();
        $saveDataTableMenu = $this->params->get('save_data_table_menu');

        $titleArray = array(1, 4, 5, 7);
        $descriptionArray = array(2, 4, 6, 7);
        $keywordsArray = array(3, 5, 6, 7);

        if (in_array($saveDataTableMenu, $titleArray)) {
            $menuParamsArray['page_title'] = $title;
        }

        if (in_array($saveDataTableMenu, $descriptionArray)) {
            $menuParamsArray['menu-meta_description'] = $description;
        }

        if (in_array($saveDataTableMenu, $keywordsArray)) {
            $menuParamsArray['menu-meta_keywords'] = $keywords;
        }

        $menuParams = json_encode($menuParamsArray);

        $query = "UPDATE " . $this->db->quoteName('#__menu') . " SET " . $this->db->quoteName('params') . " = " . $this->db->quote($menuParams) . " WHERE " . $this->db->quoteName('id') . " = " . $this->db->quote((int) $this->request->get('Itemid'));
        $this->db->setQuery($query);
        $this->db->execute();
    }

    /**
     * Replaces the metadata of extensions automatically from the given data
     *
     * @param array     $metadata
     * @param array     $head
     * @param JDocument $document
     *
     * @throws Exception
     */
    private function automaticReplacement($metadata, $head, $document)
    {
        $headKeywords = '';
        $headDescription = '';

        if (!empty($head['metaTags']['name']['keywords'])) {
            $headKeywords = $head['metaTags']['name']['keywords'];
        } elseif (!empty($head['metaTags']['standard']['keywords'])) {
            $headKeywords = $head['metaTags']['standard']['keywords'];
        }

        if (!empty($head['description'])) {
            $headDescription = $head['description'];
        }

        // Extension: com_content - View: article
        $content = $this->params->get('com_content_enable');

        if (!empty($content)) {
            $option = $this->request->get('option');
            $view = $this->request->get('view');
            $articleId = $this->request->get('id', '', 'INT');

            if ($option == 'com_content' && $view == 'article' && !empty($articleId)) {
                $model = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request' => true));
                $model->setState('params', $this->app->getParams());
                $article = (array) $model->getItem($articleId);

                if (!empty($article)) {
                    // Get most often used keywords - do not replace keywords from EFSEO table
                    if (empty($metadata['keywords'])) {
                        $contentOverwriteKeywords = $this->params->get('com_content_overwrite_keywords');

                        // Only set keywords automatically if no global keywords are entered or the overwrite option is enabled
                        if (empty($headKeywords) || !empty($contentOverwriteKeywords)) {
                            $contentNumberKeywords = $this->params->get('com_content_number_keywords');
                            $contentBlacklistKeywords = array_map('mb_strtolower', array_map('trim', explode(',', $this->params->get('com_content_blacklist_keywords'))));
                            $contentKeywordsWholeText = $article['introtext'] . ' ' . $article['fulltext'];
                            $contentMinLengthKeyword = $this->params->get('com_content_min_length_keywords', 3);

                            $document->setMetaData('keywords', $this->automaticReplacementKeywords($contentNumberKeywords, $contentBlacklistKeywords, $contentKeywordsWholeText, $contentMinLengthKeyword));
                        }
                    }

                    // Generate the description - do not replace description from EFSEO table
                    if (empty($metadata['description'])) {
                        $contentOverwriteDescription = $this->params->get('com_content_overwrite_description');

                        // Only set description automatically if no global description is entered or the overwrite option is enabled
                        if (empty($headDescription) || !empty($contentOverwriteDescription)) {
                            $contentDescriptionSelectText = $this->params->get('com_content_description_select_text');
                            $contentDescriptionAddDots = $this->params->get('com_content_description_add_dots');
                            $cleanAgain = true;

                            if ($contentDescriptionSelectText == 0) {
                                $contentDescriptionWholeText = $article['introtext'];

                                if (!empty($article['fulltext'])) {
                                    $contentDescriptionWholeText = $article['fulltext'];
                                }
                            } elseif ($contentDescriptionSelectText == 1) {
                                $contentDescriptionWholeText = $article['fulltext'];

                                if (!empty($article['introtext'])) {
                                    $contentDescriptionWholeText = $article['introtext'];
                                }
                            } elseif ($contentDescriptionSelectText == 2) {
                                $contentDescriptionWholeText = $article['introtext'] . ' ' . $article['fulltext'];
                                $cleanAgain = false;
                            }

                            if (!empty($contentDescriptionWholeText)) {
                                $document->setMetaData('description', $this->automaticReplacementDescription($contentDescriptionWholeText, $contentDescriptionAddDots, $cleanAgain));
                            }
                        }
                    }
                }

                return;
            }
        }

        // Extension: com_k2 - View: item
        $k2 = $this->params->get('com_k2_enable');

        if (!empty($k2)) {
            $option = $this->request->get('option');
            $view = $this->request->get('view');
            $itemId = $this->request->get('id', '', 'INT');

            if ($option == 'com_k2' && $view == 'item' && !empty($itemId)) {
                $query = "SELECT * FROM #__k2_items WHERE id = " . $itemId;
                $this->db->setQuery($query);
                $item = $this->db->loadAssoc();

                if (!empty($item)) {
                    // Get most often used keywords - do not replace keywords from EFSEO table
                    if (empty($metadata['keywords'])) {
                        $k2OverwriteKeywords = $this->params->get('com_k2_overwrite_keywords');

                        // Only set keywords automatically if no global keywords are entered or the overwrite option is enabled
                        if (empty($headKeywords) || !empty($k2OverwriteKeywords)) {
                            $k2NumberKeywords = $this->params->get('com_k2_number_keywords');
                            $k2BlacklistKeywords = array_map('mb_strtolower', array_map('trim', explode(',', $this->params->get('com_k2_blacklist_keywords'))));
                            $k2KeywordsWholeText = $item['introtext'] . ' ' . $item['fulltext'];
                            $k2MinLengthKeyword = $this->params->get('com_k2_min_length_keywords', 3);

                            $document->setMetaData('keywords', $this->automaticReplacementKeywords($k2NumberKeywords, $k2BlacklistKeywords, $k2KeywordsWholeText, $k2MinLengthKeyword));
                        }
                    }

                    // Generate the description - do not replace description from EFSEO table
                    if (empty($metadata['description'])) {
                        $k2OverwriteDescription = $this->params->get('com_k2_overwrite_description');

                        // Only set description automatically if no global description is entered or the overwrite option is enabled
                        if (empty($headDescription) || !empty($k2OverwriteDescription)) {
                            $k2DescriptionSelectText = $this->params->get('com_k2_description_select_text');
                            $k2DescriptionAddDots = $this->params->get('com_k2_description_add_dots');
                            $cleanAgain = true;

                            if ($k2DescriptionSelectText == 0) {
                                $k2DescriptionWholeText = $item['introtext'];

                                if (!empty($item['fulltext'])) {
                                    $k2DescriptionWholeText = $item['fulltext'];
                                }
                            } elseif ($k2DescriptionSelectText == 1) {
                                $k2DescriptionWholeText = $item['fulltext'];

                                if (!empty($item['introtext'])) {
                                    $k2DescriptionWholeText = $item['introtext'];
                                }
                            } elseif ($k2DescriptionSelectText == 2) {
                                $k2DescriptionWholeText = $item['introtext'] . ' ' . $item['fulltext'];
                                $cleanAgain = false;
                            }

                            if (!empty($k2DescriptionWholeText)) {
                                $document->setMetaData('description', $this->automaticReplacementDescription($k2DescriptionWholeText, $k2DescriptionAddDots, $cleanAgain));
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Creates the keywords list for the automatic replacement
     *
     * @param int    $numberKeywords
     * @param array  $blacklistKeywords
     * @param string $keywordsWholeText
     * @param int    $minLengthKeyword
     *
     * @return string
     */
    private function automaticReplacementKeywords($numberKeywords, $blacklistKeywords, $keywordsWholeText, $minLengthKeyword)
    {
        $automaticArticleLength = $this->params->get('automatic_article_length', 20000);
        $keywordsWholeText = $this->cleanString($keywordsWholeText, false, $automaticArticleLength);
        $pattern = array('@<[^>]+>@U', '@[,;:!"\.\?]@', '@\s+@');
        $contentWordsArray = explode(' ', preg_replace($pattern, ' ', $keywordsWholeText));
        $counter = array();

        foreach ($contentWordsArray as $value) {
            if (!empty($value)) {
                $value = mb_strtolower($value);

                if (!in_array($value, $blacklistKeywords) && mb_strlen($value) >= $minLengthKeyword) {
                    if (isset($counter[$value])) {
                        $counter[$value]++;

                        continue;
                    }

                    $counter[$value] = 1;
                }
            }
        }

        arsort($counter);

        return implode(', ', array_keys(array_slice($counter, 0, $numberKeywords)));
    }

    /**
     * Prepares and cleans the string
     *
     * @param string  $string
     * @param bool    $cleanAgain
     * @param integer $lengthMax
     *
     * @return mixed|string
     */
    private function cleanString($string, $cleanAgain = false, $lengthMax)
    {
        static $stringClean = false;

        if ($stringClean === false || $cleanAgain == true) {
            // Replace plugins with correct content
            JPluginHelper::importPlugin('content');
            $string = JHtml::_('content.prepare', $string, '');

            // Remove typical plugin syntax {...} if not replaced by a content plugin
            $string = preg_replace('@\{[^\}]*\}@sU', '', $string);

            // Decode HTML entities
            $string = html_entity_decode($string, ENT_QUOTES | ENT_XML1, 'UTF-8');

            // Remove non-breaking spaces, strip HTML tags and remove invisible chars
            $string = hex2bin(str_replace('c2a0', '20', bin2hex($string)));
            $string = preg_replace('@\s+(\t|\r\n|\r|\n)@', ' ', (strip_tags($string)));

            // Exchange double quotes and remove white spaces for the description
            $string = str_replace('"', "'", $string);
            $string = trim(preg_replace('@\s+@', ' ', $string));

            // Cut string if too long to improve performance for huge articles
            if (!empty($lengthMax)) {
                if (mb_strlen($string) > $lengthMax) {
                    $string = mb_strcut($string, 0, $lengthMax);
                }
            }

            // Remove all bad UTF8 characters with the help of the UTF8 library
            jimport('phputf8.utils.bad');
            $string = utf8_bad_strip($string);

            $stringClean = htmlspecialchars($string);
        }

        return $stringClean;
    }

    /**
     * Creates the description for the automatic replacement
     *
     * @param string $contentDescriptionWholeText
     * @param bool   $contentDescriptionAddDots
     * @param bool   $cleanAgain
     *
     * @return string
     */
    private function automaticReplacementDescription($contentDescriptionWholeText, $contentDescriptionAddDots, $cleanAgain = false)
    {
        $automaticArticleLength = $this->params->get('automatic_article_length', 20000);
        $contentDescriptionWholeText = $this->cleanString($contentDescriptionWholeText, $cleanAgain, $automaticArticleLength);

        $contentNumberDescription = $this->getCharactersLength('characters_description');
        $contentDescription = $contentDescriptionWholeText;

        if (mb_strlen($contentDescriptionWholeText) > $contentNumberDescription) {
            $contentDescription = mb_substr($contentDescriptionWholeText, 0, $contentNumberDescription);

            if (mb_substr($contentDescriptionWholeText, $contentNumberDescription, 1) != ' ') {
                $contentDescription = $this->findLastSpaceString($contentDescription);
            }

            if (!empty($contentDescriptionAddDots)) {
                if (mb_strlen($contentDescription) > $contentNumberDescription - 3) {
                    $contentDescription = $this->findLastSpaceString($contentDescription);
                }

                $contentDescription = $contentDescription . '...';
            }
        }

        return $contentDescription;
    }

    /**
     * Finds the last space in a string and removes the tail
     *
     * @param $string
     *
     * @return string
     */
    private function findLastSpaceString($string)
    {
        $string = explode(' ', $string, -1);

        return implode(' ', $string);
    }

    /**
     * Excludes certain components from collection process
     *
     * @return bool
     */
    private function excludeComponents()
    {
        $option = $this->request->get('option');
        $excludeComponents = array_map('trim', explode("\n", $this->params->get('exclude_components')));

        if (in_array($option, $excludeComponents)) {
            return true;
        }

        return false;
    }

    /**
     * Excludes certain URLs from collection process
     *
     * @return bool
     */
    private function excludeUrl()
    {
        $excludeUrls = array_filter(array_map('trim', explode("\n", $this->params->get('exclude_urls'))));

        // Exclude batch token URLs automatically
        $excludeUrls[] = 'efseo_batch_token';

        foreach ($excludeUrls as $excludeUrl) {
            if (stripos($this->url, $excludeUrl) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Builds output code for the word and character counter
     *
     * @return string
     */
    private function counterCode()
    {
        $output = '';

        if ($this->params->get('word_count') == 1) {
            if ($this->params->get('field_title') == 1) {
                $output .= "new WordCount('counter_title', {inputName:'title', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                if ($this->style == 1) {
                    $output .= "new WordCount('counter_title', {inputName:'title', eventTrigger: 'click', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                }
            }

            if ($this->params->get('field_description') == 1) {
                $output .= "new WordCount('counter_description', {inputName:'description', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                if ($this->style == 1) {
                    $output .= "new WordCount('counter_description', {inputName:'description', eventTrigger: 'click', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                }
            }

            if ($this->params->get('field_keywords') == 1) {
                $output .= "new WordCount('counter_keywords', {inputName:'keywords', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                if ($this->style == 1) {
                    $output .= "new WordCount('counter_keywords', {inputName:'keywords', eventTrigger: 'click', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                }
            }

            if ($this->params->get('field_generator') == 1) {
                $output .= "new WordCount('counter_generator', {inputName:'generator', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                if ($this->style == 1) {
                    $output .= "new WordCount('counter_generator', {inputName:'generator', eventTrigger: 'click', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                }
            }

            if ($this->params->get('field_robots') == 1) {
                $output .= "new WordCount('counter_robots', {inputName:'robots', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                if ($this->style == 1) {
                    $output .= "new WordCount('counter_robots', {inputName:'robots', eventTrigger: 'click', wordText:'" . JText::_('PLG_EASYFRONTENDSEO_WORDS') . "', charText:'" . JText::_('PLG_EASYFRONTENDSEO_CHARACTERS_LEFT') . "'});";
                }
            }
        }

        return $output;
    }

    /**
     * Gets the current head data of the document
     *
     * @param object $document
     *
     * @return array
     */
    private function currentHeadData($document)
    {
        $head = $document->getHeadData();
        $currentHeadData = array();

        $currentHeadData['title'] = '';
        $currentHeadData['description'] = '';
        $currentHeadData['keywords'] = '';
        $currentHeadData['robots'] = '';

        if (!empty($head['title'])) {
            $currentHeadData['title'] = htmlspecialchars($head['title'], ENT_COMPAT, 'UTF-8', false);
        }

        if (!empty($head['description'])) {
            $currentHeadData['description'] = htmlspecialchars($head['description'], ENT_COMPAT, 'UTF-8', false);
        }

        if (!empty($head['metaTags']['name']['keywords'])) {
            $currentHeadData['keywords'] = htmlspecialchars($head['metaTags']['name']['keywords'], ENT_COMPAT, 'UTF-8', false);
        } elseif (!empty($head['metaTags']['standard']['keywords'])) {
            $currentHeadData['keywords'] = htmlspecialchars($head['metaTags']['standard']['keywords'], ENT_COMPAT, 'UTF-8', false);
        }

        if (!empty($head['metaTags']['name']['robots'])) {
            $currentHeadData['robots'] = htmlspecialchars($head['metaTags']['name']['robots'], ENT_COMPAT, 'UTF-8', false);
        } elseif (!empty($head['metaTags']['standard']['robots'])) {
            $currentHeadData['robots'] = htmlspecialchars($head['metaTags']['standard']['robots'], ENT_COMPAT, 'UTF-8', false);
        }

        $currentHeadData['generator'] = htmlspecialchars($document->getGenerator(), ENT_COMPAT, 'UTF-8', false);

        return $currentHeadData;
    }

    /**
     * Builds the form for the modal window or the top bar
     *
     * @param string $title
     * @param string $description
     * @param string $keywords
     * @param string $generator
     * @param string $robots
     *
     * @return string
     */
    private function buildForm($title, $description, $keywords, $generator, $robots)
    {
        $wordCount = (bool) $this->params->get('word_count');
        $output = '';

        if ($this->style == 0) {
            $output .= '<div id="easyfrontendseo"><h2>' . JText::_('PLG_EASYFRONTENDSEO_PLUGINNAME') . '</h2>';
        } elseif ($this->style == 1) {
            $output .= '<div id="easyfrontendseo_lightbox">';
        } elseif ($this->style == 2) {
            $output .= '<div id="easyfrontendseo_lightbox" class="featherlight_hidden"><h2>' . JText::_('PLG_EASYFRONTENDSEO_PLUGINNAME') . '</h2>';
        }

        $output .= '<form action="' . $this->urlToString . '" method="post">';

        if ($this->params->get('field_title') == 1) {
            $charactersTitle = $this->getCharactersLength('characters_title');

            $output .= '<label for="title">' . JText::_('PLG_EASYFRONTENDSEO_TITLE') . ':</label>
                <input type="text" value="' . $title . '" name="title" id="title" size="60" maxlength="' . $charactersTitle . '" tabindex="1" />';

            if ($wordCount) {
                $output .= '<span id="counter_title" class="efseo_counter"></span>';
            }

            $output .= '<br />';
        } elseif ($this->params->get('field_title') == 2) {
            $output .= '<label for="title">' . JText::_('PLG_EASYFRONTENDSEO_TITLE') . ':</label>
                <span class="efseo_disabled">' . $title . '</span><br />';
        }

        if ($this->params->get('field_description') == 1) {
            $charactersDescription = $this->getCharactersLength('characters_description');

            $output .= '<label for="description">' . JText::_('PLG_EASYFRONTENDSEO_DESCRIPTION') . ':</label>
                <textarea name="description" id="description" rows="3" maxlength="' . $charactersDescription . '" tabindex="2" >' . $description . '</textarea>';

            if ($wordCount) {
                $output .= '<span id="counter_description" class="efseo_counter"></span>';
            }

            $output .= '<br />';
        } elseif ($this->params->get('field_description') == 2) {
            $output .= '<label for="description">' . JText::_('PLG_EASYFRONTENDSEO_DESCRIPTION') . ':</label>
                <span class="efseo_disabled">' . $description . '</span><br />';
        }

        if ($this->params->get('field_keywords') == 1) {
            $output .= '<label for="keywords">' . JText::_('PLG_EASYFRONTENDSEO_KEYWORDS') . ':</label>
                <input type="text" value="' . $keywords . '" name="keywords" id="keywords" size="60" maxlength="255" tabindex="3" />';

            if ($wordCount) {
                $output .= '<span id="counter_keywords" class="efseo_counter"></span>';
            }

            $output .= '<br />';
        } elseif ($this->params->get('field_keywords') == 2) {
            $output .= '<label for="keywords">' . JText::_('PLG_EASYFRONTENDSEO_KEYWORDS') . ':</label>
                <span class="efseo_disabled">' . $keywords . '</span><br />';
        }

        if ($this->params->get('field_generator') == 1) {
            $output .= '<label for="generator">' . JText::_('PLG_EASYFRONTENDSEO_GENERATOR') . ':</label>
                <input type="text" value="' . $generator . '" name="generator" id="generator" size="60" maxlength="255" tabindex="4" />';

            if ($wordCount) {
                $output .= '<span id="counter_generator" class="efseo_counter"></span>';
            }

            $output .= '<br />';
        } elseif ($this->params->get('field_generator') == 2) {
            $output .= '<label for="generator">' . JText::_('PLG_EASYFRONTENDSEO_GENERATOR') . ':</label>
                <span class="efseo_disabled">' . $generator . '</span><br />';
        }

        if ($this->params->get('field_robots') == 1) {
            $output .= '<label for="robots">' . JText::_('PLG_EASYFRONTENDSEO_ROBOTS') . ':</label>
                <input type="text" value="' . $robots . '" name="robots" id="robots" size="60" maxlength="255" tabindex="5" />';

            if ($wordCount) {
                $output .= '<span id="counter_robots" class="efseo_counter"></span>';
            }

            $output .= '<br />';
        } elseif ($this->params->get('field_robots') == 2) {
            $output .= '<label for="robots">' . JText::_('PLG_EASYFRONTENDSEO_ROBOTS') . ':</label>
                <span class="efseo_disabled">' . $robots . '</span><br />';
        }

        if ($this->params->get('field_delete') == 1) {
            $output .= '<span class="icon-warning-circle"></span><label for="delete">' . JText::_('PLG_EASYFRONTENDSEO_DELETEDATA') . ':</label>
                <input type="checkbox" value="1" name="delete" id="delete" tabindex="6" /><br />';
        }

        $output .= '<input class="btn btn-success" type="submit" value="' . JText::_('PLG_EASYFRONTENDSEO_APPLY') . '" name="easyfrontendseo" tabindex="7" /></form>';

        // Overwrite notice
        if ($this->params->get('overwrite_notice') && ($this->params->get('save_data_table_content') == 1 || $this->params->get('save_data_table_menu') > 0)) {
            $output .= '<p class="overwrite_notice">' . JText::_('PLG_EASYFRONTENDSEO_OVERWRITENOTICE') . '</p>';
        }

        $output .= '</div>';

        if ($this->style == 1) {
            // Adjust the output for the modal window
            $output = str_replace("'", "\'", preg_replace('@\s+@', ' ', $output));
        }

        return $output;
    }

    /**
     * Builds the whole output in the onAfterRender trigger
     */
    public function onAfterRender()
    {
        if ($this->allowedUserGroups == true) {
            $document = JFactory::getDocument();

            if ($document instanceof JDocumentHtml) {
                $head = $this->currentHeadData($document);
                $output = $this->buildButtons($head['title'], $head['description'], $head['keywords'], $head['generator'], $head['robots']);

                if ($this->style == 0 || $this->style == 2) {
                    $output .= $this->buildForm($head['title'], $head['description'], $head['keywords'], $head['generator'], $head['robots']);
                }

                $body = $this->app->getBody();

                if (preg_match("@<body[^>]*>@", $body, $matches)) {
                    $body_start = $matches[0];
                    $body = str_replace($body_start, $body_start . $output, $body);
                    $this->app->setBody($body);
                }
            }
        }
    }

    /**
     * Builds the buttons for the overview top bar
     *
     * @param string $title
     * @param string $description
     * @param string $keywords
     * @param string $generator
     * @param string $robots
     *
     * @return string
     */
    private function buildButtons($title = '', $description = '', $keywords = '', $generator = '', $robots = '')
    {
        $metaCheck = '';

        if ($this->params->get('icon_title') == 1) {
            $metaCheck .= $this->buildSingleButton($title, 'PLG_EASYFRONTENDSEO_TITLE');
        }

        if ($this->params->get('icon_description') == 1) {
            $metaCheck .= $this->buildSingleButton($description, 'PLG_EASYFRONTENDSEO_DESCRIPTION');
        }

        if ($this->params->get('icon_keywords') == 1) {
            $metaCheck .= $this->buildSingleButton($keywords, 'PLG_EASYFRONTENDSEO_KEYWORDS');
        }

        if ($this->params->get('icon_generator') == 1) {
            $metaCheck .= $this->buildSingleButton($generator, 'PLG_EASYFRONTENDSEO_GENERATOR');
        }

        if ($this->params->get('icon_robots') == 1) {
            $metaCheck .= $this->buildSingleButton($robots, 'PLG_EASYFRONTENDSEO_ROBOTS');
        }

        if ($this->style == 0) {
            return '<div id="easyfrontendseo_topbar"><a id="toggle" href="#">' . $metaCheck . '</a></div>';
        } elseif ($this->style == 1) {
            if (empty($metaCheck)) {
                $metaCheck = '<strong>' . JText::_('PLG_EASYFRONTENDSEO_PLUGINNAME') . '</strong>';
            }

            return '<div id="easyfrontendseo_lightbox_button_' . $this->params->get('modal_position') . '"><a href="#" id="modal">' . $metaCheck . '</a></div>';
        } elseif ($this->style == 2) {
            if (empty($metaCheck)) {
                $metaCheck = '<strong>' . JText::_('PLG_EASYFRONTENDSEO_PLUGINNAME') . '</strong>';
            }

            return '<div id="easyfrontendseo_lightbox_button_' . $this->params->get('modal_position') . '"><a href="#" data-featherlight="#easyfrontendseo_lightbox" data-featherlight-persist="true" id="modal">' . $metaCheck . '</a></div>';
        }

        return '';
    }

    /**
     * Creates a single button item for the top bar
     *
     * @param $value
     * @param $language_string
     *
     * @return string
     */
    private function buildSingleButton($value, $language_string)
    {
        if (!empty($value)) {
            return '<img src="' . JUri::base() . 'plugins/system/easyfrontendseo/assets/images/check.png" alt="' . JText::_($language_string) . '" title="' . JText::_($language_string) . '" />';
        }

        return '<img src="' . JUri::base() . 'plugins/system/easyfrontendseo/assets/images/cross.png" alt="' . JText::_($language_string) . '" title="' . JText::_($language_string) . '" />';
    }

    /**
     * Trigger onContentAfterTitle is used to obtain the title of the loaded article / category
     * onContentPrepare is not used because this function is also triggered by custom modules
     *
     * @param     $context
     * @param     $item
     * @param     $params
     * @param int $page
     */
    public function onContentAfterTitle($context, &$item, &$params, $page = 0)
    {
        if ($this->params->get('global_title')) {
            if (!empty($item->title)) {
                $this->articleTitle = $item->title;
            }
        }
    }
}
