<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$form->name}}</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        .is-primary {
            background-color: {{$form->color}} !important;
        }
    </style>

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

                                    <p><b>{{$question->content}}</b></p>


                                        @switch($question->type)
                                            @case('radio')

                                                @foreach ($question->options as $option)
                                                    <label for="">
                                                        <input type="radio" name="questions[{{$question->id}}][content]" id="" value="{{$option->content}}">
                                                        {{$option->content}}
                                                    </label>
                                                @endforeach


                                                @break
                                            @case('checkbox')

                                                @break

                                            @case('select')

                                                @break
                                            @default

                                                <input class="input" type="text" name="questions[{{$question->id}}][content]" id="">
                                        @endswitch
                                </div>
                                <hr>
                            @endforeach

                            <button class="button is-primary" type="submit">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
<script
			  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
			  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
			  crossorigin="anonymous"></script>
<script>


$('#sheetForm').submit(function(e){
    e.preventDefault();

    console.log('submitting');

    let form = $(this).serializeArray();

    console.log(form);
})


</script>
