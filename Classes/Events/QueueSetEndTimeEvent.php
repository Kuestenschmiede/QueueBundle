<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class QueueSetEndTimeEvent
 * @package con4gis\QueueBundle\Classes\Events
 */
class QueueSetEndTimeEvent extends Event
{


    /**
     * Name des Events
     */
    const NAME = 'con4gis.queue.setendtime';


    /**
     * Name der Tabelle in der die Queues gespeichert werden.
     * @var string
     */
    protected $queueTable = 'tl_c4g_queue';


    /**
     * Name des Felds in welches die Startzeit eingtragen werden soll.
     * @var string
     */
    protected $field = 'endworking';


    /**
     * Feld in dem die noch auszuführenden Durchläufe gespeichert werden.
     * @var string
     */
    protected $intervalField = 'intervaltorun';


    /**
     * Noch auszuführenden Durchläufe.
     * @var int
     */
    protected $intervalToRun = 0;


    /**
     * Name des Events
     * @var int
     */
    protected $id = 0;


    /**
     * Query für das Eintragen der Endzeit.
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
    public function getField(): string
    {
        return $this->field;
    }


    /**
     * @param string $field
     */
    public function setField(string $field)
    {
        $this->field = $field;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getIntervalField(): string
    {
        return $this->intervalField;
    }


    /**
     * @param string $intervalField
     */
    public function setIntervalField(string $intervalField)
    {
        $this->intervalField = $intervalField;
    }


    /**
     * @return int
     */
    public function getIntervalToRun(): int
    {
        return $this->intervalToRun;
    }


    /**
     * @param int $intervalToRun
     */
    public function setIntervalToRun(int $intervalToRun)
    {
        $this->intervalToRun = $intervalToRun;
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
