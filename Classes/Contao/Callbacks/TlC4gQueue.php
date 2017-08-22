<?php
/**
 * @package     eden
 * @filesource  TlC4gQueue.php
 * @version     1.0.0
 * @since       22.08.17 - 15:37
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2017
 * @license     EULA
 */
namespace con4gis\QueueBundle\Classes\Contao\Callbacks;

use Contao\Image;
use Eden\MemberBundle\classes\events\CheckContingentEvent;
use Eden\MemberBundle\classes\listener\VerifyPostalListener;

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

        return '<span title="' . $msg . '"><img src="' . $icon . '"> ' . $label . '</span>';
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
            $event = unserialize($row['data']);

            if ($event) {
                // Überprüfung mit Fehlern abgeschlossen
                $temp   = $event->getReturnMessages();
                $content= (is_array($temp) && count($temp)) ? implode('<br>', $temp) : $temp;
                $icon   = str_replace('.png', '-busy.png', $icon);
                $icon   = Image::getHtml($icon, $label);
                $content= '<div style=\\\'min-height: 300px; margin: 5px;\\\'>' . $content . '</div>';
                $js     = 'onclick="Backend.openModalWindow(500, \'';
                $js    .= $GLOBALS['TL_LANG']['MSC']['con4gis']['queuestatus']['error']. '\', \'' . $content . '\')"';
                $link   = '<span style="cursor: pointer;"';
                $link  .= $js . '>';
                $link  .= $icon . '</span>';
                return $link;
            }
        }

        // Überprüfung ohne Fehler abgeschlossen
        return '<span>'.Image::getHtml($icon, $label).'</span>';
    }
}
