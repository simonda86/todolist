<?php namespace App\Repositories;

use App\Item;
use Carbon\Carbon;

class ItemRepository {

    /**
     * Get the items for a list
     *
     * @param $list_id
     * @return mixed
     */
    public function getItems($list_id)
    {
        return Item::where('list_id', '=', $list_id)->where('completed_at', '=', null)->orderBy('created_at', 'ASC')->get();
    }

    /**
     * Get a single item
     * 
     * @param $list_id
     * @param $id
     * @return mixed
     */
    public function getItem($list_id, $id)
    {
        return Item::where('list_id', '=', $list_id)->where('id', '=', $id)->first();
    }

    /**
     * Create a new item
     *
     * @param $text
     * @param $list_id
     * @return Item
     */
    public function createItem($text, $list_id)
    {
        $item = new Item;
        $item->list_id = $list_id;
        $item->text = $text;
        $item->save();

        return $item;
    }

    /**
     * Mark an item as complete
     *
     * @param $list_id
     * @param $id
     * @return mixed
     */
    public function complete($list_id, $id)
    {
        $item = $this->getItem($list_id, $id);
        $item->completed_at = Carbon::now();

        return $item->save();
    }

}