<?php
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 *
 * @package     eden
 * @filesource  tl_c4g_queue.php
 * @version     1.0.0
 * @since       22.08.17 - 15:03
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2017
 * @license     EULA
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