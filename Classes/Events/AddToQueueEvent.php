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

use Symfony\Component\EventDispatcher\Event;

/**
 * Class AddToQueueEvent
 * @package con4gis\QueueBundle\Classes\Events
 */
class AddToQueueEvent extends Event
{


    /**
     * Name des Events
     */
    const NAME = 'con4gis.queue.addtoqueue';


    /**
     * Name der Tabelle in der die Queues gespeichert werden.
     * @var string
     */
    protected $queueTable = 'tl_c4g_queue';


    /**
     * Name des Events
     * @var string
     */
    protected $kind = '';


    /**
     * Priorität des Events.
     * @var int
     */
    protected $priority = 1024;


    /**
     * Event, welches auf in die Queue eingefügt werden soll.
     * @var Event
     */
    protected $event = null;


    /**
     * Query für das Einfügen der Daten in die Queue.
     * @var string
     */
    protected $query = '';


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
    public function getPriority(): int
    {
        return $this->priority;
    }


    /**
     * @param int $priority
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;
    }


    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }


    /**
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
        $this->setKind($event::NAME);
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
}
