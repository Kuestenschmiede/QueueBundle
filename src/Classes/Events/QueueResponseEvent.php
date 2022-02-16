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
 * Class QueueResponseEvent
 * @package con4gis\QueueBundle\Classes\Events
 */
class QueueResponseEvent extends Event
{
    /**
     * Name des Events
     */
    const NAME = 'con4gis.queue.response';

    /**
     * gültige Level für $this->kind
     */
    const LEVEL = ['DEBUG', 'INFO', 'NOTICE', 'WARNING', 'ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY'];

    /**
     * Name der Queue (bzw. des Verarbeiteten Events)
     * @var string
     */
    protected $queueName = '';

    /**
     * Art der Nachricht, vergleichbar mit Debuglevel (DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY)
     * @see https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels
     * @var string
     */
    protected $kind = 'INFO';

    /**
     * Inhalt der Nachricht
     * @var string
     */
    protected $content = '';

    /**
     * optional: Parameter für die Nachricht.
     * @var array
     */
    protected $param = [];

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName(string $queueName)
    {
        $this->queueName = $queueName;
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
     * @throws \Exception
     */
    public function setKind(string $kind)
    {
        $kind = strtoupper($kind);

        if (in_array($kind, self::LEVEL)) {
            $this->kind = $kind;
        } else {
            throw new \Exception("LEVEL NOT ALLOWED [$kind]!");
        }
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        if (is_array($content)) {
            $content = implode("\n", $content);
        }

        $this->content = $content;
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
