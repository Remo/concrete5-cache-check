<?php
namespace Concrete\Package\RemoCacheCheck\Controller\SinglePage\Dashboard\Reports;

use Concrete\Core\Page\Controller\DashboardPageController,
    Page,
    Loader;

class PageCacheCheck extends DashboardPageController
{
    public $helpers = array('form', 'html');

    public function view()
    {
        $hh = Loader::helper('html');
        $this->addHeaderItem($hh->css('pagecachecheck.css', 'remo_cache_check'));
        $this->addHeaderItem('<script type="text/javascript">var REMO_CACHE_CHECK_ALL_OKAY = "' . t('All blocks are cacheable on this page.') . '"</script>');
        $this->addHeaderItem('<script type="text/javascript">var REMO_CACHE_CHECK_NOT_OKAY = "' . t('The following blocks aren\'t cacheable and prevent the page from being cached:') . '"</script>');
        $this->addFooterItem($hh->javascript('pagecachecheck.js', 'remo_cache_check'));
    }

    public function check_page()
    {
        $cID = intval($this->post('cID'));
        $c = Page::getByID($cID);

        $blocks = $c->getBlocks();
        array_merge($c->getGlobalBlocks(), $blocks);

        $problemBlocks = array();
        foreach ($blocks as $b) {
            $controller = $b->getInstance();
            if (!$controller->cacheBlockOutput()) {
                $problemBlocks[] = $b->getBlockTypeHandle();
            }
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($problemBlocks);
    }

}
