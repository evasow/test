<?php

namespace App\Traits;


trait JoinQueryParams
{
    public function test($model, $request, array $tabRelations)
    {
        $join = $request->input('join');
        $joins = explode(',', $join);

        

        $params = [];

        foreach ($joins as $join) {

            if (in_array(trim($join), $tabRelations)) {
                $params[] =trim($join);
            }
        }
        echo $model::with($params)->get();
    }
}
