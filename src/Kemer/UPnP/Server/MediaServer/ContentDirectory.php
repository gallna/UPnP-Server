<?php
namespace Kemer\UPnP\Server\MediaServer;
use SoapVar;
use SoapParam;
use SimpleXmlElement;

use Kemer\MediaLibrary\LibraryInterface;

class ContentDirectory
{
    /**
     * Media library
     *
     * @var LibraryInterface
     */
    protected $library;

    /**
     * ContentDirectory server constructor
     *
     * @param LibraryInterface $library
     */
    public function __construct(LibraryInterface $library)
    {
        $this->library = $library;
    }

    /**
     * {@inheritDoc}
     */
    public function GetSearchCapabilities()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function GetSortCapabilities()
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function GetSystemUpdateID()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function Browse($ObjectID, $BrowseFlag, $Filter, $StartingIndex, $RequestedCount, $SortCriteria)
    {
        $result = $this->library->get("$ObjectID")->asXML();
        $xml = new \DOMDocument( "1.0");
        $xml->loadXML($result->asXML());
        $result = $xml->saveHTML();
        $xml = new \DOMDocument( "1.0");
        $xml->appendChild($xml->createElement("Result", $result));
        $xml->appendChild($xml->createElement("NumberReturned", count($result)));
        $xml->appendChild($xml->createElement("TotalMatches", count($result)));
        $xml->appendChild($xml->createElement("UpdateID", 1));

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
