<?php

namespace MichalHepner\Git\Exception;

use RuntimeException;

class FileNotFoundException extends RuntimeException implements Exception
{
    /**
     * @var string
     */
    protected $fileId;

    /**
     * FileNotFoundException constructor.
     *
     * @param string          $fileId
     * @param \Exception|null $previous
     */
    public function __construct($fileId, \Exception $previous = null)
    {
        $message = sprintf('File %s not found in cache storage', $fileId);

        parent::__construct($message, $previous);
    }

    /**
     * @return string
     */
    public function getFileId()
    {
        return $this->fileId;
    }
}
