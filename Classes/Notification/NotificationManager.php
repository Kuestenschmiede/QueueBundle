<?php
/**
 * @package     eden
 * @filesource  NotificationManager.php
 * @version     1.0.0
 * @since       15.08.17 - 14:24
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2017
 * @license     EULA
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
                foreach ($kinds as $kind) {
                    $this->setField($nt . '_' . $kind);
                }

            }
        }
    }


    /**
     * Erstellt das Array mit den InsertTags für die Nachrichtentypen.
     * @param $messageType
     */
    protected function setField($messageType)
    {
        foreach ($this->mailFields as $mailField) {
            $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'][$this->group][$messageType][$mailField] = $this->tags;
        }
    }
}
