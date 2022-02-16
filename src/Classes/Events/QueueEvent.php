<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2022, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
 */
namespace con4gis\QueueBundle\Classes\Events;

use Symfony\Contracts\EventDispatcher\Event;

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
    protected $error = [];

    /**
     * Falg zeigt an, ob Fehler während der Verarbeitung aufgetreten sind.
     * @var bool
     */
    protected $hasError = false;

    /**
     * Rückmeldung des Verarbeitungsprozesses (keine Fehler).
     * @var array
     */
    protected $returnMessages = [];

    /**
     * Array mit zusätzlichen Informationen. Diese können für die Rückgabe als InsertTags für das
     * NotificationCenter benutzt werden.
     * @var array
     */
    protected $param = [];

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
     * @param mixed $error
     */
    public function addError($error)
    {
        $error = (is_array($error)) ? $error : [$error];
        $this->error = array_merge($this->error, $error);
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
     * @param mixed $returnMessage
     */
    public function addReturnMessage($returnMessage)
    {
        $returnMessage = (is_array($returnMessage)) ? $returnMessage : [$returnMessage];
        $this->returnMessages = array_merge($this->returnMessages, $returnMessage);
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
