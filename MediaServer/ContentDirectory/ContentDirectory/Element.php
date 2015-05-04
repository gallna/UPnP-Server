<?php
namespace Kemer\UPnP\MediaServer\ContentDirectory;

use SimpleXmlElement;

abstract class Element implements ElementInterface
{
    /**
     * upnp:class
     * @var [type]
     */
    protected $upnpClass;

    protected $id;
    protected $parentId = 0;
    protected $title;
    protected $res;

    public function __construct($d, $upnpClass)
    {
        $this->setId($d);
        $this->setClass($upnpClass);
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setClass($upnpClass)
    {
        $this->upnpClass = $upnpClass;
        return $this;
    }

    public function getClass()
    {
        return $this->upnpClass;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
