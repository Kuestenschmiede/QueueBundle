<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2021, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
 */
namespace con4gis\QueueBundle\Classes\Listener;

use con4gis\QueueBundle\Classes\Events\QueueSaveJobResultEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class QueueSaveJobResultListener
 * @package con4gis\QueueBundle\Classes\Listener
 */
class QueueSaveJobResultListener
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
     * Erstellt die Abfrage für das Einfügen eines Fehlers in die Queue-Tabelle.
     * @param QueueSaveJobResultEvent  $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSaveJobResultQuery(
        QueueSaveJobResultEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $table = $event->getQueueTable();
        $field = $event->getField();
        $data = urlencode(serialize($event->getData()));
        $id = $event->getId();
        $query = "UPDATE $table SET $field = '$data' WHERE id = $id";
        $event->setQuery($query);
    }

    /**
     * Führt die Abfrage aus.
     * @param QueueSaveJobResultEvent  $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSaveJobResultRun(
        QueueSaveJobResultEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $query = $event->getQuery();
        $this->database->execute($query);
    }
}
