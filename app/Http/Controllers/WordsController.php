<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index()
    {
        return __METHOD__;
    }

    public function create()
    {
        $note_id = $_GET['note_id'];

        if (empty($note_id)) {
            $note_id = 0;
        }

        $note_id = (int)$note_id;

        $new_note = \App\Note::find($note_id)->words()->create([
            'note_id' => $note_id
        ]);

        if ($new_note) {
            $json = [
                'status' => 'success',
                'note_id' => $new_note->note_id,
                'word_id' => $new_note->id,
            ];
        } else {
            $json = [
                'status' => 'fail'
            ];
        }

        return json_encode($json);
    }

    public function update()
    {
        $json = [];

        $word_id = $_GET['word_id'];
        $word_word = $_GET['word'];
        $word_meaning = $_GET['meaning'];
        $word_type = $_GET['type'];

        $word_id = (int)$word_id;

        $word = \App\Word::find($word_id);

        $word->word = $word_word;
        $word->meaning = $word_meaning;
        $word->type = $word_type;

        $word->save();

        $json = [
            'word_id' => $word_id,
            'word' => $word_word,
            'meaning' => $word_meaning,
            'type' => $word_type
        ];

        return json_encode($json);
    }

    public function delete()
    {
        $word_id = $_GET['word_id'];

        $word = \App\Word::find($word_id);

        if ($word->delete()) {
            $json = [
                'status' => 'success'
            ];
        } else {
            $json = [
                'status' => 'fail'
            ];
        }

        return json_encode($json);
    }
}
