<?php

namespace Dakzilla\CacheTags\Block;

use Magento\Framework\App\State;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Component extends Template
{
    /** @var State */
    private $_state;

    /** @var Registry */
    private $_registry;

    public function __construct(
        State $state,
        Template\Context $context,
        Registry $registry,
        array $data = []
    )
    {
        $this->_registry = $registry;
        $this->_state = $state;
        parent::__construct($context, $data);
    }

    public function getTags()
    {
        if ($this->_state->getMode() === State::MODE_DEVELOPER) {
            return $this->_registry->registry('layout_cache_tags');
        }

        return '';
    }
}