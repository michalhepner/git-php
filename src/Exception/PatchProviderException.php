<?php

namespace MichalHepner\Git\Exception;

use RuntimeException;

class PatchProviderException extends RuntimeException implements Exception
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $cause;

    /**
     * PatchProviderException constructor.
     *
     * @param string         $url
     * @param string         $cause
     * @param \Exception|null $previous
     */
    public function __construct(
        $url,
        $cause = '',
        \Exception $previous = null
    ) {
        $message = sprintf(
            'Failed to provide patch from url \'%s\', cause: \'%s\'',
            strlen($cause) > 0 ? $cause : 'unknown'
        );

        parent::__construct($message, 0, $previous);
    }
}
