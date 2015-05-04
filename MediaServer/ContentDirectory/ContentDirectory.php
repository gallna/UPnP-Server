<?php
namespace Kemer\UPnP\Server;
use SoapVar;
use SoapParam;
use SimpleXmlElement;

use Kemer\UPnP\ContentInterface;

class ContentDirectory
{

    protected $content;

    public function __construct(ContentInterface $content)
    {
        $this->content = $content;
    }

    public function GetSearchCapabilities()
    {

    }

    public function GetSortCapabilities()
    {
        return '';
    }

    public function GetSystemUpdateID()
    {

    }

    public function Browse($objectID = '0', $browseflag = 'BrowseDirectChildren', $startingIndex = 0, $requestedCount = 0, $key = 1)
    {
        $result = $this->content->get($objectID);
        $xml = new \DOMDocument( "1.0");
        $xml->appendChild($xml->createElement("Result", $result->asXML()));
        $xml->appendChild($xml->createElement("NumberReturned", count($this->content)));
        $xml->appendChild($xml->createElement("TotalMatches", count($this->content)));
        $xml->appendChild($xml->createElement("UpdateID", rand(1,100)));
        //$xml->formatOutput = true;
        return new \SoapVar($xml->saveHTML(), XSD_ANYXML);
    }

    public function Search()
    {

    }

    public function CreateObject()
    {

    }

    public function DestroyObject()
    {

    }

    public function UpdateObject()
    {

    }

    public function ImportResource()
    {

    }

    public function ExportResource()
    {

    }

    public function StopTransferResource()
    {

    }

    public function GetTransferProgress()
    {

    }

    public function DeleteResource()
    {

    }

    public function CreateReference()
    {

    }

}
