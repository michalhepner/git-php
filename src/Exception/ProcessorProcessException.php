<?php

namespace MichalHepner\Git\Exception;

use MichalHepner\Git\Comparator\Processor\ProcessorInterface;
use MichalHepner\Git\WorkingCopy;
use RuntimeException;

class ProcessorProcessException extends RuntimeException implements Exception
{
    /**
     * @var ProcessorInterface
     */
    protected $processor;

    /**
     * @var WorkingCopy
     */
    protected $workingCopy;

    /**
     * ProcessorProcessException constructor.
     *
     * @param ProcessorInterface  $processor
     * @param WorkingCopy         $workingCopy
     * @param \Exception|null     $previous
     */
    public function __construct(
        ProcessorInterface $processor,
        WorkingCopy $workingCopy,
        \Exception $previous = null
    ) {
        $message = sprintf(
            'Processor of class \'%s\' failed to process working copy.',
            get_class($processor)
        );

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return ProcessorInterface
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * @return WorkingCopy
     */
    public function getWorkingCopy()
    {
        return $this->workingCopy;
    }
}
