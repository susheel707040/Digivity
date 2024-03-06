<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookmarksLinkRequest;
use App\Models\BookmarksLink;
use App\Models\BookmarksLinkCategory;
use Illuminate\Http\Request;

class BookmarksLinkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarkcategory=BookmarksLinkCategory::query()->record()->get();
        $url=$request->url;
        return view('app.erpmodule.BookmarksLink.bookmarks-link-index',compact(['url','bookmarkcategory']));
    }

    public function store(BookmarksLinkRequest $request)
    {
        $data=$request->validated();
        if(isset($request->new_bookmarks_category)&&($request->new_bookmarks_category)){
            $bookmarkcategory=BookmarksLinkCategory::query()->where(['bookmarks_category' => $request->new_bookmarks_category])->first();
            if(!$bookmarkcategory) {
                $bookmarkcategory = BookmarksLinkCategory::create(['bookmarks_category' => $request->new_bookmarks_category]);
            }
            $data=array_merge($data,['bookmarks_category_id'=>$bookmarkcategory->id]);
        }
        BookmarksLink::create($data);
        return back()->with('success','Bookmark Link Url Save Successfully.');
    }
}
