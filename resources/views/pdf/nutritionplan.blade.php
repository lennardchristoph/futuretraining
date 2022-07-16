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


</style>
<body style="">
<a href="{{ route('planPDF',['download'=>'pdf']) }}">Download PDF</a>
<div class="container" style="width: 21cm; height: 29.7cm; background-color: lightgrey">
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
<div class="container" style="width: 21cm; height: 29.7cm;">
    @foreach($meals as $key => $m)
    <h1 class="text-center">Tag 1</h1>
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
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">Frühstück - Nudeln mit Tomatensauce</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-right"></th>
            </tr>
            </thead>
            <tbody class="list">
            <tr>
                <th scope="col" class="sort">Nudeln</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
            </tr>
            <tr>
                <th scope="col" class="sort">Tomatensauce</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">150</th>
            </tr>
            </tbody>
        </table>
    </div>
    @endforeach
</div>

<div class="page-break">
</div>
<div class="container" style="width: 21cm; height: 29.7cm;">
    <h1 class="text-center">Tag 1</h1>
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
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">Frühstück - Nudeln mit Tomatensauce</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-underline">400</th>
                <th scope="col" class="sort text-right"></th>
            </tr>
            </thead>
            <tbody class="list">
                <tr>
                    <th scope="col" class="sort">Nudeln</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                </tr>
                <tr>
                    <th scope="col" class="sort">Tomatensauce</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">200</th>
                    <th scope="col" class="sort">150</th>
                </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">Mittagessen - Nudeln mit Tomatensauce</th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort text-right"></th>
            </tr>
            </thead>
            <tbody class="list">
            <tr>
                <th scope="col" class="sort">Nudeln</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
            </tr>
            <tr>
                <th scope="col" class="sort">Tomatensauce</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">150</th>
            </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">Mittagessen - Nudeln mit Tomatensauce</th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort"></th>
                <th scope="col" class="sort text-right"></th>
            </tr>
            </thead>
            <tbody class="list">
            <tr>
                <th scope="col" class="sort">Nudeln</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
            </tr>
            <tr>
                <th scope="col" class="sort">Tomatensauce</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">200</th>
                <th scope="col" class="sort">150</th>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="page-break">
</div>
<div class="container" style="width: 21cm; height: 29.7cm;">
    <h1 class="mb-4 text-center">Einkaufsliste</h1>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Cras justo odio
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Dapibus ac facilisis in
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Morbi leo risus
        </li>
    </ul>
</div>

</body>
</html>
