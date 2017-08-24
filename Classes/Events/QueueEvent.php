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
 * Class QueueEvent
 * @package con4gis\QueueBundle\Classes\Events
 */
abstract class QueueEvent extends Event
{


    /**
     * Array mit den Errormeldungen.
     * @var array
     */
    protected $error = array();


    /**
     * Falg zeigt an, ob Fehler während der Verarbeitung aufgetreten sind.
     * @var bool
     */
    protected $hasError = false;


    /**
     * Rückmeldung des Verarbeitungsprozesses (keine Fehler).
     * @var array
     */
    protected $returnMessages = array();


    /**
     * Array mit zusätzlichen Informationen. Diese können für die Rückgabe als InsertTags für das
     * NotificationCenter benutzt werden.
     * @var array
     */
    protected $param = array();


    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }


    /**
     * @param array $error
     */
    public function setError(array $error)
    {
        $this->error = $error;
    }


    /**
     * @return bool
     */
    public function getHasError(): bool
    {
        return $this->hasError;
    }


    /**
     * @param bool $hasError
     */
    public function setHasError(bool $hasError)
    {
        $this->hasError = $hasError;
    }


    /**
     * @return array
     */
    public function getReturnMessages(): array
    {
        return $this->returnMessages;
    }


    /**
     * @param array $returnMessages
     */
    public function setReturnMessages(array $returnMessages)
    {
        $this->returnMessages = $returnMessages;
    }


    /**
     * @param array $returnMessage
     */
    public function addReturnMessage(array $returnMessage)
    {
        $this->returnMessages = array_merge($this->returnMessages,$returnMessage);
    }


    /**
     * @return array
     */
    public function getParam(): array
    {
        return $this->param;
    }


    /**
     * @param array $param
     */
    public function setParam(array $param)
    {
        $this->param = $param;
    }
}
