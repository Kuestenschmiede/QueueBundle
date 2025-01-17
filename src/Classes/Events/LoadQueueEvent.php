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
namespace con4gis\QueueBundle\Classes\Events;

use Database\Result;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class LoadQueueEvent
 * @package con4gis\QueueBundle\Classes\Events
 */
class LoadQueueEvent extends Event
{
    /**
     * Name des Events
     */
    const NAME = 'con4gis.queue.loadqueue';

    /**
     * Name der Tabelle in der die Queues gespeichert werden.
     * @var string
     */
    protected $queueTable = 'tl_c4g_queue';

    /**
     * Anzahl der zuladenen Datensätze.
     * @var int
     */
    protected $count = 0;

    /**
     * Name des Events
     * @var string
     */
    protected $kind = '';

    /**
     * Query für das Einfügen der Daten in die Queue.
     * @var string
     */
    protected $query = '';

    /**
     * Events, welche von der Queue geleade wurden.
     * @var Result
     */
    protected $events = null;

    /**
     * @return string
     */
    public function getQueueTable(): string
    {
        return $this->queueTable;
    }

    /**
     * @param string $queueTable
     */
    public function setQueueTable(string $queueTable)
    {
        $this->queueTable = $queueTable;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind(string $kind)
    {
        $this->kind = $kind;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
    }

    /**
     * @return Result
     */
    public function getEvents(): Result
    {
        return $this->events;
    }

    /**
     * @param Result $events
     */
    public function setEvents(Result $events)
    {
        $this->events = $events;
    }
}
