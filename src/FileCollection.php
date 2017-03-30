<?php

namespace EdmondsCommerce\PhpCompatibility;

class FileCollection
{
    /**
     * @var array|File[]
     */
    private $files;

    /**
     * LogCollection constructor.
     * @param array|File[] $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function getFileArray()
    {
        return $this->files;
    }
}