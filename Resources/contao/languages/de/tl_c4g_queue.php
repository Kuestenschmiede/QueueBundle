<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2017
 * @link      https://www.kuestenschmiede.de
 */
/**
 * Set Tablename
 */
$strName = 'tl_c4g_queue';


/**
 * Set Elementname
 */
$strElement = 'Eintrag';


/**
 * Fields
 */
$GLOBALS['TL_LANG'][$strName]['kind']           = array('Art', 'Name des Events');
$GLOBALS['TL_LANG'][$strName]['priority']       = array('Priorität', 'Priorität');
$GLOBALS['TL_LANG'][$strName]['startworking']   = array('Begin der Abarbeitung', 'Begin der Abarbeitung');
$GLOBALS['TL_LANG'][$strName]['endworking']     = array('Ende der Abarbeitung', 'Ende der Abarbeitung');
$GLOBALS['TL_LANG'][$strName]['haserror']       = array('Fehler', 'Ist bei der Verarbeitung ein Fehler aufgetreten?');
$GLOBALS['TL_LANG'][$strName]['srcmodule']      = array('Quellmodul', 'Quellmodul des Jobs');
$GLOBALS['TL_LANG'][$strName]['srctable']       = array('Quelltabelle', 'Quelltabelle des Jobs');
$GLOBALS['TL_LANG'][$strName]['srcid']          = array('Quellid', 'Quellid des Jobs');
$GLOBALS['TL_LANG'][$strName]['interval']       = array('Intervall', 'Intervall in dem der Job ausgeführt werden soll.');
$GLOBALS['TL_LANG'][$strName]['intervalcount']  = array('Anzahl der bisherigen Ausführungen', 'Anzahl der bisherigen Ausführungen');
$GLOBALS['TL_LANG'][$strName]['intervaltorun']  = array('Gesamtzahl der Ausführungen', 'Gesamtzahl der Ausführungen');


/**
 * Legends
 */
//$GLOBALS['TL_LANG'][$strName]['']   = '';


/**
 * Reference
 */
//$GLOBALS['TL_LANG'][$strName]['']   = array();


/**
 * Buttons
 */
$GLOBALS['TL_LANG'][$strName]['new']        = array('Neuen ' . $strElement, 'Neuen ' . $strElement . ' anlegen');
$GLOBALS['TL_LANG'][$strName]['edit']       = array($strElement . ' bearbeiten', $strElement . ' mit der ID %s bearbeiten');
$GLOBALS['TL_LANG'][$strName]['copy']       = array($strElement . ' kopieren', $strElement . ' mit der ID %s kopieren');
$GLOBALS['TL_LANG'][$strName]['delete']     = array($strElement . ' löschen', $strElement . ' mit der ID %s löschen');
$GLOBALS['TL_LANG'][$strName]['show']       = array($strElement . ' anzeigen', 'Details des ' . $strElement . 's mit der ID %s anzeigen');