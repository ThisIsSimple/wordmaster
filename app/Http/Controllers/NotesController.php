<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $new_note = \App\Note::create();

        $json = [
            'status'=>'success',
            'note_id'=>$new_note->id,
            'name'=>$new_note->name,
        ];

        return json_encode($json);
    }

    public function update()
    {
        $note_id = $_GET['note_id'];
        $note_name = $_GET['note_name'];

        $note = \App\Note::find($note_id);
        $note->name = $note_name;

        $json = [];

        if($note->save()) {
            $json = [
                'status' => 'success',
                'note_id' => $note_id,
                'note_name' => $note_name
            ];
        } else {
            $json = [
                'status' => 'fail'
            ];
        }

        return json_encode($json);
    }

    public function delete()
    {
        $note_id = $_GET['note_id'];

        $note = \App\Note::find($note_id);

        if($note->delete()) {
            $json = [
                'status' => 'success',
                'note_id' => $note->id,
                'note_name' => $note->name,
            ];
        } else {
            $json = [
                'status' => 'fail'
            ];
        }

        return json_encode($json);
    }
}
