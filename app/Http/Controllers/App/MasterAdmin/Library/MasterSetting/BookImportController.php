<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\MasterAdmin\Library\Author;
use App\Models\MasterAdmin\Library\Book;
use App\Models\MasterAdmin\Library\Library;
use App\Models\MasterAdmin\Library\LibraryCategory;
use App\Models\MasterAdmin\Library\LibraryGenre;
use App\Models\MasterAdmin\Library\Racks;
use App\Models\MasterAdmin\Library\Tag;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookImportController extends Controller
{

    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.import-book');
    }


    public function store(Request $request)
    {
        if ($request->hasFile('import_file')) {
            ini_set('memory_limit', '-1');
            $importdata = collect(Excel::toArray(new StudentImport(), request()->file('import_file')))->shift();
            // return $importdata;
            $datainsert = [];

            foreach ($importdata as $key => $valuearr) {
                if ($key != 0) {
                    $bookdata = [];
                    foreach ($valuearr as $index => $value) {
                        $value = RelationTableCreate($importdata[0][$index], $value);
                        $bookdata[$importdata[0][$index]] = $value;
                    }

                    if (isset($bookdata['book_no']) && isset($bookdata['barcode_no'])) {
                        $book = Book::query()->where(['barcode_no' => $bookdata['barcode_no']])->first();

                        if ($book) {
                            // Update the existing record with new data
                            $book->update($bookdata);
                            $datainsert[] = $bookdata;
                        } else {
                            try {
                                // Create a new record with the data
                                // Convert any array values to strings before creating the record
                                foreach ($bookdata as $key => $value) {
                                    if (is_array($value)) {
                                        $bookdata[$key] = implode(',', $value); // Convert array to string
                                    }
                                }
                                $book = Book::create($bookdata);
                                $datainsert[] = $bookdata;
                            } catch (\Exception $e) {
                                // Handle any exceptions that occur during creation
                                return back()->with('danger', 'Error creating new record: ' . $e->getMessage());
                            }
                        }
                    }
                }
            }

            return back()->with('success', 'Record Save Successful Complete');
        } else {
            return back()->with('danger', 'No file uploaded');
        }
    }



    public function custommodify(Request $request)
    {
        if ($request->hasFile('import_file')) {
            ini_set('memory_limit', '-1');
            //ini_set('max_execution_time', '90000');
            $importdata=collect(Excel::toArray(new StudentImport(),request()->file('import_file')))->shift();
            $datainsert=[];
            $row=0;
            foreach ($importdata as $key=>$valuearr){
                if($key!=0) {
                    //$bookdata = ['school_id'=>auth()->user()->school_id,'branches_id'=>auth()->user()->branches_id,'user_id'=>auth()->user()->id];
                    $bookdata=[];
                    foreach ($valuearr as $key => $value) {
                        $value=RelationTableCreate($importdata[0][$key],$value);
                        $bookdata = array_merge($bookdata, [$importdata[0][$key] => $value]);
                    }
                    try {

                        if(isset($bookdata['book_no'])&&(isset($bookdata['barcode_no']))&&($bookdata['book_no'])&&($bookdata['barcode_no'])&&($bookdata)){
                            if(!empty($bookdata['book_no'])) {
                                $book = Book::query()->where(['barcode_no' => $bookdata['barcode_no']])->first();
                                if($book) {
                                    $book->update($bookdata);
                                    if ($book) {
                                        $row++;
                                        echo "<b> $row - Update</b><br/>";
                                    } else {
                                        echo "<b style='color:red;'>Fail</b><br/>";
                                    }
                                }
                            }
                        }
                    }catch (\Exception $e){
                        echo $e;
                    }



                    $datainsert[] = $bookdata;
                    //$book=Book::insert($bookdata);

                }
            }
            try {

                // return back()->with('success','Record Save Successful Complete');
            }catch (\Exception $e){
                //return back()->with('danger','Sorry, Request failed, Please try again');
            }
            //create book
        }
    }


}

//create relation table
function RelationTableCreate($column,$value)
{
    if($value) {
        switch ($column) {
            case ($column == 'author_id'):
                $author = Author::query()->where('author', $value)->record()->first();
                if ($author) {
                return $author->id;
                }
                break;

            case ($column == 'racks'):
                $rack = Racks::query()->where('racks', $value)->record()->first();
                if ($rack) {

                return $rack->id;
            }
                break;

            case ($column == 'library_id'):
                $library = Library::query()->where('library_name', $value)->record()->first();
                if ($library) {
                return $library->id;
                }
                break;

            case ($column == 'item_category_id'):
                $librarycategory = LibraryCategory::query()->where('item_category', $value)->record()->first();
                if ($librarycategory) {
                return $librarycategory->id;
            }
                break;

            case ($column == 'tag_id'):
                $tag = Tag::query()->where('tag', $value)->record()->first();
                if ($tag) {
                return $tag->id;
            }
                break;

            case ($column == 'genre_id'):
                // $value = explode(":", $value);
                // if(isset($value[0])){$genre = $value[0];}else{$genre = "";}
                // if(isset($value[1])){$booktype = $value[1];}else{$booktype = "";}

                $genre = LibraryGenre::query()->where('genre', $value)->record()->first();
                if ($genre) {
                return $genre->id;
                }
                break;

            case ($column == 'subject'):
                $subject = Subject::query()->where('subject_name', $value)->record()->first();
                if ($subject) {

                return $subject->id;
            }
                break;

            default:
                return $value;
                break;
        }
    }
    return $value;
}
