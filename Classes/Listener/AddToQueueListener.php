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
    public function onAddToQueueListenerLoadOldData(AddToQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $table          = $event->getQueueTable();
        $srctable       = $event->getSrctable();
        $srcid          = $event->getSrcid();
        $query          = "INSERT INTO $table SET ";

        if ($srctable && $srcid) {
            $loadQuery  = "SELECT * FROM $table WHERE srctable = '$srctable' AND srcid = $srcid";
            $loadQuery .= " AND startworking = 0 AND endworking = 0";
            $loadResult = $this->database->execute($loadQuery);

            if ($loadResult->numRows) {
                $event->setOldData($loadResult);
            }
        }

        $event->setQuery($query);
    }


    /**
     * Löscht die Tabelle vor dem Einfügen neuer Daten, falls gewünscht.
     * @param AddToQueueEvent          $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onAddToQueueListenerQueryKind(AddToQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $table          = $event->getQueueTable();
        $oldData        = $event->getOldData();

        if ($oldData) {
            $event->setQuery("UPDATE $table SET ");
        } else {
            $event->setQuery("INSERT INTO $table SET ");
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
        $query          = $event->getQuery();
        $eventToSave    = $event->getEvent();
        $eventToSave    = serialize($eventToSave);
        $eventToSave    = urlencode($eventToSave);  // Ohne urlencode speichert Contao das serialisierte Event nicht!
        $kind           = $event->getKind();
        $priotity       = $event->getPriority();
        $srcmodule      = $event->getSrcmodule();
        $srctable       = $event->getSrctable();
        $srcid          = $event->getSrcid();
        $interval       = $event->getIntervalkind();
        $query         .= "tstamp = " . time();
        $query         .= ", kind = '$kind'";
        $query         .= ", priority = $priotity";
        $query         .= ", data = '$eventToSave'";
        $query         .= ", srcmodule = '$srcmodule'";
        $query         .= ", srcid = $srcid";
        $query         .= ", srctable = '$srctable'";
        $query         .= ", intervalkind = '$interval'";
        $event->setQuery($query);
    }


    /**
     * Löscht die Tabelle vor dem Einfügen neuer Daten, falls gewünscht.
     * @param AddToQueueEvent          $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onAddToQueueListenerQueryWhere(AddToQueueEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $oldData        = $event->getOldData();
        $query          = $event->getQuery();
        $srctable       = $event->getSrctable();
        $srcid          = $event->getSrcid();

        if ($oldData) {
            $query .= " WHERE srctable = '$srctable' AND srcid = $srcid AND startworking = 0 AND endworking = 0";
            $event->setQuery($query);
        }
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
