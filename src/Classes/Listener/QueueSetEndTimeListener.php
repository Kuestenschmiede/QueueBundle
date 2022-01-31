<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2022, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
 */
namespace con4gis\QueueBundle\Classes\Listener;

use con4gis\QueueBundle\Classes\Events\QueueSetEndTimeEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class QueueSetEndTimeListener
 * @package con4gis\QueueBundle\Classes\Listener
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
     * Erstellt die Abfrage für das Einfügen des Enddatums in die Queue-Tabelle.
     * @param QueueSetEndTimeEvent     $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetEndTimeListenerQuery(
        QueueSetEndTimeEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $table = $event->getQueueTable();
        $field = $event->getField();
        $id = $event->getId();
        $query = "UPDATE $table SET $field = " . time();

        if ($event->getIntervalToRun()) {
            $query = ' AND intervaltorun = ' . ($event->getIntervalToRun() - 1);
        }

        $query .= " WHERE id = $id";
        $event->setQuery($query);
    }

    /**
     * Führt die Abfrage aus.
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
