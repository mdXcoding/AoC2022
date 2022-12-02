<?php

namespace classes;

class FileReader
{
    /**
     * @var string
     */
    public string $path;

    /**
     * @var resource
     */
    public $handle;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->openFile();;
    }

    /**
     * @return void
     */
    public function openFile() : void
    {
        $this->handle = fopen($this->path, 'r');
    }

    /**
     * @return array
     */
    public function getLines() : array
    {
        $rows = [];

        while(!!!feof($this->handle))
        {
            $rows[] = fgets($this->handle);
        }

        return $rows;
    }
}