<?php namespace App\Repositories;

use App\TodoList;
use Illuminate\Auth\Guard;

class ListRepository {

    /**
     * Id of the current user
     * @var integer
     */
    private $user_id;

    /**
     * ListRepository constructor.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        if($auth->getUser())
            $this->user_id = $auth->getUser()->id;
        else
            abort(403);
    }

    /**
     * Get all lists belonging to a user
     *
     * @return mixed
     */
    public function getLists()
    {
        return TodoList::where('user_id', '=', $this->user_id)->orderBy('name', 'ASC')->get();
    }

    /**
     * Get a single list belonging to a user
     *
     * @param $id
     * @return mixed
     */
    public function getList($id)
    {
        return TodoList::where('user_id', '=', $this->user_id)->where('id', '=', $id)->first();
    }

    /**
     * Create a new list for a user
     *
     * @param $name
     * @return TodoList
     */
    public function createList($name)
    {
        $list = new TodoList();
        $list->name = $name;
        $list->user_id = $this->user_id;
        $list->save();

        return $list;
    }

    /**
     * Update a list
     *
     * @param $id
     * @param $name
     * @return mixed
     */
    public function updateList($id, $name)
    {
        $list = $this->getList($id);
        $list->name = $name;
        $list->save();

        return $list;
    }

    /**
     * Delete a list
     *
     * @param $id
     * @return bool
     */
    public function deleteList($id)
    {
        $list = $this->getList($id);

        if($list)
            return $list->delete();
        else
            return false;
    }

}