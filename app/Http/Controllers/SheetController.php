<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Sheet;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\SheetCreateRequest;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SheetCreateRequest $request, Form $form)
    {
        $sheet = $form->sheets()->save(new Sheet);

        if($request->has('questions'))
        {
            foreach($request->input('questions') as $id => $answer)
            {
                $sheet->answers()->save(new Answer(array_merge($answer,['question_id' => $id ])));
            }
        }


        return response($sheet->load('answers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Sheet $sheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sheet $sheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet)
    {
        //
    }
}
