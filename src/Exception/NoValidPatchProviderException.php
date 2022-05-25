<?php

namespace MichalHepner\Git\Exception;

use RuntimeException;

class NoValidPatchProviderException extends RuntimeException implements Exception
{
    /**
     * @var string
     */
    protected $uri;

    /**
     * NoValidPatchProviderException constructor.
     *
     * @param string          $uri
     * @param \Exception|null $previous
     */
    public function __construct($uri, \Exception $previous = null)
    {
        $message = sprintf(
            'There is not patch provider able to handle uri \'%s\'',
            $uri
        );

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}
