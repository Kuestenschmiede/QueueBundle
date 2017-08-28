<?php
/**
 * con4gis - the gis-kit
 *
 * @version   php 7
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
		'enableVersioning'            => false,
		'closed'                      => true,
		'notEditable'                 => true,
		'notDeletable'                => true,
		'notSortable'                 => true,
		'notCopyable'                 => true,
		'notCreatable'                => true,
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
			'fields'                  => array('tstamp', 'priority'),
            'panelLayout'             => 'filter,limit',
			'flag'                    => 6
		),
		'label' => array
		(
			'fields'                  => array('kind', 'startworking', 'endworking'),
			'format'                  => '%s [Start: %s | Ende: %s]',
            'label_callback'          => array('\con4gis\QueueBundle\Classes\Contao\Callbacks\TlC4gQueue', 'cbGenJobLabel')
		),
		'global_operations' => array
		(/*
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)*/
		),
		'operations' => array
		(/*
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
			),*/
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
            'check' => array
            (
                'label'               => &$GLOBALS['TL_LANG'][$strName]['check'],
                #'href'                => 'act=show',
                'icon'                => 'web/bundles/con4gisqueue/status-away.png',
                'button_callback'     => array('\con4gis\QueueBundle\Classes\Contao\Callbacks\TlC4gQueue', 'cbGenCheckButton')
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
		'default'                     => '{data_legend},kind,priority,startworking,endworking,haserror;'
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
		    'flag'                    => 6,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'kind' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['kind'],
            'default'                 => '',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'priority' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['priority'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'default'                 => 1024,
            'eval'                    => array('mandatory'=>true, 'maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '1024'"
        ),
        'startworking' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['startworking'],
            'default'                 => '',
            'exclude'                 => true,
            'flag'                    => 6,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'endworking' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['endworking'],
            'default'                 => '0',
            'exclude'                 => true,
            'flag'                    => 6,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'haserror' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['haserror'],
            'default'                 => '',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            //'eval'                    => array(),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'data' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['data'],
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'doNotShow'=>true),
            'sql'                     => "text NOT NULL"
        )
	)
);
