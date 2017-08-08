<?php
/**
 * con4gis
 * @version   2.0.0
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2016 - 2017.
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Events;

use Database\Result;
use Symfony\Component\EventDispatcher\Event;

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
