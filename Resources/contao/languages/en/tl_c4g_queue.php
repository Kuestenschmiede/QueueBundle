<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
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
$GLOBALS['TL_LANG'][$strName]['kind']           = array('Kind', 'Name of the event');
$GLOBALS['TL_LANG'][$strName]['priority']       = array('Priority', 'Priority');
$GLOBALS['TL_LANG'][$strName]['startworking']   = array('Begin of Processing', 'Begin of Processing');
$GLOBALS['TL_LANG'][$strName]['endworking']     = array('End of Processing', 'End of Processing');
$GLOBALS['TL_LANG'][$strName]['haserror']       = array('Error', 'Did an error occuir during processing?');
$GLOBALS['TL_LANG'][$strName]['srcmodule']      = array('Source Module', 'Job source module');
$GLOBALS['TL_LANG'][$strName]['srctable']       = array('Source Table', 'Job source table');
$GLOBALS['TL_LANG'][$strName]['srcid']          = array('Sourceid', 'Job sourceid');
$GLOBALS['TL_LANG'][$strName]['interval']       = array('Interval', 'Interval in which to execute the job.');
$GLOBALS['TL_LANG'][$strName]['intervalcount']  = array('Number of executions so far.', 'Number of executions so far.');
$GLOBALS['TL_LANG'][$strName]['intervaltorun']  = array('Total number of executions', 'Total number of executions');


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
$GLOBALS['TL_LANG'][$strName]['new']        = array('New ' . $strElement, 'New ' . $strElement . '');
$GLOBALS['TL_LANG'][$strName]['edit']       = array('Edit ' . $strElement, 'Edit ' . $strElement . ' with ID %s');
$GLOBALS['TL_LANG'][$strName]['copy']       = array('Copy ' . $strElement, 'Copy ' . $strElement . ' with ID %s');
$GLOBALS['TL_LANG'][$strName]['delete']     = array('Delete ' . $strElement, 'Delete ' . $strElement . ' with ID %s');
$GLOBALS['TL_LANG'][$strName]['show']       = array('Show ' . $strElement, 'Show details of the ' . $strElement . 'with ID %s');