<?php


namespace App\Repositories\MasterAdmin\Certificate;


use App\Model\MasterAdmin\Certificate\CertificateRecord;
use App\Repositories\MasterAdmin\RepositoryContract;

class CertificateRepositories extends RepositoryContract
{
    public function certificaterecordlist($search=null,$relation=null)
    {
        return CertificateRecord::query()->search($search,$relation)->record()->get();
    }
}
