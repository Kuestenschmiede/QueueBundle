<?php
/**
 * con4gis
 * @version   php 7
 * @package   con4gis
 * @author    con4gis authors (see "authors.txt")
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2018
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\QueueBundle\Classes\Notification;

/**
 * Class NotificationManager
 * @package con4gis\QueueBundle\Classes\Notification
 */
class NotificationManager
{


    /**
     * Gruppe der Mitteiluungen im Auswahlfeld 'Benachrichtigungstyp'
     * @var string
     */
    protected $group = 'con4gis - QueueMessage';


    /**
     * Felder, für die die InsertTags zur Verfügung stehen sollen.
     * @var array
     */
    protected $mailFields = array('email_subject', 'email_text', 'email_html');


    /**
     * InsertTags, die erstellt werden sollen.
     * Diese Ergeben sich dadurch, dass das zu verarbeitende Event von QueueEvent abgeleitet wird.
     * Sie werden in \con4gis\QueueBundle\Classes\Listener\QueueResponseListener::onQueueResponseListenerGenerate()
     * gesetzt.
     * @var array
     */
    protected $tags = array('queueName', 'kind', 'content', 'msgKey', 'msgType');


    /**
     * initializeSystem-Hook: Erstellt die Notification-Types.
     */
    public function registerNotificationTyps()
    {
        if (isset($GLOBALS['con4gis']['queue']['notificationtypes']) &&
            is_array($GLOBALS['con4gis']['queue']['notificationtypes']) &&
            count($GLOBALS['con4gis']['queue']['notificationtypes'])
        ){
            foreach ($GLOBALS['con4gis']['queue']['notificationtypes'] as $nt => $kinds) {
                foreach ($kinds as $key => $kind) {
                    if (is_array($kind)) {
                        // Key ist der Name der Art ($kind) und $kind enthält zusätzliche Tags.
                        $tags = array_merge($this->tags, $kind);
                        $kind = $key;
                    } else {
                        $tags = $this->tags;
                    }

                    $this->setField($nt, $kind, $tags);
                }
            }
        }
    }


    /**
     * Erstellt das Array mit den InsertTags für die Nachrichtentypen.
     * @param $nt
     * @param $kind
     * @param $tags
     */
    protected function setField($nt, $kind, $tags)
    {
        foreach ($this->mailFields as $mailField) {
            $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'][$this->group][$nt . '_' . $kind][$mailField] = $tags;
        }
    }
}
