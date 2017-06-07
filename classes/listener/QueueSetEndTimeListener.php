<?php
/**
 * Eden
 * @version   2.0.0
 * @package   eden
 * @author    eden authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2016 - 2017.
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis_queue\classes\listener;

use con4gis_queue\classes\events\QueueSetEndTimeEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class QueueSetEndTimeListener
 * @package con4gis_queue\classes\listener
 */
class QueueSetEndTimeListener
{


    /**
     * Instanz von \Contao\Database
     * @var \Contao\Database|null
     */
    protected $database = null;


    /**
     * ExportRunListener constructor.
     * @param null $database
     */
    public function __construct($database = null)
    {
        if (($database !== null)) {
            $this->database = $database;
        } else {
            $this->database = Database::getInstance();
        }
    }


    /**
     * Löscht die Tabelle vor dem Einfügen neuer Daten, falls gewünscht.
     * @param QueueSetEndTimeEvent     $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetEndTimeListenerQuery(
        QueueSetEndTimeEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $table          = $event->getQueueTable();
        $field          = $event->getField();
        $id             = $event->getId();
        $query          = "UPDATE $table SET $field = " . time() . " WHERE id = $id";
        $event->setQuery($query);
    }


    /**
     * Löscht die Tabelle vor dem Einfügen neuer Daten, falls gewünscht.
     * @param QueueSetEndTimeEvent     $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetEndTimeListenerRun(
        QueueSetEndTimeEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $query = $event->getQuery();
        $this->database->execute($query);
    }
}
