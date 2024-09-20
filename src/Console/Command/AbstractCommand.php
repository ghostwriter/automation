<?php

declare(strict_types=1);

namespace Ghostwriter\Compliance\Console\Command;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\EventDispatcher\Interface\EventDispatcherInterface;
use Override;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class AbstractCommand extends Command
{
    public function __construct(
        protected ContainerInterface $container,
        protected EventDispatcherInterface $eventDispatcher,
        protected SymfonyStyle $symfonyStyle
    ) {
        parent::__construct(static::getDefaultName());
    }

    /**
     * @param class-string $event
     *
     * @return int 0 if everything went fine, or an exit code
     */
    public function dispatch(string $event): int
    {
        $this->eventDispatcher->dispatch($this->container->get($event));

        return self::SUCCESS;
    }

    #[Override]
    public static function getDefaultName(): string
    {
        return \mb_strtolower(\str_replace([__NAMESPACE__ . '\\', 'Command'], '', static::class));
    }
}