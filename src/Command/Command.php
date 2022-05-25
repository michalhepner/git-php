<?php
declare(strict_types = 1);

namespace MichalHepner\Git\Command;

use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessFactoryInterface;
use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessInterface;

interface Command
{
    public function getName(): string;
    public function getOptions(): array;
    public function getArgs(): array;
    public function getCwd(): ?string;
    public function getTimeout(): ?int;
    public function setTimeout(int $timeout): void;
    public function getEnv(): array;
    public function execute(): int;
    public function setGitBinary(string $gitBinary): void;
    public function getExitCode(): int;
    public function getOutput(): string;
    public function getErrorOutput(): string;
    public function getRawCommand(): string;
}
