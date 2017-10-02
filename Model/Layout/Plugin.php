<?php

namespace Dakzilla\CacheTags\Model\Layout;

class Plugin
{
    /** @var \Magento\PageCache\Model\Config */
    protected $_config;

    /** @var \Magento\Framework\App\ResponseInterface */
    protected $_response;

    /** @var \Magento\Framework\Registry */
    protected $_registry;

    /**
     * @param \Magento\Framework\App\ResponseInterface $response
     * @param \Magento\PageCache\Model\Config $config
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\ResponseInterface $response,
        \Magento\PageCache\Model\Config $config,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_response = $response;
        $this->_config = $config;
        $this->_registry = $registry;
    }

    /**
     * @param \Magento\Framework\View\Layout $subject
     */
    public function beforeGetOutput(\Magento\Framework\View\Layout $subject)
    {
        if ($subject->isCacheable() && !$this->_config->isEnabled()) {
            $tags = [];
            foreach ($subject->getAllBlocks() as $block) {
                if ($block instanceof \Magento\Framework\DataObject\IdentityInterface) {
                    $isEsiBlock = $block->getTtl() > 0;
                    $isVarnish = $this->_config->getType() == \Magento\PageCache\Model\Config::VARNISH;
                    if ($isVarnish && $isEsiBlock) {
                        continue;
                    }
                    $tags = array_merge($tags, $block->getIdentities());
                }
            }
            $tags = array_unique($tags);
            $this->_registry->register('layout_cache_tags', $tags, true);
        }
    }
}