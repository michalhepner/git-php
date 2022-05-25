<?php
declare(strict_types = 1);

namespace MichalHepner\Git\Command;

use LogicException;
use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessFactoryInterface;
use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessInterface;

abstract class AbstractCommand implements Command
{
    protected ProcessFactoryInterface $processFactory;
    protected string $cwd;
    protected array $args = [];
    protected array $options = [];
    protected array $env = [];
    protected string $gitBinary = 'git';
    protected int $timeout = 600;
    protected ProcessInterface|null $process = null;

    public function __construct(
        ProcessFactoryInterface $processFactory,
        string $cwd,
        null|string|array $args = null,
        array $options = [],
        array $env = []
    ) {
        $this->processFactory = $processFactory;
        $this->cwd = $cwd;
        $this->args = $args === null ? [] : (is_string($args) ? [$args] : $args);
        $this->options = $options;
        $this->env = $env;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getCwd(): string
    {
        return $this->cwd;
    }

    public function setCwd(string $cwd): void
    {
        if ($this->process) {
            throw new LogicException(sprintf('Cannot run %s, command already initialized', __METHOD__));
        }

        $this->cwd = $cwd;
    }

    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    public function setTimeout(?int $timeout): void
    {
        if ($this->process) {
            throw new LogicException(sprintf('Cannot run %s, command already initialized', __METHOD__));
        }

        $this->timeout = $timeout;
    }

    public function getEnv(): array
    {
        return $this->env;
    }

    public function setEnv(array $env): void
    {
        if ($this->process) {
            throw new LogicException(sprintf('Cannot run %s, command already initialized', __METHOD__));
        }

        $this->env = $env;
    }

    public function execute(): int
    {
        $this->ensureProcessInitialized();

        return $this->process->run();
    }

    public function getExitCode(): int
    {
        $this->ensureProcessInitialized();

        return $this->process->getExitCode();
    }

    public function getOutput(): string
    {
        $this->ensureProcessInitialized();

        return trim($this->process->getOutput());
    }

    public function getErrorOutput(): string
    {
        $this->ensureProcessInitialized();

        return trim($this->process->getErrorOutput());
    }

    public function getGitBinary(): string
    {
        return $this->gitBinary;
    }

    public function setGitBinary(string $gitBinary): void
    {
        if ($this->process) {
            throw new LogicException(sprintf('Cannot run %s, command already initialized', __METHOD__));
        }

        $this->gitBinary = $gitBinary;
    }

    public function getRawCommand(): string
    {
        $this->ensureProcessInitialized();

        return $this->process->getCommandLine();
    }

    protected function ensureProcessInitialized(): void
    {
        if ($this->process === null) {
            $this->process = $this->processFactory->create(
                array_merge([$this->getGitBinary()], explode(' ', $this->getName()), $this->getOptions(), $this->getArgs()),
                $this->getCwd(),
                $this->getTimeout(),
                array_merge($this->getEnv(), ['LC_ALL' => 'C']),
            );
        }
    }
}
