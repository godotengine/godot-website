<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Package\PackageInterface;
use Composer\Installer\MetapackageInstaller as BaseMetapackageInstaller;

class MetapackageInstaller extends BaseMetapackageInstaller
{
  public function getInstallPath(PackageInterface $package)
  {
    $path = PackageUtils::getPackageInstallPath($package, $this->composer);

    if(!empty($path))
    {
        return $path;
    }

    /*
     * In case, the user didn't provide a custom path
     * use the default one, by calling the parent::getInstallPath function
     */
    return parent::getInstallPath($package);
  }
}
