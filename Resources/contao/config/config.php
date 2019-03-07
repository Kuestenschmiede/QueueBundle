<?php
/*
 * This file is part of con4gis,
 * the gis-kit for Contao CMS.
 *
 * @package    con4gis
 * @version    6
 * @author     con4gis contributors (see "authors.txt")
 * @license    LGPL-3.0-or-later
 * @copyright  Küstenschmiede GmbH Software & Design
 * @link       https://www.con4gis.org
 */

$GLOBALS['con4gis']['queue']['installed'] = true;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['con4gis_core'] = array_merge($GLOBALS['BE_MOD']['con4gis_core'], array(
    'queue' => array
    (
        'tables' => array('tl_c4g_queue')
    )
));

//$GLOBALS['BE_MOD']['con4gis'] =
//    \con4gis\CoreBundle\Resources\contao\classes\C4GUtils::sortBackendModules($GLOBALS['BE_MOD']['con4gis']);
/**
 * HOOK
 */
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array('\con4gis\QueueBundle\Classes\Contao\Hooks\RightsManager', 'setDeleteRightForAdmin');


/**
 * API-KEY für die Ausführung der Queue-Verarbeitung
 */
$GLOBALS['con4gis']['api']['key']['queue'] = '$6$D.AAHGlxy6$CMTMiG6yfiPrbdTb0ejEhT1vsPUl1Z7x1nxRbaC9LqdnDw4naVIVz19F7d6XEX1.GaCMlwOPmERa6ws6RbAGa0';


/**
 * Tabellen, in denen die Datensätze nur von einem Amin gellöscht werden dürfen
 */
$GLOBALS['con4gis']['rightsManagement']['undeletebleTabels'][] = 'tl_c4g_queue';


/**
 * Definition der Benachrichtigungstypen
 * -------------------------------------
 * Hier werden die Events mit den gewünschten Nachrichten-Leveln definiert,
 * mit denen die automatischen Nachrichten der EventQueue erzeugt werden.
 * Zur Zeit werden vom QueueManager nur die Level ERROR, INFO und NOTICE unterstützt.
 * Die Events müssen von QueueEvent abgeleitet werden!
 *
 * Beispiel:
 * $GLOBALS['con4gis']['queue']['notificationtypes']['MemberLoadEvent'] = array('ERROR', 'INFO', 'NOTICE');
 *
 * Beispiel mit zusätzlichen InsertTag für 'NOTICE':
 * $GLOBALS['con4gis']['queue']['notificationtypes']['MemberLoadEvent'] = array('ERROR', 'INFO', 'NOTICE' => array('neuerTag'));
 */