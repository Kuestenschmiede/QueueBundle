<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2017
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Contao\Callbacks;

use Contao\Image;

/**
 * Class TlC4gQueue
 * @package con4gis\QueueBundle\Classes\Contao\Callbacks
 */
class TlC4gQueue
{


    /**
     * label_callback: Erzeugt die Icons für den Status der Jobs der Queue.
     * @param $row
     * @param $label
     * @return string
     */
    public function cbGenJobLabel($row, $label)
    {
        $path = 'bundles/con4gisqueue';

        if($row['startworking']) {
            if ($row['endworking']) {
                // Job wurde bearbeitet
                if ($row['haserror']) {
                    // Job mit Fehler abgeschlossen
                    $icon   = "$path/exclamation.png";
                    $msg    = 'error';
                } else{
                    // Job ohne Fehler abgeschlossen
                    $icon   = "$path/tick.png";
                    $msg    = 'success';
                }
            } else {
                // Job wird gerade bearbeitet
                $icon   = "$path/control.png";
                $msg    = 'running';
            }
        } else {
            // Job wartet auf Bearbeitung
            $icon   = "$path/clock.png";
            $msg    = 'waiting';
        }

        if (isset($GLOBALS['TL_LANG']['MSC']['con4gis']['queuestatus'][$msg])) {
            $msg = $GLOBALS['TL_LANG']['MSC']['con4gis']['queuestatus'][$msg];
        }

        if (isset($row['srcmodule']) && $row['srcmodule'] != '') {
            if (isset($GLOBALS['TL_LANG']['MOD'][$row['srcmodule']][0]) &&
                $GLOBALS['TL_LANG']['MOD'][$row['srcmodule']][0] != ''
            ) {
                $srcmodule = $GLOBALS['TL_LANG']['MOD'][$row['srcmodule']][0];
            } else {
                $srcmodule = $row['srcmodule'];
            }
        } else {
            $srcmodule = '';
        }

        if (isset($row['srcid']) && $row['srcid'] != '') {
            $srcmodule .= ' - ' . $row['srcid'] . ': ';
        }

        return '<span title="' . $msg . '"><img src="' . $icon . '">' . $srcmodule . $label . '</span>';
    }


    /**
     * button_callback: Erstellt das Icon für das Ergebnis der Überprüfung.
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @param $strTable
     * @param $arrRootIds
     * @param $arrChildRecordIds
     * @param $blnCircularReference
     * @param $strPrevious
     * @param $strNext
     * @return string
     */
    public function cbGenCheckButton($row, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
    {
        if ($row['endworking'] && $row['haserror'] && isset($row['data']) && $row['data']) {
            $event = unserialize(urldecode($row['data']));

            if ($event) {
                // Überprüfung mit Fehlern abgeschlossen
                $temp   = $event->getError();
                $content= (is_array($temp)) ? implode('<br>', $temp) : $temp;

                $icon   = str_replace('-away.png', '-busy.png', $icon);
                $icon   = Image::getHtml($icon, $label);
                $content= str_replace('"', '', $content);
                $content= str_replace("\n", '<br>', $content);
                $content= '<div style=\\\'min-height: 300px; margin: 5px;\\\'>' . $content . '</div>';
                $js     = 'onclick="Backend.openModalWindow(500, \'';
                $js    .= $GLOBALS['TL_LANG']['MSC']['con4gis']['queuestatus']['error']. '\', \'' . $content . '\')"';
                $link   = '<span style="cursor: pointer;"';
                $link  .= $js . '>';
                $link  .= $icon . '</span>';
                return $link;
            }
        }

        if ($row['endworking']) {
            $icon = str_replace('-away.png', '.png', $icon);
        }

        // Überprüfung ohne Fehler abgeschlossen
        return '<span>'.Image::getHtml($icon, $label).'</span>';
    }
}
