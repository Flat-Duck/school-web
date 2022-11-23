<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $notes = Note::getList();

    return view('admin.notes.index', compact('notes'));
}

/**
 * Show the form for creating a new Note
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $students = Student::all();
    return view('admin.notes.add',compact('students'));
}

/**
 * Save new Note
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate(Note::validationRules());
    $note = Note::create($validatedData);
    return redirect()->route('admin.notes.index')->with([
            'type' => 'success',
            'message' => 'Note added'
        ]);

}

/**
 * Show the form for editing the specified Note
 *
 * @param \App\Note $note
 * @return \Illuminate\Http\Response
 */
public function edit(Note $note)
{
    $students = Student::all();
    return view('admin.notes.edit', compact('note','students'));
}

/**
 * Update the Note
 *
 * @param \App\Note $note
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Note $note)
{
    $validatedData = request()->validate(
        Note::validationRules($note->id)
    );

    $note->update($validatedData);

    return redirect()->route('admin.notes.index')->with([
        'type' => 'success',
        'message' => 'Note Updated'
    ]);
}

/**
 * Delete the Note
 *
 * @param \App\Note $note
 * @return void
 */
public function destroy(Note $note)
{
    $note->delete();
    return redirect()->route('admin.notes.index')->with([
        'type' => 'success',
        'message' => 'Note deleted successfully'
    ]);
}
}
