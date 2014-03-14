<?php
defined('C5_EXECUTE') or die('Access Denied.');

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(
        t('Page Cache Check'), t('Check why a certain page cannot be cached.'), 'span7 offset3', false
);
?>
<div class="ccm-pane-body">
    <?php
    echo t('Select the page for which you want to run the full page cache check. If all blocks are cacheable, you can turn on the <a href="%s">full page cache</a> and benefit from a much better performance.', $this->url('/dashboard/system/optimization/cache/'));
    
    $pageSelector = Loader::helper('form/page_selector');
    echo $pageSelector->selectPage('pageToCheck');
    ?>

    <ul id="remo-cache-check-result">
        
    </ul>

</div>
<?php
echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);
?>