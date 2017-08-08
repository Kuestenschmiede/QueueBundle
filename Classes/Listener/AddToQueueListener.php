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

use con4gis\QueueBundle\Classes\Events\AddToQueueEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class AddToQueueListener
 * @package con4gis\QueueBundle\Classes\Listener
 */
class AddToQueueListener
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
     * @param AddToQueueEvent          $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onAddToQueueListenerQuery(AddToQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $eventToSave    = $event->getEvent();
        $eventToSave    = serialize($eventToSave);
        $eventToSave    = urlencode($eventToSave);  // Ohne urlencode speichert Contao das serialisierte Event nicht!
        $priotity       = $event->getPriority();
        $kind           = $event->getKind();
        $table          = $event->getQueueTable();
        $query          = "INSERT INTO $table SET tstamp = " . time();
        $query         .= ", kind = '$kind'";
        $query         .= ", priority = $priotity";
        $query         .= ", data = '$eventToSave'";
        $event->setQuery($query);
    }


    /**
     * Löscht die Tabelle vor dem Einfügen neuer Daten, falls gewünscht.
     * @param AddToQueueEvent          $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onAddToQueueListenerRun(AddToQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $query = $event->getQuery();
        $this->database->execute($query);
    }
}
