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
use SoureCode\Console\Action\Configuration\ConfigurationFileLocator;
use SoureCode\Console\Action\Configuration\ConfigurationLoader;
use SoureCode\Console\Action\Configuration\ConfigurationProcessor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

// Patch server script filename for box
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

/**
 * Determine vendor directory.
 */
$vendorDirectory = '';

if (file_exists(__DIR__.'/../../../../../vendor/autoload_runtime.php')) {
    $vendorDirectory = __DIR__.'/../../../../../vendor';
} elseif (file_exists(__DIR__.'/../vendor/autoload_runtime.php')) {
    $vendorDirectory = __DIR__.'/../vendor';
}

if (empty($vendorDirectory)) {
    throw new \RuntimeException('Unable to find vendor directory');
}

if (!is_file($vendorDirectory.'/autoload_runtime.php')) {
    throw new LogicException('Symfony Runtime is missing. Try running "composer require symfony/runtime".');
}

/**
 * @psalm-suppress UnresolvableInclude
 */
require_once $vendorDirectory.'/autoload_runtime.php';

return function (array $context) {
    $configurationFileLocator = new ConfigurationFileLocator();
    $configurationLoader = new ConfigurationLoader();
    $configurationProcessor = new ConfigurationProcessor();

    $files = $configurationFileLocator->locate('action.json', null, false);
    $configs = $configurationLoader->load($files);
    $config = $configurationProcessor->process($configs);

    $container = new ContainerBuilder();

    $loader = new PhpFileLoader($container, new FileLocator());
    $loader->load(__DIR__.'/../config/services.php');
    $loader->load(__DIR__.'/../config/bundle_services.php');

    $commandDefinition = $container->getDefinition('soure_code.action.action_definitions');
    $commandDefinition->setArgument('$actions', $config['actions']);

    $container->compile();

    return $container->get(Application::class);
};
