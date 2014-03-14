<?php

defined('C5_EXECUTE') or die('Access Denied. ');

class DashboardReportsPageCacheCheckController extends Controller {

    public $helpers = array('form', 'html');

    public function view() {
        $hh = Loader::helper('html');
        $this->addHeaderItem($hh->javascript('pagecachecheck.js', 'remo_cache_check'));
        $this->addHeaderItem($hh->css('pagecachecheck.css', 'remo_cache_check'));
        $this->addHeaderItem('<script type="text/javascript">var REMO_CACHE_CHECK_ALL_OKAY = "' . t('All blocks are cacheable on this page.') . '"</script>');
        $this->addHeaderItem('<script type="text/javascript">var REMO_CACHE_CHECK_NOT_OKAY = "' . t('The following blocks aren\'t cacheable and prevent the page from being cached:') . '"</script>');
    }

    public function check_page() {
        $cID = intval($this->post('cID'));
        $c = Page::getByID($cID);

        $ah = new AjaxHelper();
        $blocks = $c->getBlocks();

        $blocks = $c->getBlocks();
        array_merge($c->getGlobalBlocks(), $blocks);

        $problemBlocks = array();
        foreach ($blocks as $b) {
            $controller = $b->getInstance();
            if (!$controller->cacheBlockOutput()) {
                $problemBlocks[] = $b->getBlockTypeHandle();
            }
        }

        $ah->sendResult($problemBlocks);
    }

}
