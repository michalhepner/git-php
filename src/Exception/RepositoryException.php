<?php
declare(strict_types=1);

namespace MichalHepner\Git\Exception;

use MichalHepner\Git\Repository;
use RuntimeException;
use Throwable;

class RepositoryException extends RuntimeException
{
    public function __construct(protected Repository $repository, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }
}
