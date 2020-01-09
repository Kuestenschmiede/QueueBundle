<?php
/*
 * This file is part of con4gis,
 * the gis-kit for Contao CMS.
 *
 * @package    con4gis
 * @version    7
 * @author     con4gis contributors (see "authors.txt")
 * @license    LGPL-3.0-or-later
 * @copyright  Küstenschmiede GmbH Software & Design
 * @link       https://www.con4gis.org
 */
namespace con4gis\QueueBundle\Classes\Listener;

use con4gis\QueueBundle\Classes\Events\QueueSetStartTimeEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class QueueSetStartTimeListener
 * @package con4gis\QueueBundle\Classes\Listener
 */
class QueueSetStartTimeListener
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
     * Erstellt die Abfrage für das Einfügen des Startdatums in die Queue-Tabelle.
     * @param QueueSetStartTimeEvent   $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetStartTimeListenerQuery(
        QueueSetStartTimeEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $table = $event->getQueueTable();
        $field = $event->getField();
        $id = $event->getId();
        $query = "UPDATE $table SET $field = " . time() . " WHERE id = $id";
        $event->setQuery($query);
    }

    /**
     * Führt die Abfrage aus.
     * @param QueueSetStartTimeEvent   $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetStartTimeListenerRun(
        QueueSetStartTimeEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $query = $event->getQuery();
        $this->database->execute($query);
    }
}
