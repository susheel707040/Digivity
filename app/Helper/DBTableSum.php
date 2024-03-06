<?php


namespace App\Helper;

use Illuminate\Support\Facades\DB;

class DBTableSum
{

    public static function ModelSum($model, $condition)
    {

        if ($model::query()) {
            /**
             * model query get
             */
            $query = $model::query();
            $fillable = new $model();
            /**
             * table joins
             */
            if(isset($condition['join'])&&(count($condition['join']))){
                foreach ($condition['join'] as $key=>$jointable){
                    //owner table name get if pass then replace
                    $foreigntable=$fillable->getTable();
                    if(isset($jointable['foreigntable'])&&($jointable['foreigntable'])){
                        $foreigntable=$jointable['foreigntable'];
                    }
                    if(($key)&&($foreigntable)&&isset($jointable['table'])&&($jointable['table'])&&(isset($jointable['foreign'])&&($jointable['foreign']))&&(isset($jointable['ownerkey'])&&($jointable['ownerkey']))){
                        $query->join(''.$jointable['table'].' as '.$key.'',''.$foreigntable.'.'.$jointable['foreign'].'','=',''.$key.'.'.$jointable['ownerkey'].'');
                    }
                }
            }
            /**
             * search condition
             */
            if (isset($condition['search']) && (count($condition['search']))) {
                /**
                 * get model fillable and search condition model
                 */
                foreach ($condition['search'] as $column => $value) {
                    if (in_array($column, $fillable->getFillable())) {
                        $query->where($column, $value);
                    }
                }
            }
            /*
             * without column search
             */
            if (isset($condition['joinsearch']) && (count($condition['joinsearch']))) {
                /**
                 * if table join table search columan use this keyid
                 */
                foreach ($condition['joinsearch'] as $column => $value) {
                        $query->where($column, $value);
                }
            }

            /*
             * without column join custom search
             */
            if (isset($condition['joincustomsearch']) && (count($condition['joincustomsearch']))) {
                /*
                 * if table join custom table search columan use this keyid
                 */
                foreach ($condition['joincustomsearch'] as $key => $value) {
                    if ((is_array($value)) && ($value)) {
                        foreach ($value as $column => $val) {
                            $query->$key($column, $val);
                        }
                    }
                }
            }

            /*
             * custom search
             */
            if (isset($condition['customsearch']) && (count($condition['customsearch']))) {

                foreach ($condition['customsearch'] as $key => $value) {
                    if ((is_array($value)) && ($value)) {
                        foreach ($value as $column => $val) {
                            if (in_array($column, $fillable->getFillable())) {
                                $query->$key($column, $val);
                            }
                        }
                    } else {
                        $query->$key($value);
                    }
                }
            }

            /**
             * query relationship condition apply multiple
             */
            if (isset($condition['relation']) && count($condition['relation'])) {
                foreach ($condition['relation'] as $relation) {
                    /**
                     * relation table select db rows multiple query
                     */
                    if (isset($condition['relationdbrow'][$relation]) && count($condition['relationdbrow'][$relation])) {

                        foreach ($condition['relationdbrow'][$relation] as $key => $dbrow) {
                            /**
                             * wherehas match relation table show only column
                             */
                            $query->whereHas($relation, function ($query) use ($condition) {
                                /**
                                 * search relation tables
                                 */
                                if (isset($condition['search']) && (count($condition['search']))) {
                                    foreach ($condition['search'] as $column => $value) {
                                        if (in_array($column, $query->getModel()->getFillable())) {
                                            $query->where($column, $value);
                                        }
                                    }
                                }
                                /**
                                 * custom search relation tables
                                 */
                                if (isset($condition['customsearch']) && (count($condition['customsearch']))) {
                                    foreach ($condition['customsearch'] as $key => $value) {
                                        if ((is_array($value)) && ($value)) {
                                            foreach ($value as $column => $val) {
                                                if (in_array($column, $query->getModel()->getFillable())) {
                                                    $query->$key($column, $val);
                                                }
                                            }
                                        } else {
                                            $query->$key($value);
                                        }
                                    }
                                }
                            });

                            /**
                             * with count select column
                             */
                            $query->withCount(['' . $relation . ' as ' . $relation . '_sum' . $key . '' => function ($query) use ($condition, $dbrow) {
                                if (isset($condition['relationdbrow'])) {
                                    $query->select(DB::raw($dbrow));
                                }
                            }]);
                        }
                    }
                }
            }

            /**
             * select db row columan
             */
            if (isset($condition['dbrow'])) {
                $query->select(DB::raw($condition['dbrow']));
            }

            /**
             * pass get/first/tosql function
             */
            if (isset($condition['get'])) {
                $get = $condition['get'];
                $data = $query->record()->$get();
            } else {
                $data = $query->record()->first();
            }


            return $data;
        }
        return null;
    }
}
