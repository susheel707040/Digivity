<?php


namespace App\Repositories\MasterAdmin\OnlineStream;


use App\Model\MasterAdmin\OnlineStream\OnlineClassRecord;
use App\Repositories\MasterAdmin\RepositoryContract;

class OnlineStreamRepositories extends RepositoryContract
{

    public function onlineclasslist($search=null,$relation=null)
    {
        return OnlineClassRecord::query()->search($search,$relation)->record()->get();
    }

}
