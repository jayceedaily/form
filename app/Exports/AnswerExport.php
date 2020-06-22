<?php

namespace App\Exports;

use App\Models\Answer;
use App\Models\Sheet;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnswerExport implements FromArray,ShouldAutoSize
{
    private $form;

    public function __construct($form)
    {
        $this->form = $form;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        $sheets = Sheet::where('form_id', $this->form->id)->get();

        $questions = Question::where('form_id', $this->form->id)->get();

        $rows = [];

        $_tmp = [];

        foreach($questions as $question)
        {
            $_tmp[] = $question->content;
        }

        $rows[] = $_tmp;

        $_tmp = [];

        foreach($sheets as $sheet)
        {
            foreach($sheet->answers as $answer)
            {
                $_tmp[] = $answer->content;
            }

            $rows[] = $_tmp;

            $_tmp = [];

        }

        return $rows;

    }
}
