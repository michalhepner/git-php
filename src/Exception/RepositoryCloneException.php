<?php

namespace MichalHepner\Git\Exception;

use RuntimeException;
use SplFileInfo;

class RepositoryCloneException extends RuntimeException implements Exception
{
    /**
     * @var string
     */
    protected $repositoryUri;

    /**
     * @var SplFileInfo
     */
    protected $targetDir;

    /**
     * RepositoryCloneException constructor.
     *
     * @param string          $repositoryUri
     * @param SplFileInfo     $targetDir
     * @param \Exception|null $previous
     */
    public function __construct(
        $repositoryUri,
        SplFileInfo $targetDir,
        \Exception $previous = null
    ) {
        $message = sprintf(
            'Failed to clone repository \'%s\' to \'%s\'',
            $repositoryUri,
            $targetDir->getPathname()
        );

        $previous && $message .= 'Reason: '.$previous->getMessage();

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return string
     */
    public function getRepositoryUri()
    {
        return $this->repositoryUri;
    }

    /**
     * @return SplFileInfo
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
