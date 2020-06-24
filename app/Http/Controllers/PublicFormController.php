<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Requests\SheetCreateRequest;

class PublicFormController extends Controller
{
    public function show(Form $form) {

        return view('form',compact('form'));
    }

    public function store(SheetCreateRequest $request, Form $form) {

        // return

    }
}
