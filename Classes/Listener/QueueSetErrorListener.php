<?php
/**
 * con4gis - the gis-kit
 *
 * @version   php 5
 * @package   con4gis
 * @author    con4gis contributors (see "authors.txt")
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Listener;

use con4gis\QueueBundle\Classes\Events\QueueSetErrorEvent;
use Contao\Database;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class QueueSetErrorListener
 * @package con4gis\QueueBundle\Classes\Listener
 */
class QueueSetErrorListener
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
     * @param QueueSetErrorEvent       $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetErrorListenerQuery(
        QueueSetErrorEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $table          = $event->getQueueTable();
        $field          = $event->getField();
        $id             = $event->getId();
        $query          = "UPDATE $table SET $field = 1 WHERE id = $id";
        $event->setQuery($query);
    }


    /**
     * Führt die Abfrage aus.
     * @param QueueSetErrorEvent       $event
     * @param                          $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function onSetErrorListenerRun(
        QueueSetErrorEvent $event,
        $eventName,
        EventDispatcherInterface $dispatcher
    ) {
        $query = $event->getQuery();
        $this->database->execute($query);
    }
}
