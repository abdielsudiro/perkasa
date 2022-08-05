<?php

namespace RFM\Event\Api;

use Symfony\Contracts\EventDispatcher\Event;
use RFM\Repository\ItemData;

/**
 * API event. Dispatched each time when file or folder is copied.
 */
class AfterItemCopyEvent extends Event
{
    const NAME = 'api.after.item.copy';

    /**
     * @var ItemData
     */
    protected $itemData;

    /**
     * @var ItemData
     */
    protected $originalItemData;

    /**
     * AfterItemCopyEvent constructor.
     *
     * @param ItemData $itemData
     * @param ItemData $originalItemData
     */
    public function __construct(ItemData $itemData, ItemData $originalItemData)
    {
        $this->itemData = $itemData;
        $this->originalItemData = $originalItemData;
    }

    /**
     * @return ItemData
     */
    public function getItemData()
    {
        return $this->itemData;
    }

    /**
     * @return ItemData
     */
    public function getOriginalItemData()
    {
        return $this->originalItemData;
    }
}