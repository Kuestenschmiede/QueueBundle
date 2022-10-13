<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2022, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
 */

$strName = 'tl_c4g_queue';

$GLOBALS['TL_DCA'][$strName] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => false,
		'closed'                      => true,
		'notDeletable'                => true,
		'notEditable'                 => true,
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
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('tstamp', 'priority'),
            'panelLayout'             => 'filter,limit',
			'flag'                    => 6,
            'icon'                    => 'bundles/con4giscore/images/be-icons/con4gis_blue.svg',
		),
		'label' => array
		(
			'fields'                  => array('kind', 'startworking', 'endworking'),
			'format'                  => '%s [Start: %s | Ende: %s]',
            'label_callback'          => array('\con4gis\QueueBundle\Classes\Contao\Callbacks\TlC4gQueue', 'cbGenJobLabel')
		),
		'global_operations' => array
		(
            'back' =>
                [
                    'href'                => 'key=back',
                    'class'               => 'header_back',
                    'button_callback'     => ['\con4gis\CoreBundle\Classes\Helper\DcaHelper', 'back'],
                    'icon'                => 'back.svg',
                    'label'               => &$GLOBALS['TL_LANG']['MSC']['backBT'],
                ],
		),
		'operations' => array
		(
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			),
            'check' => array
            (
                'label'               => &$GLOBALS['TL_LANG'][$strName]['check'],
                'icon'                => 'bundles/con4gisqueue/status-away.svg',
                'button_callback'     => array('\con4gis\QueueBundle\Classes\Contao\Callbacks\TlC4gQueue', 'cbGenCheckButton')
            )
		)
	),
	'select' => array
	(
		'buttons_callback' => array()
	),
	'edit' => array
	(
		'buttons_callback' => array()
	),
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{data_legend},kind,srcmodule,priority,startworking,endworking,haserror,;'
	),
	'subpalettes' => array
	(
		''                            => ''
	),
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
            'default'                 => '',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'priority' => array
        (
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'default'                 => 1024,
            'eval'                    => array('mandatory'=>true, 'maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '1024'"
        ),
        'startworking' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'flag'                    => 6,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'endworking' => array
        (
            'default'                 => '0',
            'exclude'                 => true,
            'flag'                    => 6,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>10),
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'haserror' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'data' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('doNotShow'=>true),
            'sql'                     => "text NOT NULL"
        ),
        'srcmodule' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'srctable' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'srcid' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'intervalkind' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'intervalcount' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'intervaltorun' => array
        (
            'default'                 => '',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        )
	)
);
