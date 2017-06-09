<?php
/**
 * con4gis - the gis-kit
 *
 * @version   php 5
 * @package   con4gis
 * @author    con4gis contributors (see "authors.txt")
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2017.
 * @link      https://www.kuestenschmiede.de
 */

/**
 * Variables
 */
$strFolder      = 'con4gis_queue';
$strNamespace   = $strFolder;


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	$strNamespace
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Classes
    $strNamespace . '\classes\queue\QueueManager'                   => "system/modules/$strFolder/classes/queue/QueueManager.php",
	// Events
	$strNamespace . '\classes\events\AddToQueueEvent'               => "system/modules/$strFolder/classes/events/AddToQueueEvent.php",
    $strNamespace . '\classes\events\LoadQueueEvent'                => "system/modules/$strFolder/classes/events/LoadQueueEvent.php",
    $strNamespace . '\classes\events\QueueSetEndTimeEvent'          => "system/modules/$strFolder/classes/events/QueueSetEndTimeEvent.php",
    $strNamespace . '\classes\events\QueueSetStartTimeEvent'        => "system/modules/$strFolder/classes/events/QueueSetStartTimeEvent.php",
    // Listener
    $strNamespace . '\classes\listener\AddToQueueListener'          => "system/modules/$strFolder/classes/listener/AddToQueueListener.php",
    $strNamespace . '\classes\listener\LoadQueueListener'           => "system/modules/$strFolder/classes/listener/LoadQueueListener.php",
    $strNamespace . '\classes\listener\QueueSetEndTimeListener'     => "system/modules/$strFolder/classes/listener/QueueSetEndTimeListener.php",
    $strNamespace . '\classes\listener\QueueSetStartTimeListener'   => "system/modules/$strFolder/classes/listener/QueueSetStartTimeListener.php",
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	#'ce_demotemplate' => "system/modules/$strFolder/templates",
));