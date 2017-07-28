<?php
/**
 * @copyright	Copyright © 2017 - All rights reserved.
 * @license		GNU General Public License v2.0
 * @generator	http://xdsoft/joomla-module-generator/
 */
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
/* Available fields:"show_image","show_date","show_location","show_description","show_time","show_feature","show_read_more", */
// Include assets
$doc->addStyleSheet(JURI::root()."modules/mod_icagenda_events/assets/css/style.css");
$doc->addScript(JURI::root()."modules/mod_icagenda_events/assets/js/script.js");
// $width 			= $params->get("width");


$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select($db->quoteName(array('id','asset_id','ordering','state','approval','site_itemid','checked_out','checked_out_time','title','alias','access','language','hits','created','created_by','created_by_alias','created_by_email','modified','modified_by','username','catid','image','file','displaytime','weekdays','daystime','startdate','enddate','period','dates','next','time','place','website','email','phone','name','city','country','address','coordinate','lat','lng','shortdesc','desc','metadesc','params')));

$query->from($db->quoteName('#__icagenda_events')) ;
$query->order('startdate ASC');
$db->setQuery($query);
$objects = $db->loadObjectList();

$db2 = JFactory::getDbo();
$query2 = $db2->getQuery(true);
$query2->select($db2->quoteName(array('id','event_id','feature_id')));
$query2->from($db2->quoteName('#__icagenda_feature_xref')) ;
$db2->setQuery($query2);
$objects2 = $db2->loadObjectList();

$db3 = JFactory::getDbo();
$query3 = $db3->getQuery(true);
$query3->select($db3->quoteName(array('id','ordering','state','title')));
$query3->from($db3->quoteName('#__icagenda_feature')) ;
$db3->setQuery($query3);
$objects3 = $db3->loadObjectList();

require JModuleHelper::getLayoutPath('mod_icagenda_events', $params->get('layout', 'default'));
