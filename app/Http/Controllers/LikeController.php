<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\Relation;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($type, $id)
    {
        $this->identifyModel($type, $id)
            ->like();
    }

    public function destroy($type, $id)
    {
        $this->identifyModel($type, $id)
            ->unlike();
    }

    protected function identifyModel($type, $id)
    {
        $class = collect(Relation::morphMap())->get($type);
        return $class::find($id);
    }
}
