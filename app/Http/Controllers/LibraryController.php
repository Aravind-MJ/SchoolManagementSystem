<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Encrypt;
use App\Library;

class LibraryController extends Controller {

    protected $library;

    public function __construct(Library $library) {

        $this->library = $library;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //Select all records from Library table    
        $allBooks = $this->library
                ->orderBy('library.created_at', 'DESC')
                ->get();

        foreach ($allBooks as $book) {
            $book->enc_id = Encrypt::encrypt($book->id);
        }

        return View('library.list_book', compact('allBooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('Library.add_book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\LibraryRequest $request) {
        try {
            $library = $this->library;
            $library->bookno = $request['bookno'];
            $library->title = $request['title'];
            $library->author = $request['author'];
            $library->edition = $request['edition'];           
            $library->subject = $request['subject'];
            $library->publisher = $request['publisher'];
            $library->quantity = $request['quantity'];
            $library->bookcost = $request['bookcost'];
            $library->language = $request['language'];
            $library->save();
        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Unable to add book!!')->withType('danger');
        }
        return redirect::back()
                        ->withFlashMessage('Book Added successfully!')
                        ->withType('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        try {
            $enc_id = $id;
            $id = Encrypt::decrypt($id);
            $book = $this->library
                    ->where('id', '=', $id)
                    ->first();
            $book->enc_id = Encrypt::encrypt($book->id);
        } catch (Exception $ex) {
            return redirect()->back()->withFlashMessage('Book not found!!')->withType('danger');
        }
        return View('Library.edit_book', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Requests\LibraryRequest $request) {
        try {
            $enc_id = $id;
            $id = Encrypt::decrypt($id);
            $library = Library::find($id);
            $library->bookno = $request['bookno'];
            $library->title = $request['title'];
            $library->author = $request['author'];
            $library->edition = $request['edition'];           
            $library->subject = $request['subject'];
            $library->publisher = $request['publisher'];
            $library->quantity = $request['quantity'];
            $library->bookcost = $request['bookcost'];
            $library->language = $request['language'];
            $library->save();
        } catch (Exception $ex) {
            return redirect()->back()
                            ->withFlashMessage('Book not found!')
                            ->withType('danger');
        }
        return redirect()->route('Library.index')
                        ->withFlashMessage('Book Updated successfully!')
                        ->withType('success');
    }
    
    public function issueBook() {
        
        return View('Library.issue_book');
    }
    
    public function filterStudent() {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        /*$enc_id = $id;
        $id = Encrypt::decrypt($id);*/
        $book = new Library;
        $book::findOrFail($id)->delete();
        return redirect()->route('Library.index')
                        ->withFlashMessage('Book Deleted successfully!')
                        ->withType('success');
    }

}
