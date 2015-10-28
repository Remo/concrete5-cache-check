<?php
namespace Concrete\Package\RemoCacheCheck;

use Package,
    SinglePage;

class Controller extends Package
{

    protected $pkgHandle = 'remo_cache_check';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '1.9';

    public function getPackageName()
    {
        return t("Page Cache Check");
    }

    public function getPackageDescription()
    {
        return t("Check why a particular page can't be cached");
    }

    public function install()
    {
        $pkg = parent::install();

        // install single pages 
        SinglePage::add('/dashboard/reports/page_cache_check', $pkg);
    }

}
