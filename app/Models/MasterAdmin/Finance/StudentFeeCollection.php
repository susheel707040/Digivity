<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\MasterAdmin\Admission\StudentProspectus;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\Record;
use App\Models\User as ModelsUser;
use App\Models\User;

class StudentFeeCollection extends Record
{
    protected $table = "finance_fee_collection_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'financial_id',
        'receipt_group_token_id',
        'receipt_id',
        'receipt_date',
        'student_id',
        'prospectus_id',
        'course_id',
        'section_id',
        'sub_total',
        'concession_total',
        'special_concession',
        'fine_total',
        'fine_concession',
        'fee_payable',
        'paid_amount',
        'balance',
        'entry_mode',
        'online_transaction_no',
        'online_remark',
        'online_status',
        'paymode_id',
        'instrument_no',
        'instrument_date',
        'bank',
        'receipt_status',
        'concession_remark',
        'special_concession_remark',
        'fine_remark',
        'fee_remark',
        'custom_fee_id',
        'new_custom_fee_id',
        'user_id'
    ];

    public function feeheadrecord()
    {
        return $this->hasMany(StudentFeeCollectionFeeHeadRecord::class, 'fee_collection_id', 'id')->with(['feehead'])->orderBy('priority', 'asc')->withTrashed();
    }

    public function feeheadinstalmentrecord()
    {
        return $this->belongsToMany(StudentFeeCollectionInstalmentRecord::class, 'finance_fee_collection_instalment_record', 'fee_collection_id', 'id');
    }

    public function feeheadinstalment()
    {
        return $this->hasMany(StudentFeeCollectionInstalmentRecord::class, 'fee_collection_id', 'id')->select(array('id', 'fee_collection_id', 'fee_structure_id', 'fee_head_id', 'instalment_id', 'instalment_amount', 'instalment_concession', 'instalment_paid', 'instalment_bal', 'paid_status'));
    }

    public function feeheadinstalmentfull()
    {
        return $this->hasMany(StudentFeeCollectionInstalmentRecord::class, 'fee_collection_id', 'id')->orderBy('instalment_priority', 'asc');
    }

    public function paymode()
    {
        return $this->belongsTo(Paymode::class, 'paymode_id', 'id')->withTrashed();
    }

    public function student()
    {
        return $this->belongsTo(StudentRecord::class, 'student_id', 'student_id')->with(['student', 'course', 'section'])->withTrashed();
    }

    public function prospectus()
    {
        return $this->belongsTo(StudentProspectus::class, 'prospectus_id', 'id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(ModelsUser::class,'user_id','id')->withTrashed();
    }

    /**
     * @return string
     * define relation table functions
     */
    public function PaymodeName()
    {
        try {
            return ucfirst($this->paymode->paymode);
        } catch (\Exception $e) {
        }
        return null;
    }

    public function AdmissionNo()
    {
        try {
            return $this->student->admission_no;
        } catch (\Exception $e) {
        }
        try {
            return $this->prospectus->pros_no;
        } catch (\Exception $e) {
        }
        return null;
    }

    public function fullName()
    {
        try {
            if (isset($this->student)) {
                return $this->student->fullName();
            }
        } catch (\Exception $e) {
        }
        try {
            if ($this->prospectus) {
                return $this->prospectus->fullName();
            }
        } catch (\Exception $e) {
        }
        return null;
    }

    public function CourseSection()
    {
        try {
            if (isset($this->student)) {
                return $this->student->CourseSection();
            }
        } catch (\Exception $e) {
        }
        try {
            if ($this->prospectus) {
                return $this->prospectus->CourseName();
            }
        } catch (\Exception $e) {
        }
        return null;
    }

    public function FatherName()
    {
        try {
            if (isset($this->student)) {
                return $this->student->FatherName();
            }
        } catch (\Exception $e) {
        }
        try {
            if ($this->prospectus) {
                return $this->prospectus->FatherName();
            }
        } catch (\Exception $e) {
        }
        return null;
    }

    public function ContactNo()
    {
        try {
            if (isset($this->student)) {
                return $this->student->student->contact_no;
            }
            if ($this->prospectus) {
                return $this->prospectus->mobile_no;
            }
        } catch (\Exception $e) {
        }
    }

    public function Address()
    {
        try {
            return $this->student->residence_address;
        } catch (\Exception $e) {
        }
        try {
            if ($this->prospectus) {
                return $this->prospectus->residence_address;
            }
        } catch (\Exception $e) {
        }
    }

    public function ServerName()
    {
        try {
            return $this->user->first_name;
        }catch (\Exception $e){ return null;}
    }


    /**
     * parameter define to dynamic replace text sms and email value
     * @return array
     */
    public function parameters()
    {
        return [
            '{ReceiptNo}'=>$this->receipt_id,
            '{ReceiptDate}'=>nowdate($this->receipt_date,'d-M-Y'),
            '{TotalFee}'=>$this->sub_total,
            '{TotalConcession}'=>$this->concession_total,
            '{TotalFine}'=>$this->fine_total,
            '{PayableFee}'=>$this->fee_payable,
            '{PaidAmount}'=>$this->paid_amount,
            '{BalanceTextAmount}'=>'',
            '{Paymode}'=>$this->PaymodeName(),
            '{AdmissionNo}'=>$this->AdmissionNo(),
            '{FullName}' => $this->fullName(),
            '{CourseSection}'=>$this->CourseSection(),
            '{FatherName}'=>$this->FatherName(),
            '{NowDate}' => nowdate('', 'd-M-Y'),
            '{NowDateTime}' => nowdate('', 'd-M-Y H:i:s'),
        ];
    }


}
