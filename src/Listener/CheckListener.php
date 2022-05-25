<?php

declare(strict_types=1);

namespace Ghostwriter\Compliance\Listener;

use Ghostwriter\Compliance\Contract\EventListenerInterface;
use Ghostwriter\Compliance\Event\CheckEvent;
use Ghostwriter\Compliance\Event\ProcessJobEvent;
use Throwable;

final class CheckListener implements EventListenerInterface
{
    /**
     * @throws Throwable
     */
    public function __invoke(CheckEvent $event): void
    {
        $output = $event->getOutput();

        $output->comment($event::class);
    }
}