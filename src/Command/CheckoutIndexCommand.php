<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CheckoutIndexCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'checkout-index';
    }
}
