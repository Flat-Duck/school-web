<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\TimeTable;
use App\Http\Controllers\Controller;
use App\Room;
use App\Subject;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class TimeTableController extends Controller
{
    /**
 * Display a list of Services.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $time_tables = TimeTable::getList();

    return view('admin.time_tables.index', compact('time_tables'));
}

/**
 * Show the form for creating a new TimeTable
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $subjects = Subject::all();
    $rooms = Room::all();
    $grades = Grade::all();
    $periods = TimeTable::periods();
    $days = TimeTable::days();
    
    return view('admin.time_tables.add',compact('subjects','rooms','grades','days','periods'));
}

/**
 * Show the form for creating a new TimeTable
 *
 * @return \Illuminate\Http\Response
 */
public function add_period(TimeTable $time_table)
{
    $subjects = Subject::all();
    $rooms = Room::all();
    $grades = Grade::all();
    $periods = TimeTable::periods();
    $days = TimeTable::days();
    
    return view('admin.time_tables.add_period',compact('time_table', 'subjects','rooms','grades','days','periods'));
}
/**
 * Save new TimeTable
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store_period(TimeTable $time_table, Request $request)
{
    //dd($request->all());

    $validatedData = request()->validate(TimeTable::PeriodValidationRules());
    $subject = Subject::find($request->subject_id);

    $time_table->subjects()->attach($subject, ['day'=> $validatedData['day'], 'period' => $validatedData['period']]);
    //$time_table = TimeTable::create($validatedData);
    return redirect()->route('admin.time_tables.show',['time_table'=>$time_table])->with([
            'type' => 'success',
            'message' => 'TimeTable added'
        ]);

}
/**
 * Save new TimeTable
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function store()
{
    $validatedData = request()->validate(TimeTable::validationRules());
    $time_table = TimeTable::create($validatedData);
    return redirect()->route('admin.time_tables.index')->with([
            'type' => 'success',
            'message' => 'TimeTable added'
        ]);

}

/**
 * Show the specified TimeTable
 *
 * @param \App\TimeTable $time_table
 * @return \Illuminate\Http\Response
 */
public function show(TimeTable $time_table)
 {
//     $subjects = Subject::all();
//     $rooms = Room::all();
//     $grades = Grade::all();
//     $periods = TimeTable::periods();
//     $days = TimeTable::days();
    return view('admin.time_tables.show', compact('time_table'));
}

/**
 * Show the form for editing the specified TimeTable
 *
 * @param \App\TimeTable $time_table
 * @return \Illuminate\Http\Response
 */
public function edit(TimeTable $time_table)
{
    $subjects = Subject::all();
    $rooms = Room::all();
    $grades = Grade::all();
    $periods = TimeTable::periods();
    $days = TimeTable::days();
    return view('admin.time_tables.edit', compact('time_table','rooms','grades','days','periods'));
}

/**
 * Update the TimeTable
 *
 * @param \App\TimeTable $time_table
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(TimeTable $time_table)
{
    $validatedData = request()->validate(
        TimeTable::validationRules($time_table->id)
    );

    $time_table->update($validatedData);

    return redirect()->route('admin.time_tables.index')->with([
        'type' => 'success',
        'message' => 'TimeTable Updated'
    ]);
}

/**
 * Delete the TimeTable
 *
 * @param \App\TimeTable $time_table
 * @return void
 */
public function destroy(TimeTable $time_table)
{
    $time_table->delete();
    return redirect()->route('admin.time_tables.index')->with([
        'type' => 'success',
        'message' => 'TimeTable deleted successfully'
    ]);
}
}
