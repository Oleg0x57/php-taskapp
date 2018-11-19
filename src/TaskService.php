<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 19.11.2018
 * Time: 23:18
 */

namespace App;


class TaskService
{
    public function view($id)
    {
        return ['id' => $id, 'title' => 'test',];
    }
}