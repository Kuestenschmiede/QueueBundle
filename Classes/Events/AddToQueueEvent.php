<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2017
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
     * Moduel des Quelldatensatzes, falls vorhanden.
     * Wird benötigt, um es in der Liste der Queue im BE anzuzeigen.
     * @var string
     */
    protected $srcmodule = '';


    /**
     * Tabelle des Quelldatensatzes, falls vorhanden.
     * Wird benötigt, um beim erneuten Speichern den Queuejob zu aktualisieren.
     * @var string
     */
    protected $srctable = '';


    /**
     * Id des Quelldatensatzes, falls vorhanden.
     * Wird benötigt, um beim erneuten Speichern den Queuejob zu aktualisieren.
     * @var int
     */
    protected $srcid = 0;


    /**
     * Schon vorhandener Datensatz, falls vorhanden.
     * Wird benötigt, um beim erneuten Speichern den Queuejob zu aktualisieren.
     * @var null
     */
    protected $oldData = null;


    /**
     * Intervall in dem der Job ausgeführt werden soll.
     * @var string
     */
    protected $intervalkind = '';


    /**
     * Anzahl der maximalen Ausführungen
     * 0 = unendlich
     * @var int
     */
    protected $intervalcount = 1;


    /**
     * Anzhal der noch offen Aufrufe des Jobs bis die maximale Ausführung erreicht ist.
     * @var int
     */
    protected $intervaltorun = 1;


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
    public function getSrcmodule(): string
    {
        return $this->srcmodule;
    }


    /**
     * @param string $srcmodule
     */
    public function setSrcmodule(string $srcmodule)
    {
        $this->srcmodule = $srcmodule;
    }


    /**
     * @return string
     */
    public function getSrctable(): string
    {
        return $this->srctable;
    }


    /**
     * @param string $srctable
     */
    public function setSrctable(string $srctable)
    {
        $this->srctable = $srctable;
    }


    /**
     * @return int
     */
    public function getSrcid(): int
    {
        return $this->srcid;
    }


    /**
     * @param int $srcid
     */
    public function setSrcid(int $srcid)
    {
        $this->srcid = $srcid;
    }


    /**
     * @return null
     */
    public function getOldData()
    {
        return $this->oldData;
    }


    /**
     * @param null $oldData
     */
    public function setOldData($oldData)
    {
        $this->oldData = $oldData;
    }


    /**
     * @return string
     */
    public function getIntervalkind(): string
    {
        return $this->intervalkind;
    }


    /**
     * @param string $intervalkind
     */
    public function setIntervalkind(string $intervalkind)
    {
        $this->intervalkind = $intervalkind;
    }


    /**
     * @return int
     */
    public function getIntervalcount(): int
    {
        return $this->intervalcount;
    }


    /**
     * @param int $intervalcount
     */
    public function setIntervalcount(int $intervalcount)
    {
        $this->intervalcount = $intervalcount;
    }


    /**
     * @return int
     */
    public function getIntervaltorun(): int
    {
        return $this->intervaltorun;
    }


    /**
     * @param int $intervaltorun
     */
    public function setIntervaltorun(int $intervaltorun)
    {
        $this->intervaltorun = $intervaltorun;
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
