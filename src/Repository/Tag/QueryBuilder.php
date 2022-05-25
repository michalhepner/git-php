<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Tag;

use MichalHepner\Git\Command\ShowRefCommand;
use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Tag;
use MichalHepner\Git\Repository\TagCollection;

class QueryBuilder
{
    public function __construct(protected Repository $repository)
    {}

    public function execute(): TagCollection
    {
        $tags = new TagCollection();
        $command = $this->repository->showRefCommand(options: [ShowRefCommand::OPTION_TAGS]);
        $command->execute();
        $output = $command->getOutput();
        foreach (array_values(array_filter(explode(PHP_EOL, $output))) as $line) {
            list(, $fullTagName) = explode(' ', $line);
            $name = preg_replace('/^refs\/tags\//', '', $fullTagName);
            $tags->add(new Tag($this->repository, $name));
        }

        return $tags;
    }
}
