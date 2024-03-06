<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\Record;
use App\Models\User;

class Book extends Record
{
    protected $table = "library_book";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'library_id',
        'item_category_id',
        'racks',
        'author_id',
        'tag_id',
        'genre_id',
        'subject_id',
        'book_no',
        'accession_no',
        'ddc_no',
        'barcode_no',
        'book_title',
        'search_keyword',
        'no_of_copy',
        'pages',
        'book_condition',
        'issuable',
        'edition',
        'year',
        'publisher',
        'purchase_date',
        'shelf_no',
        'price',
        'scan_copy',
        'book_image',
        'e_book_url',
        'source',
        'bill_no',
        'bill_date',
        'cost',
        'topic',
        'remark',
        'status',
        'current_issue',
        'entry_id',
        'user_id'
    ];

    /*
     * Join Relation
     */
    public function library()
    {
        return $this->belongsTo(Library::class,'library_id','id')->withTrashed();
    }

    public function itemcategory()
    {
        return $this->belongsTo(LibraryCategory::class,'item_category_id','id')->withTrashed();
    }

    public function rack()
    {
        return $this->belongsTo(Racks::class,'racks','id')->withTrashed();
    }

    public function author()
    {
        return $this->belongsTo(Author::class,'author_id','id')->withTrashed();
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class,'tag_id','id')->withTrashed();
    }

    public function genre()
    {
        return $this->belongsTo(LibraryGenre::class,'genre_id','id')->withTrashed();
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }

    public function libraryentryrecord()
    {
        return $this->belongsTo(LibraryEntryRecord::class,'entry_id','entry_id')->latest();
    }

    /*
     * Table Relation Return Column Name
     */
    public function LibraryName()
    {
        try {
            return $this->library->library_name;
        }catch (\Exception $e){}
        return null;
    }

    public function ItemCategoryName()
    {
        try {
            return $this->itemcategory->item_category;
        }catch (\Exception $e){}
        return null;
    }

    public function ReturnDays()
    {
        try {
            return $this->itemcategory->return_day;
        }catch (\Exception $e){}
        return 0;
    }

    public function RackNo()
    {
        try {
            return $this->rack->racks;
        }catch (\Exception $e){}
        return null;
    }

    public function AuthorName()
    {
        try {
            return $this->author->author;
        }catch (\Exception $e){}
        return null;
    }

    public function TagName()
    {
        try {
            return $this->tag->tag;
        }catch (\Exception $e){}
        return null;
    }

    public function GenreName()
    {
        try {
            return $this->genre->genre;
        }catch (\Exception $e){}
        return null;
    }

    public function SubjectName()
    {
        try {
            return $this->subject->subject_name;
        }catch (\Exception $e){}
        return null;
    }

    public function UserName()
    {
        try {
            return $this->user->first_name." ".$this->user->last_name;
        }catch (\Exception $e){}
        return null;
    }




}
