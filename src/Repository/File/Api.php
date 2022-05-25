<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\File;

use InvalidArgumentException;
use MichalHepner\Git\Repository;
use Symfony\Component\Filesystem\Filesystem;
use Traversable;

class Api
{
    protected Filesystem $filesystem;

    public function __construct(protected Repository $repository)
    {
        $this->filesystem = new Filesystem();
    }

    public function file(string $filename): ?string
    {
        return file_get_contents($this->getPath($filename));
    }

    public function copy(string $originFile, string $targetFile, bool $overwriteNewerFiles = false): void
    {
        $this->filesystem->copy($this->getPath($originFile), $this->getPath($targetFile), $overwriteNewerFiles);
    }

    public function mkdir(iterable|string $dirs, int $mode = 0777): void
    {
        $this->filesystem->mkdir($this->toIterablePaths($dirs), $mode);
    }

    public function exists(iterable|string $files): bool
    {
        return $this->filesystem->exists($this->toIterablePaths($files));
    }

    public function touch(iterable|string $files, int $time = null, int $atime = null): void
    {
        $this->filesystem->touch($this->toIterablePaths($files), $time, $atime);
    }

    public function remove(iterable|string $files): void
    {
        $this->filesystem->remove($this->toIterablePaths($files));
    }

    public function chmod(iterable|string $files, int $mode, int $umask = 0000, bool $recursive = false): void
    {
        $this->filesystem->chmod($this->toIterablePaths($files), $mode, $umask, $recursive);
    }

    public function rename(string $origin, string $target, bool $overwrite = false): void
    {
        $this->filesystem->rename($this->getPath($origin), $this->getPath($target), $overwrite);
    }

    public function symlink(string $originDir, string $targetDir, bool $copyOnWindows = false): void
    {
        $this->filesystem->symlink($this->getPath($originDir), $this->getPath($targetDir), $copyOnWindows);
    }

    public function mirror(string $originDir, string $targetDir, Traversable $iterator = null, array $options = []): void
    {
        $this->filesystem->mirror($this->getPath($originDir), $this->getPath($targetDir), $iterator, $options);
    }

    public function dumpFile(string $filename, $content): void
    {
        $this->filesystem->dumpFile($this->getPath($filename), $content);
    }

    public function appendToFile(string $filename, $content): void
    {
        $this->filesystem->appendToFile($this->getPath($filename), $content);
    }

    protected function getPath($path): string
    {
        if ($this->filesystem->isAbsolutePath($path)) {
            throw new InvalidArgumentException(sprintf(
                'Given path %s is invalid. Only relative paths are accepted',
                $path
            ));
        }

        return $this->repository->getPath() . DIRECTORY_SEPARATOR . $path;
    }

    protected function toIterablePaths(string|iterable $paths): iterable
    {
        $paths = is_string($paths) ? [$paths] : $paths;
        foreach ($paths as $k => $path) {
            $paths[$k] = $this->getPath($path);
        }

        return $paths;
    }
}
