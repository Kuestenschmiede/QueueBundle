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
$GLOBALS['TL_LANG'][$strName]['startworking']   = array('Beginn der Abarbeitung', 'Beginn der Abarbeitung');
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