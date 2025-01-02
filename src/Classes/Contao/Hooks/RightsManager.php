<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 10
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2025, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
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
     * loadDataContainer_Hook: Ermöglich das Löschen von Datensätzen nur für Admins.
     * @param $name
     */
    public function setDeleteRightForAdmin($name)
    {
        if (isset($GLOBALS['con4gis']['rightsManagement']['undeletebleTabels']) &&
            in_array($name, $GLOBALS['con4gis']['rightsManagement']['undeletebleTabels'])
        ) {
            $objUser = BackendUser::getInstance();

            if ($objUser->admin) {
                $GLOBALS['TL_DCA'][$name]['config']['notDeletable'] = false;
            } else {
                unset($GLOBALS['TL_DCA'][$name]['list']['operations']['delete']);
            }
        }
    }
}
