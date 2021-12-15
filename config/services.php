<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use SoureCode\Console\Action\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Filesystem\Filesystem;

return static function (ContainerConfigurator $builder) {
    $services = $builder->services();

    $services->set('filesystem', Filesystem::class);
    $services->set('event_dispatcher', EventDispatcher::class)->public();

    $services
        ->instanceof(Command::class)->tag('console.command');

    $services
        ->set(Application::class, Application::class)
        ->args([
            tagged_iterator('console.command'),
        ])
        ->public();
};
