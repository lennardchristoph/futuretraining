<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<style>
    .page-break {
        page-break-after: always;
    }

    /*
    .start-page {
        position: relative;
        width: 100%;
        background-image: url('{{ asset('assets/img/pdf/background/background-image.jpg')}}');
        background-size: cover;
        opacity: 0.7;
        color: white;
    }*/

</style>
<body style="">
<div class="container start-page" style="width: 21cm; height: 29.7cm;">
    <h1 class="text-center">Ernährungsplan</h1>
    <h3 class="text-center">für</h3>
    <h2 class="text-center bold">{{$athlete->surname}} {{$athlete->lastname}}</h2>
    <div class="row">
        <div class="col-lg-6 text-center">
            <h3>Plan von:</h3>
            {{$plan->start_date}}
        </div>
        <div class="col-lg-6 text-center">
            <h3>Plan bis:</h3>
            {{$plan->end_date}}
        </div>
    </div>
</div>
<div class="page-break">
</div>
@foreach($days as $day => $meals)
<div class="container" style="width: 21cm; height: 29.7cm;">
    <h1 class="text-center">Tag {{$day+1}}</h1>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="sort">Mahlzeit</th>
                <th scope="col" class="sort">KCAL</th>
                <th scope="col" class="sort">Carbs</th>
                <th scope="col" class="sort">Protein</th>
                <th scope="col" class="sort">Fat</th>
                <th scope="col" class="sort text-right">Menge [g]</th>
            </tr>
            </thead>
            @foreach($meals as $meal)
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">@if($meal['daytime'] == 'am')Frühstück @elseif($meal['daytime'] == 'an')Mittag @elseif($meal['daytime'] =='ev')Abendessen @endif - {{$meal[$locale.'_title']}}</th>
                <th scope="col" class="sort text-underline"><u>{{$meal[1][0]}}</u></th>
                <th scope="col" class="sort text-underline"><u>{{$meal[1][1]}}</u></th>
                <th scope="col" class="sort text-underline"><u>{{$meal[1][2]}}</u></th>
                <th scope="col" class="sort text-underline"><u>{{$meal[1][3]}}</u></th>
                <th scope="col" class="sort text-right"></th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($meal[0] as $ing)
            <tr>
                <th scope="col" class="sort">{{$ing->$localeName}}</th>
                <th scope="col" class="sort">{{$ing->kcal}}</th>
                <th scope="col" class="sort">{{$ing->carbs}}</th>
                <th scope="col" class="sort">{{$ing->protein}}</th>
                <th scope="col" class="sort">{{$ing->fat}}</th>
                <th scope="col" class="sort text-right">{{$ing->final_amount}}</th>
            </tr>
            @endforeach
            </tbody>
            @endforeach
        </table>
    </div>
</div>
<div class="page-break">
</div>
@endforeach

<div class="page-break">
</div>
<div class="container" style="width: 21cm; height: 29.7cm;">
    <h1 class="mb-4 text-center">Einkaufsliste</h1>
    <ul class="list-group">
        @foreach($ingredients as $ing)
        <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="pull-left">{{$ing->$localeName}}</div>
                <div class="pull-right">{{$ing->final_amount}} {{App\Models\Ingredient::unit($ing->unit)->short}}</div>
        </li>
        @endforeach

    </ul>
</div>

</body>
</html>
