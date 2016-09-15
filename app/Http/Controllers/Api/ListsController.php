<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ListRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;

class ListsController extends Controller
{
    /**
     * @var ListRepository
     */
    private $list;

    /**
     * ListsController constructor.
     *
     * @param ListRepository $list
     */
    public function __construct(ListRepository $list)
    {
        $this->list = $list;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->list->getLists();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ListRequest  $request
     * @return Response
     */
    public function store(ListRequest $request)
    {
        return $this->list->createList($request->input('name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->list->getList($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ListRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ListRequest $request, $id)
    {
        return $this->list->updateList($request->input('name'), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if($this->list->deleteList($id))
        {
            return 'Success';
        }
    }
}
