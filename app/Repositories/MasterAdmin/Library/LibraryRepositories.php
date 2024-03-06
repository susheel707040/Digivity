<?php


namespace App\Repositories\MasterAdmin\Library;

use App\Models\MasterAdmin\Library\Author;
use App\Models\MasterAdmin\Library\Book;
use App\Models\MasterAdmin\Library\Library;
use App\Models\MasterAdmin\Library\LibraryCategory;
use App\Models\MasterAdmin\Library\LibraryEntryRecord;
use App\Models\MasterAdmin\Library\LibraryGenre;
use App\Models\MasterAdmin\Library\Racks;
use App\Models\MasterAdmin\Library\Tag;
use App\Repositories\MasterAdmin\RepositoryContract;

class LibraryRepositories extends RepositoryContract
{

    public function libraryitemcategorylist($search=null,$addonrelation=null)
    {
        return LibraryCategory::query()->search($search)->record()->get();
    }

    public function rackslist($search=null,$addonrelation=null)
    {
        return Racks::query()->search($search)->record()->get();
    }

    public function authorlist($search=null,$addonrelation=null)
    {
        return Author::query()->search($search)->record()->get();
    }

    public function taglist($search=null,$addonrelation=null)
    {
        return Tag::query()->search($search)->record()->get();
    }

    public function genrelist($search=null,$addonrelation=null)
    {
        return LibraryGenre::query()->search($search)->record()->get();
    }

    public function librarylist($search=null,$addonrelation=null)
    {
        return Library::query()->search($search)->record()->get();
    }

    public function booksearchlist($search=null,$addonrelation=null,$limit=null)
    {
        if(!$limit){$limit=50;}
        return Book::query()->search($search)->with(['author'])->record()->limit($limit)->get();
    }

    public function bookentrylist($search=null,$addonrelation=null,$limit=null)
    {
        return LibraryEntryRecord::query()->search($search,$addonrelation)->record()->get();
    }

}
