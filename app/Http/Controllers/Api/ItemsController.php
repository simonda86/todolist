<?php namespace App\Http\Controllers\Api;

use App\Repositories\ItemRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;

class ItemsController extends Controller
{
    /**
     * @var ItemRepository
     */
    private $item;

    /**
     * ItemsController constructor.
     */
    public function __construct(ItemRepository $item)
    {
        $this->item = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($list_id)
    {
        return $this->item->getItems($list_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ItemRequest $request, $list_id)
    {
        return $this->item->createItem($request->input('text'), $list_id);
    }

    /**
     * Mark an item as completed
     *
     * @param $list_id
     * @param $id
     * @return string
     */
    public function complete($list_id, $id)
    {
        return ($this->item->complete($list_id, $id)) ? 'Complete' : 'FAILED';
    }
}
