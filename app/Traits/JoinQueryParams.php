<?php

namespace App\Traits;


trait JoinQueryParams
{
    public function test($classe, $request)
    {
        $value=$request->query('join');
        if ($value=='classes') {
            # code...
            return 'App\Model\'.$classe::with($value)->get();
        }
        return false;
    }
}
