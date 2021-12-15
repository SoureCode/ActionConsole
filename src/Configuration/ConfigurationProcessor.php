<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Console\Action\Configuration;

use SoureCode\Bundle\Action\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class ConfigurationProcessor
{
    public function process(array $configurations): array
    {
        $processor = new Processor();
        $configuration = new Configuration();

        return $processor->processConfiguration($configuration, $configurations);
    }
}
