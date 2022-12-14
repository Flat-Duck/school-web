<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $rooms = Room::getList();

    return view('admin.rooms.index', compact('rooms'));
}

/**
 * Show the form for creating a new Room
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $grades = Grade::all();
    return view('admin.rooms.add',compact('grades'));
}

/**
 * Save new Room
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate([
        'name' =>  ['required', Rule::unique('rooms')->where('grade_id', request()->grade_id) ],
        'grade_id' => 'required|numeric',
    ]); 
    
    $room = Room::create($validatedData);    
    return redirect()->route('admin.rooms.index')->with([
            'type' => 'success',
            'message' => 'تمت الاضافة بنجاح'
        ]);

}

/**
 * Show the form for editing the specified Room
 *
 * @param \App\Room $room
 * @return \Illuminate\Http\Response
 */
public function edit(Room $room)
{
    $grades = Grade::all();
    return view('admin.rooms.edit', compact('room','grades'));
}

/**
 * Update the Room
 *
 * @param \App\Room $room
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Room $room)
{
    $validatedData = request()->validate(
        Room::validationRules($room->id)
    );

    $room->update($validatedData);

    return redirect()->route('admin.rooms.index')->with([
        'type' => 'success',
        'message' => 'تم التعديل بنجاج'
    ]);
}

/**
 * Delete the Room
 *
 * @param \App\Room $room
 * @return void
 */
public function destroy(Room $room)
{
    $room->delete();
    return redirect()->route('admin.rooms.index')->with([
        'type' => 'success',
        'message' => 'تم الحذف بنجاح'
    ]);
}
}
