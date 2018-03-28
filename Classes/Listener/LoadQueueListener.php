<?php
/**
 * con4gis - the gis-kit
 *
 * @version   php 7
 * @package   con4gis
 * @author    con4gis contributors (see "authors.txt")
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Listener;

use con4gis\QueueBundle\Classes\Events\LoadQueueEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class LoadQueueListener
 * @package con4gis\QueueBundle\Classes\Listener
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
        $query         .= " AND (intervaltorun != 0 OR intervaltorun = '')";
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
