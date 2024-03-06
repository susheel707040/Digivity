<?php

namespace App\Http\Controllers\App\MasterAdmin\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\LibraryBookEntryRequest;
use App\Models\MasterAdmin\Library\Book;
use App\Models\MasterAdmin\Library\LibraryEntryRecord;
use Illuminate\Http\Request;

class LibraryBookEntryController extends Controller
{
    public function issuebook(LibraryBookEntryRequest $request)
    {
        $request->validated();
        $request->merge(['entry_date'=>nowdate($request->entry_date,'Y-m-d'),'end_date'=>nowdate($request->end_date,'Y-m-d')]);
        $request->merge(['entry_count'=>1]);
        $data=$request->all();
        $bookentry=LibraryEntryRecord::create($data);
        if($bookentry){
            $item=Book::find($bookentry->book_id);
            if($item){
                //Previous Exist Books Entry Disable
                $existentry=LibraryEntryRecord::query();
                if($request->entry_status=="return"){
                    $item->update(['current_issue' => '0', 'entry_id' => null]);
                    $existentry->where('entry_id',$bookentry->entry_id)->update(['status'=>'0']);
                }else {
                    $item->update(['current_issue' => '1', 'entry_id' => $bookentry->entry_id]);
                    $existentry->whereNotIn('id',[$bookentry->id])
                        ->where('entry_id',$bookentry->entry_id)->update(['status'=>'0']);
                }
                return back()->with('success','Book '.ucwords($request->entry_status).' Successful');
            }
            $bookentry->update(['status'=>0]);
        }
        return back()->with('danger','Sorry, Request failed, Please try again');
    }
}
