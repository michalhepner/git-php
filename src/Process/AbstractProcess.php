<?php

namespace MichalHepner\Git\Process;

use MichalHepner\Git\Exception\ProcessException;
use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessFactoryInterface;
use Symfony\Component\Process\Process;

abstract class AbstractProcess
{
    /**
     * @var ProcessFactoryInterface
     */
    protected $processFactory;

    /**
     * AbstractProcess constructor.
     *
     * @param ProcessFactoryInterface $processFactory
     */
    public function __construct(ProcessFactoryInterface $processFactory)
    {
        $this->processFactory = $processFactory;
    }

    /**
     * @param string $cmd
     *
     * @return string
     *
     * @throws ProcessException
     */
    protected function runProcess(string $cmd)
    {
        $process = $this->processFactory->createFromString($cmd);
        $process->run();

        if ($process->isSuccessful()) {
            return $process->getOutput();
        }

        throw new ProcessException($process);
    }
}
