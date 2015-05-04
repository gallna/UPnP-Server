<?php
namespace Kemer\UPnP\MediaServer\ContentDirectory;

use SimpleXmlElement;

class Item extends Element
{
    const VIDEO_ITEM = "object.item.videoItem";

    protected $gene;
    protected $res = [];

    public function addRes($res)
    {
        $this->res[] = $res;
        return $this;
    }

    public function getRes()
    {
        return $this->res;
    }

    public function setGene($gene)
    {
        $this->gene = $gene;
        return $this;
    }

    public function getGene()
    {
        return $this->gene;
    }

    public function asXML(SimpleXmlElement $root)
    {
        $container = $root->addChild('item');
        $container->addAttribute('restricted', '1');
        $container->addAttribute('id', $this->getId());
        $container->addAttribute('parentID', $this->getParentId());
        $container->addChild('title', $this->getTitle(), 'http://purl.org/dc/elements/1.1/');
        $container->addChild('class', $this->getClass(), 'urn:schemas-upnp-org:metadata-1-0/upnp/');
        foreach ($this->getRes() as $resource) {
            $res = $container->addChild('res', $resource);
            $res->addAttribute('protocolInfo', 'http-get:*:video/mp4:DLNA.ORG_OP=01;DLNA.ORG_CI=0;DLNA.ORG_FLAGS=01500000000000000000000000000000');
            $res->addAttribute('size', '716473052');
            $res->addAttribute('duration', '00:57:48');
        }
        return $container;
    }
}
