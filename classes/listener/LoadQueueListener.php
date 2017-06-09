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

use con4gis_queue\classes\events\LoadQueueEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class LoadQueueListener
 * @package con4gis_queue\classes\listener
 */
class LoadQueueListener
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
     * @param LoadQueueEvent            $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onLoadQueueListenerQuery(LoadQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $kind           = $event->getKind();
        $table          = $event->getQueueTable();
        $count          = $event->getCount();
        $query          = "SELECT * FROM $table WHERE ";
        $query         .= " kind = '$kind'";
        $query         .= " AND endworking = 0";
        $query         .= " AND startworking = 0";
        $query         .= " ORDER BY priority, id";
        $query         .= " LIMIT 0,$count";
        $event->setQuery($query);
    }


    /**
     * Löscht die Tabelle vor dem Einfügen neuer Daten, falls gewünscht.
     * @param LoadQueueEvent            $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onLoadQueueListenerRun(LoadQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $query  = $event->getQuery();
        $result = $this->database->execute($query);
        $event->setEvents($result);
    }
}
