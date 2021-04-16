<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Answer;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\FormCreateRequest;
use App\Exports\AnswerExport;
use Illuminate\Support\Str;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Form::with('author')->withCount('sheets');

        if($request->has('search')) {
            $query->search($request->search);
        }


        if($request->sort) {
            foreach ($request->sort as $field => $value) {
                $query->orderBy($field, $value);
            }
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        return response($query->paginate($request->limit ?? 15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCreateRequest $request)
    {
        $form = Form::create($request->all());

        if($request->has('questions'))
        {
            foreach ($request->input('questions') as $question) {

                $_question = $form->questions()->save(new Question($question));

                if(isset($question['options']))
                {
                    foreach ($question['options'] as $option) {

                        $option = $_question->options()->save(new Option($option));

                    }
                }
            }
        }

        return response($form, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        return response($form->load('questions.options')->loadCount('sheets'), 200);
    }

    public function update(Request $request, Form $form)
    {
        $form->update($request->all());

        return response($form, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }

    public function download(Form $form)
    {
        return \Excel::download(new AnswerExport($form),Str::snake($form->name) . '.xlsx');
    }
}
