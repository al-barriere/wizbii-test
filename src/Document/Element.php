<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class Element
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $version;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $hitType;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $documentLocation;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $documentReferer;

    /**
     * @MongoDB\Field(type="string")
     */
protected $wizbiiCreatorType ;

    /**
     * @MongoDB\Field(type="string")
     */
protected $wizbiiUserId ;

    /**
     * @MongoDB\Field(type="string")
     */
protected $eventCategory ;

    /**
     * @MongoDB\Field(type="string")
     */
protected $eventAction;

    /**
     * @MongoDB\Field(type="string")
     */
protected $eventLabel;

    /**
     * @MongoDB\Field(type="string")
     */
protected $eventValue;

    /**
     * @MongoDB\Field(type="string")
     */
protected $trackingId;

    /**
     * @MongoDB\Field(type="string")
     */
protected $dataSource;

    /**
     * @MongoDB\Field(type="string")
     */
protected $campaignName;

    /**
     * @MongoDB\Field(type="string")
     */
protected $campaignSource;

    /**
     * @MongoDB\Field(type="string")
     */
protected $campaignMedium;

    /**
     * @MongoDB\Field(type="string")
     */
protected $campaignKeyword;

    /**
     * @MongoDB\Field(type="string")
     */
protected $campaignContent;

    /**
     * @MongoDB\Field(type="string")
     */
protected $screenName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getHitType()
    {
        return $this->hitType;
    }

    /**
     * @param mixed $hitType
     */
    public function setHitType($hitType): void
    {
        $this->hitType = $hitType;
    }

    /**
     * @return mixed
     */
    public function getDocumentLocation()
    {
        return $this->documentLocation;
    }

    /**
     * @param mixed $documentLocation
     */
    public function setDocumentLocation($documentLocation): void
    {
        $this->documentLocation = $documentLocation;
    }

    /**
     * @return mixed
     */
    public function getDocumentReferer()
    {
        return $this->documentReferer;
    }

    /**
     * @param mixed $documentReferer
     */
    public function setDocumentReferer($documentReferer): void
    {
        $this->documentReferer = $documentReferer;
    }

    /**
     * @return mixed
     */
    public function getWizbiiCreatorType()
    {
        return $this->wizbiiCreatorType;
    }

    /**
     * @param mixed $wizbiiCreatorType
     */
    public function setWizbiiCreatorType($wizbiiCreatorType): void
    {
        $this->wizbiiCreatorType = $wizbiiCreatorType;
    }

    /**
     * @return mixed
     */
    public function getWizbiiUserId()
    {
        return $this->wizbiiUserId;
    }

    /**
     * @param mixed $wizbiiUserId
     */
    public function setWizbiiUserId($wizbiiUserId): void
    {
        $this->wizbiiUserId = $wizbiiUserId;
    }

    /**
     * @return mixed
     */
    public function getEventCategory()
    {
        return $this->eventCategory;
    }

    /**
     * @param mixed $eventCategory
     */
    public function setEventCategory($eventCategory): void
    {
        $this->eventCategory = $eventCategory;
    }

    /**
     * @return mixed
     */
    public function getEventAction()
    {
        return $this->eventAction;
    }

    /**
     * @param mixed $eventAction
     */
    public function setEventAction($eventAction): void
    {
        $this->eventAction = $eventAction;
    }

    /**
     * @return mixed
     */
    public function getEventLabel()
    {
        return $this->eventLabel;
    }

    /**
     * @param mixed $eventLabel
     */
    public function setEventLabel($eventLabel): void
    {
        $this->eventLabel = $eventLabel;
    }

    /**
     * @return mixed
     */
    public function getEventValue()
    {
        return $this->eventValue;
    }

    /**
     * @param mixed $eventValue
     */
    public function setEventValue($eventValue): void
    {
        $this->eventValue = $eventValue;
    }

    /**
     * @return mixed
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * @param mixed $trackingId
     */
    public function setTrackingId($trackingId): void
    {
        $this->trackingId = $trackingId;
    }

    /**
     * @return mixed
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param mixed $dataSource
     */
    public function setDataSource($dataSource): void
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return mixed
     */
    public function getCampaignName()
    {
        return $this->campaignName;
    }

    /**
     * @param mixed $campaignName
     */
    public function setCampaignName($campaignName): void
    {
        $this->campaignName = $campaignName;
    }

    /**
     * @return mixed
     */
    public function getCampaignSource()
    {
        return $this->campaignSource;
    }

    /**
     * @param mixed $campaignSource
     */
    public function setCampaignSource($campaignSource): void
    {
        $this->campaignSource = $campaignSource;
    }

    /**
     * @return mixed
     */
    public function getCampaignMedium()
    {
        return $this->campaignMedium;
    }

    /**
     * @param mixed $campaignMedium
     */
    public function setCampaignMedium($campaignMedium): void
    {
        $this->campaignMedium = $campaignMedium;
    }

    /**
     * @return mixed
     */
    public function getCampaignKeyword()
    {
        return $this->campaignKeyword;
    }

    /**
     * @param mixed $campaignKeyword
     */
    public function setCampaignKeyword($campaignKeyword): void
    {
        $this->campaignKeyword = $campaignKeyword;
    }

    /**
     * @return mixed
     */
    public function getCampaignContent()
    {
        return $this->campaignContent;
    }

    /**
     * @param mixed $campaignContent
     */
    public function setCampaignContent($campaignContent): void
    {
        $this->campaignContent = $campaignContent;
    }

    /**
     * @return mixed
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * @param mixed $screenName
     */
    public function setScreenName($screenName): void
    {
        $this->screenName = $screenName;
    }

    /**
     * @return mixed
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    /**
     * @param mixed $applicationName
     */
    public function setApplicationName($applicationName): void
    {
        $this->applicationName = $applicationName;
    }

    /**
     * @return mixed
     */
    public function getApplicationVersion()
    {
        return $this->applicationVersion;
    }

    /**
     * @param mixed $applicationVersion
     */
    public function setApplicationVersion($applicationVersion): void
    {
        $this->applicationVersion = $applicationVersion;
    }

    /**
     * @MongoDB\Field(type="string")
     */
protected $applicationName;

    /**
     * @MongoDB\Field(type="string")
     */
protected $applicationVersion;



}