<?php
//app/Http/Controllers/APIController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
/**
 * Consyst base Controller
 * @author Hardiyansyah
 * @package kspsb\consyst\Controllers
 */
class ConsystControllers extends BaseController
{


    protected $request;
    protected $repository;

    public function __construct(Request $request, RepositoryInterface $repository = null)
    {
        $this->request    = $request;
        $this->repository = $repository;
    }

    protected function getRules()
    {
        return [];
    }

    public function create()
    {
        $this->validate($this->request, $this->getRules());

        $new = $this->repository->create($this->request->input(), $this->relations);

        if (! $new) {
            return response([], 422);
        }

        return response($new, 201);
    }

    public function update($id)
    {
        $this->validate($this->request, $this->getRules($id));

        $record = $this->repository->getById($id);

        if (empty($record)) {
            return response([], 404);
        }

        return response($this->repository->update($record, $this->request->input()));
    }

    public function delete($id)
    {
        $deleted = $this->repository->delete($id);

        if (! $deleted) {
            return response([], 404);
        }

        return response([], 204);
    }

    public function index()
    {
        return response($this->repository->getAll());
    }

    public function getById($id)
    {
        $record = $this->repository->getById($id);

        if (empty($record)) {
            return response([], 404);
        }

        return response($record);
    }
}
