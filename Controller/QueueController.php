<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2017
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Controller;

use con4gis\QueueBundle\Classes\Queue\QueueManager;
use Contao\Input;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class QueueController
 * @package con4gis\QueueBundle\Controller
 */
class QueueController extends Controller
{


    /**
     * initialize contao
     */
    protected function initialize()
    {
        $this->container->get('contao.framework')->initialize();
    }


    /**
     * Ruft das Event für das Abarbeiten der Queue auf.
     * @param     $queuename
     * @param int $count
     * @return JsonResponse
     */
    public function runQueueAction($queuename, $count)
    {
        $this->initialize();
        $key = Input::get('key');

        if (isset($GLOBALS['con4gis']['api']['key']['queue']) && $key == $GLOBALS['con4gis']['api']['key']['queue']) {
            $queueManager = new QueueManager();
            $queueManager->run($queuename, $count);
            $output = sprintf($GLOBALS['TL_LANG']['MSC']['con4gis']['queueoutput'], $count, $queuename);

            return $this->sendResponse($output);
        } else {
            return $this->sendResponse('ERROR: invalid key!', 403);
        }
    }


    /**
     * Erstellt das Response.
     * @param       $output
     * @param int   $status
     * @param array $header
     * @param bool  $json
     * @return JsonResponse
     */
    protected function sendResponse($output, $status = 200, $header = array(), $json = true)
    {
        $output = date('Y.m.d H:i:s') . " - $output";
        $data = json_encode(['output' => $output]);
        return new JsonResponse($data, $status, $header, $json);
    }
}
