<?php
namespace Kemer\UPnP\Server;

use Kemer\UPnP\Eventing;
use Kemer\UPnP\Description\Service;
use Kemer\UPnP\Description\Device\ServiceList\Service as ServiceDescription;
use Kemer\UPnP\Server\MediaServer\ContentDirectory;
use Kemer\UPnP\Server\MediaServer\ConnectionManager;
use Kemer\UPnP\Server\MediaServer\AVTransport;
use Zend\Soap\Server as SoapServer;
class MediaServer extends AbstractDevice
{
    protected $contentDirectory;
    protected $connectionManager;
    protected $avTransport;

    public function getContentDirectory()
    {
        return $this->contentDirectory;
    }

    public function setContentDirectory(ContentDirectory $contentDirectory, \SoapServer $server = null)
    {
        $this->contentDirectory = $contentDirectory;
        if (!$server) {
            $server = $this->createServer(
                $this->getDescription()->getServiceList()->get(Service::CONTENT_DIRECTORY)
            );
        }
        $server->setObject($contentDirectory);
        $this->addService(Service::CONTENT_DIRECTORY, $server);
        $factory = new Eventing\RequestFactory();
        $eventing = new Eventing\Eventing();
        $eventingDecorator = new Eventing\EventingDecorator($factory, $eventing);
        $this->addEventing(Service::CONTENT_DIRECTORY, $eventingDecorator);
        return $this;
    }

    public function setConnectionManager(ConnectionManager $connectionManager, \SoapServer $server = null)
    {
        $this->connectionManager = $connectionManager;
        if (!$server) {
            $server = $this->createServer(
                $this->getDescription()->getServiceList()->get(Service::CONNECTION_MANAGER)
            );
        }
        $server->setObject($connectionManager);
        $this->addService(Service::CONNECTION_MANAGER, $server);
        return $this;
    }

    public function setAvTransport(AVTransport $avTransport, \SoapServer $server = null)
    {
        $this->avTransport = $avTransport;
        if (!$server) {
            $server = $this->createServer(
                $this->getDescription()->getServiceList()->get(Service::AV_TRANSPORT)
            );
        }
        $server->setObject($avTransport);
        $this->addService(Service::AV_TRANSPORT, $server);
        return $this;
    }

    public function createServer(ServiceDescription $service)
    {
        $uri = clone($this->getDescription()->getLocation());
        $url = $uri->setPath($service->getControlURL());
        return new \SoapServer(null,
            [
                'uri' => "urn:schemas-upnp-org:service:ContentDirectory:1",
                'location' => (string)$url,
                'soap_version' => SOAP_1_2,
                'trace' => true
            ]
        );
    }
}
