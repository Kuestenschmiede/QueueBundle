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
namespace con4gis\QueueBundle\Classes\Listener;

use con4gis\QueueBundle\Classes\Events\QueueResponseEvent;
use NotificationCenter\Model\Notification;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class QueueResponseListener
 * @package con4gis\QueueBundle\Classes\Listener
 */
class QueueResponseListener
{


    /**
     * Ruft die Verarbeitung des Responses auf.
     * @param QueueResponseEvent       $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onQueueResponseListenerLoadContent(
        QueueResponseEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $content = $event->getContent();

        if (isset($GLOBALS['TL_LANG']['MSC']['con4gis']['queue'][$content])) {
            $event->setContent($GLOBALS['TL_LANG']['MSC']['con4gis']['queue'][$content]);
        }
    }


    /**
     * Ruft die Verarbeitung des Responses auf.
     * @param QueueResponseEvent       $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onQueueResponseListenerGenerate(
        QueueResponseEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $queueName          = $event->getQueueName();
        $kind               = $event->getKind();
        $content            = $event->getContent();
        $msgKey             = 'con4gis - QueueMessage';
        $msgType            = $queueName . '_' . $kind;
        $param              = $event->getParam();
        $param['queueName'] = $queueName;
        $param['kind']      = $kind;
        $param['content']   = $content;
        $param['msgKey']    = $msgKey;
        $param['msgType']   = $msgType;

        $notifications = Notification::findAllByType($msgType);

        if ($notifications !== null) {
            while ($notifications->next()) {
                $notifications->send($param);
            }
        }
    }
}
