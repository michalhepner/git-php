<?php

namespace MichalHepner\Git\Exception;

use RuntimeException;

class ExpectedDirException extends RuntimeException implements Exception
{
    /**
     * @var string
     */
    protected $fileId;

    /**
     * ExpectedDirException constructor.
     *
     * @param string          $fileId
     * @param \Exception|null $previous
     */
    public function __construct($fileId, \Exception $previous = null)
    {
        $message = sprintf(
            'Expected cached file \'%s\' to be a directory',
            $fileId
        );

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return string
     */
    public function getFileId()
    {
        return $this->fileId;
    }
}
