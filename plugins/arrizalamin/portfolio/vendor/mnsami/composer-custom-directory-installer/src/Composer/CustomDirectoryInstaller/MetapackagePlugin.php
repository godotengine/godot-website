<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\CustomDirectoryInstaller\MetapackageInstaller;

class MetapackagePlugin implements PluginInterface
{
  public function activate (Composer $composer, IOInterface $io)
  {
    $installer = new MetapackageInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);
  }
}
