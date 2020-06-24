<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$form->name}}</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    {{-- <style>
        .is-primary {
            background-color: {{$form->color}} !important;
        }
    </style> --}}

</head>
<body>


    <section class="section">
        <div class="columns">
            <div class="column is-12">
                <div class="card">
                    <div class="card-content">
                        <form id="sheetForm" action="{{url('api/form/'.$form->id.'/sheet')}}" method="POST">

                            @foreach ($form->questions as $question)

                                @if(isset(request()->query('questions')[$question->id]))

                                    <input type="hidden" name="questions[{{$question->id}}][content]" value="{{request()->query('questions')[$question->id]['content']}}">
                                    @php
                                        continue
                                    @endphp
                                @endif

                                <div class="mb-10">

                                    <p><b>{{$question->content}}{{$question->is_required ? '*' : ''}}</b></p>


                                        @switch($question->type)
                                            @case('radio')

                                                @foreach ($question->options as $option)
                                                    <label for="">
                                                        <input type="radio" name="questions[{{$question->id}}][content]" id="" value="{{$option->content}}">
                                                        {{$option->content}}
                                                    </label>

                                                    <p>

                                                    </p>

                                                @endforeach


                                                @break
                                            @case('checkbox')

                                                @break

                                            @case('select')

                                                @break
                                            @default

                                                <input class="input" type="text" name="questions[{{$question->id}}][content]" id="">
                                        @endswitch
                                        <span class="has-text-danger" id="error-questions_{{$question->id}}"></span>

                                </div>
                                <hr>
                            @endforeach

                            <button class="button is-primary" type="submit" id="sheetSubmitButton">Submit</button>

                        </form>

                        <p class="is-size-3" id="sheetSubmitted">Your feedback has been submitted.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
<script>

$(document).ready(function() {

        $('#sheetSubmitted').hide();

        $('#sheetForm').submit(function(e){
            e.preventDefault();

            console.log('submitting');

            let data    = $(this).serializeArray();
            let url     = $(this).attr('action');
            let method     = $(this).attr('method');

            $('#sheetSubmitButton').addClass('is-loading')

            $.ajax({
                url,
                data,
                method,

                error: function(response) {

                    $("div[id^='error-'],span[id^='error-']").empty();

                    $.each(response.responseJSON, function(field, message) {

                        let _field = field.split('.').join('_');
                        console.log(_field);

                        $(`#error-${_field}`).html(message
                                .join(' ,'))
                            .removeClass('animated shake')
                            .width('auto').addClass('animated shake');
                    });
                },

                success: function() {
                    $('#sheetForm').hide();
                    $('#sheetSubmitted').show();
                },

                complete: function() {
                    $('#sheetSubmitButton').removeClass('is-loading')
                }
            });
        })
})


</script>
