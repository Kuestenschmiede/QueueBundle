<?php
/**
 * con4gis
 * @version   2.0.0
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class QueueSaveJobResultEvent
 * @package con4gis\QueueBundle\Classes\Events
 */
class QueueSaveJobResultEvent extends Event
{


    /**
     * Name des Events
     */
    const NAME = 'con4gis.queue.savejobresult';


    /**
     * Name der Tabelle in der die Queues gespeichert werden.
     * @var string
     */
    protected $queueTable = 'tl_c4g_queue';


    /**
     * Name des Felds in welches die Startzeit eingtragen werden soll.
     * @var string
     */
    protected $field = 'data';


    /**
     * Name des Events
     * @var int
     */
    protected $id = 0;


    /**
     * @var null
     */
    protected $data = null;


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
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @param null $data
     */
    public function setData($data)
    {
        $this->data = $data;
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
