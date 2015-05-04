<?php
namespace Kemer\UPnP\MediaServer\ContentDirectory;

interface ElementInterface
{
    public function getId();

    public function getParentId();

    public function getClass();

    public function getTitle();
}
