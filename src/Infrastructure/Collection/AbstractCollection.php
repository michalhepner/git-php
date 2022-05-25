<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\Collection;

use InvalidArgumentException;
use IteratorAggregate;

/**
 * @template TKey
 * @template TValue
 * @implements IteratorAggregate<TKey, TValue>
 */
abstract class AbstractCollection implements \Countable, IteratorAggregate
{
    use Mappable;
    use ProvidesIterator;
    use Countable;
    use Filterable;
    use Reducable;
    use Sortable;

    protected array $items = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function add($item): void
    {
        $this->validateItem($item);
        $this->items[] = $item;
    }

    public function getArrayCopy(): array
    {
        return $this->items;
    }

    protected function &getArrayReference(): array
    {
        return $this->items;
    }

    protected function validateItem($item): void
    {
        $expectedClass = preg_replace('/Collection$/', '', get_class($this));
        if (!$item instanceof $expectedClass) {
            throw new InvalidArgumentException(sprintf(
                'Item provided to %s is expected to be an instance of %s',
                __METHOD__,
                $expectedClass
            ));
        }
    }

    public function first()
    {
        foreach ($this as $item) {
            return $item;
        }

        return null;
    }

    public function last()
    {
        $lastItem = null;
        foreach ($this as $item) {
            $lastItem = $item;
        }

        return $lastItem;
    }

}
