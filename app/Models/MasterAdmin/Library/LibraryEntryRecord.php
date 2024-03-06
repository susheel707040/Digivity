<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Staff\StaffRecord;
use App\Models\Record;

class LibraryEntryRecord extends Record
{
    protected $table = "library_entry_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'entry_id',
        'library_id',
        'student_id',
        'staff_id',
        'library_account_id',
        'book_id',
        'book_group_id',
        'entry_date',
        'end_date',
        'entry_status',
        'entry_count',
        'remark',
        'status',
        'user_id'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id','id')->withTrashed();;
    }

    public function student()
    {
        return $this->belongsTo(StudentRecord::class,'student_id','student_id')->withTrashed();
    }

    public function staff()
    {
        return $this->belongsTo(StaffRecord::class,'staff_id','staff_id')->withTrashed();
    }

    public function member()
    {

    }
    /*
     * Table Relation Columan Name in Array
     */
    public function BookName()
    {
        try {
            return $this->book->book_title;
        }catch (\Exception $e){
            return null;
        }
    }

    public function BookNo()
    {
        try {
            return $this->book->book_no;
        }catch (\Exception $e){
            return null;
        }
    }

    public function MemberName()
    {
        if($this->student){
            return $this->student->fullName()." - ". $this->student->CourseSection()." <span class='badge badge-success p-1 ml-2'>Student</span>";
        }
    }

    public function EntryStatus()
    {
        if($this->entry_status=="issue"){
            return "<span class='badge badge-success'>Issued</span>";
        }
        if($this->entry_status=="renew"){
            return "<span class='badge badge-info'>Renew</span>";
        }
        if($this->entry_status=="return"){
            return "<span class='badge badge-danger'>Return</span>";
        }
        if($this->entry_status=="loss"){
            return "<span class='badge badge-dark'>Loss</span>";
        }
    }

}
