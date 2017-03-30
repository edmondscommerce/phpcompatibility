<?php

namespace EdmondsCommerce\PhpCompatibility;

class File
{

    /** @var string */
    private $path;

    /** @var array */
    private $errors;


    public function __construct($path, array $errors)
    {
        $this->path = $path;
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function getErrorsAsString()
    {
        $output = [];
        foreach($this->errors as $error)
        {
            $entry = '';
            $entry .= $error['type'].': '.$error['message']."\n";
            $entry .= 'on line '.$error['line'].':'.$error['column']."\n";

            $output[] = $entry;
        }

        return implode("\n", $output );
    }
}