<?php

namespace App\Http\Controllers\App\MasterAdmin\Library;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Library\Book;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class IssueBookController extends Controller
{
    public function index(Request $request)
    {
        $studentid=0;

            $student = (new StudentRepository())->studentshortlist($request->all()) ?? [];

        return view('app.erpmodule.MasterAdmin.Library.Entry.issue-book',compact(['studentid','student']));
    }

    public function indexsearch($selectuserid,$selectuser)
    {
        if($selectuser=="student"){
            $search=['student_id'=>$selectuserid];
        }elseif($selectuser=="staff"){
            $search=['staff_id'=>$selectuserid];
        }else{
            $search=['library_account_id'=>$selectuserid];
        }
        $search=array_merge($search,['status'=>1]);
        $bookentrylist=(new LibraryRepositories())->bookentrylist($search);
        return view('app.erpmodule.MasterAdmin.Library.Entry.issue-book',compact(['selectuserid','selectuser','bookentrylist']));
    }

    public function issuebookindex($user,$memberid,$bookid,$operation,$entryid)
    {
        $book=Book::find($bookid);
        return view('app.erpmodule.MasterAdmin.Library.Entry.Pages.issue-and-return-entry-page',compact(['book','user','memberid','operation','entryid']));
    }
}
