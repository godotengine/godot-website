<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\CustomDirectoryInstaller\PearInstaller;

class PearPlugin implements PluginInterface
{
  public function activate (Composer $composer, IOInterface $io)
  {
    $installer = new PearInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);
  }
}
