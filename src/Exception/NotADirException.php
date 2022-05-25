<?php

namespace MichalHepner\Git\Exception;

use SplFileInfo;

class NotADirException extends \RuntimeException implements Exception
{
    /**
     * @var SplFileInfo
     */
    protected $fileInfo;

    /**
     * NotADirException constructor.
     *
     * @param SplFileInfo     $fileInfo
     * @param \Exception|null $previous
     */
    public function __construct(SplFileInfo $fileInfo, \Exception $previous = null)
    {
        $message = sprintf(
            'Provided file %s is expected to be a directory',
            $fileInfo->getPathname()
        );

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return SplFileInfo
     */
    public function getFileInfo()
    {
        return $this->fileInfo;
    }
}
