<?php


namespace App\Helper;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class NewEloquentBuilder extends Builder
{
    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function search($querysearch = null, $relation = null, $relationsearch = null)
    {
        //operators define
        if (isset($querysearch['operators']) && ($querysearch['operators'] == 'or')) { $operators = "orWhere";} else {$operators = "where";}

        if (is_array($querysearch)) {
            if(!isset($querysearch['search'])&&!isset($querysearch['customsearch'])&&!isset($querysearch['colsearch'])){ $querysearch=['search'=>$querysearch];}

            //normal search
            if (isset($querysearch['search'])) {
                $search = $querysearch['search'];
                //Model parent search
                $this->where(function ($query) use ($operators, $search) {
                    foreach ($search as $column => $value) {
                        if ((in_array($column, $query->model->getFillable())) && (!empty($value))) {
                            $query->$operators($column, $value);
                        }
                    }
                });

                //Model Relation Search
                if (isset($relation) && is_array($relation)) {
                    foreach ($relation as $relationtable) {
                        $this->whereHas($relationtable, function ($query) use ($search, $operators) {
                            $query->where(function ($query) use ($search, $operators) {
                                foreach ($search as $column => $value) {
                                    if ((in_array($column, $query->model->getFillable())) && (!empty($value))) {
                                        $query->query->$operators($column, $value);
                                    }
                                }
                            });
                        });
                    }
                }
            }

            //direct search column like wherenull,wherenotnull
            if (isset($querysearch['colsearch'])) {
                $colsearch = $querysearch['colsearch'];
                //Model parent search
                if(isset($colsearch['operator'])&&($colsearch['operator'])){
                    $operators=$colsearch['operator'];
                    $this->$operators(function ($query) use ($colsearch) {
                        unset($colsearch['operator']);
                        foreach ($colsearch as $operators => $column) {
                            $query->$operators($column);
                        }
                    });
                }else{
                    $this->where(function ($query) use ($colsearch) {
                        foreach ($colsearch as $operators => $column) {
                            $query->$operators($column);
                        }
                    });
                }
            }



            //customsearch
            if (isset($querysearch['customsearch'])) {

                $customsearch = $querysearch['customsearch'];
                //Parent Model Search
                $this->where(function ($query) use ($customsearch) {

                    foreach ($customsearch as $operators => $search) {
                        foreach ($search as $column => $value) {
                            if ((in_array($column, $query->model->getFillable())) && (!empty($value))) {
                                $this->customWhere($query, $operators, $column, $value);
                            }
                        }
                    }

                });

                //Model Relation Search
                if (isset($relation) && is_array($relation)) {

                    foreach ($relation as $relationtable) {
                        $this->whereHas($relationtable, function ($query) use ($customsearch) {

                            $query->where(function ($query) use ($customsearch) {
                                foreach ($customsearch as $operators => $search) {
                                    foreach ($search as $column => $value) {
                                        if ((in_array($column, $query->model->getFillable())) && (!empty($value))) {

                                            $this->customWhere($query->query, $operators, $column, $value);

                                        }
                                    }
                                }
                            });
                        });
                    }
                }
            }

            //dd($this->toSql());
        }

        return $this;
    }
    public function customWhere($query, $operator, $column, $value)
    {
        return $query->where($column, $operator, $value);
    }

}


