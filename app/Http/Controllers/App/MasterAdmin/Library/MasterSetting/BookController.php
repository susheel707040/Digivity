<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\BookRequest;
use App\Models\MasterAdmin\Library\Book;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search=$request->all();
        if(isset($request->accession_no)&&($request->accession_no)){
            $search=array_merge($search,['customsearch'=>['whereIn'=>['accession_no'=>explode(",",$request->accession_no)]]]);
        }
        unset($search['accession_no']);
        $book=[];
        if(count($search)>0){
            $book = (new LibraryRepositories())->booksearchlist($search);
        }
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-books', compact(['book']));
    }

    public function createbookindex()
    {
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.add-new-book');
    }

    public function store(BookRequest $request)
{
    // return $request;
    try {
        $data = $request->validated();
        $request->purchase_date ? $data['purchase_date'] = nowdate($request->purchase_date, 'Y-m-d') : null;
        $request->bill_date ? $data['bill_date'] = nowdate($request->bill_date, 'Y-m-d') : null;

        // Save images if provided
        if ($request->hasFile('scan_copy')) {
            // Get the file from the request
            $ScanprofileImage = $request->scan_copy;

            // Generate a unique name for the file
            $SchoolBannerFileName = $ScanprofileImage->getClientOriginalName();

            // Move the file to the desired location
            $ScanprofileImage->move(public_path('uploads/Book_scan_copy_image'), $SchoolBannerFileName);

            // Update the student's profile_img attribute with the file name
            $data['scan_copy'] = $SchoolBannerFileName;
        }

        if ($request->hasFile('book_image')) {
            // Get the file from the request
            $BookprofileImage = $request->book_image;

            // Generate a unique name for the file
            $BookBannerFileName = $BookprofileImage->getClientOriginalName();

            // Move the file to the desired location
            $BookprofileImage->move(public_path('uploads/Book_image'), $BookBannerFileName);

            // Update the student's profile_img attribute with the file name
            $data['book_image'] = $BookBannerFileName;
        }

        // Create Book object with data
        Book::create($data);

        return back()->with('success', 'Record Save Successful Complete');
    } catch (\Exception $e) {
        return back()->with('danger', 'Sorry, permission to create this record was denied.');
    }
}


    public function editview(Book $book)
    {
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.edit-book', compact(['book']));
    }

    public function modify(Book $book, BookRequest $request)
    {
        try {
            $data = $request->validated();
            $request->purchase_date ? $data['purchase_date'] = nowdate($request->purchase_date, 'Y-m-d') : null;
            $request->bill_date ? $data['bill_date'] = nowdate($request->bill_date, 'Y-m-d') : null;
            $book->update($data);
            return back()->with('success', 'Record Update Successful Complete');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function preview(Book $book)
    {
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.book-preview-detail');
    }

    /*
     * Book Report
     */

    public function bookautocomplete($selectuserid,$selectuser,Request $request)
    {
        $request->limit ? $limit = $request->limit : $limit = 30;
        //search by condition
        $search = "";
        if (isset($request->search_by)) {
            $search = ['search' => ['book_no' => $request->book_no], 'customsearch' => ['wherelike' => [$request->search_by => $request->search]]];
        }
        $bookresult = (new LibraryRepositories())->booksearchlist($search, ['author'], $limit);
        return view('erpmodule.MasterAdmin.Library.MasterSetting.issue-page-book-autocomplete',compact(['bookresult','selectuserid','selectuser']));
    }
}
