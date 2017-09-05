<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\CustomDirectoryInstaller\PluginInstaller;

class PluginPlugin implements PluginInterface
{
  public function activate (Composer $composer, IOInterface $io)
  {
    $installer = new PluginInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);
  }
}
