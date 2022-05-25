<?php

namespace MichalHepner\Git\Exception;

use RuntimeException;

class FileAlreadyExistsException extends RuntimeException implements Exception
{
    /**
     * @var string
     */
    protected $fileId;

    /**
     * FileAlreadyExistsException constructor.
     *
     * @param string          $fileId
     * @param \Exception|null $previous
     */
    public function __construct($fileId, \Exception $previous = null)
    {
        $message = sprintf('File %s already exists cache storage', $fileId);

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
