<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $notes = App\Note::get();
    $words = App\Word::get();

    return view('word', [
        'notes' => $notes,
        'words' => $words,
    ]);
});


//Route::get('words/create', 'WordsController@create');
Route::get('words/create', function() {
    $new_note = App\Note::create();

    $json = [
        'status'=>'success',
        'note_id'=>$new_note->id,
        'name'=>$new_note->name,
    ];

    return json_encode($json);
});
Route::get('words/update', 'WordsController@update');
Route::get('words/delete', 'WordsController@delete');

Route::get('note/create', 'NotesController@create');
Route::get('note/update', 'NotesController@update');
Route::get('note/delete', 'NotesController@delete');

Route::get('login', function() {
    return view('login');
});


//Route::resource('/words', 'WordsController');