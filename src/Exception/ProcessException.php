<?php

namespace MichalHepner\Git\Exception;

use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessInterface;
use RuntimeException;

class ProcessException extends RuntimeException implements Exception
{
    /**
     * @var ProcessInterface
     */
    protected $process;

    /**
     * ProcessException constructor.
     *
     * @param ProcessInterface  $process
     * @param \Exception|null   $previous
     */
    public function __construct(
        ProcessInterface $process,
        \Exception $previous = null
    ) {
        $message = sprintf(
            'Process \'%s\' exited with non-zero code \'%d\'. Output: \'%s\'. Error output: \'%s\'.',
            $process->getCommandLine(),
            $process->getExitCode(),
            $process->getOutput(),
            $process->getErrorOutput()
        );

        parent::__construct($message, 0, $previous);
    }
}
