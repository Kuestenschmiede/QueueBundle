<?php
/**
 * @package     con4gis
 * @filesource  QueueManager.php
 * @version     1.0.0
 * @since       03.06.17 - 17:12
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2017
 * @license     EULA
 */
namespace con4gis\Queue\Classes\Queue;

use con4gis\Queue\Classes\Events\AddToQueueEvent;
use con4gis\Queue\Classes\Events\LoadQueueEvent;
use con4gis\Queue\Classes\Events\QueueSetEndTimeEvent;
use con4gis\Queue\Classes\Events\QueueSetStartTimeEvent;
use Contao\System;

/**
 * Class QueueManager
 * @package con4gis\Queue\Classes\Queue
 */
class QueueManager
{


    /**
     * Instanz des EventDispatchers
     * @var null|object
     */
    public $dispatcher = null;


    /**
     * QueueManager constructor.
     * @param null $dispatcher
     */
    public function __construct($dispatcher = null)
    {
        if ($dispatcher !== null) {
            $this->dispatcher = $dispatcher;
        } else {
            $this->dispatcher = System::getContainer()->get('event_dispatcher');
        }
    }


    /**
     * Speichert ein Event in der Queue für die zeitversetzte Ausführung.
     * @param $saveEvent
     * @param $priority
     */
    public function addToQueue($saveEvent, $priority = 1024)
    {
        $queueEvent = new AddToQueueEvent();
        $queueEvent->setEvent($saveEvent);
        $queueEvent->setPriority($priority);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Startet die Verarbeitung der Events eines Types der Queue.
     * @param $eventname
     * @param $count
     */
    public function run($eventname, $count)
    {
        $queueEvents = $this->loadQueue($eventname, $count);

        if ($queueEvents->numRows) {
            while ($queueEvents->next()) {
                $this->setStartTime($queueEvents->id);
                $this->dispatch($queueEvents);
                $this->setEndTime($queueEvents->id);
            }
        }
        #@todo Event für das Auslesen der Rückgabe implementieren! Muss individuell erstellt werden!!!
        #@todo Es muss mehrere Provider für die Rückgabe geben, z.B. Log, Mail, Konsole, HTML!!!
        #@todo Der aufruf von Außen muss noch erstellt werden!!!
    }


    /**
     * Lädt die angegebene Anzahl an Elementen des übergebenen Events von der Queue.
     * @param $eventname
     * @param $count
     * @return \Database\Result
     */
    public function loadQueue($eventname, $count)
    {
        $queueEvent = new LoadQueueEvent();
        $queueEvent->setKind($eventname);
        $queueEvent->setCount($count);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
        return $queueEvent->getEvents();
    }


    /**
     * Setzt die Startzeit der Verarbeitung für einen Eintrag der Queue.
     * @param $id
     */
    public function setStartTime($id)
    {
        $queueEvent = new QueueSetStartTimeEvent();
        $queueEvent->setId($id);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Setzt die Endzeit der Verarbeitung eines Eintrags in der Queue.
     * @param $id
     */
    public function setEndTime($id)
    {
        $queueEvent = new QueueSetEndTimeEvent();
        $queueEvent->setId($id);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Ruft die Verarbeitung eines Events der Queue auf.
     * @param $queueEvent
     */
    public function dispatch($queueEvent)
    {
        $event = urldecode($queueEvent->data);
        $event = unserialize($event);
        #$this->dispatcher->dispatch($event::NAME, $event);
    }
}
