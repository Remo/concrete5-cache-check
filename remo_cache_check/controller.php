<?php

defined('C5_EXECUTE') or die('Access Denied.');

class RemoCacheCheckPackage extends Package {

    protected $pkgHandle = 'remo_cache_check';
    protected $appVersionRequired = '5.6.0';
    protected $pkgVersion = '0.9';

    public function getPackageDescription() {
        return t("Check why a particular page can't be cached");
    }

    public function getPackageName() {
        return t("Page Cache Check");
    }

    public function install() {
        $pkg = parent::install();

        // install single pages 
        $sp = SinglePage::add('/dashboard/reports/page_cache_check', $pkg);        
        if (version_compare(APP_VERSION, '5.6', '>')) {
            $sp->setAttribute('icon_dashboard', 'icon-hdd');
        }
    }

}
