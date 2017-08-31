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
namespace con4gis\QueueBundle\Classes\Contao\Hooks;

use Contao\BackendUser;

/**
 * Class RightsManager
 * @package con4gis\QueueBundle\Classes\Contao\Hooks
 */
class RightsManager
{


    /**
     * Ermöglich das Löschen von Datensätzen nur für Admins.
     * @param $name
     */
    public function setDeleteRightForAdmin($name)
    {
        if (isset($GLOBALS['con4gis']['rightsManagement']['undeletebleTabels']) &&
            in_array($name, $GLOBALS['con4gis']['rightsManagement']['undeletebleTabels'])
        ) {
            $objUser = BackendUser::getInstance();

            if ($objUser->isAdmin) {
                $GLOBALS['TL_DCA'][$name]['config']['notDeletable'] = false;
            } else {
                unset($GLOBALS['TL_DCA'][$name]['list']['operations']['delete']);
            }
        }
    }
}
