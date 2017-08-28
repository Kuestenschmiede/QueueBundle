<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2017
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Queue;

use con4gis\QueueBundle\Classes\Events\AddToQueueEvent;
use con4gis\QueueBundle\Classes\Events\LoadQueueEvent;
use con4gis\QueueBundle\Classes\Events\QueueEvent;
use con4gis\QueueBundle\Classes\Events\QueueResponseEvent;
use con4gis\QueueBundle\Classes\Events\QueueSaveJobResultEvent;
use con4gis\QueueBundle\Classes\Events\QueueSetEndTimeEvent;
use con4gis\QueueBundle\Classes\Events\QueueSetErrorEvent;
use con4gis\QueueBundle\Classes\Events\QueueSetStartTimeEvent;
use Contao\System;

/**
 * Class QueueManager
 * @package con4gis\QueueBundle\Classes\Queue
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
     * @param QueueEvent $saveEvent
     * @param int        $priority
     */
    public function addToQueue(QueueEvent $saveEvent, $priority = 1024)
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
                $jobEvent = $this->dispatch($queueEvents);
                $this->setEndTime($queueEvents->id);
                $this->saveJobResult($queueEvents->id, $jobEvent);
            }
        } else {
            $this->response($eventname, 'noActiveJobs', 'INFO');
        }
    }


    /**
     * Lädt die angegebene Anzahl an Elementen des übergebenen Events von der Queue.
     * @param $eventname
     * @param $count
     * @return \Database\Result
     */
    protected function loadQueue($eventname, $count)
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
    protected function setStartTime($id)
    {
        $queueEvent = new QueueSetStartTimeEvent();
        $queueEvent->setId($id);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Setzt die Endzeit der Verarbeitung eines Eintrags in der Queue.
     * @param $id
     */
    protected function setEndTime($id)
    {
        $queueEvent = new QueueSetEndTimeEvent();
        $queueEvent->setId($id);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Setzt die Endzeit der Verarbeitung eines Eintrags in der Queue.
     * @param $id
     */
    protected function setError($id)
    {
        $queueEvent = new QueueSetErrorEvent();
        $queueEvent->setId($id);
        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Speichernt das verarbeitete Event in der Queue, damit die Fehlermeldungen erhalten bleiben.
     * @param $id
     * @param $jobEvent
     */
    protected function saveJobResult($id, $jobEvent)
    {
        $queueEvent = new QueueSaveJobResultEvent();
        $queueEvent->setId($id);
        $queueEvent->setData($jobEvent);

        $this->dispatcher->dispatch($queueEvent::NAME, $queueEvent);
    }


    /**
     * Ruft die Verarbeitung eines Events der Queue auf.
     * @param $queueEvent
     * @return array
     */
    protected function dispatch($queueEvent)
    {
        $event = urldecode($queueEvent->data);
        $event = unserialize($event);

        if ($event) {
            $this->dispatcher->dispatch($event::NAME, $event);
            if ($event->getHasError()) {
                $this->setError($queueEvent->id);
                $this->response($event::NAME, $event->getError(), 'ERROR', $event->getParam());
            } else {
                $this->response($event::NAME, $event->getReturnMessages(), 'NOTICE', $event->getParam());
            }

            return $event;
        }
    }


    /**
     * Ruft das Event für die Rückgabe auf.
     * @param        $eventname
     * @param        $content
     * @param string $kind
     * @param array  $param
     */
    protected function response($eventname, $content, $kind = 'INFO', $param = array())
    {
        $event = new QueueResponseEvent();
        $event->setQueueName($eventname);
        $event->setContent($content);
        $event->setKind($kind);
        $event->setParam($param);
        $this->dispatcher->dispatch($event::NAME, $event);
    }
}
