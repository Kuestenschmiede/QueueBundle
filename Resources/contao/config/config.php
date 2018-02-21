<?php

/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
 * @link      https://www.kuestenschmiede.de
 */

$GLOBALS['con4gis']['queue']['installed'] = true;

/**
 * Backend modules
 */
array_insert($GLOBALS['BE_MOD']['con4gis_bricks'],5, array(
    'queue' => array
    (
        'tables' => array('tl_c4g_queue')
    )
));


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