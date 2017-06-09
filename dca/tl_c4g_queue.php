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
 * Set Tablename
 */
$strName = 'tl_c4g_queue';


/**
 * Table tl_c4g_queue
 */
$GLOBALS['TL_DCA'][$strName] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('kind'),
            'panelLayout'             => 'sort,filter;search,limit',
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('kind'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{data_legend},kind,priority,startworking,endworking,data;'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'kind' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['kind'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'priority' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['priority'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 1024,
            'eval'                    => array('mandatory'=>true, 'maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '1024'"
        ),
        'startworking' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['startworking'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'endworking' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['endworking'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'data' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['data'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "text NOT NULL "
        )
	)
);
