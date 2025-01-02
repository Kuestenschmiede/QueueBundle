<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 10
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2025, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
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
        $kind = $event->getKind();
        $table = $event->getQueueTable();
        $count = $event->getCount();
        $query = "SELECT * FROM $table WHERE ";
        $query .= " kind = '$kind'";
        $query .= ' AND endworking = 0';
        $query .= ' AND startworking = 0';
        $query .= " AND (intervaltorun != 0 OR intervaltorun = '')";
        $query .= ' ORDER BY priority, id';
        $query .= " LIMIT 0,$count";
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
        $query = $event->getQuery();
        $result = $this->database->execute($query);
        $event->setEvents($result);
    }
}
