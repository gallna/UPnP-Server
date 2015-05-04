<?php
namespace Kemer\UPnP\MediaServer\ContentDirectory;

use SimpleXmlElement;

class Container extends Element implements \RecursiveIterator
{
    protected $elements = [];

    public function __construct($id)
    {
        parent::__construct($id, "object.container");
    }

    public function add(ElementInterface $element)
    {
        $element->setParentId($this->getId());
        $this->elements[] = $element;
    }

    public function asXML(SimpleXmlElement $root = null)
    {
        if (!$root instanceof SimpleXmlElement) {
            $root = new SimpleXmlElement('<DIDL-Lite xmlns="urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dlna="urn:schemas-dlna-org:metadata-1-0/" xmlns:upnp="urn:schemas-upnp-org:metadata-1-0/upnp/"></DIDL-Lite>');
            foreach ($this->elements as $element) {
                $element->asXML($root);
            }
            return $root->asXML();
        } else {
            $container = $root->addChild('container');
            $container->addAttribute('restricted', '1');
            $container->addAttribute('id', $this->getId());
            $container->addAttribute('parentID', $this->getParentId());
            $container->addChild('title', $this->getTitle(), 'http://purl.org/dc/elements/1.1/');
            $container->addChild('class', $this->getClass(), 'urn:schemas-upnp-org:metadata-1-0/upnp/');
            return $container;
        }
    }

    public function rewind()
    {
        reset($this->elements);
    }

    public function current()
    {
        return current($this->elements);
    }

    public function key()
    {
        return key($this->elements);
    }

    public function next()
    {
        next($this->elements);
    }

    public function valid()
    {
        return $this->key() !== null;
    }

    public function hasChildren()
    {
        return $this->current() instanceof Container;
    }

    public function getChildren()
    {
        return $this->current();
    }

}
