<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/interactive-map.css') }}" rel="stylesheet">
    <title>Covid Timelapse</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

</head>

<body class="antialiased">

    <header class="header" id="header">
        <nav class="nav container2" style="margin-top: 13px">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ url('/') }}" style="font-size: 16px" class="nav__link active-link">Accueil</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('/carte') }}" style="font-size: 16px" class="nav__link">Carte des régions</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('/departement') }}" style="font-size: 16px" class="nav__link">Carte des départements</a>
                    </li>
                </ul>

                <i class="ri-close-line nav__close" id="nav-close"></i>
            </div>

            <div class="nav__toggle" style="margin-left: 10px; font-size: medium;" id="nav-toggle">
                <i class="ri-function-line"></i>
            </div>
        </nav>
    </header>

    <main class="main" style="margin-top: -48px;">
        <!--==================== HOME ====================-->
        <section class="home" id="home" style="max-width: 100%; padding: 0">
            <img class="img-fluid" src="{{ asset('img/covid.png') }}" alt="" class="home__img">
            </div>
        </section>

        <!-- tableau bilan de la journée sur toute la france en fonction de la date selectionnée-->

        <section class="sec">
            <table style="width: 70%; margin: auto;">
                <thead style="background: #000; color: #fff; text-align: left;">
                    <tr style=" width: 100%;">
                        <th style=" background: #000; color: #fff;text-align: left;  box-sizing: border-box;padding: 15px;">Date</th>
                        <th style=" background: #000; color: #fff;text-align: left;  box-sizing: border-box;padding: 15px;">Nombre de Decès</th>
                        <th style=" background: #000; color: #fff;text-align: left;  box-sizing: border-box;padding: 15px;">Nombre d'Hospitalisations</th>
                        <th style=" background: #000; color: #fff;text-align: left;  box-sizing: border-box;padding: 15px;">Nombre de Guérisons</th>
                    </tr>
                </thead>
                <tbody style="text-align: left;">
                    <tr style=" width: 100%;">
                        <th style="background: #eee; box-sizing: border-box;padding: 15px;"> {{$departement[0]->date}}</th>
                        <td style="border: #000000;border-style: groove;border-width: thin;padding: 15px;  box-sizing: border-box;">{{$departement->sum('deces')}}</td>
                        <td style="border: #000000;border-style: groove;border-width: thin;padding: 15px;  box-sizing: border-box;">{{$departement->sum('hospitalises')}}</td>
                        <td style="border: #000000;border-style: groove;border-width: thin;padding: 15px;  box-sizing: border-box;">{{$departement->sum('gueris')}}</td>

                    </tr>
                </tbody>
            </table>
        </section>

        <!-- création du datepicker pour changer la date grâce à la fonction load_day et d'un bouton permettant de faire le timelapse avec la fonction timelapse. -->

        <div style="margin-left: 35px;">
            <h4 style="margin-left: 5px; font-size: 20px; margin-bottom: 14px;">Selectionnez une date :</h4>
            <div class="searchbox-wrap">
                <input class="date form-control" type="text" value="{{$departement[0]->date}}">
                <button onclick="load_day();" type="submit" name="submit" id="submit"><span>Valider</span> </button>
                </div>
            <button style = "margin-top: 40px"class="button" type="submit" name="submit" id="submit" onclick="timelapse();">Timelapse</button>
        </div>



        <!-- Mise en place de la carte département par département et vérification du nombre d'hospitalisé afin de crée une échelle de couleur sur la carte -->

        <section class="interactive-map" id="carte">
            <div class="map">
                <svg id="map_dep" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 667 578" xml:space="preserve">
                    <g data-nom="Guadeloupe">

                        @if ($departement[96]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Guadeloupe" data-nom="Guadeloupe" data-numerodepartement="971" class="region-01 departement departement-971 departement-guadeloupe" d="M35.87,487.13l0.7,7.2l-4.5-1.1l-2,1.7l-5.8-0.6l-1.7-1.2l4.9,0.5l3.2-4.4L35.87,487.13z M104.87,553.63 l-4.4-1.8l-1.9,0.8l0.2,2.1l-1.9,0.3l-2.2,4.9l0.7,2.4l1.7,2.9l3.4,1.2l3.4-0.5l5.3-5l-0.4-2.5L104.87,553.63z M110.27,525.53 l-6.7-2.2l-2.4-4.2l-11.1-2.5l-2.7-5.7l-0.7-7.7l-6.2-4.7l-5.9,5.5l-0.8,2.9l1.2,4.5l3.1,1.2l-1,3.4l-2.6,1.2l-2.5,5.1l-1.9-0.2 l-1,1.9l-4.3-0.7l1.8-0.7l-3.5-3.7l-10.4-4.1l-3.4,1.6l-2.4,4.8l-0.5,3.5l3.1,9.7l0.6,12l6.3,9l0.6,2.7c3-1.2,6-2.5,9.1-3.7l5.9-6.9 l-0.4-8.7l-2.8-5.3l0.2-5.5l3.6,0.2l0.9-1.7l1.4,3.1l6.8,2l13.8-4.9L110.27,525.53z">
                            </path>
                            @endif
                            @if ($departement[96]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Guadeloupe" data-nom="Guadeloupe" data-numerodepartement="971" class="region-01 departement departement-971 departement-guadeloupe" d="M35.87,487.13l0.7,7.2l-4.5-1.1l-2,1.7l-5.8-0.6l-1.7-1.2l4.9,0.5l3.2-4.4L35.87,487.13z M104.87,553.63 l-4.4-1.8l-1.9,0.8l0.2,2.1l-1.9,0.3l-2.2,4.9l0.7,2.4l1.7,2.9l3.4,1.2l3.4-0.5l5.3-5l-0.4-2.5L104.87,553.63z M110.27,525.53 l-6.7-2.2l-2.4-4.2l-11.1-2.5l-2.7-5.7l-0.7-7.7l-6.2-4.7l-5.9,5.5l-0.8,2.9l1.2,4.5l3.1,1.2l-1,3.4l-2.6,1.2l-2.5,5.1l-1.9-0.2 l-1,1.9l-4.3-0.7l1.8-0.7l-3.5-3.7l-10.4-4.1l-3.4,1.6l-2.4,4.8l-0.5,3.5l3.1,9.7l0.6,12l6.3,9l0.6,2.7c3-1.2,6-2.5,9.1-3.7l5.9-6.9 l-0.4-8.7l-2.8-5.3l0.2-5.5l3.6,0.2l0.9-1.7l1.4,3.1l6.8,2l13.8-4.9L110.27,525.53z">
                            </path> @endif
                            @if ($departement[96]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Guadeloupe" data-nom="Guadeloupe" data-numerodepartement="971" class="region-01 departement departement-971 departement-guadeloupe" d="M35.87,487.13l0.7,7.2l-4.5-1.1l-2,1.7l-5.8-0.6l-1.7-1.2l4.9,0.5l3.2-4.4L35.87,487.13z M104.87,553.63 l-4.4-1.8l-1.9,0.8l0.2,2.1l-1.9,0.3l-2.2,4.9l0.7,2.4l1.7,2.9l3.4,1.2l3.4-0.5l5.3-5l-0.4-2.5L104.87,553.63z M110.27,525.53 l-6.7-2.2l-2.4-4.2l-11.1-2.5l-2.7-5.7l-0.7-7.7l-6.2-4.7l-5.9,5.5l-0.8,2.9l1.2,4.5l3.1,1.2l-1,3.4l-2.6,1.2l-2.5,5.1l-1.9-0.2 l-1,1.9l-4.3-0.7l1.8-0.7l-3.5-3.7l-10.4-4.1l-3.4,1.6l-2.4,4.8l-0.5,3.5l3.1,9.7l0.6,12l6.3,9l0.6,2.7c3-1.2,6-2.5,9.1-3.7l5.9-6.9 l-0.4-8.7l-2.8-5.3l0.2-5.5l3.6,0.2l0.9-1.7l1.4,3.1l6.8,2l13.8-4.9L110.27,525.53z">
                            </path> @endif
                            @if ($departement[96]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Guadeloupe" data-nom="Guadeloupe" data-numerodepartement="971" class="region-01 departement departement-971 departement-guadeloupe" d="M35.87,487.13l0.7,7.2l-4.5-1.1l-2,1.7l-5.8-0.6l-1.7-1.2l4.9,0.5l3.2-4.4L35.87,487.13z M104.87,553.63 l-4.4-1.8l-1.9,0.8l0.2,2.1l-1.9,0.3l-2.2,4.9l0.7,2.4l1.7,2.9l3.4,1.2l3.4-0.5l5.3-5l-0.4-2.5L104.87,553.63z M110.27,525.53 l-6.7-2.2l-2.4-4.2l-11.1-2.5l-2.7-5.7l-0.7-7.7l-6.2-4.7l-5.9,5.5l-0.8,2.9l1.2,4.5l3.1,1.2l-1,3.4l-2.6,1.2l-2.5,5.1l-1.9-0.2 l-1,1.9l-4.3-0.7l1.8-0.7l-3.5-3.7l-10.4-4.1l-3.4,1.6l-2.4,4.8l-0.5,3.5l3.1,9.7l0.6,12l6.3,9l0.6,2.7c3-1.2,6-2.5,9.1-3.7l5.9-6.9 l-0.4-8.7l-2.8-5.3l0.2-5.5l3.6,0.2l0.9-1.7l1.4,3.1l6.8,2l13.8-4.9L110.27,525.53z">
                            </path> @endif
                            @if ($departement[96]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Guadeloupe" data-nom="Guadeloupe" data-numerodepartement="971" class="region-01 departement departement-971 departement-guadeloupe" d="M35.87,487.13l0.7,7.2l-4.5-1.1l-2,1.7l-5.8-0.6l-1.7-1.2l4.9,0.5l3.2-4.4L35.87,487.13z M104.87,553.63 l-4.4-1.8l-1.9,0.8l0.2,2.1l-1.9,0.3l-2.2,4.9l0.7,2.4l1.7,2.9l3.4,1.2l3.4-0.5l5.3-5l-0.4-2.5L104.87,553.63z M110.27,525.53 l-6.7-2.2l-2.4-4.2l-11.1-2.5l-2.7-5.7l-0.7-7.7l-6.2-4.7l-5.9,5.5l-0.8,2.9l1.2,4.5l3.1,1.2l-1,3.4l-2.6,1.2l-2.5,5.1l-1.9-0.2 l-1,1.9l-4.3-0.7l1.8-0.7l-3.5-3.7l-10.4-4.1l-3.4,1.6l-2.4,4.8l-0.5,3.5l3.1,9.7l0.6,12l6.3,9l0.6,2.7c3-1.2,6-2.5,9.1-3.7l5.9-6.9 l-0.4-8.7l-2.8-5.3l0.2-5.5l3.6,0.2l0.9-1.7l1.4,3.1l6.8,2l13.8-4.9L110.27,525.53z">
                            </path> @endif
                    </g>

                    <g data-nom="Martinique">

                        @if ($departement[97]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Martinique" data-nom="Martinique" data-numerodepartement="972" class="region-02 departement departement-972 departement-martinique" d="m44.23,433.5l1.4-4.1l-6.2-7.5l0.3-5.8l4.8-4 l4.9-0.9l17,9.9l7,8.8l9.4-5.2l1.8,2.2l-2.8,0.8l0.7,2.6l-2.9,1l-2.2-2.4l-1.9,1.7l0.6,2.5l5.1,1.6l-5.3,4.9l1.6,2.3l4.5-1.5 l-0.8,5.6l3.7,0.2l7.6,19l-1.8,5.5l-4.1,5.1h-2.6l-2-3l3.7-5.7l-4.3,1.7l-2.5-2.5l-2.4,1.2l-6-2.8l-5.5,0.1l-5.4,3.5l-2.4-2.1 l0.2-2.7l-2-2l2.5-4.9l3.4-2.5l4.9,3.4l3.2-1.9l-4.4-4.7l0.2-2.4l-1.8,1.2l-7.2-1.1l-7.6-7L44.23,433.5z">
                            </path>
                            @endif
                            @if ($departement[97]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Martinique" data-nom="Martinique" data-numerodepartement="972" class="region-02 departement departement-972 departement-martinique" d="m44.23,433.5l1.4-4.1l-6.2-7.5l0.3-5.8l4.8-4 l4.9-0.9l17,9.9l7,8.8l9.4-5.2l1.8,2.2l-2.8,0.8l0.7,2.6l-2.9,1l-2.2-2.4l-1.9,1.7l0.6,2.5l5.1,1.6l-5.3,4.9l1.6,2.3l4.5-1.5 l-0.8,5.6l3.7,0.2l7.6,19l-1.8,5.5l-4.1,5.1h-2.6l-2-3l3.7-5.7l-4.3,1.7l-2.5-2.5l-2.4,1.2l-6-2.8l-5.5,0.1l-5.4,3.5l-2.4-2.1 l0.2-2.7l-2-2l2.5-4.9l3.4-2.5l4.9,3.4l3.2-1.9l-4.4-4.7l0.2-2.4l-1.8,1.2l-7.2-1.1l-7.6-7L44.23,433.5z">
                            </path> @endif
                            @if ($departement[97]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Martinique" data-nom="Martinique" data-numerodepartement="972" class="region-02 departement departement-972 departement-martinique" d="m44.23,433.5l1.4-4.1l-6.2-7.5l0.3-5.8l4.8-4 l4.9-0.9l17,9.9l7,8.8l9.4-5.2l1.8,2.2l-2.8,0.8l0.7,2.6l-2.9,1l-2.2-2.4l-1.9,1.7l0.6,2.5l5.1,1.6l-5.3,4.9l1.6,2.3l4.5-1.5 l-0.8,5.6l3.7,0.2l7.6,19l-1.8,5.5l-4.1,5.1h-2.6l-2-3l3.7-5.7l-4.3,1.7l-2.5-2.5l-2.4,1.2l-6-2.8l-5.5,0.1l-5.4,3.5l-2.4-2.1 l0.2-2.7l-2-2l2.5-4.9l3.4-2.5l4.9,3.4l3.2-1.9l-4.4-4.7l0.2-2.4l-1.8,1.2l-7.2-1.1l-7.6-7L44.23,433.5z">
                            </path> @endif
                            @if ($departement[97]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Martinique" data-nom="Martinique" data-numerodepartement="972" class="region-02 departement departement-972 departement-martinique" d="m44.23,433.5l1.4-4.1l-6.2-7.5l0.3-5.8l4.8-4 l4.9-0.9l17,9.9l7,8.8l9.4-5.2l1.8,2.2l-2.8,0.8l0.7,2.6l-2.9,1l-2.2-2.4l-1.9,1.7l0.6,2.5l5.1,1.6l-5.3,4.9l1.6,2.3l4.5-1.5 l-0.8,5.6l3.7,0.2l7.6,19l-1.8,5.5l-4.1,5.1h-2.6l-2-3l3.7-5.7l-4.3,1.7l-2.5-2.5l-2.4,1.2l-6-2.8l-5.5,0.1l-5.4,3.5l-2.4-2.1 l0.2-2.7l-2-2l2.5-4.9l3.4-2.5l4.9,3.4l3.2-1.9l-4.4-4.7l0.2-2.4l-1.8,1.2l-7.2-1.1l-7.6-7L44.23,433.5z">
                            </path> @endif
                            @if ($departement[97]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Martinique" data-nom="Martinique" data-numerodepartement="972" class="region-02 departement departement-972 departement-martinique" d="m44.23,433.5l1.4-4.1l-6.2-7.5l0.3-5.8l4.8-4 l4.9-0.9l17,9.9l7,8.8l9.4-5.2l1.8,2.2l-2.8,0.8l0.7,2.6l-2.9,1l-2.2-2.4l-1.9,1.7l0.6,2.5l5.1,1.6l-5.3,4.9l1.6,2.3l4.5-1.5 l-0.8,5.6l3.7,0.2l7.6,19l-1.8,5.5l-4.1,5.1h-2.6l-2-3l3.7-5.7l-4.3,1.7l-2.5-2.5l-2.4,1.2l-6-2.8l-5.5,0.1l-5.4,3.5l-2.4-2.1 l0.2-2.7l-2-2l2.5-4.9l3.4-2.5l4.9,3.4l3.2-1.9l-4.4-4.7l0.2-2.4l-1.8,1.2l-7.2-1.1l-7.6-7L44.23,433.5z">
                            </path>@endif
                    </g>

                    <g data-nom="Guyane">

                        @if ($departement[98]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Guyane" data-nom="Guyane" data-numerodepartement="973" class="region-03 departement departement-973 departement-guyane" d="m95.2,348.97l-11.7,16.4l0.3,2.4l-7.3,14.9 l-4.4,3.9l-2.6,1.3l-2.3-1.7l-4.4,0.8l0.7-1.8l-10.6-0.3l-4.3,0.8l-4.1,4.1l-9.1-4.4l6.6-11.8l0.3-6l4.2-10.8l-8.3-9.6l-2.7-8 l-0.6-11.4l3.8-7.5l5.9-5.4l1-4l4.2,0.5l-2.3-2l24.7,8.6l9.2,8.8l3.1,0.3l-0.7,1.2l6.1,4l1.4,4.1l-2.4,3.1l2.6-1.6l0.1-5.5l4,3.5 l2.4,7L95.2,348.97z">
                            </path>
                            @endif
                            @if ($departement[98]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Guyane" data-nom="Guyane" data-numerodepartement="973" class="region-03 departement departement-973 departement-guyane" d="m95.2,348.97l-11.7,16.4l0.3,2.4l-7.3,14.9 l-4.4,3.9l-2.6,1.3l-2.3-1.7l-4.4,0.8l0.7-1.8l-10.6-0.3l-4.3,0.8l-4.1,4.1l-9.1-4.4l6.6-11.8l0.3-6l4.2-10.8l-8.3-9.6l-2.7-8 l-0.6-11.4l3.8-7.5l5.9-5.4l1-4l4.2,0.5l-2.3-2l24.7,8.6l9.2,8.8l3.1,0.3l-0.7,1.2l6.1,4l1.4,4.1l-2.4,3.1l2.6-1.6l0.1-5.5l4,3.5 l2.4,7L95.2,348.97z">
                            </path> @endif
                            @if ($departement[98]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Guyane" data-nom="Guyane" data-numerodepartement="973" class="region-03 departement departement-973 departement-guyane" d="m95.2,348.97l-11.7,16.4l0.3,2.4l-7.3,14.9 l-4.4,3.9l-2.6,1.3l-2.3-1.7l-4.4,0.8l0.7-1.8l-10.6-0.3l-4.3,0.8l-4.1,4.1l-9.1-4.4l6.6-11.8l0.3-6l4.2-10.8l-8.3-9.6l-2.7-8 l-0.6-11.4l3.8-7.5l5.9-5.4l1-4l4.2,0.5l-2.3-2l24.7,8.6l9.2,8.8l3.1,0.3l-0.7,1.2l6.1,4l1.4,4.1l-2.4,3.1l2.6-1.6l0.1-5.5l4,3.5 l2.4,7L95.2,348.97z">
                            </path> @endif
                            @if ($departement[98]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Guyane" data-nom="Guyane" data-numerodepartement="973" class="region-03 departement departement-973 departement-guyane" d="m95.2,348.97l-11.7,16.4l0.3,2.4l-7.3,14.9 l-4.4,3.9l-2.6,1.3l-2.3-1.7l-4.4,0.8l0.7-1.8l-10.6-0.3l-4.3,0.8l-4.1,4.1l-9.1-4.4l6.6-11.8l0.3-6l4.2-10.8l-8.3-9.6l-2.7-8 l-0.6-11.4l3.8-7.5l5.9-5.4l1-4l4.2,0.5l-2.3-2l24.7,8.6l9.2,8.8l3.1,0.3l-0.7,1.2l6.1,4l1.4,4.1l-2.4,3.1l2.6-1.6l0.1-5.5l4,3.5 l2.4,7L95.2,348.97z">
                            </path> @endif
                            @if ($departement[98]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Guyane" data-nom="Guyane" data-numerodepartement="973" class="region-03 departement departement-973 departement-guyane" d="m95.2,348.97l-11.7,16.4l0.3,2.4l-7.3,14.9 l-4.4,3.9l-2.6,1.3l-2.3-1.7l-4.4,0.8l0.7-1.8l-10.6-0.3l-4.3,0.8l-4.1,4.1l-9.1-4.4l6.6-11.8l0.3-6l4.2-10.8l-8.3-9.6l-2.7-8 l-0.6-11.4l3.8-7.5l5.9-5.4l1-4l4.2,0.5l-2.3-2l24.7,8.6l9.2,8.8l3.1,0.3l-0.7,1.2l6.1,4l1.4,4.1l-2.4,3.1l2.6-1.6l0.1-5.5l4,3.5 l2.4,7L95.2,348.97z">
                            </path> @endif
                    </g>

                    <g data-nom="La Réunion">

                        @if ($departement[99]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="La-Réunion" data-nom="La Réunion" data-numerodepartement="974" class="region-04 departement departement-974 departement-la-reunion" d="m41.33,265.3l-6.7-8.5l1.3-6l4.1-2.4l0.7-7.9 l3.3,0.4l7.6-6.1l5.7-0.8l21,4l5,5.3v4.1l7.3,10.1l6.7,4.5l1,3.6l-3.3,7.9l0.9,9.6l-3.4,3.5l-17.3,2.9l-19.6-6.5l-3.8-3.6l-4.7-1.2 l-0.9-2.5l-3.6-2.3L41.33,265.3z">
                            </path>
                            @endif
                            @if ($departement[99]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="La-Réunion" data-nom="La Réunion" data-numerodepartement="974" class="region-04 departement departement-974 departement-la-reunion" d="m41.33,265.3l-6.7-8.5l1.3-6l4.1-2.4l0.7-7.9 l3.3,0.4l7.6-6.1l5.7-0.8l21,4l5,5.3v4.1l7.3,10.1l6.7,4.5l1,3.6l-3.3,7.9l0.9,9.6l-3.4,3.5l-17.3,2.9l-19.6-6.5l-3.8-3.6l-4.7-1.2 l-0.9-2.5l-3.6-2.3L41.33,265.3z">
                            </path> @endif
                            @if ($departement[99]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="La-Réunion" data-nom="La Réunion" data-numerodepartement="974" class="region-04 departement departement-974 departement-la-reunion" d="m41.33,265.3l-6.7-8.5l1.3-6l4.1-2.4l0.7-7.9 l3.3,0.4l7.6-6.1l5.7-0.8l21,4l5,5.3v4.1l7.3,10.1l6.7,4.5l1,3.6l-3.3,7.9l0.9,9.6l-3.4,3.5l-17.3,2.9l-19.6-6.5l-3.8-3.6l-4.7-1.2 l-0.9-2.5l-3.6-2.3L41.33,265.3z">
                            </path> @endif
                            @if ($departement[99]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="La-Réunion" data-nom="La Réunion" data-numerodepartement="974" class="region-04 departement departement-974 departement-la-reunion" d="m41.33,265.3l-6.7-8.5l1.3-6l4.1-2.4l0.7-7.9 l3.3,0.4l7.6-6.1l5.7-0.8l21,4l5,5.3v4.1l7.3,10.1l6.7,4.5l1,3.6l-3.3,7.9l0.9,9.6l-3.4,3.5l-17.3,2.9l-19.6-6.5l-3.8-3.6l-4.7-1.2 l-0.9-2.5l-3.6-2.3L41.33,265.3z">
                            </path> @endif
                            @if ($departement[99]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="La-Réunion" data-nom="La Réunion" data-numerodepartement="974" class="region-04 departement departement-974 departement-la-reunion" d="m41.33,265.3l-6.7-8.5l1.3-6l4.1-2.4l0.7-7.9 l3.3,0.4l7.6-6.1l5.7-0.8l21,4l5,5.3v4.1l7.3,10.1l6.7,4.5l1,3.6l-3.3,7.9l0.9,9.6l-3.4,3.5l-17.3,2.9l-19.6-6.5l-3.8-3.6l-4.7-1.2 l-0.9-2.5l-3.6-2.3L41.33,265.3z">
                            </path> @endif
                    </g>

                    <g data-nom="Mayotte">
                        @if ($departement[100]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Mayotte" data-nom="Mayotte" data-numerodepartement="976" class="region-06 departement departement-976 departement-mayotte" d="m57.79,157.13l11.32,5.82l-3.24,7.46l-5.66,7.52l5.66,8.37l-4.04,5.7l-5.66,8.01l5.66,4.37l-7.28,4.37l-8.09-2.73l-4.04-5.04v-4.85l-3.24-6.55l7.28,3.88l4.04,1.13v-7.14l-4.85-8.43v-14.8l-8.09-2.61l-3.24-2.67v-5.76l8.9-6.79l7.28,10.19L57.79,157.13z M78.07,164.38l-5.56,3.42l4.81,5.59l3.93-4.79L78.07,164.38z">
                            </path>
                            @endif
                            @if ($departement[100]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Mayotte" data-nom="Mayotte" data-numerodepartement="976" class="region-06 departement departement-976 departement-mayotte" d="m57.79,157.13l11.32,5.82l-3.24,7.46l-5.66,7.52l5.66,8.37l-4.04,5.7l-5.66,8.01l5.66,4.37l-7.28,4.37l-8.09-2.73l-4.04-5.04v-4.85l-3.24-6.55l7.28,3.88l4.04,1.13v-7.14l-4.85-8.43v-14.8l-8.09-2.61l-3.24-2.67v-5.76l8.9-6.79l7.28,10.19L57.79,157.13z M78.07,164.38l-5.56,3.42l4.81,5.59l3.93-4.79L78.07,164.38z">
                            </path> @endif
                            @if ($departement[100]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Mayotte" data-nom="Mayotte" data-numerodepartement="976" class="region-06 departement departement-976 departement-mayotte" d="m57.79,157.13l11.32,5.82l-3.24,7.46l-5.66,7.52l5.66,8.37l-4.04,5.7l-5.66,8.01l5.66,4.37l-7.28,4.37l-8.09-2.73l-4.04-5.04v-4.85l-3.24-6.55l7.28,3.88l4.04,1.13v-7.14l-4.85-8.43v-14.8l-8.09-2.61l-3.24-2.67v-5.76l8.9-6.79l7.28,10.19L57.79,157.13z M78.07,164.38l-5.56,3.42l4.81,5.59l3.93-4.79L78.07,164.38z">
                            </path> @endif
                            @if ($departement[100]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Mayotte" data-nom="Mayotte" data-numerodepartement="976" class="region-06 departement departement-976 departement-mayotte" d="m57.79,157.13l11.32,5.82l-3.24,7.46l-5.66,7.52l5.66,8.37l-4.04,5.7l-5.66,8.01l5.66,4.37l-7.28,4.37l-8.09-2.73l-4.04-5.04v-4.85l-3.24-6.55l7.28,3.88l4.04,1.13v-7.14l-4.85-8.43v-14.8l-8.09-2.61l-3.24-2.67v-5.76l8.9-6.79l7.28,10.19L57.79,157.13z M78.07,164.38l-5.56,3.42l4.81,5.59l3.93-4.79L78.07,164.38z">
                            </path>@endif
                            @if ($departement[100]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Mayotte" data-nom="Mayotte" data-numerodepartement="976" class="region-06 departement departement-976 departement-mayotte" d="m57.79,157.13l11.32,5.82l-3.24,7.46l-5.66,7.52l5.66,8.37l-4.04,5.7l-5.66,8.01l5.66,4.37l-7.28,4.37l-8.09-2.73l-4.04-5.04v-4.85l-3.24-6.55l7.28,3.88l4.04,1.13v-7.14l-4.85-8.43v-14.8l-8.09-2.61l-3.24-2.67v-5.76l8.9-6.79l7.28,10.19L57.79,157.13z M78.07,164.38l-5.56,3.42l4.81,5.59l3.93-4.79L78.07,164.38z">
                            </path> @endif
                    </g>

                    <g class=data-nom="Île-de-France">

                        @if ($departement[75]->hospitalises
                        <= 50) <path class="region" style="fill: green" style="fill: green" id="Paris" data-nom="Paris" data-numerodepartement="75" class="region-11 departement departement-75 departement-paris" d="M641.8,78.3l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.4-0.1l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2 l0.4-1.9l1.3-3.1l2.7-2.1l2.9-1.1l3.9,0.5h0.1l0.9-2.2l7.1-4.6l14-0.1l1.8,3.6l1.8,2.4l0.6,0.9l0.1,0.4L631,68l0.4,5.4l0.4,1.8v0.1 l-0.3,0.8l0.1,3.6l0.6-0.5l1.6-1.6l2-0.5l2-0.5L641.8,78.3z M396.8,154.7l-3.2-0.5l-2.5,1.7l3,3.5l5.3-0.1l-1.8-1.9L396.8,154.7z">
                            </path>
                            @endif
                            @if ($departement[75]->hospitalises > 50)
                            <path class="region" style="fill: yellow" style="fill: black" id="Paris" data-nom="Paris" data-numerodepartement="75" class="region-11 departement departement-75 departement-paris" d="M641.8,78.3l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.4-0.1l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2 l0.4-1.9l1.3-3.1l2.7-2.1l2.9-1.1l3.9,0.5h0.1l0.9-2.2l7.1-4.6l14-0.1l1.8,3.6l1.8,2.4l0.6,0.9l0.1,0.4L631,68l0.4,5.4l0.4,1.8v0.1 l-0.3,0.8l0.1,3.6l0.6-0.5l1.6-1.6l2-0.5l2-0.5L641.8,78.3z M396.8,154.7l-3.2-0.5l-2.5,1.7l3,3.5l5.3-0.1l-1.8-1.9L396.8,154.7z">
                            </path> @endif
                            @if ($departement[75]->hospitalises >= 150)
                            <path class="region" style="fill: pink" style="fill: orange" id="Paris" data-nom="Paris" data-numerodepartement="75" class="region-11 departement departement-75 departement-paris" d="M641.8,78.3l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.4-0.1l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2 l0.4-1.9l1.3-3.1l2.7-2.1l2.9-1.1l3.9,0.5h0.1l0.9-2.2l7.1-4.6l14-0.1l1.8,3.6l1.8,2.4l0.6,0.9l0.1,0.4L631,68l0.4,5.4l0.4,1.8v0.1 l-0.3,0.8l0.1,3.6l0.6-0.5l1.6-1.6l2-0.5l2-0.5L641.8,78.3z M396.8,154.7l-3.2-0.5l-2.5,1.7l3,3.5l5.3-0.1l-1.8-1.9L396.8,154.7z">
                            </path> @endif
                            @if ($departement[75]->hospitalises >= 250)
                            <path class="region" style="fill: purple" style="fill: red" id="Paris" data-nom="Paris" data-numerodepartement="75" class="region-11 departement departement-75 departement-paris" d="M641.8,78.3l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.4-0.1l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2 l0.4-1.9l1.3-3.1l2.7-2.1l2.9-1.1l3.9,0.5h0.1l0.9-2.2l7.1-4.6l14-0.1l1.8,3.6l1.8,2.4l0.6,0.9l0.1,0.4L631,68l0.4,5.4l0.4,1.8v0.1 l-0.3,0.8l0.1,3.6l0.6-0.5l1.6-1.6l2-0.5l2-0.5L641.8,78.3z M396.8,154.7l-3.2-0.5l-2.5,1.7l3,3.5l5.3-0.1l-1.8-1.9L396.8,154.7z">
                            </path> @endif
                            @if ($departement[75]->hospitalises >= 400)
                            <path class="region" style="fill: red" style="fill: yellow" id="Paris" data-nom="Paris" data-numerodepartement="75" class="region-11 departement departement-75 departement-paris" d="M641.8,78.3l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.4-0.1l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2 l0.4-1.9l1.3-3.1l2.7-2.1l2.9-1.1l3.9,0.5h0.1l0.9-2.2l7.1-4.6l14-0.1l1.8,3.6l1.8,2.4l0.6,0.9l0.1,0.4L631,68l0.4,5.4l0.4,1.8v0.1 l-0.3,0.8l0.1,3.6l0.6-0.5l1.6-1.6l2-0.5l2-0.5L641.8,78.3z M396.8,154.7l-3.2-0.5l-2.5,1.7l3,3.5l5.3-0.1l-1.8-1.9L396.8,154.7z">
                            </path> @endif


                            @if ($departement[77]->hospitalises
                            <= 50) <path class="region" style="fill: green" style="fill: green" id="Seine-et-Marne" data-nom="Seine-et-Marne" data-numerodepartement="77" class="region-11 departement departement-77 departement-seine-et-marne" d="m441.1,176.1l-2.9,0.8l0.4,8.5l-15.4,3 l-0.2,5.8l-3.9,5.4l-11.2,2.7l-9.2-0.7l2.6-1.5l0.6-2.7l-4.2-4.3L397,190l3.4-4.8l4-17.2l-0.5-1l1.1-4.1l-0.3-2.9v-0.1l-1.3-4.7 l1.3-2.5l-1.7-5.1l0.1-0.1l1.7-2.3l-0.2-2l6.9,1l2-2.2l2.5,1.6l8.1-2.9l2.6,0.7l1.8,2.5l-0.7,2.8l3.9,4.2l9.3,6l-0.4,2l-2.6,2.2 l3.5,8.3l2.6,1.7L441.1,176.1z">
                                </path>
                                @endif
                                @if ($departement[77]->hospitalises > 50)
                                <path class="region" style="fill: yellow" style="fill: green" id="Seine-et-Marne" data-nom="Seine-et-Marne" data-numerodepartement="77" class="region-11 departement departement-77 departement-seine-et-marne" d="m441.1,176.1l-2.9,0.8l0.4,8.5l-15.4,3 l-0.2,5.8l-3.9,5.4l-11.2,2.7l-9.2-0.7l2.6-1.5l0.6-2.7l-4.2-4.3L397,190l3.4-4.8l4-17.2l-0.5-1l1.1-4.1l-0.3-2.9v-0.1l-1.3-4.7 l1.3-2.5l-1.7-5.1l0.1-0.1l1.7-2.3l-0.2-2l6.9,1l2-2.2l2.5,1.6l8.1-2.9l2.6,0.7l1.8,2.5l-0.7,2.8l3.9,4.2l9.3,6l-0.4,2l-2.6,2.2 l3.5,8.3l2.6,1.7L441.1,176.1z">
                                </path> @endif
                                @if ($departement[77]->hospitalises >= 150)
                                <path class="region" style="fill: pink" style="fill: green" id="Seine-et-Marne" data-nom="Seine-et-Marne" data-numerodepartement="77" class="region-11 departement departement-77 departement-seine-et-marne" d="m441.1,176.1l-2.9,0.8l0.4,8.5l-15.4,3 l-0.2,5.8l-3.9,5.4l-11.2,2.7l-9.2-0.7l2.6-1.5l0.6-2.7l-4.2-4.3L397,190l3.4-4.8l4-17.2l-0.5-1l1.1-4.1l-0.3-2.9v-0.1l-1.3-4.7 l1.3-2.5l-1.7-5.1l0.1-0.1l1.7-2.3l-0.2-2l6.9,1l2-2.2l2.5,1.6l8.1-2.9l2.6,0.7l1.8,2.5l-0.7,2.8l3.9,4.2l9.3,6l-0.4,2l-2.6,2.2 l3.5,8.3l2.6,1.7L441.1,176.1z">
                                </path> @endif
                                @if ($departement[77]->hospitalises >= 250)
                                <path class="region" style="fill: purple" style="fill: green" id="Seine-et-Marne" data-nom="Seine-et-Marne" data-numerodepartement="77" class="region-11 departement departement-77 departement-seine-et-marne" d="m441.1,176.1l-2.9,0.8l0.4,8.5l-15.4,3 l-0.2,5.8l-3.9,5.4l-11.2,2.7l-9.2-0.7l2.6-1.5l0.6-2.7l-4.2-4.3L397,190l3.4-4.8l4-17.2l-0.5-1l1.1-4.1l-0.3-2.9v-0.1l-1.3-4.7 l1.3-2.5l-1.7-5.1l0.1-0.1l1.7-2.3l-0.2-2l6.9,1l2-2.2l2.5,1.6l8.1-2.9l2.6,0.7l1.8,2.5l-0.7,2.8l3.9,4.2l9.3,6l-0.4,2l-2.6,2.2 l3.5,8.3l2.6,1.7L441.1,176.1z">
                                </path> @endif
                                @if ($departement[77]->hospitalises >= 400)
                                <path class="region" style="fill: red" style="fill: green" id="Seine-et-Marne" data-nom="Seine-et-Marne" data-numerodepartement="77" class="region-11 departement departement-77 departement-seine-et-marne" d="m441.1,176.1l-2.9,0.8l0.4,8.5l-15.4,3 l-0.2,5.8l-3.9,5.4l-11.2,2.7l-9.2-0.7l2.6-1.5l0.6-2.7l-4.2-4.3L397,190l3.4-4.8l4-17.2l-0.5-1l1.1-4.1l-0.3-2.9v-0.1l-1.3-4.7 l1.3-2.5l-1.7-5.1l0.1-0.1l1.7-2.3l-0.2-2l6.9,1l2-2.2l2.5,1.6l8.1-2.9l2.6,0.7l1.8,2.5l-0.7,2.8l3.9,4.2l9.3,6l-0.4,2l-2.6,2.2 l3.5,8.3l2.6,1.7L441.1,176.1z">
                                </path> @endif


                                @if ($departement[78]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Yvelines" data-nom="Yvelines" data-numerodepartement="78" class="region-11 departement departement-78 departement-yvelines" d="m364.1,158.1l-3.6-6.6l-1.8-5.8l2.3-2.6 l3.8,0.1l9.5,0.8l9,3.6l5.5,6.1l-2,3.1l3.2,5.2l-7.1,5.4l-1.6,2.6l0.7,2.9l-4.6,8.6l-3.1,0.7L372,180l-1.2-5.6l-6.2-5.4L364.1,158.1z">
                                    </path>
                                    @endif
                                    @if ($departement[78]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Yvelines" data-nom="Yvelines" data-numerodepartement="78" class="region-11 departement departement-78 departement-yvelines" d="m364.1,158.1l-3.6-6.6l-1.8-5.8l2.3-2.6 l3.8,0.1l9.5,0.8l9,3.6l5.5,6.1l-2,3.1l3.2,5.2l-7.1,5.4l-1.6,2.6l0.7,2.9l-4.6,8.6l-3.1,0.7L372,180l-1.2-5.6l-6.2-5.4L364.1,158.1z">
                                    </path> @endif
                                    @if ($departement[78]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Yvelines" data-nom="Yvelines" data-numerodepartement="78" class="region-11 departement departement-78 departement-yvelines" d="m364.1,158.1l-3.6-6.6l-1.8-5.8l2.3-2.6 l3.8,0.1l9.5,0.8l9,3.6l5.5,6.1l-2,3.1l3.2,5.2l-7.1,5.4l-1.6,2.6l0.7,2.9l-4.6,8.6l-3.1,0.7L372,180l-1.2-5.6l-6.2-5.4L364.1,158.1z">
                                    </path>@endif
                                    @if ($departement[78]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Yvelines" data-nom="Yvelines" data-numerodepartement="78" class="region-11 departement departement-78 departement-yvelines" d="m364.1,158.1l-3.6-6.6l-1.8-5.8l2.3-2.6 l3.8,0.1l9.5,0.8l9,3.6l5.5,6.1l-2,3.1l3.2,5.2l-7.1,5.4l-1.6,2.6l0.7,2.9l-4.6,8.6l-3.1,0.7L372,180l-1.2-5.6l-6.2-5.4L364.1,158.1z">
                                    </path> @endif
                                    @if ($departement[78]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Yvelines" data-nom="Yvelines" data-numerodepartement="78" class="region-11 departement departement-78 departement-yvelines" d="m364.1,158.1l-3.6-6.6l-1.8-5.8l2.3-2.6 l3.8,0.1l9.5,0.8l9,3.6l5.5,6.1l-2,3.1l3.2,5.2l-7.1,5.4l-1.6,2.6l0.7,2.9l-4.6,8.6l-3.1,0.7L372,180l-1.2-5.6l-6.2-5.4L364.1,158.1z">
                                    </path> @endif

                                    @if ($departement[91]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Essonne" data-nom="Essonne" data-numerodepartement="91" class="region-11 departement departement-91 departement-essonne" d="m401.6,164.8l2.3,2.2l0.5,1l-4,17.2L397,190 l-3.7-0.6l-2.8,1.8l-1.5-2.7l-1.9,2.9l-6.9,0.7l-2.8-10.6l4.6-8.6l-0.7-2.9l1.6-2.6l7.1-5.4v-0.1l3.7,1.6l5.1,2.1L401.6,164.8z">
                                        </path>
                                        @endif
                                        @if ($departement[91]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Essonne" data-nom="Essonne" data-numerodepartement="91" class="region-11 departement departement-91 departement-essonne" d="m401.6,164.8l2.3,2.2l0.5,1l-4,17.2L397,190 l-3.7-0.6l-2.8,1.8l-1.5-2.7l-1.9,2.9l-6.9,0.7l-2.8-10.6l4.6-8.6l-0.7-2.9l1.6-2.6l7.1-5.4v-0.1l3.7,1.6l5.1,2.1L401.6,164.8z">
                                        </path> @endif
                                        @if ($departement[91]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Essonne" data-nom="Essonne" data-numerodepartement="91" class="region-11 departement departement-91 departement-essonne" d="m401.6,164.8l2.3,2.2l0.5,1l-4,17.2L397,190 l-3.7-0.6l-2.8,1.8l-1.5-2.7l-1.9,2.9l-6.9,0.7l-2.8-10.6l4.6-8.6l-0.7-2.9l1.6-2.6l7.1-5.4v-0.1l3.7,1.6l5.1,2.1L401.6,164.8z">
                                        </path>@endif
                                        @if ($departement[91]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Essonne" data-nom="Essonne" data-numerodepartement="91" class="region-11 departement departement-91 departement-essonne" d="m401.6,164.8l2.3,2.2l0.5,1l-4,17.2L397,190 l-3.7-0.6l-2.8,1.8l-1.5-2.7l-1.9,2.9l-6.9,0.7l-2.8-10.6l4.6-8.6l-0.7-2.9l1.6-2.6l7.1-5.4v-0.1l3.7,1.6l5.1,2.1L401.6,164.8z">
                                        </path> @endif
                                        @if ($departement[91]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Essonne" data-nom="Essonne" data-numerodepartement="91" class="region-11 departement departement-91 departement-essonne" d="m401.6,164.8l2.3,2.2l0.5,1l-4,17.2L397,190 l-3.7-0.6l-2.8,1.8l-1.5-2.7l-1.9,2.9l-6.9,0.7l-2.8-10.6l4.6-8.6l-0.7-2.9l1.6-2.6l7.1-5.4v-0.1l3.7,1.6l5.1,2.1L401.6,164.8z">
                                        </path> @endif

                                        @if ($departement[92]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Hauts-de-Seine" data-nom="Hauts-de-Seine" data-numerodepartement="92" class="region-11 departement departement-92 departement-hauts-de-seine" d="M391.1,155.9l3,3.5l-0.4,4.1l-3.7-1.6v0.1l-3.2-5.2l2-3.1l3.6-2.6l1.3,2l-0.1,1.1L391.1,155.9z M612.6,54.1 l1.6-0.7l0.7-1.9l0.5-1.8l-0.1-1.1l-0.2-1.4l-4.6-1.9l-4.6-0.9l-4,1.3l-7.6,5.6l-6.1,5.8l-5.3,3l-1,1l-3.75,7.4l1.79,7.17 l-0.06,0.07l0.01,0.06l-2.74,3.23l0.68,2.44l2.5,4.8l3.3-0.5l1,5.2l3.9-0.3l1.4,3.5l3.4,1.6l0.5,2.1l5.3,4.2l4.3,1.3l-0.1,4.9 l5.7,3.5l3.15-5.91l-0.7-5.46l0.72-1.2l0.4-1.3l0.7-2.1l-1.4-1.9l0.3-1.2l0.8-2.8l-1-2.6l0.5-0.3l0.5-0.3l0.9-0.5l0.7-1.1l-0.4-0.1 l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2l0.3-1.9l1.4-3.1l2.7-2.1l2.8-1.1h0.1l3.9,0.5l0.9-2.2l7.2-4.6l-0.7-2l-0.6-2l1.4-0.7L612.6,54.1z">
                                            </path>
                                            @endif
                                            @if ($departement[92]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Hauts-de-Seine" data-nom="Hauts-de-Seine" data-numerodepartement="92" class="region-11 departement departement-92 departement-hauts-de-seine" d="M391.1,155.9l3,3.5l-0.4,4.1l-3.7-1.6v0.1l-3.2-5.2l2-3.1l3.6-2.6l1.3,2l-0.1,1.1L391.1,155.9z M612.6,54.1 l1.6-0.7l0.7-1.9l0.5-1.8l-0.1-1.1l-0.2-1.4l-4.6-1.9l-4.6-0.9l-4,1.3l-7.6,5.6l-6.1,5.8l-5.3,3l-1,1l-3.75,7.4l1.79,7.17 l-0.06,0.07l0.01,0.06l-2.74,3.23l0.68,2.44l2.5,4.8l3.3-0.5l1,5.2l3.9-0.3l1.4,3.5l3.4,1.6l0.5,2.1l5.3,4.2l4.3,1.3l-0.1,4.9 l5.7,3.5l3.15-5.91l-0.7-5.46l0.72-1.2l0.4-1.3l0.7-2.1l-1.4-1.9l0.3-1.2l0.8-2.8l-1-2.6l0.5-0.3l0.5-0.3l0.9-0.5l0.7-1.1l-0.4-0.1 l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2l0.3-1.9l1.4-3.1l2.7-2.1l2.8-1.1h0.1l3.9,0.5l0.9-2.2l7.2-4.6l-0.7-2l-0.6-2l1.4-0.7L612.6,54.1z">
                                            </path>@endif
                                            @if ($departement[92]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Hauts-de-Seine" data-nom="Hauts-de-Seine" data-numerodepartement="92" class="region-11 departement departement-92 departement-hauts-de-seine" d="M391.1,155.9l3,3.5l-0.4,4.1l-3.7-1.6v0.1l-3.2-5.2l2-3.1l3.6-2.6l1.3,2l-0.1,1.1L391.1,155.9z M612.6,54.1 l1.6-0.7l0.7-1.9l0.5-1.8l-0.1-1.1l-0.2-1.4l-4.6-1.9l-4.6-0.9l-4,1.3l-7.6,5.6l-6.1,5.8l-5.3,3l-1,1l-3.75,7.4l1.79,7.17 l-0.06,0.07l0.01,0.06l-2.74,3.23l0.68,2.44l2.5,4.8l3.3-0.5l1,5.2l3.9-0.3l1.4,3.5l3.4,1.6l0.5,2.1l5.3,4.2l4.3,1.3l-0.1,4.9 l5.7,3.5l3.15-5.91l-0.7-5.46l0.72-1.2l0.4-1.3l0.7-2.1l-1.4-1.9l0.3-1.2l0.8-2.8l-1-2.6l0.5-0.3l0.5-0.3l0.9-0.5l0.7-1.1l-0.4-0.1 l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2l0.3-1.9l1.4-3.1l2.7-2.1l2.8-1.1h0.1l3.9,0.5l0.9-2.2l7.2-4.6l-0.7-2l-0.6-2l1.4-0.7L612.6,54.1z">
                                            </path>@endif
                                            @if ($departement[92]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Hauts-de-Seine" data-nom="Hauts-de-Seine" data-numerodepartement="92" class="region-11 departement departement-92 departement-hauts-de-seine" d="M391.1,155.9l3,3.5l-0.4,4.1l-3.7-1.6v0.1l-3.2-5.2l2-3.1l3.6-2.6l1.3,2l-0.1,1.1L391.1,155.9z M612.6,54.1 l1.6-0.7l0.7-1.9l0.5-1.8l-0.1-1.1l-0.2-1.4l-4.6-1.9l-4.6-0.9l-4,1.3l-7.6,5.6l-6.1,5.8l-5.3,3l-1,1l-3.75,7.4l1.79,7.17 l-0.06,0.07l0.01,0.06l-2.74,3.23l0.68,2.44l2.5,4.8l3.3-0.5l1,5.2l3.9-0.3l1.4,3.5l3.4,1.6l0.5,2.1l5.3,4.2l4.3,1.3l-0.1,4.9 l5.7,3.5l3.15-5.91l-0.7-5.46l0.72-1.2l0.4-1.3l0.7-2.1l-1.4-1.9l0.3-1.2l0.8-2.8l-1-2.6l0.5-0.3l0.5-0.3l0.9-0.5l0.7-1.1l-0.4-0.1 l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2l0.3-1.9l1.4-3.1l2.7-2.1l2.8-1.1h0.1l3.9,0.5l0.9-2.2l7.2-4.6l-0.7-2l-0.6-2l1.4-0.7L612.6,54.1z">
                                            </path> @endif
                                            @if ($departement[92]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Hauts-de-Seine" data-nom="Hauts-de-Seine" data-numerodepartement="92" class="region-11 departement departement-92 departement-hauts-de-seine" d="M391.1,155.9l3,3.5l-0.4,4.1l-3.7-1.6v0.1l-3.2-5.2l2-3.1l3.6-2.6l1.3,2l-0.1,1.1L391.1,155.9z M612.6,54.1 l1.6-0.7l0.7-1.9l0.5-1.8l-0.1-1.1l-0.2-1.4l-4.6-1.9l-4.6-0.9l-4,1.3l-7.6,5.6l-6.1,5.8l-5.3,3l-1,1l-3.75,7.4l1.79,7.17 l-0.06,0.07l0.01,0.06l-2.74,3.23l0.68,2.44l2.5,4.8l3.3-0.5l1,5.2l3.9-0.3l1.4,3.5l3.4,1.6l0.5,2.1l5.3,4.2l4.3,1.3l-0.1,4.9 l5.7,3.5l3.15-5.91l-0.7-5.46l0.72-1.2l0.4-1.3l0.7-2.1l-1.4-1.9l0.3-1.2l0.8-2.8l-1-2.6l0.5-0.3l0.5-0.3l0.9-0.5l0.7-1.1l-0.4-0.1 l-13.5-5l-3-3.8l-4.3-1.9l-0.5-0.2l0.3-1.9l1.4-3.1l2.7-2.1l2.8-1.1h0.1l3.9,0.5l0.9-2.2l7.2-4.6l-0.7-2l-0.6-2l1.4-0.7L612.6,54.1z">
                                            </path> @endif

                                            @if ($departement[93]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Seine-Saint-Denis" data-nom="Seine-Saint-Denis" data-numerodepartement="93" class="region-11 departement departement-93 departement-seine-saint-denis" d="M404.7,152.7l-1.3,2.5l1.3,4.7v0.1l-7.1-2.6l-0.8-2.7l-3.2-0.5l0.1-1.1l-1.3-2l3.3-1.3l2.6,1.1 c1.6-1.1,3.2-2.2,4.7-3.3L404.7,152.7z M663.2,73.89l0.06-0.08l-0.02-0.04l2.61-3.38l-3.95-0.3l-1.6-5.9l0.06-0.06l-0.02-0.06 l6.36-6.56l0.1-5.42l1.1-4l-1.2-3.4l-5.1-8l0.07-0.08l-0.03-0.04l2.65-3.33l-0.89-4.04l-4.5-2.9l-4.1,1.7l-6.4,8.8l-8.2,6.2 l-0.7-0.2l-7.8-1.1l-1.9,1l-5.1-4.6l-1.3-0.2l-1.9-0.7l-5.1,3l-1.6,2.7l-1-1.2l-5.9-2.1l-1.96,2.25v0.2l0.66,2.45l3.9,0.8l4.7,1.9 l0.1,1.4l0.1,1.1l-0.2,0.9l-0.3,0.9l-0.7,1.9l-1.6,0.7l-0.3,0.8l-1.4,0.7l0.6,2l0.7,2l13.9-0.2l0.1,0.1l1.8,3.6l1.8,2.4l0.6,0.8 l0.1,0.5L631,68l0.4,5.4l0.4,1.8l5.9-0.5l0.5-0.3c0.1,0,0.1,0,0.2,0l6.3-2.8l2.9,0.4l0.7,1.3l3,1.5l4,2.9c0,0.1,0.1,0.2,0.2,0.2 l0.7,0.5l6,6.2l0.8,0.6c0.1,0,0.2,0.1,0.3,0.1l3.6,2.6l0.04-0.13l0.43-1.3l0.23-0.68l-1.8-6L663.2,73.89z">
                                                </path>
                                                @endif
                                                @if ($departement[93]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Seine-Saint-Denis" data-nom="Seine-Saint-Denis" data-numerodepartement="93" class="region-11 departement departement-93 departement-seine-saint-denis" d="M404.7,152.7l-1.3,2.5l1.3,4.7v0.1l-7.1-2.6l-0.8-2.7l-3.2-0.5l0.1-1.1l-1.3-2l3.3-1.3l2.6,1.1 c1.6-1.1,3.2-2.2,4.7-3.3L404.7,152.7z M663.2,73.89l0.06-0.08l-0.02-0.04l2.61-3.38l-3.95-0.3l-1.6-5.9l0.06-0.06l-0.02-0.06 l6.36-6.56l0.1-5.42l1.1-4l-1.2-3.4l-5.1-8l0.07-0.08l-0.03-0.04l2.65-3.33l-0.89-4.04l-4.5-2.9l-4.1,1.7l-6.4,8.8l-8.2,6.2 l-0.7-0.2l-7.8-1.1l-1.9,1l-5.1-4.6l-1.3-0.2l-1.9-0.7l-5.1,3l-1.6,2.7l-1-1.2l-5.9-2.1l-1.96,2.25v0.2l0.66,2.45l3.9,0.8l4.7,1.9 l0.1,1.4l0.1,1.1l-0.2,0.9l-0.3,0.9l-0.7,1.9l-1.6,0.7l-0.3,0.8l-1.4,0.7l0.6,2l0.7,2l13.9-0.2l0.1,0.1l1.8,3.6l1.8,2.4l0.6,0.8 l0.1,0.5L631,68l0.4,5.4l0.4,1.8l5.9-0.5l0.5-0.3c0.1,0,0.1,0,0.2,0l6.3-2.8l2.9,0.4l0.7,1.3l3,1.5l4,2.9c0,0.1,0.1,0.2,0.2,0.2 l0.7,0.5l6,6.2l0.8,0.6c0.1,0,0.2,0.1,0.3,0.1l3.6,2.6l0.04-0.13l0.43-1.3l0.23-0.68l-1.8-6L663.2,73.89z">
                                                </path> @endif
                                                @if ($departement[93]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Seine-Saint-Denis" data-nom="Seine-Saint-Denis" data-numerodepartement="93" class="region-11 departement departement-93 departement-seine-saint-denis" d="M404.7,152.7l-1.3,2.5l1.3,4.7v0.1l-7.1-2.6l-0.8-2.7l-3.2-0.5l0.1-1.1l-1.3-2l3.3-1.3l2.6,1.1 c1.6-1.1,3.2-2.2,4.7-3.3L404.7,152.7z M663.2,73.89l0.06-0.08l-0.02-0.04l2.61-3.38l-3.95-0.3l-1.6-5.9l0.06-0.06l-0.02-0.06 l6.36-6.56l0.1-5.42l1.1-4l-1.2-3.4l-5.1-8l0.07-0.08l-0.03-0.04l2.65-3.33l-0.89-4.04l-4.5-2.9l-4.1,1.7l-6.4,8.8l-8.2,6.2 l-0.7-0.2l-7.8-1.1l-1.9,1l-5.1-4.6l-1.3-0.2l-1.9-0.7l-5.1,3l-1.6,2.7l-1-1.2l-5.9-2.1l-1.96,2.25v0.2l0.66,2.45l3.9,0.8l4.7,1.9 l0.1,1.4l0.1,1.1l-0.2,0.9l-0.3,0.9l-0.7,1.9l-1.6,0.7l-0.3,0.8l-1.4,0.7l0.6,2l0.7,2l13.9-0.2l0.1,0.1l1.8,3.6l1.8,2.4l0.6,0.8 l0.1,0.5L631,68l0.4,5.4l0.4,1.8l5.9-0.5l0.5-0.3c0.1,0,0.1,0,0.2,0l6.3-2.8l2.9,0.4l0.7,1.3l3,1.5l4,2.9c0,0.1,0.1,0.2,0.2,0.2 l0.7,0.5l6,6.2l0.8,0.6c0.1,0,0.2,0.1,0.3,0.1l3.6,2.6l0.04-0.13l0.43-1.3l0.23-0.68l-1.8-6L663.2,73.89z">
                                                </path> @endif
                                                @if ($departement[93]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Seine-Saint-Denis" data-nom="Seine-Saint-Denis" data-numerodepartement="93" class="region-11 departement departement-93 departement-seine-saint-denis" d="M404.7,152.7l-1.3,2.5l1.3,4.7v0.1l-7.1-2.6l-0.8-2.7l-3.2-0.5l0.1-1.1l-1.3-2l3.3-1.3l2.6,1.1 c1.6-1.1,3.2-2.2,4.7-3.3L404.7,152.7z M663.2,73.89l0.06-0.08l-0.02-0.04l2.61-3.38l-3.95-0.3l-1.6-5.9l0.06-0.06l-0.02-0.06 l6.36-6.56l0.1-5.42l1.1-4l-1.2-3.4l-5.1-8l0.07-0.08l-0.03-0.04l2.65-3.33l-0.89-4.04l-4.5-2.9l-4.1,1.7l-6.4,8.8l-8.2,6.2 l-0.7-0.2l-7.8-1.1l-1.9,1l-5.1-4.6l-1.3-0.2l-1.9-0.7l-5.1,3l-1.6,2.7l-1-1.2l-5.9-2.1l-1.96,2.25v0.2l0.66,2.45l3.9,0.8l4.7,1.9 l0.1,1.4l0.1,1.1l-0.2,0.9l-0.3,0.9l-0.7,1.9l-1.6,0.7l-0.3,0.8l-1.4,0.7l0.6,2l0.7,2l13.9-0.2l0.1,0.1l1.8,3.6l1.8,2.4l0.6,0.8 l0.1,0.5L631,68l0.4,5.4l0.4,1.8l5.9-0.5l0.5-0.3c0.1,0,0.1,0,0.2,0l6.3-2.8l2.9,0.4l0.7,1.3l3,1.5l4,2.9c0,0.1,0.1,0.2,0.2,0.2 l0.7,0.5l6,6.2l0.8,0.6c0.1,0,0.2,0.1,0.3,0.1l3.6,2.6l0.04-0.13l0.43-1.3l0.23-0.68l-1.8-6L663.2,73.89z">
                                                </path> @endif
                                                @if ($departement[93]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Seine-Saint-Denis" data-nom="Seine-Saint-Denis" data-numerodepartement="93" class="region-11 departement departement-93 departement-seine-saint-denis" d="M404.7,152.7l-1.3,2.5l1.3,4.7v0.1l-7.1-2.6l-0.8-2.7l-3.2-0.5l0.1-1.1l-1.3-2l3.3-1.3l2.6,1.1 c1.6-1.1,3.2-2.2,4.7-3.3L404.7,152.7z M663.2,73.89l0.06-0.08l-0.02-0.04l2.61-3.38l-3.95-0.3l-1.6-5.9l0.06-0.06l-0.02-0.06 l6.36-6.56l0.1-5.42l1.1-4l-1.2-3.4l-5.1-8l0.07-0.08l-0.03-0.04l2.65-3.33l-0.89-4.04l-4.5-2.9l-4.1,1.7l-6.4,8.8l-8.2,6.2 l-0.7-0.2l-7.8-1.1l-1.9,1l-5.1-4.6l-1.3-0.2l-1.9-0.7l-5.1,3l-1.6,2.7l-1-1.2l-5.9-2.1l-1.96,2.25v0.2l0.66,2.45l3.9,0.8l4.7,1.9 l0.1,1.4l0.1,1.1l-0.2,0.9l-0.3,0.9l-0.7,1.9l-1.6,0.7l-0.3,0.8l-1.4,0.7l0.6,2l0.7,2l13.9-0.2l0.1,0.1l1.8,3.6l1.8,2.4l0.6,0.8 l0.1,0.5L631,68l0.4,5.4l0.4,1.8l5.9-0.5l0.5-0.3c0.1,0,0.1,0,0.2,0l6.3-2.8l2.9,0.4l0.7,1.3l3,1.5l4,2.9c0,0.1,0.1,0.2,0.2,0.2 l0.7,0.5l6,6.2l0.8,0.6c0.1,0,0.2,0.1,0.3,0.1l3.6,2.6l0.04-0.13l0.43-1.3l0.23-0.68l-1.8-6L663.2,73.89z">
                                                </path> @endif

                                                @if ($departement[94]->hospitalises
                                                <= 50) <path class="region" style="fill: green" id="Val-de-Marne" data-nom="Val-de-Marne" data-numerodepartement="94" class="region-11 departement departement-94 departement-val-de-marne" d="M404.7,160l0.3,2.9l-1.1,4.1l-2.3-2.2l-2.8,0.8l-5.1-2.1l0.4-4.1l5.3-0.1l-1.8-1.9L404.7,160z M668.09,102.2 h0.06l-0.02-0.12l3.31-0.19l-1.55-3.58l-3.69-2.41l0.8-8h-0.1l-3.6-2.6c-0.1,0-0.2-0.1-0.3-0.1l-0.8-0.6l-6-6.2l-0.7-0.5 c-0.1,0-0.2-0.1-0.2-0.2l-4-2.9l-3-1.5l-0.7-1.3l-2.9-0.4l-6.3,2.8c-0.1,0-0.1,0-0.2,0l-0.5,0.3l-5.9,0.5v0.1l-0.3,0.8l0.1,3.6 l0.6-0.5l1.6-1.7l2-0.4l2-0.5l4,1.7l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.6,1.1h-0.1l-0.9,0.5l-0.5,0.3l-0.5,0.3 l1,2.5v0.1l-0.8,2.8l-0.3,1.2l1.4,1.9l-0.7,2.1l-0.4,1.3l-0.7,1.2l0.78,5.38h0.06l2.1,0.2l4.7,2.8l3.1-2.2l0.1,5.5l3.3,2.4l4.9-1.8 l0.7,2.5l5.2-2.3l0.5,1.3l1.7,1.7l4.6-3.6l2.1-0.5l5.2-1.8l1.9,6.8l1.7,2.5l3.3,1.8l5.44,1.88l-0.68-5.05l0.05-0.08l-0.01-0.04 l2.5-4.2l2.73-2.74l-1.38-3.64l0.07-0.06l-0.03-0.07l2.35-1.96L668.09,102.2z">
                                                    </path>
                                                    @endif
                                                    @if ($departement[94]->hospitalises > 50)
                                                    <path class="region" style="fill: yellow" id="Val-de-Marne" data-nom="Val-de-Marne" data-numerodepartement="94" class="region-11 departement departement-94 departement-val-de-marne" d="M404.7,160l0.3,2.9l-1.1,4.1l-2.3-2.2l-2.8,0.8l-5.1-2.1l0.4-4.1l5.3-0.1l-1.8-1.9L404.7,160z M668.09,102.2 h0.06l-0.02-0.12l3.31-0.19l-1.55-3.58l-3.69-2.41l0.8-8h-0.1l-3.6-2.6c-0.1,0-0.2-0.1-0.3-0.1l-0.8-0.6l-6-6.2l-0.7-0.5 c-0.1,0-0.2-0.1-0.2-0.2l-4-2.9l-3-1.5l-0.7-1.3l-2.9-0.4l-6.3,2.8c-0.1,0-0.1,0-0.2,0l-0.5,0.3l-5.9,0.5v0.1l-0.3,0.8l0.1,3.6 l0.6-0.5l1.6-1.7l2-0.4l2-0.5l4,1.7l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.6,1.1h-0.1l-0.9,0.5l-0.5,0.3l-0.5,0.3 l1,2.5v0.1l-0.8,2.8l-0.3,1.2l1.4,1.9l-0.7,2.1l-0.4,1.3l-0.7,1.2l0.78,5.38h0.06l2.1,0.2l4.7,2.8l3.1-2.2l0.1,5.5l3.3,2.4l4.9-1.8 l0.7,2.5l5.2-2.3l0.5,1.3l1.7,1.7l4.6-3.6l2.1-0.5l5.2-1.8l1.9,6.8l1.7,2.5l3.3,1.8l5.44,1.88l-0.68-5.05l0.05-0.08l-0.01-0.04 l2.5-4.2l2.73-2.74l-1.38-3.64l0.07-0.06l-0.03-0.07l2.35-1.96L668.09,102.2z">
                                                    </path> @endif
                                                    @if ($departement[94]->hospitalises >= 150)
                                                    <path class="region" style="fill: pink" id="Val-de-Marne" data-nom="Val-de-Marne" data-numerodepartement="94" class="region-11 departement departement-94 departement-val-de-marne" d="M404.7,160l0.3,2.9l-1.1,4.1l-2.3-2.2l-2.8,0.8l-5.1-2.1l0.4-4.1l5.3-0.1l-1.8-1.9L404.7,160z M668.09,102.2 h0.06l-0.02-0.12l3.31-0.19l-1.55-3.58l-3.69-2.41l0.8-8h-0.1l-3.6-2.6c-0.1,0-0.2-0.1-0.3-0.1l-0.8-0.6l-6-6.2l-0.7-0.5 c-0.1,0-0.2-0.1-0.2-0.2l-4-2.9l-3-1.5l-0.7-1.3l-2.9-0.4l-6.3,2.8c-0.1,0-0.1,0-0.2,0l-0.5,0.3l-5.9,0.5v0.1l-0.3,0.8l0.1,3.6 l0.6-0.5l1.6-1.7l2-0.4l2-0.5l4,1.7l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.6,1.1h-0.1l-0.9,0.5l-0.5,0.3l-0.5,0.3 l1,2.5v0.1l-0.8,2.8l-0.3,1.2l1.4,1.9l-0.7,2.1l-0.4,1.3l-0.7,1.2l0.78,5.38h0.06l2.1,0.2l4.7,2.8l3.1-2.2l0.1,5.5l3.3,2.4l4.9-1.8 l0.7,2.5l5.2-2.3l0.5,1.3l1.7,1.7l4.6-3.6l2.1-0.5l5.2-1.8l1.9,6.8l1.7,2.5l3.3,1.8l5.44,1.88l-0.68-5.05l0.05-0.08l-0.01-0.04 l2.5-4.2l2.73-2.74l-1.38-3.64l0.07-0.06l-0.03-0.07l2.35-1.96L668.09,102.2z">
                                                    </path> @endif
                                                    @if ($departement[94]->hospitalises >= 250)
                                                    <path class="region" style="fill: purple" id="Val-de-Marne" data-nom="Val-de-Marne" data-numerodepartement="94" class="region-11 departement departement-94 departement-val-de-marne" d="M404.7,160l0.3,2.9l-1.1,4.1l-2.3-2.2l-2.8,0.8l-5.1-2.1l0.4-4.1l5.3-0.1l-1.8-1.9L404.7,160z M668.09,102.2 h0.06l-0.02-0.12l3.31-0.19l-1.55-3.58l-3.69-2.41l0.8-8h-0.1l-3.6-2.6c-0.1,0-0.2-0.1-0.3-0.1l-0.8-0.6l-6-6.2l-0.7-0.5 c-0.1,0-0.2-0.1-0.2-0.2l-4-2.9l-3-1.5l-0.7-1.3l-2.9-0.4l-6.3,2.8c-0.1,0-0.1,0-0.2,0l-0.5,0.3l-5.9,0.5v0.1l-0.3,0.8l0.1,3.6 l0.6-0.5l1.6-1.7l2-0.4l2-0.5l4,1.7l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.6,1.1h-0.1l-0.9,0.5l-0.5,0.3l-0.5,0.3 l1,2.5v0.1l-0.8,2.8l-0.3,1.2l1.4,1.9l-0.7,2.1l-0.4,1.3l-0.7,1.2l0.78,5.38h0.06l2.1,0.2l4.7,2.8l3.1-2.2l0.1,5.5l3.3,2.4l4.9-1.8 l0.7,2.5l5.2-2.3l0.5,1.3l1.7,1.7l4.6-3.6l2.1-0.5l5.2-1.8l1.9,6.8l1.7,2.5l3.3,1.8l5.44,1.88l-0.68-5.05l0.05-0.08l-0.01-0.04 l2.5-4.2l2.73-2.74l-1.38-3.64l0.07-0.06l-0.03-0.07l2.35-1.96L668.09,102.2z">
                                                    </path> @endif
                                                    @if ($departement[94]->hospitalises >= 400)
                                                    <path class="region" style="fill: red" id="Val-de-Marne" data-nom="Val-de-Marne" data-numerodepartement="94" class="region-11 departement departement-94 departement-val-de-marne" d="M404.7,160l0.3,2.9l-1.1,4.1l-2.3-2.2l-2.8,0.8l-5.1-2.1l0.4-4.1l5.3-0.1l-1.8-1.9L404.7,160z M668.09,102.2 h0.06l-0.02-0.12l3.31-0.19l-1.55-3.58l-3.69-2.41l0.8-8h-0.1l-3.6-2.6c-0.1,0-0.2-0.1-0.3-0.1l-0.8-0.6l-6-6.2l-0.7-0.5 c-0.1,0-0.2-0.1-0.2-0.2l-4-2.9l-3-1.5l-0.7-1.3l-2.9-0.4l-6.3,2.8c-0.1,0-0.1,0-0.2,0l-0.5,0.3l-5.9,0.5v0.1l-0.3,0.8l0.1,3.6 l0.6-0.5l1.6-1.7l2-0.4l2-0.5l4,1.7l-0.2,3.8l-1,2.6l-8.3-1.7l-6-0.6l-5.2,3h-4l-2.5-0.3l-0.6,1.1h-0.1l-0.9,0.5l-0.5,0.3l-0.5,0.3 l1,2.5v0.1l-0.8,2.8l-0.3,1.2l1.4,1.9l-0.7,2.1l-0.4,1.3l-0.7,1.2l0.78,5.38h0.06l2.1,0.2l4.7,2.8l3.1-2.2l0.1,5.5l3.3,2.4l4.9-1.8 l0.7,2.5l5.2-2.3l0.5,1.3l1.7,1.7l4.6-3.6l2.1-0.5l5.2-1.8l1.9,6.8l1.7,2.5l3.3,1.8l5.44,1.88l-0.68-5.05l0.05-0.08l-0.01-0.04 l2.5-4.2l2.73-2.74l-1.38-3.64l0.07-0.06l-0.03-0.07l2.35-1.96L668.09,102.2z">
                                                    </path> @endif

                                                    @if ($departement[95]->hospitalises
                                                    <= 50) <path class="region" style="fill: green" id="Val-d’Oise" data-nom="Val-d’Oise" data-numerodepartement="95" class="region-11 departement departement-95 departement-val-doise" d="m374.3,144l-9.5-0.8l4-9.5l1.6,3.2l5.6,1.1 l6.3-1.8l9.2,2.2l2.2-1.6l10.9,6.4l0.2,2l-1.7,2.3l-0.1,0.1c-1.5,1.1-3.1,2.2-4.7,3.3l-2.6-1.1l-3.3,1.3l-3.6,2.6l-5.5-6.1 L374.3,144z">
                                                        </path>
                                                        @endif
                                                        @if ($departement[95]->hospitalises > 50)
                                                        <path class="region" style="fill: yellow" id="Val-d’Oise" data-nom="Val-d’Oise" data-numerodepartement="95" class="region-11 departement departement-95 departement-val-doise" d="m374.3,144l-9.5-0.8l4-9.5l1.6,3.2l5.6,1.1 l6.3-1.8l9.2,2.2l2.2-1.6l10.9,6.4l0.2,2l-1.7,2.3l-0.1,0.1c-1.5,1.1-3.1,2.2-4.7,3.3l-2.6-1.1l-3.3,1.3l-3.6,2.6l-5.5-6.1 L374.3,144z">
                                                        </path> @endif
                                                        @if ($departement[95]->hospitalises >= 150)
                                                        <path class="region" style="fill: pink" id="Val-d’Oise" data-nom="Val-d’Oise" data-numerodepartement="95" class="region-11 departement departement-95 departement-val-doise" d="m374.3,144l-9.5-0.8l4-9.5l1.6,3.2l5.6,1.1 l6.3-1.8l9.2,2.2l2.2-1.6l10.9,6.4l0.2,2l-1.7,2.3l-0.1,0.1c-1.5,1.1-3.1,2.2-4.7,3.3l-2.6-1.1l-3.3,1.3l-3.6,2.6l-5.5-6.1 L374.3,144z">
                                                        </path> @endif
                                                        @if ($departement[95]->hospitalises >= 250)
                                                        <path class="region" style="fill: purple" id="Val-d’Oise" data-nom="Val-d’Oise" data-numerodepartement="95" class="region-11 departement departement-95 departement-val-doise" d="m374.3,144l-9.5-0.8l4-9.5l1.6,3.2l5.6,1.1 l6.3-1.8l9.2,2.2l2.2-1.6l10.9,6.4l0.2,2l-1.7,2.3l-0.1,0.1c-1.5,1.1-3.1,2.2-4.7,3.3l-2.6-1.1l-3.3,1.3l-3.6,2.6l-5.5-6.1 L374.3,144z">
                                                        </path> @endif
                                                        @if ($departement[95]->hospitalises >= 400)
                                                        <path class="region" style="fill: red" id="Val-d’Oise" data-nom="Val-d’Oise" data-numerodepartement="95" class="region-11 departement departement-95 departement-val-doise" d="m374.3,144l-9.5-0.8l4-9.5l1.6,3.2l5.6,1.1 l6.3-1.8l9.2,2.2l2.2-1.6l10.9,6.4l0.2,2l-1.7,2.3l-0.1,0.1c-1.5,1.1-3.1,2.2-4.7,3.3l-2.6-1.1l-3.3,1.3l-3.6,2.6l-5.5-6.1 L374.3,144z">
                                                        </path> @endif
                    </g>


                    <g data-nom="Centre-Val de Loire">

                        @if ($departement[17]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Cher" data-nom="Cher" data-numerodepartement="18" class="region-24 departement departement-18 departement-cher" d="m385.3,235.4l5-2.4l13.5,3.1l3.9,4.8l9-1.7l2,6.5l-1.7,5.8l2.7,2.1 l3.1,7.6l0.3,5.9l2.2,2l-0.2,5.8l-1.3,8.9h-0.1h-4l-4.8,3.7l-8.4,2.9l-2.3,1.9l1.7,5.3l-1.7,2.4l-8.7,1l-3.5,5.9v0.1l-4.9-0.2 l1.5-3.5l-0.9-8.9l-4.7-7.9l1.4-2.7l-2.3-2.2l2.5-5.1l-2.3-11.7l-11.6-1.6l2.8-5.5l2.8,0.1l0.6-2.8l9.7-2l-2.1-5.9l5.9-4.1 L385.3,235.4z">
                            </path>
                            @endif
                            @if ($departement[17]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Cher" data-nom="Cher" data-numerodepartement="18" class="region-24 departement departement-18 departement-cher" d="m385.3,235.4l5-2.4l13.5,3.1l3.9,4.8l9-1.7l2,6.5l-1.7,5.8l2.7,2.1 l3.1,7.6l0.3,5.9l2.2,2l-0.2,5.8l-1.3,8.9h-0.1h-4l-4.8,3.7l-8.4,2.9l-2.3,1.9l1.7,5.3l-1.7,2.4l-8.7,1l-3.5,5.9v0.1l-4.9-0.2 l1.5-3.5l-0.9-8.9l-4.7-7.9l1.4-2.7l-2.3-2.2l2.5-5.1l-2.3-11.7l-11.6-1.6l2.8-5.5l2.8,0.1l0.6-2.8l9.7-2l-2.1-5.9l5.9-4.1 L385.3,235.4z">
                            </path> @endif
                            @if ($departement[17]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Cher" data-nom="Cher" data-numerodepartement="18" class="region-24 departement departement-18 departement-cher" d="m385.3,235.4l5-2.4l13.5,3.1l3.9,4.8l9-1.7l2,6.5l-1.7,5.8l2.7,2.1 l3.1,7.6l0.3,5.9l2.2,2l-0.2,5.8l-1.3,8.9h-0.1h-4l-4.8,3.7l-8.4,2.9l-2.3,1.9l1.7,5.3l-1.7,2.4l-8.7,1l-3.5,5.9v0.1l-4.9-0.2 l1.5-3.5l-0.9-8.9l-4.7-7.9l1.4-2.7l-2.3-2.2l2.5-5.1l-2.3-11.7l-11.6-1.6l2.8-5.5l2.8,0.1l0.6-2.8l9.7-2l-2.1-5.9l5.9-4.1 L385.3,235.4z">
                            </path> @endif
                            @if ($departement[17]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Cher" data-nom="Cher" data-numerodepartement="18" class="region-24 departement departement-18 departement-cher" d="m385.3,235.4l5-2.4l13.5,3.1l3.9,4.8l9-1.7l2,6.5l-1.7,5.8l2.7,2.1 l3.1,7.6l0.3,5.9l2.2,2l-0.2,5.8l-1.3,8.9h-0.1h-4l-4.8,3.7l-8.4,2.9l-2.3,1.9l1.7,5.3l-1.7,2.4l-8.7,1l-3.5,5.9v0.1l-4.9-0.2 l1.5-3.5l-0.9-8.9l-4.7-7.9l1.4-2.7l-2.3-2.2l2.5-5.1l-2.3-11.7l-11.6-1.6l2.8-5.5l2.8,0.1l0.6-2.8l9.7-2l-2.1-5.9l5.9-4.1 L385.3,235.4z">
                            </path> @endif
                            @if ($departement[17]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Cher" data-nom="Cher" data-numerodepartement="18" class="region-24 departement departement-18 departement-cher" d="m385.3,235.4l5-2.4l13.5,3.1l3.9,4.8l9-1.7l2,6.5l-1.7,5.8l2.7,2.1 l3.1,7.6l0.3,5.9l2.2,2l-0.2,5.8l-1.3,8.9h-0.1h-4l-4.8,3.7l-8.4,2.9l-2.3,1.9l1.7,5.3l-1.7,2.4l-8.7,1l-3.5,5.9v0.1l-4.9-0.2 l1.5-3.5l-0.9-8.9l-4.7-7.9l1.4-2.7l-2.3-2.2l2.5-5.1l-2.3-11.7l-11.6-1.6l2.8-5.5l2.8,0.1l0.6-2.8l9.7-2l-2.1-5.9l5.9-4.1 L385.3,235.4z">
                            </path> @endif

                            @if ($departement[26]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Eure-et-Loir" data-nom="Eure-et-Loir" data-numerodepartement="28" class="region-24 departement departement-28 departement-eure-et-loir" d="m333.1,200.9l-2.1-3.8l-1.1-7.5l7.5-5.1 l-0.5-4.6l0.2-4.5l-4.8-4.4l-0.1-3.2l2.4-2.6l6-1.1l5.3-3.2l2.8,1.6l6-1.3l-0.2-2.8l6-6.9l3.6,6.6l0.5,10.9l6.2,5.4l1.2,5.6l2.3,2.2 l3.1-0.7l2.8,10.6l-0.5,1.5l-4.8,10.8l-8.5,0.6l-6,2.8l0.2,2.8l-3.3-1.9l-5.5,3.5L339,201.4l-6.3,1.3L333.1,200.9z">
                                </path>
                                @endif
                                @if ($departement[26]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Eure-et-Loir" data-nom="Eure-et-Loir" data-numerodepartement="28" class="region-24 departement departement-28 departement-eure-et-loir" d="m333.1,200.9l-2.1-3.8l-1.1-7.5l7.5-5.1 l-0.5-4.6l0.2-4.5l-4.8-4.4l-0.1-3.2l2.4-2.6l6-1.1l5.3-3.2l2.8,1.6l6-1.3l-0.2-2.8l6-6.9l3.6,6.6l0.5,10.9l6.2,5.4l1.2,5.6l2.3,2.2 l3.1-0.7l2.8,10.6l-0.5,1.5l-4.8,10.8l-8.5,0.6l-6,2.8l0.2,2.8l-3.3-1.9l-5.5,3.5L339,201.4l-6.3,1.3L333.1,200.9z">
                                </path> @endif
                                @if ($departement[26]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Eure-et-Loir" data-nom="Eure-et-Loir" data-numerodepartement="28" class="region-24 departement departement-28 departement-eure-et-loir" d="m333.1,200.9l-2.1-3.8l-1.1-7.5l7.5-5.1 l-0.5-4.6l0.2-4.5l-4.8-4.4l-0.1-3.2l2.4-2.6l6-1.1l5.3-3.2l2.8,1.6l6-1.3l-0.2-2.8l6-6.9l3.6,6.6l0.5,10.9l6.2,5.4l1.2,5.6l2.3,2.2 l3.1-0.7l2.8,10.6l-0.5,1.5l-4.8,10.8l-8.5,0.6l-6,2.8l0.2,2.8l-3.3-1.9l-5.5,3.5L339,201.4l-6.3,1.3L333.1,200.9z">
                                </path> @endif
                                @if ($departement[26]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Eure-et-Loir" data-nom="Eure-et-Loir" data-numerodepartement="28" class="region-24 departement departement-28 departement-eure-et-loir" d="m333.1,200.9l-2.1-3.8l-1.1-7.5l7.5-5.1 l-0.5-4.6l0.2-4.5l-4.8-4.4l-0.1-3.2l2.4-2.6l6-1.1l5.3-3.2l2.8,1.6l6-1.3l-0.2-2.8l6-6.9l3.6,6.6l0.5,10.9l6.2,5.4l1.2,5.6l2.3,2.2 l3.1-0.7l2.8,10.6l-0.5,1.5l-4.8,10.8l-8.5,0.6l-6,2.8l0.2,2.8l-3.3-1.9l-5.5,3.5L339,201.4l-6.3,1.3L333.1,200.9z">
                                </path> @endif
                                @if ($departement[26]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Eure-et-Loir" data-nom="Eure-et-Loir" data-numerodepartement="28" class="region-24 departement departement-28 departement-eure-et-loir" d="m333.1,200.9l-2.1-3.8l-1.1-7.5l7.5-5.1 l-0.5-4.6l0.2-4.5l-4.8-4.4l-0.1-3.2l2.4-2.6l6-1.1l5.3-3.2l2.8,1.6l6-1.3l-0.2-2.8l6-6.9l3.6,6.6l0.5,10.9l6.2,5.4l1.2,5.6l2.3,2.2 l3.1-0.7l2.8,10.6l-0.5,1.5l-4.8,10.8l-8.5,0.6l-6,2.8l0.2,2.8l-3.3-1.9l-5.5,3.5L339,201.4l-6.3,1.3L333.1,200.9z">
                                </path> @endif

                                @if ($departement[36]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Indre" data-nom="Indre" data-numerodepartement="36" class="region-24 departement departement-36 departement-indre" d="m357.8,308.5l-2.8,2.9l-1.7-2.5l-5.8,1.1 l-2.6-1.1l1.5-2.8l-2.5-1.3l-2.6-5.4h-2.9l-4.6-4.4l0.8-5.8l-2.1-3l5.6-0.5l-1-2.7l3.3-11.9l5.1-2.7l2.3,1.7l2.6-3.5l2.5-2.1l-1-4.9 l6-3.2l2.5,1.3l1.5-2.6l6.4-0.9l5.2,3.5l-2.8,5.5l11.6,1.6l2.3,11.7l-2.5,5.1l2.3,2.2l-1.4,2.7l4.7,7.9l0.9,8.9l-1.5,3.5l-2.7,0.8 l-13.2-2.7l-1.9,2.5L357.8,308.5z">
                                    </path>
                                    @endif
                                    @if ($departement[36]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Indre" data-nom="Indre" data-numerodepartement="36" class="region-24 departement departement-36 departement-indre" d="m357.8,308.5l-2.8,2.9l-1.7-2.5l-5.8,1.1 l-2.6-1.1l1.5-2.8l-2.5-1.3l-2.6-5.4h-2.9l-4.6-4.4l0.8-5.8l-2.1-3l5.6-0.5l-1-2.7l3.3-11.9l5.1-2.7l2.3,1.7l2.6-3.5l2.5-2.1l-1-4.9 l6-3.2l2.5,1.3l1.5-2.6l6.4-0.9l5.2,3.5l-2.8,5.5l11.6,1.6l2.3,11.7l-2.5,5.1l2.3,2.2l-1.4,2.7l4.7,7.9l0.9,8.9l-1.5,3.5l-2.7,0.8 l-13.2-2.7l-1.9,2.5L357.8,308.5z">
                                    </path> @endif
                                    @if ($departement[36]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Indre" data-nom="Indre" data-numerodepartement="36" class="region-24 departement departement-36 departement-indre" d="m357.8,308.5l-2.8,2.9l-1.7-2.5l-5.8,1.1 l-2.6-1.1l1.5-2.8l-2.5-1.3l-2.6-5.4h-2.9l-4.6-4.4l0.8-5.8l-2.1-3l5.6-0.5l-1-2.7l3.3-11.9l5.1-2.7l2.3,1.7l2.6-3.5l2.5-2.1l-1-4.9 l6-3.2l2.5,1.3l1.5-2.6l6.4-0.9l5.2,3.5l-2.8,5.5l11.6,1.6l2.3,11.7l-2.5,5.1l2.3,2.2l-1.4,2.7l4.7,7.9l0.9,8.9l-1.5,3.5l-2.7,0.8 l-13.2-2.7l-1.9,2.5L357.8,308.5z">
                                    </path> @endif
                                    @if ($departement[36]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Indre" data-nom="Indre" data-numerodepartement="36" class="region-24 departement departement-36 departement-indre" d="m357.8,308.5l-2.8,2.9l-1.7-2.5l-5.8,1.1 l-2.6-1.1l1.5-2.8l-2.5-1.3l-2.6-5.4h-2.9l-4.6-4.4l0.8-5.8l-2.1-3l5.6-0.5l-1-2.7l3.3-11.9l5.1-2.7l2.3,1.7l2.6-3.5l2.5-2.1l-1-4.9 l6-3.2l2.5,1.3l1.5-2.6l6.4-0.9l5.2,3.5l-2.8,5.5l11.6,1.6l2.3,11.7l-2.5,5.1l2.3,2.2l-1.4,2.7l4.7,7.9l0.9,8.9l-1.5,3.5l-2.7,0.8 l-13.2-2.7l-1.9,2.5L357.8,308.5z">
                                    </path> @endif
                                    @if ($departement[36]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Indre" data-nom="Indre" data-numerodepartement="36" class="region-24 departement departement-36 departement-indre" d="m357.8,308.5l-2.8,2.9l-1.7-2.5l-5.8,1.1 l-2.6-1.1l1.5-2.8l-2.5-1.3l-2.6-5.4h-2.9l-4.6-4.4l0.8-5.8l-2.1-3l5.6-0.5l-1-2.7l3.3-11.9l5.1-2.7l2.3,1.7l2.6-3.5l2.5-2.1l-1-4.9 l6-3.2l2.5,1.3l1.5-2.6l6.4-0.9l5.2,3.5l-2.8,5.5l11.6,1.6l2.3,11.7l-2.5,5.1l2.3,2.2l-1.4,2.7l4.7,7.9l0.9,8.9l-1.5,3.5l-2.7,0.8 l-13.2-2.7l-1.9,2.5L357.8,308.5z">
                                    </path> @endif

                                    @if ($departement[37]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Indre-et-Loire" data-nom="Indre-et-Loire" data-numerodepartement="37" class="region-24 departement departement-37 departement-indre-et-loire" d="m303.9,263l-5.5-3.2v-0.1l5.8-15.3l1.7-9.3 l0.7-2.4l6.1,2.6l-0.5-3.3l2.8,0.3l7.7-4.5l10.5,0.5l-0.2,5.5l2.2-1.8l6,3.4l-0.7,2.7l3.4,5.1l-1.2,9.1l2.4,1.9l2.6-1.3l4.2,6.7 l1,4.9l-2.5,2.1l-2.6,3.5l-2.3-1.7l-5.1,2.7l-3.3,11.9l1,2.7l-5.6,0.5l-7.1-10l-0.3-3.1l-5.3-3l1.4,2.9l-10,0.4l-2.8-1.4l-1.3-6.1 l-2.9,0.3L303.9,263z">
                                        </path>
                                        @endif
                                        @if ($departement[37]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Indre-et-Loire" data-nom="Indre-et-Loire" data-numerodepartement="37" class="region-24 departement departement-37 departement-indre-et-loire" d="m303.9,263l-5.5-3.2v-0.1l5.8-15.3l1.7-9.3 l0.7-2.4l6.1,2.6l-0.5-3.3l2.8,0.3l7.7-4.5l10.5,0.5l-0.2,5.5l2.2-1.8l6,3.4l-0.7,2.7l3.4,5.1l-1.2,9.1l2.4,1.9l2.6-1.3l4.2,6.7 l1,4.9l-2.5,2.1l-2.6,3.5l-2.3-1.7l-5.1,2.7l-3.3,11.9l1,2.7l-5.6,0.5l-7.1-10l-0.3-3.1l-5.3-3l1.4,2.9l-10,0.4l-2.8-1.4l-1.3-6.1 l-2.9,0.3L303.9,263z">
                                        </path> @endif
                                        @if ($departement[37]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Indre-et-Loire" data-nom="Indre-et-Loire" data-numerodepartement="37" class="region-24 departement departement-37 departement-indre-et-loire" d="m303.9,263l-5.5-3.2v-0.1l5.8-15.3l1.7-9.3 l0.7-2.4l6.1,2.6l-0.5-3.3l2.8,0.3l7.7-4.5l10.5,0.5l-0.2,5.5l2.2-1.8l6,3.4l-0.7,2.7l3.4,5.1l-1.2,9.1l2.4,1.9l2.6-1.3l4.2,6.7 l1,4.9l-2.5,2.1l-2.6,3.5l-2.3-1.7l-5.1,2.7l-3.3,11.9l1,2.7l-5.6,0.5l-7.1-10l-0.3-3.1l-5.3-3l1.4,2.9l-10,0.4l-2.8-1.4l-1.3-6.1 l-2.9,0.3L303.9,263z">
                                        </path> @endif
                                        @if ($departement[37]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Indre-et-Loire" data-nom="Indre-et-Loire" data-numerodepartement="37" class="region-24 departement departement-37 departement-indre-et-loire" d="m303.9,263l-5.5-3.2v-0.1l5.8-15.3l1.7-9.3 l0.7-2.4l6.1,2.6l-0.5-3.3l2.8,0.3l7.7-4.5l10.5,0.5l-0.2,5.5l2.2-1.8l6,3.4l-0.7,2.7l3.4,5.1l-1.2,9.1l2.4,1.9l2.6-1.3l4.2,6.7 l1,4.9l-2.5,2.1l-2.6,3.5l-2.3-1.7l-5.1,2.7l-3.3,11.9l1,2.7l-5.6,0.5l-7.1-10l-0.3-3.1l-5.3-3l1.4,2.9l-10,0.4l-2.8-1.4l-1.3-6.1 l-2.9,0.3L303.9,263z">
                                        </path> @endif
                                        @if ($departement[37]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Indre-et-Loire" data-nom="Indre-et-Loire" data-numerodepartement="37" class="region-24 departement departement-37 departement-indre-et-loire" d="m303.9,263l-5.5-3.2v-0.1l5.8-15.3l1.7-9.3 l0.7-2.4l6.1,2.6l-0.5-3.3l2.8,0.3l7.7-4.5l10.5,0.5l-0.2,5.5l2.2-1.8l6,3.4l-0.7,2.7l3.4,5.1l-1.2,9.1l2.4,1.9l2.6-1.3l4.2,6.7 l1,4.9l-2.5,2.1l-2.6,3.5l-2.3-1.7l-5.1,2.7l-3.3,11.9l1,2.7l-5.6,0.5l-7.1-10l-0.3-3.1l-5.3-3l1.4,2.9l-10,0.4l-2.8-1.4l-1.3-6.1 l-2.9,0.3L303.9,263z">
                                        </path> @endif

                                        @if ($departement[41]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Loir-et-Cher" data-nom="Loir-et-Cher" data-numerodepartement="41" class="region-24 departement departement-41 departement-loir-et-cher" d="m357.9,256.4l-6,3.2l-4.2-6.7l-2.6,1.3 l-2.4-1.9l1.2-9.1l-3.4-5.1l0.7-2.7l-6-3.4l-2.2,1.8l0.2-5.5l-10.5-0.5l0.6-3.5l3.2-1.1l6.3-10.6l-0.4-5.5l-1.7-2.2l2-2.1v-0.1 l6.3-1.3l12.8,10.8l5.5-3.5l3.3,1.9l2.5,7.1l-1.8,3.2l1.7,5.6l3-1.3l2.4,1.5l1.1,3.8l2.9,0.6l1.9-2.3l15.2,1.6l0.8,2.6l-5,2.4 l5.1,7.6l-5.9,4.1l2.1,5.9l-9.7,2l-0.6,2.8l-2.8-0.1l-5.2-3.5l-6.4,0.9l-1.5,2.6L357.9,256.4z">
                                            </path>
                                            @endif
                                            @if ($departement[41]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Loir-et-Cher" data-nom="Loir-et-Cher" data-numerodepartement="41" class="region-24 departement departement-41 departement-loir-et-cher" d="m357.9,256.4l-6,3.2l-4.2-6.7l-2.6,1.3 l-2.4-1.9l1.2-9.1l-3.4-5.1l0.7-2.7l-6-3.4l-2.2,1.8l0.2-5.5l-10.5-0.5l0.6-3.5l3.2-1.1l6.3-10.6l-0.4-5.5l-1.7-2.2l2-2.1v-0.1 l6.3-1.3l12.8,10.8l5.5-3.5l3.3,1.9l2.5,7.1l-1.8,3.2l1.7,5.6l3-1.3l2.4,1.5l1.1,3.8l2.9,0.6l1.9-2.3l15.2,1.6l0.8,2.6l-5,2.4 l5.1,7.6l-5.9,4.1l2.1,5.9l-9.7,2l-0.6,2.8l-2.8-0.1l-5.2-3.5l-6.4,0.9l-1.5,2.6L357.9,256.4z">
                                            </path> @endif
                                            @if ($departement[41]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Loir-et-Cher" data-nom="Loir-et-Cher" data-numerodepartement="41" class="region-24 departement departement-41 departement-loir-et-cher" d="m357.9,256.4l-6,3.2l-4.2-6.7l-2.6,1.3 l-2.4-1.9l1.2-9.1l-3.4-5.1l0.7-2.7l-6-3.4l-2.2,1.8l0.2-5.5l-10.5-0.5l0.6-3.5l3.2-1.1l6.3-10.6l-0.4-5.5l-1.7-2.2l2-2.1v-0.1 l6.3-1.3l12.8,10.8l5.5-3.5l3.3,1.9l2.5,7.1l-1.8,3.2l1.7,5.6l3-1.3l2.4,1.5l1.1,3.8l2.9,0.6l1.9-2.3l15.2,1.6l0.8,2.6l-5,2.4 l5.1,7.6l-5.9,4.1l2.1,5.9l-9.7,2l-0.6,2.8l-2.8-0.1l-5.2-3.5l-6.4,0.9l-1.5,2.6L357.9,256.4z">
                                            </path> @endif
                                            @if ($departement[41]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Loir-et-Cher" data-nom="Loir-et-Cher" data-numerodepartement="41" class="region-24 departement departement-41 departement-loir-et-cher" d="m357.9,256.4l-6,3.2l-4.2-6.7l-2.6,1.3 l-2.4-1.9l1.2-9.1l-3.4-5.1l0.7-2.7l-6-3.4l-2.2,1.8l0.2-5.5l-10.5-0.5l0.6-3.5l3.2-1.1l6.3-10.6l-0.4-5.5l-1.7-2.2l2-2.1v-0.1 l6.3-1.3l12.8,10.8l5.5-3.5l3.3,1.9l2.5,7.1l-1.8,3.2l1.7,5.6l3-1.3l2.4,1.5l1.1,3.8l2.9,0.6l1.9-2.3l15.2,1.6l0.8,2.6l-5,2.4 l5.1,7.6l-5.9,4.1l2.1,5.9l-9.7,2l-0.6,2.8l-2.8-0.1l-5.2-3.5l-6.4,0.9l-1.5,2.6L357.9,256.4z">
                                            </path> @endif
                                            @if ($departement[41]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Loir-et-Cher" data-nom="Loir-et-Cher" data-numerodepartement="41" class="region-24 departement departement-41 departement-loir-et-cher" d="m357.9,256.4l-6,3.2l-4.2-6.7l-2.6,1.3 l-2.4-1.9l1.2-9.1l-3.4-5.1l0.7-2.7l-6-3.4l-2.2,1.8l0.2-5.5l-10.5-0.5l0.6-3.5l3.2-1.1l6.3-10.6l-0.4-5.5l-1.7-2.2l2-2.1v-0.1 l6.3-1.3l12.8,10.8l5.5-3.5l3.3,1.9l2.5,7.1l-1.8,3.2l1.7,5.6l3-1.3l2.4,1.5l1.1,3.8l2.9,0.6l1.9-2.3l15.2,1.6l0.8,2.6l-5,2.4 l5.1,7.6l-5.9,4.1l2.1,5.9l-9.7,2l-0.6,2.8l-2.8-0.1l-5.2-3.5l-6.4,0.9l-1.5,2.6L357.9,256.4z">
                                            </path> @endif

                                            @if ($departement[45]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Loiret" data-nom="Loiret" data-numerodepartement="45" class="region-24 departement departement-45 departement-loiret" d="m393.3,189.4l3.7,0.6l0.7,3.1l4.2,4.3l-0.6,2.7 l-2.6,1.5l9.2,0.7l11.2-2.7l6.7,7.5l0.4,5.8l-4.6,4.9l1.1,2.9l-1.6,2.4l-5.3,3.3l3,2.8l2.2,6.9l-2.8,0.7l-1.5,2.4l-9,1.7l-3.9-4.8 l-13.5-3.1l-0.8-2.6l-15.2-1.6l-1.9,2.3l-2.9-0.6l-1.1-3.8l-2.4-1.5l-3,1.3l-1.7-5.6l1.8-3.2l-2.5-7.1l-0.2-2.8l6-2.8l8.5-0.6 l4.8-10.8l0.5-1.5l6.9-0.7l1.9-2.9l1.5,2.7L393.3,189.4z">
                                                </path>
                                                @endif
                                                @if ($departement[45]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Loiret" data-nom="Loiret" data-numerodepartement="45" class="region-24 departement departement-45 departement-loiret" d="m393.3,189.4l3.7,0.6l0.7,3.1l4.2,4.3l-0.6,2.7 l-2.6,1.5l9.2,0.7l11.2-2.7l6.7,7.5l0.4,5.8l-4.6,4.9l1.1,2.9l-1.6,2.4l-5.3,3.3l3,2.8l2.2,6.9l-2.8,0.7l-1.5,2.4l-9,1.7l-3.9-4.8 l-13.5-3.1l-0.8-2.6l-15.2-1.6l-1.9,2.3l-2.9-0.6l-1.1-3.8l-2.4-1.5l-3,1.3l-1.7-5.6l1.8-3.2l-2.5-7.1l-0.2-2.8l6-2.8l8.5-0.6 l4.8-10.8l0.5-1.5l6.9-0.7l1.9-2.9l1.5,2.7L393.3,189.4z">
                                                </path> @endif
                                                @if ($departement[45]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Loiret" data-nom="Loiret" data-numerodepartement="45" class="region-24 departement departement-45 departement-loiret" d="m393.3,189.4l3.7,0.6l0.7,3.1l4.2,4.3l-0.6,2.7 l-2.6,1.5l9.2,0.7l11.2-2.7l6.7,7.5l0.4,5.8l-4.6,4.9l1.1,2.9l-1.6,2.4l-5.3,3.3l3,2.8l2.2,6.9l-2.8,0.7l-1.5,2.4l-9,1.7l-3.9-4.8 l-13.5-3.1l-0.8-2.6l-15.2-1.6l-1.9,2.3l-2.9-0.6l-1.1-3.8l-2.4-1.5l-3,1.3l-1.7-5.6l1.8-3.2l-2.5-7.1l-0.2-2.8l6-2.8l8.5-0.6 l4.8-10.8l0.5-1.5l6.9-0.7l1.9-2.9l1.5,2.7L393.3,189.4z">
                                                </path> @endif
                                                @if ($departement[45]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Loiret" data-nom="Loiret" data-numerodepartement="45" class="region-24 departement departement-45 departement-loiret" d="m393.3,189.4l3.7,0.6l0.7,3.1l4.2,4.3l-0.6,2.7 l-2.6,1.5l9.2,0.7l11.2-2.7l6.7,7.5l0.4,5.8l-4.6,4.9l1.1,2.9l-1.6,2.4l-5.3,3.3l3,2.8l2.2,6.9l-2.8,0.7l-1.5,2.4l-9,1.7l-3.9-4.8 l-13.5-3.1l-0.8-2.6l-15.2-1.6l-1.9,2.3l-2.9-0.6l-1.1-3.8l-2.4-1.5l-3,1.3l-1.7-5.6l1.8-3.2l-2.5-7.1l-0.2-2.8l6-2.8l8.5-0.6 l4.8-10.8l0.5-1.5l6.9-0.7l1.9-2.9l1.5,2.7L393.3,189.4z">
                                                </path> @endif
                                                @if ($departement[45]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Loiret" data-nom="Loiret" data-numerodepartement="45" class="region-24 departement departement-45 departement-loiret" d="m393.3,189.4l3.7,0.6l0.7,3.1l4.2,4.3l-0.6,2.7 l-2.6,1.5l9.2,0.7l11.2-2.7l6.7,7.5l0.4,5.8l-4.6,4.9l1.1,2.9l-1.6,2.4l-5.3,3.3l3,2.8l2.2,6.9l-2.8,0.7l-1.5,2.4l-9,1.7l-3.9-4.8 l-13.5-3.1l-0.8-2.6l-15.2-1.6l-1.9,2.3l-2.9-0.6l-1.1-3.8l-2.4-1.5l-3,1.3l-1.7-5.6l1.8-3.2l-2.5-7.1l-0.2-2.8l6-2.8l8.5-0.6 l4.8-10.8l0.5-1.5l6.9-0.7l1.9-2.9l1.5,2.7L393.3,189.4z">
                                                </path>@endif
                    </g>

                    <g data-nom="Bourgogne-Franche-Comté">

                        @if ($departement[19]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Côte-d’Or" data-nom="Côte-d’Or" data-numerodepartement="21" class="region-27 departement departement-21 departement-cote-dor" d="m523.6,241.7l3.9,8.2l-1.2,1.3l-1.8,8.2 l-6.2,6.8l-1.1,4.1v-0.1l-15,1.5l-8.8,4.2l-5.6-6.3l-5.5-1.9l-1.3-2.6l-5.7-1.7l-2.4-2.6V260l0.4-3.2l-3.7-1.2l-1.3-6h0.1l-1.3-2.7 l1.3-8.1l6.7-10.4l-1.7-2.3l2.8-2.1l0.3-3.7l-3.1-3.9l1.9-3.1l2.2-2l6.1-0.9l4.7-3.9l3.9,0.5l3.5,0.7l0.5,2.7l2.6,1l-0.3,2.9 l2.9,0.3l1.8,2.2l1,3.1l-2.8,2.4l2.3,4.8l9.2,2l3,1.6v2.8l4.8-1.9h0.1l2.7-1.6l2,3l0.1,3.2l-4.6,4.1L523.6,241.7z">
                            </path>
                            @endif
                            @if ($departement[19]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Côte-d’Or" data-nom="Côte-d’Or" data-numerodepartement="21" class="region-27 departement departement-21 departement-cote-dor" d="m523.6,241.7l3.9,8.2l-1.2,1.3l-1.8,8.2 l-6.2,6.8l-1.1,4.1v-0.1l-15,1.5l-8.8,4.2l-5.6-6.3l-5.5-1.9l-1.3-2.6l-5.7-1.7l-2.4-2.6V260l0.4-3.2l-3.7-1.2l-1.3-6h0.1l-1.3-2.7 l1.3-8.1l6.7-10.4l-1.7-2.3l2.8-2.1l0.3-3.7l-3.1-3.9l1.9-3.1l2.2-2l6.1-0.9l4.7-3.9l3.9,0.5l3.5,0.7l0.5,2.7l2.6,1l-0.3,2.9 l2.9,0.3l1.8,2.2l1,3.1l-2.8,2.4l2.3,4.8l9.2,2l3,1.6v2.8l4.8-1.9h0.1l2.7-1.6l2,3l0.1,3.2l-4.6,4.1L523.6,241.7z">
                            </path> @endif
                            @if ($departement[19]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Côte-d’Or" data-nom="Côte-d’Or" data-numerodepartement="21" class="region-27 departement departement-21 departement-cote-dor" d="m523.6,241.7l3.9,8.2l-1.2,1.3l-1.8,8.2 l-6.2,6.8l-1.1,4.1v-0.1l-15,1.5l-8.8,4.2l-5.6-6.3l-5.5-1.9l-1.3-2.6l-5.7-1.7l-2.4-2.6V260l0.4-3.2l-3.7-1.2l-1.3-6h0.1l-1.3-2.7 l1.3-8.1l6.7-10.4l-1.7-2.3l2.8-2.1l0.3-3.7l-3.1-3.9l1.9-3.1l2.2-2l6.1-0.9l4.7-3.9l3.9,0.5l3.5,0.7l0.5,2.7l2.6,1l-0.3,2.9 l2.9,0.3l1.8,2.2l1,3.1l-2.8,2.4l2.3,4.8l9.2,2l3,1.6v2.8l4.8-1.9h0.1l2.7-1.6l2,3l0.1,3.2l-4.6,4.1L523.6,241.7z">
                            </path> @endif
                            @if ($departement[19]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Côte-d’Or" data-nom="Côte-d’Or" data-numerodepartement="21" class="region-27 departement departement-21 departement-cote-dor" d="m523.6,241.7l3.9,8.2l-1.2,1.3l-1.8,8.2 l-6.2,6.8l-1.1,4.1v-0.1l-15,1.5l-8.8,4.2l-5.6-6.3l-5.5-1.9l-1.3-2.6l-5.7-1.7l-2.4-2.6V260l0.4-3.2l-3.7-1.2l-1.3-6h0.1l-1.3-2.7 l1.3-8.1l6.7-10.4l-1.7-2.3l2.8-2.1l0.3-3.7l-3.1-3.9l1.9-3.1l2.2-2l6.1-0.9l4.7-3.9l3.9,0.5l3.5,0.7l0.5,2.7l2.6,1l-0.3,2.9 l2.9,0.3l1.8,2.2l1,3.1l-2.8,2.4l2.3,4.8l9.2,2l3,1.6v2.8l4.8-1.9h0.1l2.7-1.6l2,3l0.1,3.2l-4.6,4.1L523.6,241.7z">
                            </path> @endif
                            @if ($departement[19]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Côte-d’Or" data-nom="Côte-d’Or" data-numerodepartement="21" class="region-27 departement departement-21 departement-cote-dor" d="m523.6,241.7l3.9,8.2l-1.2,1.3l-1.8,8.2 l-6.2,6.8l-1.1,4.1v-0.1l-15,1.5l-8.8,4.2l-5.6-6.3l-5.5-1.9l-1.3-2.6l-5.7-1.7l-2.4-2.6V260l0.4-3.2l-3.7-1.2l-1.3-6h0.1l-1.3-2.7 l1.3-8.1l6.7-10.4l-1.7-2.3l2.8-2.1l0.3-3.7l-3.1-3.9l1.9-3.1l2.2-2l6.1-0.9l4.7-3.9l3.9,0.5l3.5,0.7l0.5,2.7l2.6,1l-0.3,2.9 l2.9,0.3l1.8,2.2l1,3.1l-2.8,2.4l2.3,4.8l9.2,2l3,1.6v2.8l4.8-1.9h0.1l2.7-1.6l2,3l0.1,3.2l-4.6,4.1L523.6,241.7z">
                            </path> @endif



                            @if ($departement[23]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Doubs" data-nom="Doubs" data-numerodepartement="25" class="region-27 departement departement-25 departement-doubs" d="m590.1,245.2l-2.4,2.2l0.4,3l-4.8,6.2l-4.8,4 l-0.4,2.9l-2.5,2.7l-5.7,1.7l-0.3,0.3l-1.7,2.3l0.9,2.7l-0.7,4.5l0.5,2.5l-9.5,8.8l-2.9,5.2l-0.22,0.69l-3.68-3.49l3.6-7.4l2.1-2.3 l-4.2-4.1l-2.9-0.5l-5.8-10.1l-3,0.8l-1.5-2.5l-2,2.1l-1.2-2.5l3-5.1l-5.2-7.8l22.3-10.2l3-4.7l5.6-1.9l2.8,0.9l1.8-2.2l3.2-0.4 l0.5-2.8l5.9,0.8l0.2-0.1h0.1l5.9,2.7l-1.4,2.5l1.4,2.4l0.41-0.46l-0.11,0.16l-2.2,4.9l7-0.7L590.1,245.2z">
                                </path>
                                @endif
                                @if ($departement[23]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Doubs" data-nom="Doubs" data-numerodepartement="25" class="region-27 departement departement-25 departement-doubs" d="m590.1,245.2l-2.4,2.2l0.4,3l-4.8,6.2l-4.8,4 l-0.4,2.9l-2.5,2.7l-5.7,1.7l-0.3,0.3l-1.7,2.3l0.9,2.7l-0.7,4.5l0.5,2.5l-9.5,8.8l-2.9,5.2l-0.22,0.69l-3.68-3.49l3.6-7.4l2.1-2.3 l-4.2-4.1l-2.9-0.5l-5.8-10.1l-3,0.8l-1.5-2.5l-2,2.1l-1.2-2.5l3-5.1l-5.2-7.8l22.3-10.2l3-4.7l5.6-1.9l2.8,0.9l1.8-2.2l3.2-0.4 l0.5-2.8l5.9,0.8l0.2-0.1h0.1l5.9,2.7l-1.4,2.5l1.4,2.4l0.41-0.46l-0.11,0.16l-2.2,4.9l7-0.7L590.1,245.2z">
                                </path> @endif
                                @if ($departement[23]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Doubs" data-nom="Doubs" data-numerodepartement="25" class="region-27 departement departement-25 departement-doubs" d="m590.1,245.2l-2.4,2.2l0.4,3l-4.8,6.2l-4.8,4 l-0.4,2.9l-2.5,2.7l-5.7,1.7l-0.3,0.3l-1.7,2.3l0.9,2.7l-0.7,4.5l0.5,2.5l-9.5,8.8l-2.9,5.2l-0.22,0.69l-3.68-3.49l3.6-7.4l2.1-2.3 l-4.2-4.1l-2.9-0.5l-5.8-10.1l-3,0.8l-1.5-2.5l-2,2.1l-1.2-2.5l3-5.1l-5.2-7.8l22.3-10.2l3-4.7l5.6-1.9l2.8,0.9l1.8-2.2l3.2-0.4 l0.5-2.8l5.9,0.8l0.2-0.1h0.1l5.9,2.7l-1.4,2.5l1.4,2.4l0.41-0.46l-0.11,0.16l-2.2,4.9l7-0.7L590.1,245.2z">
                                </path> @endif
                                @if ($departement[23]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Doubs" data-nom="Doubs" data-numerodepartement="25" class="region-27 departement departement-25 departement-doubs" d="m590.1,245.2l-2.4,2.2l0.4,3l-4.8,6.2l-4.8,4 l-0.4,2.9l-2.5,2.7l-5.7,1.7l-0.3,0.3l-1.7,2.3l0.9,2.7l-0.7,4.5l0.5,2.5l-9.5,8.8l-2.9,5.2l-0.22,0.69l-3.68-3.49l3.6-7.4l2.1-2.3 l-4.2-4.1l-2.9-0.5l-5.8-10.1l-3,0.8l-1.5-2.5l-2,2.1l-1.2-2.5l3-5.1l-5.2-7.8l22.3-10.2l3-4.7l5.6-1.9l2.8,0.9l1.8-2.2l3.2-0.4 l0.5-2.8l5.9,0.8l0.2-0.1h0.1l5.9,2.7l-1.4,2.5l1.4,2.4l0.41-0.46l-0.11,0.16l-2.2,4.9l7-0.7L590.1,245.2z">
                                </path> @endif
                                @if ($departement[23]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Doubs" data-nom="Doubs" data-numerodepartement="25" class="region-27 departement departement-25 departement-doubs" d="m590.1,245.2l-2.4,2.2l0.4,3l-4.8,6.2l-4.8,4 l-0.4,2.9l-2.5,2.7l-5.7,1.7l-0.3,0.3l-1.7,2.3l0.9,2.7l-0.7,4.5l0.5,2.5l-9.5,8.8l-2.9,5.2l-0.22,0.69l-3.68-3.49l3.6-7.4l2.1-2.3 l-4.2-4.1l-2.9-0.5l-5.8-10.1l-3,0.8l-1.5-2.5l-2,2.1l-1.2-2.5l3-5.1l-5.2-7.8l22.3-10.2l3-4.7l5.6-1.9l2.8,0.9l1.8-2.2l3.2-0.4 l0.5-2.8l5.9,0.8l0.2-0.1h0.1l5.9,2.7l-1.4,2.5l1.4,2.4l0.41-0.46l-0.11,0.16l-2.2,4.9l7-0.7L590.1,245.2z">
                                </path> @endif



                                @if ($departement[39]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Jura" data-nom="Jura" data-numerodepartement="39" class="region-27 departement departement-39 departement-jura" d="m552.3,291.4l3.68,3.49L553.4,303l-5.3,7.2 l-5.5,3.2l-3.8,0.2l-0.4-2.8l-3.4-1.6l-4,4.4l-2.9,0.1l-0.1-3h-2.9l-4.3-7.7l2.8-1.1l-0.8-5.3l2.8-5l-2.2-8.7l-2.5-1.6l5-3.7 l-8.3-4.4l-0.4-2.9l1.1-4.1l6.2-6.8l1.8-8.2l1.2-1.3l2.3,2l5.4,0.1l5.2,7.8l-3,5.1l1.2,2.5l2-2.1l1.5,2.5l3-0.8l5.8,10.1l2.9,0.5 l4.2,4.1l-2.1,2.3L552.3,291.4z">
                                    </path>
                                    @endif
                                    @if ($departement[39]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Jura" data-nom="Jura" data-numerodepartement="39" class="region-27 departement departement-39 departement-jura" d="m552.3,291.4l3.68,3.49L553.4,303l-5.3,7.2 l-5.5,3.2l-3.8,0.2l-0.4-2.8l-3.4-1.6l-4,4.4l-2.9,0.1l-0.1-3h-2.9l-4.3-7.7l2.8-1.1l-0.8-5.3l2.8-5l-2.2-8.7l-2.5-1.6l5-3.7 l-8.3-4.4l-0.4-2.9l1.1-4.1l6.2-6.8l1.8-8.2l1.2-1.3l2.3,2l5.4,0.1l5.2,7.8l-3,5.1l1.2,2.5l2-2.1l1.5,2.5l3-0.8l5.8,10.1l2.9,0.5 l4.2,4.1l-2.1,2.3L552.3,291.4z">
                                    </path>@endif
                                    @if ($departement[39]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Jura" data-nom="Jura" data-numerodepartement="39" class="region-27 departement departement-39 departement-jura" d="m552.3,291.4l3.68,3.49L553.4,303l-5.3,7.2 l-5.5,3.2l-3.8,0.2l-0.4-2.8l-3.4-1.6l-4,4.4l-2.9,0.1l-0.1-3h-2.9l-4.3-7.7l2.8-1.1l-0.8-5.3l2.8-5l-2.2-8.7l-2.5-1.6l5-3.7 l-8.3-4.4l-0.4-2.9l1.1-4.1l6.2-6.8l1.8-8.2l1.2-1.3l2.3,2l5.4,0.1l5.2,7.8l-3,5.1l1.2,2.5l2-2.1l1.5,2.5l3-0.8l5.8,10.1l2.9,0.5 l4.2,4.1l-2.1,2.3L552.3,291.4z">
                                    </path>@endif
                                    @if ($departement[39]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Jura" data-nom="Jura" data-numerodepartement="39" class="region-27 departement departement-39 departement-jura" d="m552.3,291.4l3.68,3.49L553.4,303l-5.3,7.2 l-5.5,3.2l-3.8,0.2l-0.4-2.8l-3.4-1.6l-4,4.4l-2.9,0.1l-0.1-3h-2.9l-4.3-7.7l2.8-1.1l-0.8-5.3l2.8-5l-2.2-8.7l-2.5-1.6l5-3.7 l-8.3-4.4l-0.4-2.9l1.1-4.1l6.2-6.8l1.8-8.2l1.2-1.3l2.3,2l5.4,0.1l5.2,7.8l-3,5.1l1.2,2.5l2-2.1l1.5,2.5l3-0.8l5.8,10.1l2.9,0.5 l4.2,4.1l-2.1,2.3L552.3,291.4z">
                                    </path> @endif
                                    @if ($departement[39]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Jura" data-nom="Jura" data-numerodepartement="39" class="region-27 departement departement-39 departement-jura" d="m552.3,291.4l3.68,3.49L553.4,303l-5.3,7.2 l-5.5,3.2l-3.8,0.2l-0.4-2.8l-3.4-1.6l-4,4.4l-2.9,0.1l-0.1-3h-2.9l-4.3-7.7l2.8-1.1l-0.8-5.3l2.8-5l-2.2-8.7l-2.5-1.6l5-3.7 l-8.3-4.4l-0.4-2.9l1.1-4.1l6.2-6.8l1.8-8.2l1.2-1.3l2.3,2l5.4,0.1l5.2,7.8l-3,5.1l1.2,2.5l2-2.1l1.5,2.5l3-0.8l5.8,10.1l2.9,0.5 l4.2,4.1l-2.1,2.3L552.3,291.4z">
                                    </path>@endif

                                    @if ($departement[58]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Nièvre" data-nom="Nièvre" data-numerodepartement="58" class="region-27 departement departement-58 departement-nievre" d="m462.8,250l5.5-0.4l1.3,6l3.7,1.2l-0.4,3.2v0.8 l-1.1,0.3l-2.7,0.4v1.3l-2.8,1l0.3,5.9l-2.1,1.7l4,7l-1.9,2.1l0.7,2.9l-11.3,5.7l-7-2.8l-5.9,6l-4.4-3.7l-2.8,1.7l-6.4-0.2l-5.7-6.3 l1.3-8.9l0.2-5.8l-2.2-2l-0.3-5.9l-3.1-7.6l-2.7-2.1l1.7-5.8l-2-6.5l1.5-2.4l2.8-0.7v0.1h3.4l7.4,4.8h6l4.6-4.3l3.9,5.6l5.5,3 l5.8-0.9l0.9,3.7l2.8-0.9L462.8,250z">
                                        </path>
                                        @endif
                                        @if ($departement[58]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Nièvre" data-nom="Nièvre" data-numerodepartement="58" class="region-27 departement departement-58 departement-nievre" d="m462.8,250l5.5-0.4l1.3,6l3.7,1.2l-0.4,3.2v0.8 l-1.1,0.3l-2.7,0.4v1.3l-2.8,1l0.3,5.9l-2.1,1.7l4,7l-1.9,2.1l0.7,2.9l-11.3,5.7l-7-2.8l-5.9,6l-4.4-3.7l-2.8,1.7l-6.4-0.2l-5.7-6.3 l1.3-8.9l0.2-5.8l-2.2-2l-0.3-5.9l-3.1-7.6l-2.7-2.1l1.7-5.8l-2-6.5l1.5-2.4l2.8-0.7v0.1h3.4l7.4,4.8h6l4.6-4.3l3.9,5.6l5.5,3 l5.8-0.9l0.9,3.7l2.8-0.9L462.8,250z">
                                        </path> @endif
                                        @if ($departement[58]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Nièvre" data-nom="Nièvre" data-numerodepartement="58" class="region-27 departement departement-58 departement-nievre" d="m462.8,250l5.5-0.4l1.3,6l3.7,1.2l-0.4,3.2v0.8 l-1.1,0.3l-2.7,0.4v1.3l-2.8,1l0.3,5.9l-2.1,1.7l4,7l-1.9,2.1l0.7,2.9l-11.3,5.7l-7-2.8l-5.9,6l-4.4-3.7l-2.8,1.7l-6.4-0.2l-5.7-6.3 l1.3-8.9l0.2-5.8l-2.2-2l-0.3-5.9l-3.1-7.6l-2.7-2.1l1.7-5.8l-2-6.5l1.5-2.4l2.8-0.7v0.1h3.4l7.4,4.8h6l4.6-4.3l3.9,5.6l5.5,3 l5.8-0.9l0.9,3.7l2.8-0.9L462.8,250z">
                                        </path> @endif
                                        @if ($departement[58]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Nièvre" data-nom="Nièvre" data-numerodepartement="58" class="region-27 departement departement-58 departement-nievre" d="m462.8,250l5.5-0.4l1.3,6l3.7,1.2l-0.4,3.2v0.8 l-1.1,0.3l-2.7,0.4v1.3l-2.8,1l0.3,5.9l-2.1,1.7l4,7l-1.9,2.1l0.7,2.9l-11.3,5.7l-7-2.8l-5.9,6l-4.4-3.7l-2.8,1.7l-6.4-0.2l-5.7-6.3 l1.3-8.9l0.2-5.8l-2.2-2l-0.3-5.9l-3.1-7.6l-2.7-2.1l1.7-5.8l-2-6.5l1.5-2.4l2.8-0.7v0.1h3.4l7.4,4.8h6l4.6-4.3l3.9,5.6l5.5,3 l5.8-0.9l0.9,3.7l2.8-0.9L462.8,250z">
                                        </path> @endif
                                        @if ($departement[58]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Nièvre" data-nom="Nièvre" data-numerodepartement="58" class="region-27 departement departement-58 departement-nievre" d="m462.8,250l5.5-0.4l1.3,6l3.7,1.2l-0.4,3.2v0.8 l-1.1,0.3l-2.7,0.4v1.3l-2.8,1l0.3,5.9l-2.1,1.7l4,7l-1.9,2.1l0.7,2.9l-11.3,5.7l-7-2.8l-5.9,6l-4.4-3.7l-2.8,1.7l-6.4-0.2l-5.7-6.3 l1.3-8.9l0.2-5.8l-2.2-2l-0.3-5.9l-3.1-7.6l-2.7-2.1l1.7-5.8l-2-6.5l1.5-2.4l2.8-0.7v0.1h3.4l7.4,4.8h6l4.6-4.3l3.9,5.6l5.5,3 l5.8-0.9l0.9,3.7l2.8-0.9L462.8,250z">
                                        </path> @endif

                                        @if ($departement[70]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Haute-Saône" data-nom="Haute-Saône" data-numerodepartement="70" class="region-27 departement departement-70 departement-haute-saone" d="m579.1,225.9l1.4,5.5l-0.2,0.1l-5.9-0.8 l-0.5,2.8l-3.2,0.4l-1.8,2.2l-2.8-0.9l-5.6,1.9l-3,4.7L535.2,252l-5.4-0.1l-2.3-2l-3.9-8.2l-2.6-1.4l4.6-4.1l-0.1-3.2l-2-3l-2.7,1.6 h-0.1l1.2-2.5l6.6-3.9l2.1,1.8l3.2-1l0.3-8.3l2-2.4l2.9,0.3l2.3-3.2l-0.2-1.4l8-5.8l7,4.3l5.8-1.6l4.9,3.6l5.1-2.2l8.4,6.6l-2.3,5.7 L579.1,225.9z">
                                            </path>
                                            @endif
                                            @if ($departement[70]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Haute-Saône" data-nom="Haute-Saône" data-numerodepartement="70" class="region-27 departement departement-70 departement-haute-saone" d="m579.1,225.9l1.4,5.5l-0.2,0.1l-5.9-0.8 l-0.5,2.8l-3.2,0.4l-1.8,2.2l-2.8-0.9l-5.6,1.9l-3,4.7L535.2,252l-5.4-0.1l-2.3-2l-3.9-8.2l-2.6-1.4l4.6-4.1l-0.1-3.2l-2-3l-2.7,1.6 h-0.1l1.2-2.5l6.6-3.9l2.1,1.8l3.2-1l0.3-8.3l2-2.4l2.9,0.3l2.3-3.2l-0.2-1.4l8-5.8l7,4.3l5.8-1.6l4.9,3.6l5.1-2.2l8.4,6.6l-2.3,5.7 L579.1,225.9z">
                                            </path> @endif
                                            @if ($departement[70]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Haute-Saône" data-nom="Haute-Saône" data-numerodepartement="70" class="region-27 departement departement-70 departement-haute-saone" d="m579.1,225.9l1.4,5.5l-0.2,0.1l-5.9-0.8 l-0.5,2.8l-3.2,0.4l-1.8,2.2l-2.8-0.9l-5.6,1.9l-3,4.7L535.2,252l-5.4-0.1l-2.3-2l-3.9-8.2l-2.6-1.4l4.6-4.1l-0.1-3.2l-2-3l-2.7,1.6 h-0.1l1.2-2.5l6.6-3.9l2.1,1.8l3.2-1l0.3-8.3l2-2.4l2.9,0.3l2.3-3.2l-0.2-1.4l8-5.8l7,4.3l5.8-1.6l4.9,3.6l5.1-2.2l8.4,6.6l-2.3,5.7 L579.1,225.9z">
                                            </path> @endif
                                            @if ($departement[70]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Haute-Saône" data-nom="Haute-Saône" data-numerodepartement="70" class="region-27 departement departement-70 departement-haute-saone" d="m579.1,225.9l1.4,5.5l-0.2,0.1l-5.9-0.8 l-0.5,2.8l-3.2,0.4l-1.8,2.2l-2.8-0.9l-5.6,1.9l-3,4.7L535.2,252l-5.4-0.1l-2.3-2l-3.9-8.2l-2.6-1.4l4.6-4.1l-0.1-3.2l-2-3l-2.7,1.6 h-0.1l1.2-2.5l6.6-3.9l2.1,1.8l3.2-1l0.3-8.3l2-2.4l2.9,0.3l2.3-3.2l-0.2-1.4l8-5.8l7,4.3l5.8-1.6l4.9,3.6l5.1-2.2l8.4,6.6l-2.3,5.7 L579.1,225.9z">
                                            </path> @endif
                                            @if ($departement[70]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Haute-Saône" data-nom="Haute-Saône" data-numerodepartement="70" class="region-27 departement departement-70 departement-haute-saone" d="m579.1,225.9l1.4,5.5l-0.2,0.1l-5.9-0.8 l-0.5,2.8l-3.2,0.4l-1.8,2.2l-2.8-0.9l-5.6,1.9l-3,4.7L535.2,252l-5.4-0.1l-2.3-2l-3.9-8.2l-2.6-1.4l4.6-4.1l-0.1-3.2l-2-3l-2.7,1.6 h-0.1l1.2-2.5l6.6-3.9l2.1,1.8l3.2-1l0.3-8.3l2-2.4l2.9,0.3l2.3-3.2l-0.2-1.4l8-5.8l7,4.3l5.8-1.6l4.9,3.6l5.1-2.2l8.4,6.6l-2.3,5.7 L579.1,225.9z">
                                            </path> @endif


                                            @if ($departement[71]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Saône-et-Loire" data-nom="Saône-et-Loire" data-numerodepartement="71" class="region-27 departement departement-71 departement-saone-et-loire" d="m517.2,270.2v0.1l0.4,2.9l8.3,4.4l-5,3.7 l2.5,1.6l2.2,8.7l-2.8,5l0.8,5.3l-2.8,1.1l-4.8-3.3l-5.4,1.3l-5.9-1.5l-5.9,20.9l-5.7-7.7l-1.6,2.3l-2.5-1.5l-2.2,1.6l-2.2-1.7 l-2.3,1.9l-0.29,2.91L482,318.2v0.1l-5.7,3.8l-2.1-2.1l-8,1.5l-5.2-3.3v-3l3.7-4.6l0.5-5.5l-1.6-2.4l-7.9-2.9l-6.7-13.5l7,2.8 l11.3-5.7l-0.7-2.9l1.9-2.1l-4-7l2.1-1.7l-0.3-5.9l2.8-1l2.7-1.7l1.1-0.3l2.4,2.6l5.7,1.7l1.3,2.6l5.5,1.9l5.6,6.3l8.8-4.2 L517.2,270.2z">
                                                </path>
                                                @endif
                                                @if ($departement[71]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Saône-et-Loire" data-nom="Saône-et-Loire" data-numerodepartement="71" class="region-27 departement departement-71 departement-saone-et-loire" d="m517.2,270.2v0.1l0.4,2.9l8.3,4.4l-5,3.7 l2.5,1.6l2.2,8.7l-2.8,5l0.8,5.3l-2.8,1.1l-4.8-3.3l-5.4,1.3l-5.9-1.5l-5.9,20.9l-5.7-7.7l-1.6,2.3l-2.5-1.5l-2.2,1.6l-2.2-1.7 l-2.3,1.9l-0.29,2.91L482,318.2v0.1l-5.7,3.8l-2.1-2.1l-8,1.5l-5.2-3.3v-3l3.7-4.6l0.5-5.5l-1.6-2.4l-7.9-2.9l-6.7-13.5l7,2.8 l11.3-5.7l-0.7-2.9l1.9-2.1l-4-7l2.1-1.7l-0.3-5.9l2.8-1l2.7-1.7l1.1-0.3l2.4,2.6l5.7,1.7l1.3,2.6l5.5,1.9l5.6,6.3l8.8-4.2 L517.2,270.2z">
                                                </path> @endif
                                                @if ($departement[71]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Saône-et-Loire" data-nom="Saône-et-Loire" data-numerodepartement="71" class="region-27 departement departement-71 departement-saone-et-loire" d="m517.2,270.2v0.1l0.4,2.9l8.3,4.4l-5,3.7 l2.5,1.6l2.2,8.7l-2.8,5l0.8,5.3l-2.8,1.1l-4.8-3.3l-5.4,1.3l-5.9-1.5l-5.9,20.9l-5.7-7.7l-1.6,2.3l-2.5-1.5l-2.2,1.6l-2.2-1.7 l-2.3,1.9l-0.29,2.91L482,318.2v0.1l-5.7,3.8l-2.1-2.1l-8,1.5l-5.2-3.3v-3l3.7-4.6l0.5-5.5l-1.6-2.4l-7.9-2.9l-6.7-13.5l7,2.8 l11.3-5.7l-0.7-2.9l1.9-2.1l-4-7l2.1-1.7l-0.3-5.9l2.8-1l2.7-1.7l1.1-0.3l2.4,2.6l5.7,1.7l1.3,2.6l5.5,1.9l5.6,6.3l8.8-4.2 L517.2,270.2z">
                                                </path> @endif
                                                @if ($departement[71]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Saône-et-Loire" data-nom="Saône-et-Loire" data-numerodepartement="71" class="region-27 departement departement-71 departement-saone-et-loire" d="m517.2,270.2v0.1l0.4,2.9l8.3,4.4l-5,3.7 l2.5,1.6l2.2,8.7l-2.8,5l0.8,5.3l-2.8,1.1l-4.8-3.3l-5.4,1.3l-5.9-1.5l-5.9,20.9l-5.7-7.7l-1.6,2.3l-2.5-1.5l-2.2,1.6l-2.2-1.7 l-2.3,1.9l-0.29,2.91L482,318.2v0.1l-5.7,3.8l-2.1-2.1l-8,1.5l-5.2-3.3v-3l3.7-4.6l0.5-5.5l-1.6-2.4l-7.9-2.9l-6.7-13.5l7,2.8 l11.3-5.7l-0.7-2.9l1.9-2.1l-4-7l2.1-1.7l-0.3-5.9l2.8-1l2.7-1.7l1.1-0.3l2.4,2.6l5.7,1.7l1.3,2.6l5.5,1.9l5.6,6.3l8.8-4.2 L517.2,270.2z">
                                                </path> @endif
                                                @if ($departement[71]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Saône-et-Loire" data-nom="Saône-et-Loire" data-numerodepartement="71" class="region-27 departement departement-71 departement-saone-et-loire" d="m517.2,270.2v0.1l0.4,2.9l8.3,4.4l-5,3.7 l2.5,1.6l2.2,8.7l-2.8,5l0.8,5.3l-2.8,1.1l-4.8-3.3l-5.4,1.3l-5.9-1.5l-5.9,20.9l-5.7-7.7l-1.6,2.3l-2.5-1.5l-2.2,1.6l-2.2-1.7 l-2.3,1.9l-0.29,2.91L482,318.2v0.1l-5.7,3.8l-2.1-2.1l-8,1.5l-5.2-3.3v-3l3.7-4.6l0.5-5.5l-1.6-2.4l-7.9-2.9l-6.7-13.5l7,2.8 l11.3-5.7l-0.7-2.9l1.9-2.1l-4-7l2.1-1.7l-0.3-5.9l2.8-1l2.7-1.7l1.1-0.3l2.4,2.6l5.7,1.7l1.3,2.6l5.5,1.9l5.6,6.3l8.8-4.2 L517.2,270.2z">
                                                </path> @endif


                                                @if ($departement[89]->hospitalises
                                                <= 50) <path class="region" style="fill: green" id="Yonne" data-nom="Yonne" data-numerodepartement="89" class="region-27 departement departement-89 departement-yonne" d="m425.8,207.1l-6.7-7.5l3.9-5.4l0.2-5.8l15.4-3 l3.6,1.5l4.5,5.5l2.5,8.3l2-2.2l3.6,4.1l5,10.9l12.6-1.6l2.9,1.4l-1.9,3.1l3.1,3.9l-0.3,3.7l-2.8,2.1l1.7,2.3l-6.7,10.4l-1.3,8.1 l1.3,2.7h-0.1l-5.5,0.4l-1.5-2.8l-2.8,0.9l-0.9-3.7l-5.8,0.9l-5.5-3l-3.9-5.6l-4.6,4.3h-6l-7.4-4.8H421v-0.1l-2.2-6.9l-3-2.8 l5.3-3.3l1.6-2.4l-1.1-2.9l4.6-4.9L425.8,207.1z">
                                                    </path>
                                                    @endif
                                                    @if ($departement[89]->hospitalises > 50)
                                                    <path class="region" style="fill: yellow" id="Yonne" data-nom="Yonne" data-numerodepartement="89" class="region-27 departement departement-89 departement-yonne" d="m425.8,207.1l-6.7-7.5l3.9-5.4l0.2-5.8l15.4-3 l3.6,1.5l4.5,5.5l2.5,8.3l2-2.2l3.6,4.1l5,10.9l12.6-1.6l2.9,1.4l-1.9,3.1l3.1,3.9l-0.3,3.7l-2.8,2.1l1.7,2.3l-6.7,10.4l-1.3,8.1 l1.3,2.7h-0.1l-5.5,0.4l-1.5-2.8l-2.8,0.9l-0.9-3.7l-5.8,0.9l-5.5-3l-3.9-5.6l-4.6,4.3h-6l-7.4-4.8H421v-0.1l-2.2-6.9l-3-2.8 l5.3-3.3l1.6-2.4l-1.1-2.9l4.6-4.9L425.8,207.1z">
                                                    </path> @endif
                                                    @if ($departement[89]->hospitalises >= 150)
                                                    <path class="region" style="fill: pink" id="Yonne" data-nom="Yonne" data-numerodepartement="89" class="region-27 departement departement-89 departement-yonne" d="m425.8,207.1l-6.7-7.5l3.9-5.4l0.2-5.8l15.4-3 l3.6,1.5l4.5,5.5l2.5,8.3l2-2.2l3.6,4.1l5,10.9l12.6-1.6l2.9,1.4l-1.9,3.1l3.1,3.9l-0.3,3.7l-2.8,2.1l1.7,2.3l-6.7,10.4l-1.3,8.1 l1.3,2.7h-0.1l-5.5,0.4l-1.5-2.8l-2.8,0.9l-0.9-3.7l-5.8,0.9l-5.5-3l-3.9-5.6l-4.6,4.3h-6l-7.4-4.8H421v-0.1l-2.2-6.9l-3-2.8 l5.3-3.3l1.6-2.4l-1.1-2.9l4.6-4.9L425.8,207.1z">
                                                    </path>@endif
                                                    @if ($departement[89]->hospitalises >= 250)
                                                    <path class="region" style="fill: purple" id="Yonne" data-nom="Yonne" data-numerodepartement="89" class="region-27 departement departement-89 departement-yonne" d="m425.8,207.1l-6.7-7.5l3.9-5.4l0.2-5.8l15.4-3 l3.6,1.5l4.5,5.5l2.5,8.3l2-2.2l3.6,4.1l5,10.9l12.6-1.6l2.9,1.4l-1.9,3.1l3.1,3.9l-0.3,3.7l-2.8,2.1l1.7,2.3l-6.7,10.4l-1.3,8.1 l1.3,2.7h-0.1l-5.5,0.4l-1.5-2.8l-2.8,0.9l-0.9-3.7l-5.8,0.9l-5.5-3l-3.9-5.6l-4.6,4.3h-6l-7.4-4.8H421v-0.1l-2.2-6.9l-3-2.8 l5.3-3.3l1.6-2.4l-1.1-2.9l4.6-4.9L425.8,207.1z">
                                                    </path> @endif
                                                    @if ($departement[89]->hospitalises >= 400)
                                                    <path class="region" style="fill: red" id="Yonne" data-nom="Yonne" data-numerodepartement="89" class="region-27 departement departement-89 departement-yonne" d="m425.8,207.1l-6.7-7.5l3.9-5.4l0.2-5.8l15.4-3 l3.6,1.5l4.5,5.5l2.5,8.3l2-2.2l3.6,4.1l5,10.9l12.6-1.6l2.9,1.4l-1.9,3.1l3.1,3.9l-0.3,3.7l-2.8,2.1l1.7,2.3l-6.7,10.4l-1.3,8.1 l1.3,2.7h-0.1l-5.5,0.4l-1.5-2.8l-2.8,0.9l-0.9-3.7l-5.8,0.9l-5.5-3l-3.9-5.6l-4.6,4.3h-6l-7.4-4.8H421v-0.1l-2.2-6.9l-3-2.8 l5.3-3.3l1.6-2.4l-1.1-2.9l4.6-4.9L425.8,207.1z">
                                                    </path> @endif

                                                    @if ($departement[90]->hospitalises
                                                    <= 50) <path class="region" style="fill: green" id="Territoire de Belfort" data-nom="Territoire de Belfort" data-numerodepartement="90" class="region-27 departement departement-90 departement-territoire-de-belfort" d="m580.3,215.9l0.9-0.6l7.6,5l0.5,9l2.8-0.2l2,5 l-0.1,0.1l-2.79,0.39l-1.11-0.39l-3.19,4.34L586.5,239l-1.4-2.4l1.4-2.5l-5.9-2.7h-0.1l-1.4-5.5l-1.1-4.3L580.3,215.9z">
                                                        </path>
                                                        @endif
                                                        @if ($departement[90]->hospitalises > 50)
                                                        <path class="region" style="fill: yellow" id="Territoire de Belfort" data-nom="Territoire de Belfort" data-numerodepartement="90" class="region-27 departement departement-90 departement-territoire-de-belfort" d="m580.3,215.9l0.9-0.6l7.6,5l0.5,9l2.8-0.2l2,5 l-0.1,0.1l-2.79,0.39l-1.11-0.39l-3.19,4.34L586.5,239l-1.4-2.4l1.4-2.5l-5.9-2.7h-0.1l-1.4-5.5l-1.1-4.3L580.3,215.9z">
                                                        </path> @endif
                                                        @if ($departement[90]->hospitalises >= 150)
                                                        <path class="region" style="fill: pink" id="Territoire de Belfort" data-nom="Territoire de Belfort" data-numerodepartement="90" class="region-27 departement departement-90 departement-territoire-de-belfort" d="m580.3,215.9l0.9-0.6l7.6,5l0.5,9l2.8-0.2l2,5 l-0.1,0.1l-2.79,0.39l-1.11-0.39l-3.19,4.34L586.5,239l-1.4-2.4l1.4-2.5l-5.9-2.7h-0.1l-1.4-5.5l-1.1-4.3L580.3,215.9z">
                                                        </path> @endif
                                                        @if ($departement[90]->hospitalises >= 250)
                                                        <path class="region" style="fill: purple" id="Territoire de Belfort" data-nom="Territoire de Belfort" data-numerodepartement="90" class="region-27 departement departement-90 departement-territoire-de-belfort" d="m580.3,215.9l0.9-0.6l7.6,5l0.5,9l2.8-0.2l2,5 l-0.1,0.1l-2.79,0.39l-1.11-0.39l-3.19,4.34L586.5,239l-1.4-2.4l1.4-2.5l-5.9-2.7h-0.1l-1.4-5.5l-1.1-4.3L580.3,215.9z">
                                                        </path> @endif
                                                        @if ($departement[90]->hospitalises >= 400)
                                                        <path class="region" style="fill: red" id="Territoire de Belfort" data-nom="Territoire de Belfort" data-numerodepartement="90" class="region-27 departement departement-90 departement-territoire-de-belfort" d="m580.3,215.9l0.9-0.6l7.6,5l0.5,9l2.8-0.2l2,5 l-0.1,0.1l-2.79,0.39l-1.11-0.39l-3.19,4.34L586.5,239l-1.4-2.4l1.4-2.5l-5.9-2.7h-0.1l-1.4-5.5l-1.1-4.3L580.3,215.9z">
                                                        </path> @endif
                    </g>

                    <g data-nom="Normandie">

                        @if ($departement[13]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Calvados" data-nom="Calvados" data-numerodepartement="14" class="region-28 departement departement-14 departement-calvados" d="m316.9,148l-0.7,2.2l-5.6-1l-7,1.7l-7.2,5.4 l-2.9,0.3l-5.7-1.1l-2.6,1.7l-4.9-3l-6.4,2.3l-2.7-1.3l-0.9,2.7l-5.4,2.9l-9.7-2.1l-1.8-2.4l4.5-5.3l-1.6-2.3l8.1-4.9l-2.2-8.2 l2-2.6l-8.4-3.1l-0.5-6.6v-0.1l0.1-0.7l1.8,0.8l1.9-2.1l3.4-0.3l9.4,3.3l13.9,1.5l6.9,3.4l5.7-0.7l4.7-2.5l4.1-3.7l5.1-1.1l0.3,8.3 h2.9l-2.3,2.1l2.8,9.4l-1.4,3L316.9,148z">
                            </path>
                            @endif
                            @if ($departement[13]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Calvados" data-nom="Calvados" data-numerodepartement="14" class="region-28 departement departement-14 departement-calvados" d="m316.9,148l-0.7,2.2l-5.6-1l-7,1.7l-7.2,5.4 l-2.9,0.3l-5.7-1.1l-2.6,1.7l-4.9-3l-6.4,2.3l-2.7-1.3l-0.9,2.7l-5.4,2.9l-9.7-2.1l-1.8-2.4l4.5-5.3l-1.6-2.3l8.1-4.9l-2.2-8.2 l2-2.6l-8.4-3.1l-0.5-6.6v-0.1l0.1-0.7l1.8,0.8l1.9-2.1l3.4-0.3l9.4,3.3l13.9,1.5l6.9,3.4l5.7-0.7l4.7-2.5l4.1-3.7l5.1-1.1l0.3,8.3 h2.9l-2.3,2.1l2.8,9.4l-1.4,3L316.9,148z">
                            </path> @endif
                            @if ($departement[13]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Calvados" data-nom="Calvados" data-numerodepartement="14" class="region-28 departement departement-14 departement-calvados" d="m316.9,148l-0.7,2.2l-5.6-1l-7,1.7l-7.2,5.4 l-2.9,0.3l-5.7-1.1l-2.6,1.7l-4.9-3l-6.4,2.3l-2.7-1.3l-0.9,2.7l-5.4,2.9l-9.7-2.1l-1.8-2.4l4.5-5.3l-1.6-2.3l8.1-4.9l-2.2-8.2 l2-2.6l-8.4-3.1l-0.5-6.6v-0.1l0.1-0.7l1.8,0.8l1.9-2.1l3.4-0.3l9.4,3.3l13.9,1.5l6.9,3.4l5.7-0.7l4.7-2.5l4.1-3.7l5.1-1.1l0.3,8.3 h2.9l-2.3,2.1l2.8,9.4l-1.4,3L316.9,148z">
                            </path> @endif
                            @if ($departement[13]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Calvados" data-nom="Calvados" data-numerodepartement="14" class="region-28 departement departement-14 departement-calvados" d="m316.9,148l-0.7,2.2l-5.6-1l-7,1.7l-7.2,5.4 l-2.9,0.3l-5.7-1.1l-2.6,1.7l-4.9-3l-6.4,2.3l-2.7-1.3l-0.9,2.7l-5.4,2.9l-9.7-2.1l-1.8-2.4l4.5-5.3l-1.6-2.3l8.1-4.9l-2.2-8.2 l2-2.6l-8.4-3.1l-0.5-6.6v-0.1l0.1-0.7l1.8,0.8l1.9-2.1l3.4-0.3l9.4,3.3l13.9,1.5l6.9,3.4l5.7-0.7l4.7-2.5l4.1-3.7l5.1-1.1l0.3,8.3 h2.9l-2.3,2.1l2.8,9.4l-1.4,3L316.9,148z">
                            </path> @endif
                            @if ($departement[13]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Calvados" data-nom="Calvados" data-numerodepartement="14" class="region-28 departement departement-14 departement-calvados" d="m316.9,148l-0.7,2.2l-5.6-1l-7,1.7l-7.2,5.4 l-2.9,0.3l-5.7-1.1l-2.6,1.7l-4.9-3l-6.4,2.3l-2.7-1.3l-0.9,2.7l-5.4,2.9l-9.7-2.1l-1.8-2.4l4.5-5.3l-1.6-2.3l8.1-4.9l-2.2-8.2 l2-2.6l-8.4-3.1l-0.5-6.6v-0.1l0.1-0.7l1.8,0.8l1.9-2.1l3.4-0.3l9.4,3.3l13.9,1.5l6.9,3.4l5.7-0.7l4.7-2.5l4.1-3.7l5.1-1.1l0.3,8.3 h2.9l-2.3,2.1l2.8,9.4l-1.4,3L316.9,148z">
                            </path> @endif

                            @if ($departement[27]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Eure" data-nom="Eure" data-numerodepartement="27" class="region-28 departement departement-27 departement-eure" d="m316.4,153.4l-0.2-3.2l0.7-2.2l-2.3-4.1l1.4-3l-2.8-9.4l2.3-2.1h-2.9 l-0.3-8.3l1.7-0.4l0.28-0.1h1.52l-0.9-0.2l0.8-0.3l-1.29-0.3l5.89-2.4l7.6,5l3.4-0.7l4.9,3l-1.9,2.4l2.1,2.1l5.4,2.4l1.4-2.7 l8.2-2.5l4.8-7l13.1,3.3l3.5,8.4l-4,2.6l-4,9.5l-3.8-0.1l-2.3,2.6l1.8,5.8l-6,6.9l0.2,2.8l-6,1.3l-2.8-1.6l-5.3,3.2l-6,1.1l-2.4,2.6 l-3.4-2.1l1.7-2.3l-7.8-9.5L316.4,153.4z">
                                </path>
                                @endif
                                @if ($departement[27]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Eure" data-nom="Eure" data-numerodepartement="27" class="region-28 departement departement-27 departement-eure" d="m316.4,153.4l-0.2-3.2l0.7-2.2l-2.3-4.1l1.4-3l-2.8-9.4l2.3-2.1h-2.9 l-0.3-8.3l1.7-0.4l0.28-0.1h1.52l-0.9-0.2l0.8-0.3l-1.29-0.3l5.89-2.4l7.6,5l3.4-0.7l4.9,3l-1.9,2.4l2.1,2.1l5.4,2.4l1.4-2.7 l8.2-2.5l4.8-7l13.1,3.3l3.5,8.4l-4,2.6l-4,9.5l-3.8-0.1l-2.3,2.6l1.8,5.8l-6,6.9l0.2,2.8l-6,1.3l-2.8-1.6l-5.3,3.2l-6,1.1l-2.4,2.6 l-3.4-2.1l1.7-2.3l-7.8-9.5L316.4,153.4z">
                                </path> @endif
                                @if ($departement[27]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Eure" data-nom="Eure" data-numerodepartement="27" class="region-28 departement departement-27 departement-eure" d="m316.4,153.4l-0.2-3.2l0.7-2.2l-2.3-4.1l1.4-3l-2.8-9.4l2.3-2.1h-2.9 l-0.3-8.3l1.7-0.4l0.28-0.1h1.52l-0.9-0.2l0.8-0.3l-1.29-0.3l5.89-2.4l7.6,5l3.4-0.7l4.9,3l-1.9,2.4l2.1,2.1l5.4,2.4l1.4-2.7 l8.2-2.5l4.8-7l13.1,3.3l3.5,8.4l-4,2.6l-4,9.5l-3.8-0.1l-2.3,2.6l1.8,5.8l-6,6.9l0.2,2.8l-6,1.3l-2.8-1.6l-5.3,3.2l-6,1.1l-2.4,2.6 l-3.4-2.1l1.7-2.3l-7.8-9.5L316.4,153.4z">
                                </path> @endif
                                @if ($departement[27]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Eure" data-nom="Eure" data-numerodepartement="27" class="region-28 departement departement-27 departement-eure" d="m316.4,153.4l-0.2-3.2l0.7-2.2l-2.3-4.1l1.4-3l-2.8-9.4l2.3-2.1h-2.9 l-0.3-8.3l1.7-0.4l0.28-0.1h1.52l-0.9-0.2l0.8-0.3l-1.29-0.3l5.89-2.4l7.6,5l3.4-0.7l4.9,3l-1.9,2.4l2.1,2.1l5.4,2.4l1.4-2.7 l8.2-2.5l4.8-7l13.1,3.3l3.5,8.4l-4,2.6l-4,9.5l-3.8-0.1l-2.3,2.6l1.8,5.8l-6,6.9l0.2,2.8l-6,1.3l-2.8-1.6l-5.3,3.2l-6,1.1l-2.4,2.6 l-3.4-2.1l1.7-2.3l-7.8-9.5L316.4,153.4z">
                                </path> @endif
                                @if ($departement[27]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Eure" data-nom="Eure" data-numerodepartement="27" class="region-28 departement departement-27 departement-eure" d="m316.4,153.4l-0.2-3.2l0.7-2.2l-2.3-4.1l1.4-3l-2.8-9.4l2.3-2.1h-2.9 l-0.3-8.3l1.7-0.4l0.28-0.1h1.52l-0.9-0.2l0.8-0.3l-1.29-0.3l5.89-2.4l7.6,5l3.4-0.7l4.9,3l-1.9,2.4l2.1,2.1l5.4,2.4l1.4-2.7 l8.2-2.5l4.8-7l13.1,3.3l3.5,8.4l-4,2.6l-4,9.5l-3.8-0.1l-2.3,2.6l1.8,5.8l-6,6.9l0.2,2.8l-6,1.3l-2.8-1.6l-5.3,3.2l-6,1.1l-2.4,2.6 l-3.4-2.1l1.7-2.3l-7.8-9.5L316.4,153.4z">
                                </path> @endif

                                @if ($departement[50]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Manche" data-nom="Manche" data-numerodepartement="50" class="region-28 departement departement-50 departement-manche" d="m255.2,158.7l9.7,2.1l4.1,4.2l-1.8,6.7 l-3.6,4.5h-0.1l-8.6-0.8l-5.4-2.3l-7.1,4.8l-2.7-1l-4.7-9.6l1.9-0.2l4.8,0.4l2.5-1.1l0.5-2.2l-2.4,1.3l-5.1-5.6l-0.3-5.3l2-6.1 l-0.3-4.9l-1.8-3.6l0.4-7.4l1.5-2l-2.5,0.3l-2-5l0.3-2.2l-2.4-1.2l-2.9-4.1l-0.7-5.9l-1.4-1.9l1.8-1.8l0.1-2.8l-0.5-2.3l-2.2-1.1 l-1-2.5l2.1-0.2l11.9,4.2h2.4l4-2.6l5.1,0.6l1.8,1.7l0.9,2.7l-3.2,5.2l4,6.5l1.1,4.3l-0.1,0.7v0.1l0.5,6.6l8.4,3.1l-2,2.6l2.2,8.2 l-8.1,4.9l1.6,2.3l-4.5,5.3L255.2,158.7z">
                                    </path>
                                    @endif
                                    @if ($departement[50]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Manche" data-nom="Manche" data-numerodepartement="50" class="region-28 departement departement-50 departement-manche" d="m255.2,158.7l9.7,2.1l4.1,4.2l-1.8,6.7 l-3.6,4.5h-0.1l-8.6-0.8l-5.4-2.3l-7.1,4.8l-2.7-1l-4.7-9.6l1.9-0.2l4.8,0.4l2.5-1.1l0.5-2.2l-2.4,1.3l-5.1-5.6l-0.3-5.3l2-6.1 l-0.3-4.9l-1.8-3.6l0.4-7.4l1.5-2l-2.5,0.3l-2-5l0.3-2.2l-2.4-1.2l-2.9-4.1l-0.7-5.9l-1.4-1.9l1.8-1.8l0.1-2.8l-0.5-2.3l-2.2-1.1 l-1-2.5l2.1-0.2l11.9,4.2h2.4l4-2.6l5.1,0.6l1.8,1.7l0.9,2.7l-3.2,5.2l4,6.5l1.1,4.3l-0.1,0.7v0.1l0.5,6.6l8.4,3.1l-2,2.6l2.2,8.2 l-8.1,4.9l1.6,2.3l-4.5,5.3L255.2,158.7z">
                                    </path> @endif
                                    @if ($departement[50]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Manche" data-nom="Manche" data-numerodepartement="50" class="region-28 departement departement-50 departement-manche" d="m255.2,158.7l9.7,2.1l4.1,4.2l-1.8,6.7 l-3.6,4.5h-0.1l-8.6-0.8l-5.4-2.3l-7.1,4.8l-2.7-1l-4.7-9.6l1.9-0.2l4.8,0.4l2.5-1.1l0.5-2.2l-2.4,1.3l-5.1-5.6l-0.3-5.3l2-6.1 l-0.3-4.9l-1.8-3.6l0.4-7.4l1.5-2l-2.5,0.3l-2-5l0.3-2.2l-2.4-1.2l-2.9-4.1l-0.7-5.9l-1.4-1.9l1.8-1.8l0.1-2.8l-0.5-2.3l-2.2-1.1 l-1-2.5l2.1-0.2l11.9,4.2h2.4l4-2.6l5.1,0.6l1.8,1.7l0.9,2.7l-3.2,5.2l4,6.5l1.1,4.3l-0.1,0.7v0.1l0.5,6.6l8.4,3.1l-2,2.6l2.2,8.2 l-8.1,4.9l1.6,2.3l-4.5,5.3L255.2,158.7z">
                                    </path> @endif
                                    @if ($departement[50]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Manche" data-nom="Manche" data-numerodepartement="50" class="region-28 departement departement-50 departement-manche" d="m255.2,158.7l9.7,2.1l4.1,4.2l-1.8,6.7 l-3.6,4.5h-0.1l-8.6-0.8l-5.4-2.3l-7.1,4.8l-2.7-1l-4.7-9.6l1.9-0.2l4.8,0.4l2.5-1.1l0.5-2.2l-2.4,1.3l-5.1-5.6l-0.3-5.3l2-6.1 l-0.3-4.9l-1.8-3.6l0.4-7.4l1.5-2l-2.5,0.3l-2-5l0.3-2.2l-2.4-1.2l-2.9-4.1l-0.7-5.9l-1.4-1.9l1.8-1.8l0.1-2.8l-0.5-2.3l-2.2-1.1 l-1-2.5l2.1-0.2l11.9,4.2h2.4l4-2.6l5.1,0.6l1.8,1.7l0.9,2.7l-3.2,5.2l4,6.5l1.1,4.3l-0.1,0.7v0.1l0.5,6.6l8.4,3.1l-2,2.6l2.2,8.2 l-8.1,4.9l1.6,2.3l-4.5,5.3L255.2,158.7z">
                                    </path> @endif
                                    @if ($departement[50]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Manche" data-nom="Manche" data-numerodepartement="50" class="region-28 departement departement-50 departement-manche" d="m255.2,158.7l9.7,2.1l4.1,4.2l-1.8,6.7 l-3.6,4.5h-0.1l-8.6-0.8l-5.4-2.3l-7.1,4.8l-2.7-1l-4.7-9.6l1.9-0.2l4.8,0.4l2.5-1.1l0.5-2.2l-2.4,1.3l-5.1-5.6l-0.3-5.3l2-6.1 l-0.3-4.9l-1.8-3.6l0.4-7.4l1.5-2l-2.5,0.3l-2-5l0.3-2.2l-2.4-1.2l-2.9-4.1l-0.7-5.9l-1.4-1.9l1.8-1.8l0.1-2.8l-0.5-2.3l-2.2-1.1 l-1-2.5l2.1-0.2l11.9,4.2h2.4l4-2.6l5.1,0.6l1.8,1.7l0.9,2.7l-3.2,5.2l4,6.5l1.1,4.3l-0.1,0.7v0.1l0.5,6.6l8.4,3.1l-2,2.6l2.2,8.2 l-8.1,4.9l1.6,2.3l-4.5,5.3L255.2,158.7z">
                                    </path> @endif

                                    @if ($departement[61]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Orne" data-nom="Orne" data-numerodepartement="61" class="region-28 departement departement-61 departement-orne" d="m266.9,179.9l-3.3-3.7l3.6-4.5l1.8-6.7 l-4.1-4.2l5.4-2.9l0.9-2.7l2.7,1.3l6.4-2.3l4.9,3l2.6-1.7l5.7,1.1l2.9-0.3l7.2-5.4l7-1.7l5.6,1l0.2,3.2l6.3,0.5l7.8,9.5l-1.7,2.3 l3.4,2.1l0.1,3.2l4.8,4.4l-0.2,4.5l0.5,4.6l-7.5,5.1l1.1,7.5l-3.2-0.7l-3.1-3.5l-2.9,1l-7.2-5l-1.6-8.4l-2.8-1.5l-11,5.9l-3-0.1 v-0.1v-2.9l-3.3-1.6l-1.9-6l-2.7-0.2l-0.7,2.7h-9.1l-6.7,3.3l-2.5-1.7L266.9,179.9z">
                                        </path>
                                        @endif
                                        @if ($departement[61]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Orne" data-nom="Orne" data-numerodepartement="61" class="region-28 departement departement-61 departement-orne" d="m266.9,179.9l-3.3-3.7l3.6-4.5l1.8-6.7 l-4.1-4.2l5.4-2.9l0.9-2.7l2.7,1.3l6.4-2.3l4.9,3l2.6-1.7l5.7,1.1l2.9-0.3l7.2-5.4l7-1.7l5.6,1l0.2,3.2l6.3,0.5l7.8,9.5l-1.7,2.3 l3.4,2.1l0.1,3.2l4.8,4.4l-0.2,4.5l0.5,4.6l-7.5,5.1l1.1,7.5l-3.2-0.7l-3.1-3.5l-2.9,1l-7.2-5l-1.6-8.4l-2.8-1.5l-11,5.9l-3-0.1 v-0.1v-2.9l-3.3-1.6l-1.9-6l-2.7-0.2l-0.7,2.7h-9.1l-6.7,3.3l-2.5-1.7L266.9,179.9z">
                                        </path> @endif
                                        @if ($departement[61]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Orne" data-nom="Orne" data-numerodepartement="61" class="region-28 departement departement-61 departement-orne" d="m266.9,179.9l-3.3-3.7l3.6-4.5l1.8-6.7 l-4.1-4.2l5.4-2.9l0.9-2.7l2.7,1.3l6.4-2.3l4.9,3l2.6-1.7l5.7,1.1l2.9-0.3l7.2-5.4l7-1.7l5.6,1l0.2,3.2l6.3,0.5l7.8,9.5l-1.7,2.3 l3.4,2.1l0.1,3.2l4.8,4.4l-0.2,4.5l0.5,4.6l-7.5,5.1l1.1,7.5l-3.2-0.7l-3.1-3.5l-2.9,1l-7.2-5l-1.6-8.4l-2.8-1.5l-11,5.9l-3-0.1 v-0.1v-2.9l-3.3-1.6l-1.9-6l-2.7-0.2l-0.7,2.7h-9.1l-6.7,3.3l-2.5-1.7L266.9,179.9z">
                                        </path> @endif
                                        @if ($departement[61]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Orne" data-nom="Orne" data-numerodepartement="61" class="region-28 departement departement-61 departement-orne" d="m266.9,179.9l-3.3-3.7l3.6-4.5l1.8-6.7 l-4.1-4.2l5.4-2.9l0.9-2.7l2.7,1.3l6.4-2.3l4.9,3l2.6-1.7l5.7,1.1l2.9-0.3l7.2-5.4l7-1.7l5.6,1l0.2,3.2l6.3,0.5l7.8,9.5l-1.7,2.3 l3.4,2.1l0.1,3.2l4.8,4.4l-0.2,4.5l0.5,4.6l-7.5,5.1l1.1,7.5l-3.2-0.7l-3.1-3.5l-2.9,1l-7.2-5l-1.6-8.4l-2.8-1.5l-11,5.9l-3-0.1 v-0.1v-2.9l-3.3-1.6l-1.9-6l-2.7-0.2l-0.7,2.7h-9.1l-6.7,3.3l-2.5-1.7L266.9,179.9z">
                                        </path> @endif
                                        @if ($departement[61]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Orne" data-nom="Orne" data-numerodepartement="61" class="region-28 departement departement-61 departement-orne" d="m266.9,179.9l-3.3-3.7l3.6-4.5l1.8-6.7 l-4.1-4.2l5.4-2.9l0.9-2.7l2.7,1.3l6.4-2.3l4.9,3l2.6-1.7l5.7,1.1l2.9-0.3l7.2-5.4l7-1.7l5.6,1l0.2,3.2l6.3,0.5l7.8,9.5l-1.7,2.3 l3.4,2.1l0.1,3.2l4.8,4.4l-0.2,4.5l0.5,4.6l-7.5,5.1l1.1,7.5l-3.2-0.7l-3.1-3.5l-2.9,1l-7.2-5l-1.6-8.4l-2.8-1.5l-11,5.9l-3-0.1 v-0.1v-2.9l-3.3-1.6l-1.9-6l-2.7-0.2l-0.7,2.7h-9.1l-6.7,3.3l-2.5-1.7L266.9,179.9z">
                                        </path> @endif

                                        @if ($departement[76]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Seine-Maritime" data-nom="Seine-Maritime" data-numerodepartement="76" class="region-28 departement departement-76 departement-seine-maritime" d="m314.41,119.8l-7.61-1.8l-1.2-2l-0.1-2.3 l4.4-9.7l13.8-7.4L326,95l10.3-2.1l4.8-1.8l2.4,0.3L352,87l5.11-4.09l11.79,9.99l3.4,8.4l-3.1,4.7l1.4,8.7l-1.3,8l-13.1-3.3l-4.8,7 l-8.2,2.5l-1.4,2.7l-5.4-2.4l-2.1-2.1l1.9-2.4l-4.9-3l-3.4,0.7l-7.6-5L314.41,119.8z">
                                            </path>
                                            @endif
                                            @if ($departement[76]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Seine-Maritime" data-nom="Seine-Maritime" data-numerodepartement="76" class="region-28 departement departement-76 departement-seine-maritime" d="m314.41,119.8l-7.61-1.8l-1.2-2l-0.1-2.3 l4.4-9.7l13.8-7.4L326,95l10.3-2.1l4.8-1.8l2.4,0.3L352,87l5.11-4.09l11.79,9.99l3.4,8.4l-3.1,4.7l1.4,8.7l-1.3,8l-13.1-3.3l-4.8,7 l-8.2,2.5l-1.4,2.7l-5.4-2.4l-2.1-2.1l1.9-2.4l-4.9-3l-3.4,0.7l-7.6-5L314.41,119.8z">
                                            </path> @endif
                                            @if ($departement[76]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Seine-Maritime" data-nom="Seine-Maritime" data-numerodepartement="76" class="region-28 departement departement-76 departement-seine-maritime" d="m314.41,119.8l-7.61-1.8l-1.2-2l-0.1-2.3 l4.4-9.7l13.8-7.4L326,95l10.3-2.1l4.8-1.8l2.4,0.3L352,87l5.11-4.09l11.79,9.99l3.4,8.4l-3.1,4.7l1.4,8.7l-1.3,8l-13.1-3.3l-4.8,7 l-8.2,2.5l-1.4,2.7l-5.4-2.4l-2.1-2.1l1.9-2.4l-4.9-3l-3.4,0.7l-7.6-5L314.41,119.8z">
                                            </path> @endif
                                            @if ($departement[76]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Seine-Maritime" data-nom="Seine-Maritime" data-numerodepartement="76" class="region-28 departement departement-76 departement-seine-maritime" d="m314.41,119.8l-7.61-1.8l-1.2-2l-0.1-2.3 l4.4-9.7l13.8-7.4L326,95l10.3-2.1l4.8-1.8l2.4,0.3L352,87l5.11-4.09l11.79,9.99l3.4,8.4l-3.1,4.7l1.4,8.7l-1.3,8l-13.1-3.3l-4.8,7 l-8.2,2.5l-1.4,2.7l-5.4-2.4l-2.1-2.1l1.9-2.4l-4.9-3l-3.4,0.7l-7.6-5L314.41,119.8z">
                                            </path> @endif
                                            @if ($departement[76]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Seine-Maritime" data-nom="Seine-Maritime" data-numerodepartement="76" class="region-28 departement departement-76 departement-seine-maritime" d="m314.41,119.8l-7.61-1.8l-1.2-2l-0.1-2.3 l4.4-9.7l13.8-7.4L326,95l10.3-2.1l4.8-1.8l2.4,0.3L352,87l5.11-4.09l11.79,9.99l3.4,8.4l-3.1,4.7l1.4,8.7l-1.3,8l-13.1-3.3l-4.8,7 l-8.2,2.5l-1.4,2.7l-5.4-2.4l-2.1-2.1l1.9-2.4l-4.9-3l-3.4,0.7l-7.6-5L314.41,119.8z">
                                            </path> @endif
                    </g>

                    <g data-nom="Hauts-de-France">

                        @if ($departement[2]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Aisne" data-nom="Aisne" data-numerodepartement="02" class="region-32 departement departement-02 departement-aisne" d="m450.3,82.6l16.7,4.6l2.91,0.94L470.6,94l-1.3,3.5l1.3,3.1l-5,7.2 l-2.7,0.3l0.3,14.3l-1,2.8l-5.3-1.8l-8,4l-1.2,2.6l3.2,8l-5.5,2.3l1.6,2.4l-0.8,2.7l2.5,1.3l-7.7,10.2l-9.3-6l-3.9-4.2l0.7-2.8 l-1.8-2.5l-2.6-0.7l2.1-1.7l-0.5-2.8l-2.9-1.1l-2.4,1.5l-0.7-2.9l3,0.2l-2.9-4.5l2.6-1.7l2.4-5.7l2.6-1.1l-2.2-1.8l0.8-4.5 l-0.4-10.2l-2.3-7l3.9-8.1l0.4-3.8l12.6-0.6l2.6-2.2l2.3,1.7L450.3,82.6z">
                            </path>
                            @endif
                            @if ($departement[2]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Aisne" data-nom="Aisne" data-numerodepartement="02" class="region-32 departement departement-02 departement-aisne" d="m450.3,82.6l16.7,4.6l2.91,0.94L470.6,94l-1.3,3.5l1.3,3.1l-5,7.2 l-2.7,0.3l0.3,14.3l-1,2.8l-5.3-1.8l-8,4l-1.2,2.6l3.2,8l-5.5,2.3l1.6,2.4l-0.8,2.7l2.5,1.3l-7.7,10.2l-9.3-6l-3.9-4.2l0.7-2.8 l-1.8-2.5l-2.6-0.7l2.1-1.7l-0.5-2.8l-2.9-1.1l-2.4,1.5l-0.7-2.9l3,0.2l-2.9-4.5l2.6-1.7l2.4-5.7l2.6-1.1l-2.2-1.8l0.8-4.5 l-0.4-10.2l-2.3-7l3.9-8.1l0.4-3.8l12.6-0.6l2.6-2.2l2.3,1.7L450.3,82.6z">
                            </path> @endif
                            @if ($departement[2]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Aisne" data-nom="Aisne" data-numerodepartement="02" class="region-32 departement departement-02 departement-aisne" d="m450.3,82.6l16.7,4.6l2.91,0.94L470.6,94l-1.3,3.5l1.3,3.1l-5,7.2 l-2.7,0.3l0.3,14.3l-1,2.8l-5.3-1.8l-8,4l-1.2,2.6l3.2,8l-5.5,2.3l1.6,2.4l-0.8,2.7l2.5,1.3l-7.7,10.2l-9.3-6l-3.9-4.2l0.7-2.8 l-1.8-2.5l-2.6-0.7l2.1-1.7l-0.5-2.8l-2.9-1.1l-2.4,1.5l-0.7-2.9l3,0.2l-2.9-4.5l2.6-1.7l2.4-5.7l2.6-1.1l-2.2-1.8l0.8-4.5 l-0.4-10.2l-2.3-7l3.9-8.1l0.4-3.8l12.6-0.6l2.6-2.2l2.3,1.7L450.3,82.6z">
                            </path> @endif
                            @if ($departement[2]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Aisne" data-nom="Aisne" data-numerodepartement="02" class="region-32 departement departement-02 departement-aisne" d="m450.3,82.6l16.7,4.6l2.91,0.94L470.6,94l-1.3,3.5l1.3,3.1l-5,7.2 l-2.7,0.3l0.3,14.3l-1,2.8l-5.3-1.8l-8,4l-1.2,2.6l3.2,8l-5.5,2.3l1.6,2.4l-0.8,2.7l2.5,1.3l-7.7,10.2l-9.3-6l-3.9-4.2l0.7-2.8 l-1.8-2.5l-2.6-0.7l2.1-1.7l-0.5-2.8l-2.9-1.1l-2.4,1.5l-0.7-2.9l3,0.2l-2.9-4.5l2.6-1.7l2.4-5.7l2.6-1.1l-2.2-1.8l0.8-4.5 l-0.4-10.2l-2.3-7l3.9-8.1l0.4-3.8l12.6-0.6l2.6-2.2l2.3,1.7L450.3,82.6z">
                            </path>@endif
                            @if ($departement[2]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Aisne" data-nom="Aisne" data-numerodepartement="02" class="region-32 departement departement-02 departement-aisne" d="m450.3,82.6l16.7,4.6l2.91,0.94L470.6,94l-1.3,3.5l1.3,3.1l-5,7.2 l-2.7,0.3l0.3,14.3l-1,2.8l-5.3-1.8l-8,4l-1.2,2.6l3.2,8l-5.5,2.3l1.6,2.4l-0.8,2.7l2.5,1.3l-7.7,10.2l-9.3-6l-3.9-4.2l0.7-2.8 l-1.8-2.5l-2.6-0.7l2.1-1.7l-0.5-2.8l-2.9-1.1l-2.4,1.5l-0.7-2.9l3,0.2l-2.9-4.5l2.6-1.7l2.4-5.7l2.6-1.1l-2.2-1.8l0.8-4.5 l-0.4-10.2l-2.3-7l3.9-8.1l0.4-3.8l12.6-0.6l2.6-2.2l2.3,1.7L450.3,82.6z">
                            </path> @endif

                            @if ($departement[59]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Nord" data-nom="Nord" data-numerodepartement="59" class="region-32 departement departement-59 departement-nord" d="m384.33,25.06l0.87-0.26l2,0.8l1.1-2.1l7.9-2.1 l2.9,0.3l4.4-1.9v-0.1l1.2,4.8l2.3,3.7l-1.6,1.9l0.6,0.8l1.2,5.8h3.4l2.7,5.1l3.1,1.5h2.1l0.6-2.4l8.1-3l3.8,7.5l0.1,1l1.3,5.2 l2,3.5h0.1l2.8,0.6l2.1-1.4l2.4-0.2l-0.5,2.2l2.2-0.7l2.8,1l1.8,4.4l-0.6,2.3l0.7,2.3l1.4,1.9l1.1-2.6l4.6-0.3l2.4,1.1L462,64l5.5,6 l2.3,0.2l-2.1,2.4l-1.4,4.7l2.6,0.2l1.4,3.3l-3.5,3.9l0.2,2.5l-16.7-4.6l-5.2,1.8l-2.3-1.7l-2.6,2.2l-12.6,0.6l-3.3-2.6l3.5-10.6 l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6 L384.33,25.06z">
                                </path>
                                @endif
                                @if ($departement[59]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Nord" data-nom="Nord" data-numerodepartement="59" class="region-32 departement departement-59 departement-nord" d="m384.33,25.06l0.87-0.26l2,0.8l1.1-2.1l7.9-2.1 l2.9,0.3l4.4-1.9v-0.1l1.2,4.8l2.3,3.7l-1.6,1.9l0.6,0.8l1.2,5.8h3.4l2.7,5.1l3.1,1.5h2.1l0.6-2.4l8.1-3l3.8,7.5l0.1,1l1.3,5.2 l2,3.5h0.1l2.8,0.6l2.1-1.4l2.4-0.2l-0.5,2.2l2.2-0.7l2.8,1l1.8,4.4l-0.6,2.3l0.7,2.3l1.4,1.9l1.1-2.6l4.6-0.3l2.4,1.1L462,64l5.5,6 l2.3,0.2l-2.1,2.4l-1.4,4.7l2.6,0.2l1.4,3.3l-3.5,3.9l0.2,2.5l-16.7-4.6l-5.2,1.8l-2.3-1.7l-2.6,2.2l-12.6,0.6l-3.3-2.6l3.5-10.6 l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6 L384.33,25.06z">
                                </path> @endif
                                @if ($departement[59]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Nord" data-nom="Nord" data-numerodepartement="59" class="region-32 departement departement-59 departement-nord" d="m384.33,25.06l0.87-0.26l2,0.8l1.1-2.1l7.9-2.1 l2.9,0.3l4.4-1.9v-0.1l1.2,4.8l2.3,3.7l-1.6,1.9l0.6,0.8l1.2,5.8h3.4l2.7,5.1l3.1,1.5h2.1l0.6-2.4l8.1-3l3.8,7.5l0.1,1l1.3,5.2 l2,3.5h0.1l2.8,0.6l2.1-1.4l2.4-0.2l-0.5,2.2l2.2-0.7l2.8,1l1.8,4.4l-0.6,2.3l0.7,2.3l1.4,1.9l1.1-2.6l4.6-0.3l2.4,1.1L462,64l5.5,6 l2.3,0.2l-2.1,2.4l-1.4,4.7l2.6,0.2l1.4,3.3l-3.5,3.9l0.2,2.5l-16.7-4.6l-5.2,1.8l-2.3-1.7l-2.6,2.2l-12.6,0.6l-3.3-2.6l3.5-10.6 l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6 L384.33,25.06z">
                                </path> @endif
                                @if ($departement[59]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Nord" data-nom="Nord" data-numerodepartement="59" class="region-32 departement departement-59 departement-nord" d="m384.33,25.06l0.87-0.26l2,0.8l1.1-2.1l7.9-2.1 l2.9,0.3l4.4-1.9v-0.1l1.2,4.8l2.3,3.7l-1.6,1.9l0.6,0.8l1.2,5.8h3.4l2.7,5.1l3.1,1.5h2.1l0.6-2.4l8.1-3l3.8,7.5l0.1,1l1.3,5.2 l2,3.5h0.1l2.8,0.6l2.1-1.4l2.4-0.2l-0.5,2.2l2.2-0.7l2.8,1l1.8,4.4l-0.6,2.3l0.7,2.3l1.4,1.9l1.1-2.6l4.6-0.3l2.4,1.1L462,64l5.5,6 l2.3,0.2l-2.1,2.4l-1.4,4.7l2.6,0.2l1.4,3.3l-3.5,3.9l0.2,2.5l-16.7-4.6l-5.2,1.8l-2.3-1.7l-2.6,2.2l-12.6,0.6l-3.3-2.6l3.5-10.6 l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6 L384.33,25.06z">
                                </path> @endif
                                @if ($departement[59]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Nord" data-nom="Nord" data-numerodepartement="59" class="region-32 departement departement-59 departement-nord" d="m384.33,25.06l0.87-0.26l2,0.8l1.1-2.1l7.9-2.1 l2.9,0.3l4.4-1.9v-0.1l1.2,4.8l2.3,3.7l-1.6,1.9l0.6,0.8l1.2,5.8h3.4l2.7,5.1l3.1,1.5h2.1l0.6-2.4l8.1-3l3.8,7.5l0.1,1l1.3,5.2 l2,3.5h0.1l2.8,0.6l2.1-1.4l2.4-0.2l-0.5,2.2l2.2-0.7l2.8,1l1.8,4.4l-0.6,2.3l0.7,2.3l1.4,1.9l1.1-2.6l4.6-0.3l2.4,1.1L462,64l5.5,6 l2.3,0.2l-2.1,2.4l-1.4,4.7l2.6,0.2l1.4,3.3l-3.5,3.9l0.2,2.5l-16.7-4.6l-5.2,1.8l-2.3-1.7l-2.6,2.2l-12.6,0.6l-3.3-2.6l3.5-10.6 l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6 L384.33,25.06z">
                                </path> @endif

                                @if ($departement[60]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Oise" data-nom="Oise" data-numerodepartement="60" class="region-32 departement departement-60 departement-oise" d="m372.8,131.1l-3.5-8.4l1.3-8l-1.4-8.7l3.1-4.7 l4.1,3.7l3.1-1.2l14.4,2.2l12.8,6.7l8.6-6.8l10.3-1.5l0.4,10.2l-0.8,4.5l2.2,1.8l-2.6,1.1l-2.4,5.7l-2.6,1.7l2.9,4.5l-3-0.2l0.7,2.9 l2.4-1.5l2.9,1.1l0.5,2.8l-2.1,1.7l-8.1,2.9l-2.5-1.6l-2,2.2l-6.9-1l-10.9-6.4l-2.2,1.6l-9.2-2.2L376,138l-5.6-1.1l-1.6-3.2 L372.8,131.1z">
                                    </path>
                                    @endif
                                    @if ($departement[60]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Oise" data-nom="Oise" data-numerodepartement="60" class="region-32 departement departement-60 departement-oise" d="m372.8,131.1l-3.5-8.4l1.3-8l-1.4-8.7l3.1-4.7 l4.1,3.7l3.1-1.2l14.4,2.2l12.8,6.7l8.6-6.8l10.3-1.5l0.4,10.2l-0.8,4.5l2.2,1.8l-2.6,1.1l-2.4,5.7l-2.6,1.7l2.9,4.5l-3-0.2l0.7,2.9 l2.4-1.5l2.9,1.1l0.5,2.8l-2.1,1.7l-8.1,2.9l-2.5-1.6l-2,2.2l-6.9-1l-10.9-6.4l-2.2,1.6l-9.2-2.2L376,138l-5.6-1.1l-1.6-3.2 L372.8,131.1z">
                                    </path> @endif
                                    @if ($departement[60]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Oise" data-nom="Oise" data-numerodepartement="60" class="region-32 departement departement-60 departement-oise" d="m372.8,131.1l-3.5-8.4l1.3-8l-1.4-8.7l3.1-4.7 l4.1,3.7l3.1-1.2l14.4,2.2l12.8,6.7l8.6-6.8l10.3-1.5l0.4,10.2l-0.8,4.5l2.2,1.8l-2.6,1.1l-2.4,5.7l-2.6,1.7l2.9,4.5l-3-0.2l0.7,2.9 l2.4-1.5l2.9,1.1l0.5,2.8l-2.1,1.7l-8.1,2.9l-2.5-1.6l-2,2.2l-6.9-1l-10.9-6.4l-2.2,1.6l-9.2-2.2L376,138l-5.6-1.1l-1.6-3.2 L372.8,131.1z">
                                    </path> @endif
                                    @if ($departement[60]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Oise" data-nom="Oise" data-numerodepartement="60" class="region-32 departement departement-60 departement-oise" d="m372.8,131.1l-3.5-8.4l1.3-8l-1.4-8.7l3.1-4.7 l4.1,3.7l3.1-1.2l14.4,2.2l12.8,6.7l8.6-6.8l10.3-1.5l0.4,10.2l-0.8,4.5l2.2,1.8l-2.6,1.1l-2.4,5.7l-2.6,1.7l2.9,4.5l-3-0.2l0.7,2.9 l2.4-1.5l2.9,1.1l0.5,2.8l-2.1,1.7l-8.1,2.9l-2.5-1.6l-2,2.2l-6.9-1l-10.9-6.4l-2.2,1.6l-9.2-2.2L376,138l-5.6-1.1l-1.6-3.2 L372.8,131.1z">
                                    </path>@endif
                                    @if ($departement[60]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Oise" data-nom="Oise" data-numerodepartement="60" class="region-32 departement departement-60 departement-oise" d="m372.8,131.1l-3.5-8.4l1.3-8l-1.4-8.7l3.1-4.7 l4.1,3.7l3.1-1.2l14.4,2.2l12.8,6.7l8.6-6.8l10.3-1.5l0.4,10.2l-0.8,4.5l2.2,1.8l-2.6,1.1l-2.4,5.7l-2.6,1.7l2.9,4.5l-3-0.2l0.7,2.9 l2.4-1.5l2.9,1.1l0.5,2.8l-2.1,1.7l-8.1,2.9l-2.5-1.6l-2,2.2l-6.9-1l-10.9-6.4l-2.2,1.6l-9.2-2.2L376,138l-5.6-1.1l-1.6-3.2 L372.8,131.1z">
                                    </path> @endif

                                    @if ($departement[62]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Pas-de-Calais" data-nom="Pas-de-Calais" data-numerodepartement="62" class="region-32 departement departement-62 departement-pas-de-calais" d="m379.8,68.9l7.1,5.8l12-2.5l-2.6,5.7L398,81 l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7l0.8,3.2l8.6-1.8l3.5-10.6l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1 l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6l-6.27-12.14L372.6,28.5l-6.4,5.4l0.9,5.6l-1.7,4.6l0.6,6.7l2,4.2 l-1.7-1.4l-0.3,9.7l2.27,1.58l10.53,1.02L379.8,68.9z">
                                        </path>
                                        @endif
                                        @if ($departement[62]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Pas-de-Calais" data-nom="Pas-de-Calais" data-numerodepartement="62" class="region-32 departement departement-62 departement-pas-de-calais" d="m379.8,68.9l7.1,5.8l12-2.5l-2.6,5.7L398,81 l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7l0.8,3.2l8.6-1.8l3.5-10.6l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1 l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6l-6.27-12.14L372.6,28.5l-6.4,5.4l0.9,5.6l-1.7,4.6l0.6,6.7l2,4.2 l-1.7-1.4l-0.3,9.7l2.27,1.58l10.53,1.02L379.8,68.9z">
                                        </path> @endif
                                        @if ($departement[62]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Pas-de-Calais" data-nom="Pas-de-Calais" data-numerodepartement="62" class="region-32 departement departement-62 departement-pas-de-calais" d="m379.8,68.9l7.1,5.8l12-2.5l-2.6,5.7L398,81 l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7l0.8,3.2l8.6-1.8l3.5-10.6l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1 l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6l-6.27-12.14L372.6,28.5l-6.4,5.4l0.9,5.6l-1.7,4.6l0.6,6.7l2,4.2 l-1.7-1.4l-0.3,9.7l2.27,1.58l10.53,1.02L379.8,68.9z">
                                        </path> @endif
                                        @if ($departement[62]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Pas-de-Calais" data-nom="Pas-de-Calais" data-numerodepartement="62" class="region-32 departement departement-62 departement-pas-de-calais" d="m379.8,68.9l7.1,5.8l12-2.5l-2.6,5.7L398,81 l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7l0.8,3.2l8.6-1.8l3.5-10.6l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1 l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6l-6.27-12.14L372.6,28.5l-6.4,5.4l0.9,5.6l-1.7,4.6l0.6,6.7l2,4.2 l-1.7-1.4l-0.3,9.7l2.27,1.58l10.53,1.02L379.8,68.9z">
                                        </path> @endif
                                        @if ($departement[62]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Pas-de-Calais" data-nom="Pas-de-Calais" data-numerodepartement="62" class="region-32 departement departement-62 departement-pas-de-calais" d="m379.8,68.9l7.1,5.8l12-2.5l-2.6,5.7L398,81 l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7l0.8,3.2l8.6-1.8l3.5-10.6l-1.8-2.4l-3-0.4l0.7-2.7l-3.9-5.2l3.1-1.6l-3.8-5.3l-5.9-1 l1-6.1l-1.3-2.5l-1.7,2.2l-11.6-0.5l-4.1-4.2l0.6-2.8l-5.5-2.6l-6.27-12.14L372.6,28.5l-6.4,5.4l0.9,5.6l-1.7,4.6l0.6,6.7l2,4.2 l-1.7-1.4l-0.3,9.7l2.27,1.58l10.53,1.02L379.8,68.9z">
                                        </path> @endif

                                        @if ($departement[80]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Somme" data-nom="Somme" data-numerodepartement="80" class="region-32 departement departement-80 departement-somme" d="m424.3,82.9l3.3,2.6l-0.4,3.8l-3.9,8.1l2.3,7 l-10.3,1.5l-8.6,6.8l-12.8-6.7l-14.4-2.2l-3.1,1.2l-4.1-3.7l-3.4-8.4l-11.79-9.99L359.5,81l3.4-6.6l1.9-1.1l0.1-0.1l1.4,1.8l3.5,0.3 l-5.6-6l1.2-5.1l2.9,0.7l-0.03-0.02l10.53,1.02l1,3l7.1,5.8l12-2.5l-2.6,5.7L398,81l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7 l0.8,3.2L424.3,82.9z">
                                            </path>
                                            @endif
                                            @if ($departement[80]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Somme" data-nom="Somme" data-numerodepartement="80" class="region-32 departement departement-80 departement-somme" d="m424.3,82.9l3.3,2.6l-0.4,3.8l-3.9,8.1l2.3,7 l-10.3,1.5l-8.6,6.8l-12.8-6.7l-14.4-2.2l-3.1,1.2l-4.1-3.7l-3.4-8.4l-11.79-9.99L359.5,81l3.4-6.6l1.9-1.1l0.1-0.1l1.4,1.8l3.5,0.3 l-5.6-6l1.2-5.1l2.9,0.7l-0.03-0.02l10.53,1.02l1,3l7.1,5.8l12-2.5l-2.6,5.7L398,81l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7 l0.8,3.2L424.3,82.9z">
                                            </path> @endif
                                            @if ($departement[80]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Somme" data-nom="Somme" data-numerodepartement="80" class="region-32 departement departement-80 departement-somme" d="m424.3,82.9l3.3,2.6l-0.4,3.8l-3.9,8.1l2.3,7 l-10.3,1.5l-8.6,6.8l-12.8-6.7l-14.4-2.2l-3.1,1.2l-4.1-3.7l-3.4-8.4l-11.79-9.99L359.5,81l3.4-6.6l1.9-1.1l0.1-0.1l1.4,1.8l3.5,0.3 l-5.6-6l1.2-5.1l2.9,0.7l-0.03-0.02l10.53,1.02l1,3l7.1,5.8l12-2.5l-2.6,5.7L398,81l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7 l0.8,3.2L424.3,82.9z">
                                            </path> @endif
                                            @if ($departement[80]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Somme" data-nom="Somme" data-numerodepartement="80" class="region-32 departement departement-80 departement-somme" d="m424.3,82.9l3.3,2.6l-0.4,3.8l-3.9,8.1l2.3,7 l-10.3,1.5l-8.6,6.8l-12.8-6.7l-14.4-2.2l-3.1,1.2l-4.1-3.7l-3.4-8.4l-11.79-9.99L359.5,81l3.4-6.6l1.9-1.1l0.1-0.1l1.4,1.8l3.5,0.3 l-5.6-6l1.2-5.1l2.9,0.7l-0.03-0.02l10.53,1.02l1,3l7.1,5.8l12-2.5l-2.6,5.7L398,81l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7 l0.8,3.2L424.3,82.9z">
                                            </path> @endif
                                            @if ($departement[80]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Somme" data-nom="Somme" data-numerodepartement="80" class="region-32 departement departement-80 departement-somme" d="m424.3,82.9l3.3,2.6l-0.4,3.8l-3.9,8.1l2.3,7 l-10.3,1.5l-8.6,6.8l-12.8-6.7l-14.4-2.2l-3.1,1.2l-4.1-3.7l-3.4-8.4l-11.79-9.99L359.5,81l3.4-6.6l1.9-1.1l0.1-0.1l1.4,1.8l3.5,0.3 l-5.6-6l1.2-5.1l2.9,0.7l-0.03-0.02l10.53,1.02l1,3l7.1,5.8l12-2.5l-2.6,5.7L398,81l2.5-3.1l8.4,3.5l0.8-2.8l2.8,4.6l2.4-1.7 l0.8,3.2L424.3,82.9z">
                                            </path> @endif
                    </g>

                    <g data-nom="Grand Est">

                        @if ($departement[7]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Ardennes" data-nom="Ardennes" data-numerodepartement="08" class="region-44 departement departement-08 departement-ardennes" d="m469.91,88.14l0.79,0.26l9.8,0.4l7.3-3.2l1.1-6 l4-3.8l2.8-0.2v3.8L494,81l-0.6,5.2l3.3,4.5l-1,2.4l0.6,3.1l1.4,1.9l3.3-0.9l4.3,2.4l2.8,3.8l4.9,0.6l2,1.7l-0.9,2.4l2.1-0.13 l-1.6,1.13l-2,2.7l-5.7-2.1l-1.9,2l0.8,8.8l-3.2,5.1l1.4,2.5l-4.2,3.6v0.1l-20.1-1.9l-9.8-6.6l-6.7-0.9l-0.3-14.3l2.7-0.3l5-7.2 l-1.3-3.1l1.3-3.5L469.91,88.14z">
                            </path>
                            @endif
                            @if ($departement[7]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Ardennes" data-nom="Ardennes" data-numerodepartement="08" class="region-44 departement departement-08 departement-ardennes" d="m469.91,88.14l0.79,0.26l9.8,0.4l7.3-3.2l1.1-6 l4-3.8l2.8-0.2v3.8L494,81l-0.6,5.2l3.3,4.5l-1,2.4l0.6,3.1l1.4,1.9l3.3-0.9l4.3,2.4l2.8,3.8l4.9,0.6l2,1.7l-0.9,2.4l2.1-0.13 l-1.6,1.13l-2,2.7l-5.7-2.1l-1.9,2l0.8,8.8l-3.2,5.1l1.4,2.5l-4.2,3.6v0.1l-20.1-1.9l-9.8-6.6l-6.7-0.9l-0.3-14.3l2.7-0.3l5-7.2 l-1.3-3.1l1.3-3.5L469.91,88.14z">
                            </path> @endif
                            @if ($departement[7]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Ardennes" data-nom="Ardennes" data-numerodepartement="08" class="region-44 departement departement-08 departement-ardennes" d="m469.91,88.14l0.79,0.26l9.8,0.4l7.3-3.2l1.1-6 l4-3.8l2.8-0.2v3.8L494,81l-0.6,5.2l3.3,4.5l-1,2.4l0.6,3.1l1.4,1.9l3.3-0.9l4.3,2.4l2.8,3.8l4.9,0.6l2,1.7l-0.9,2.4l2.1-0.13 l-1.6,1.13l-2,2.7l-5.7-2.1l-1.9,2l0.8,8.8l-3.2,5.1l1.4,2.5l-4.2,3.6v0.1l-20.1-1.9l-9.8-6.6l-6.7-0.9l-0.3-14.3l2.7-0.3l5-7.2 l-1.3-3.1l1.3-3.5L469.91,88.14z">
                            </path> @endif
                            @if ($departement[7]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Ardennes" data-nom="Ardennes" data-numerodepartement="08" class="region-44 departement departement-08 departement-ardennes" d="m469.91,88.14l0.79,0.26l9.8,0.4l7.3-3.2l1.1-6 l4-3.8l2.8-0.2v3.8L494,81l-0.6,5.2l3.3,4.5l-1,2.4l0.6,3.1l1.4,1.9l3.3-0.9l4.3,2.4l2.8,3.8l4.9,0.6l2,1.7l-0.9,2.4l2.1-0.13 l-1.6,1.13l-2,2.7l-5.7-2.1l-1.9,2l0.8,8.8l-3.2,5.1l1.4,2.5l-4.2,3.6v0.1l-20.1-1.9l-9.8-6.6l-6.7-0.9l-0.3-14.3l2.7-0.3l5-7.2 l-1.3-3.1l1.3-3.5L469.91,88.14z">
                            </path> @endif
                            @if ($departement[7]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Ardennes" data-nom="Ardennes" data-numerodepartement="08" class="region-44 departement departement-08 departement-ardennes" d="m469.91,88.14l0.79,0.26l9.8,0.4l7.3-3.2l1.1-6 l4-3.8l2.8-0.2v3.8L494,81l-0.6,5.2l3.3,4.5l-1,2.4l0.6,3.1l1.4,1.9l3.3-0.9l4.3,2.4l2.8,3.8l4.9,0.6l2,1.7l-0.9,2.4l2.1-0.13 l-1.6,1.13l-2,2.7l-5.7-2.1l-1.9,2l0.8,8.8l-3.2,5.1l1.4,2.5l-4.2,3.6v0.1l-20.1-1.9l-9.8-6.6l-6.7-0.9l-0.3-14.3l2.7-0.3l5-7.2 l-1.3-3.1l1.3-3.5L469.91,88.14z">
                            </path> @endif

                            @if ($departement[9]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Aube" data-nom="Aube" data-numerodepartement="10" class="region-44 departement departement-10 departement-aube" d="m442.2,186.9l-3.6-1.5l-0.4-8.5l2.9-0.8l3-5 l3.2,4.5l9,1.2v-3.3l9.5-7.6l6.5-0.9l3.1,0.5l0.4,6.1l2.6,2c1.9,0.8,3.8,1.5,5.6,2.3l2.5-1.5l3.3,1.1l-0.6,3.4l2.4,5.2l5.6,3 l0.5,9.9l-0.1,2.7l-5.6,2.5l0.2,4.8l-3.9-0.5l-4.7,3.9l-6.1,0.9l-2.2,2l-2.9-1.4l-12.6,1.6l-5-10.9l-3.6-4.1l-2,2.2l-2.5-8.3 L442.2,186.9z">
                                </path>
                                @endif
                                @if ($departement[9]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Aube" data-nom="Aube" data-numerodepartement="10" class="region-44 departement departement-10 departement-aube" d="m442.2,186.9l-3.6-1.5l-0.4-8.5l2.9-0.8l3-5 l3.2,4.5l9,1.2v-3.3l9.5-7.6l6.5-0.9l3.1,0.5l0.4,6.1l2.6,2c1.9,0.8,3.8,1.5,5.6,2.3l2.5-1.5l3.3,1.1l-0.6,3.4l2.4,5.2l5.6,3 l0.5,9.9l-0.1,2.7l-5.6,2.5l0.2,4.8l-3.9-0.5l-4.7,3.9l-6.1,0.9l-2.2,2l-2.9-1.4l-12.6,1.6l-5-10.9l-3.6-4.1l-2,2.2l-2.5-8.3 L442.2,186.9z">
                                </path> @endif
                                @if ($departement[9]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Aube" data-nom="Aube" data-numerodepartement="10" class="region-44 departement departement-10 departement-aube" d="m442.2,186.9l-3.6-1.5l-0.4-8.5l2.9-0.8l3-5 l3.2,4.5l9,1.2v-3.3l9.5-7.6l6.5-0.9l3.1,0.5l0.4,6.1l2.6,2c1.9,0.8,3.8,1.5,5.6,2.3l2.5-1.5l3.3,1.1l-0.6,3.4l2.4,5.2l5.6,3 l0.5,9.9l-0.1,2.7l-5.6,2.5l0.2,4.8l-3.9-0.5l-4.7,3.9l-6.1,0.9l-2.2,2l-2.9-1.4l-12.6,1.6l-5-10.9l-3.6-4.1l-2,2.2l-2.5-8.3 L442.2,186.9z">
                                </path> @endif
                                @if ($departement[9]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Aube" data-nom="Aube" data-numerodepartement="10" class="region-44 departement departement-10 departement-aube" d="m442.2,186.9l-3.6-1.5l-0.4-8.5l2.9-0.8l3-5 l3.2,4.5l9,1.2v-3.3l9.5-7.6l6.5-0.9l3.1,0.5l0.4,6.1l2.6,2c1.9,0.8,3.8,1.5,5.6,2.3l2.5-1.5l3.3,1.1l-0.6,3.4l2.4,5.2l5.6,3 l0.5,9.9l-0.1,2.7l-5.6,2.5l0.2,4.8l-3.9-0.5l-4.7,3.9l-6.1,0.9l-2.2,2l-2.9-1.4l-12.6,1.6l-5-10.9l-3.6-4.1l-2,2.2l-2.5-8.3 L442.2,186.9z">
                                </path> @endif
                                @if ($departement[9]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Aube" data-nom="Aube" data-numerodepartement="10" class="region-44 departement departement-10 departement-aube" d="m442.2,186.9l-3.6-1.5l-0.4-8.5l2.9-0.8l3-5 l3.2,4.5l9,1.2v-3.3l9.5-7.6l6.5-0.9l3.1,0.5l0.4,6.1l2.6,2c1.9,0.8,3.8,1.5,5.6,2.3l2.5-1.5l3.3,1.1l-0.6,3.4l2.4,5.2l5.6,3 l0.5,9.9l-0.1,2.7l-5.6,2.5l0.2,4.8l-3.9-0.5l-4.7,3.9l-6.1,0.9l-2.2,2l-2.9-1.4l-12.6,1.6l-5-10.9l-3.6-4.1l-2,2.2l-2.5-8.3 L442.2,186.9z">
                                </path> @endif

                                @if ($departement[51]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Marne" data-nom="Marne" data-numerodepartement="51" class="region-44 departement departement-51 departement-marne" d="m440.6,158.9l0.4-2l7.7-10.2l-2.5-1.3l0.8-2.7 l-1.6-2.4l5.5-2.3l-3.2-8l1.2-2.6l8-4l5.3,1.8l1-2.8l6.7,0.9l9.8,6.6l20.1,1.9l2.2,9l-1,4.1l2.6,1.3l-0.6,3.9l-3.1,1.1l-1.1,5.8 l3.2,4.6l0.5,4.1l-8.6,2.2l2.2,2.5l-2.3,2.2l0.7,2.9h-4.7l-3.3-1.1l-2.5,1.5c-1.8-0.8-3.7-1.5-5.6-2.3l-2.6-2l-0.4-6.1l-3.1-0.5 l-6.5,0.9l-9.5,7.6v3.3l-9-1.2l-3.2-4.5l-2.6-1.7l-3.5-8.3L440.6,158.9z">
                                    </path>
                                    @endif
                                    @if ($departement[51]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Marne" data-nom="Marne" data-numerodepartement="51" class="region-44 departement departement-51 departement-marne" d="m440.6,158.9l0.4-2l7.7-10.2l-2.5-1.3l0.8-2.7 l-1.6-2.4l5.5-2.3l-3.2-8l1.2-2.6l8-4l5.3,1.8l1-2.8l6.7,0.9l9.8,6.6l20.1,1.9l2.2,9l-1,4.1l2.6,1.3l-0.6,3.9l-3.1,1.1l-1.1,5.8 l3.2,4.6l0.5,4.1l-8.6,2.2l2.2,2.5l-2.3,2.2l0.7,2.9h-4.7l-3.3-1.1l-2.5,1.5c-1.8-0.8-3.7-1.5-5.6-2.3l-2.6-2l-0.4-6.1l-3.1-0.5 l-6.5,0.9l-9.5,7.6v3.3l-9-1.2l-3.2-4.5l-2.6-1.7l-3.5-8.3L440.6,158.9z">
                                    </path> @endif
                                    @if ($departement[51]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Marne" data-nom="Marne" data-numerodepartement="51" class="region-44 departement departement-51 departement-marne" d="m440.6,158.9l0.4-2l7.7-10.2l-2.5-1.3l0.8-2.7 l-1.6-2.4l5.5-2.3l-3.2-8l1.2-2.6l8-4l5.3,1.8l1-2.8l6.7,0.9l9.8,6.6l20.1,1.9l2.2,9l-1,4.1l2.6,1.3l-0.6,3.9l-3.1,1.1l-1.1,5.8 l3.2,4.6l0.5,4.1l-8.6,2.2l2.2,2.5l-2.3,2.2l0.7,2.9h-4.7l-3.3-1.1l-2.5,1.5c-1.8-0.8-3.7-1.5-5.6-2.3l-2.6-2l-0.4-6.1l-3.1-0.5 l-6.5,0.9l-9.5,7.6v3.3l-9-1.2l-3.2-4.5l-2.6-1.7l-3.5-8.3L440.6,158.9z">
                                    </path> @endif
                                    @if ($departement[51]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Marne" data-nom="Marne" data-numerodepartement="51" class="region-44 departement departement-51 departement-marne" d="m440.6,158.9l0.4-2l7.7-10.2l-2.5-1.3l0.8-2.7 l-1.6-2.4l5.5-2.3l-3.2-8l1.2-2.6l8-4l5.3,1.8l1-2.8l6.7,0.9l9.8,6.6l20.1,1.9l2.2,9l-1,4.1l2.6,1.3l-0.6,3.9l-3.1,1.1l-1.1,5.8 l3.2,4.6l0.5,4.1l-8.6,2.2l2.2,2.5l-2.3,2.2l0.7,2.9h-4.7l-3.3-1.1l-2.5,1.5c-1.8-0.8-3.7-1.5-5.6-2.3l-2.6-2l-0.4-6.1l-3.1-0.5 l-6.5,0.9l-9.5,7.6v3.3l-9-1.2l-3.2-4.5l-2.6-1.7l-3.5-8.3L440.6,158.9z">
                                    </path> @endif
                                    @if ($departement[51]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Marne" data-nom="Marne" data-numerodepartement="51" class="region-44 departement departement-51 departement-marne" d="m440.6,158.9l0.4-2l7.7-10.2l-2.5-1.3l0.8-2.7 l-1.6-2.4l5.5-2.3l-3.2-8l1.2-2.6l8-4l5.3,1.8l1-2.8l6.7,0.9l9.8,6.6l20.1,1.9l2.2,9l-1,4.1l2.6,1.3l-0.6,3.9l-3.1,1.1l-1.1,5.8 l3.2,4.6l0.5,4.1l-8.6,2.2l2.2,2.5l-2.3,2.2l0.7,2.9h-4.7l-3.3-1.1l-2.5,1.5c-1.8-0.8-3.7-1.5-5.6-2.3l-2.6-2l-0.4-6.1l-3.1-0.5 l-6.5,0.9l-9.5,7.6v3.3l-9-1.2l-3.2-4.5l-2.6-1.7l-3.5-8.3L440.6,158.9z">
                                    </path> @endif

                                    @if ($departement[52]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Haute-Marne" data-nom="Haute-Marne" data-numerodepartement="52" class="region-44 departement departement-52 departement-haute-marne" d="m493.9,167.9l8.6-2.2l3.4,5.2l16.9,10.4 l-2.4,2.3l12.7,9.5l-1.7,8.6l5.5,4.7l0.2,3.1l2.7-1.1l1.3,2.5v0.1l0.2,1.4l-2.3,3.2l-2.9-0.3l-2,2.4l-0.3,8.3l-3.2,1l-2.1-1.8 l-6.6,3.9l-1.2,2.5l-4.8,1.9v-2.8l-3-1.6l-9.2-2l-2.3-4.8l2.8-2.4l-1-3.1l-1.8-2.2l-2.9-0.3l0.3-2.9l-2.6-1l-0.5-2.7l-3.5-0.7 l-0.2-4.8l5.6-2.5l0.1-2.7l-0.5-9.9l-5.6-3l-2.4-5.2l0.6-3.4h4.7l-0.7-2.9l2.3-2.2L493.9,167.9z">
                                        </path>
                                        @endif
                                        @if ($departement[52]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Haute-Marne" data-nom="Haute-Marne" data-numerodepartement="52" class="region-44 departement departement-52 departement-haute-marne" d="m493.9,167.9l8.6-2.2l3.4,5.2l16.9,10.4 l-2.4,2.3l12.7,9.5l-1.7,8.6l5.5,4.7l0.2,3.1l2.7-1.1l1.3,2.5v0.1l0.2,1.4l-2.3,3.2l-2.9-0.3l-2,2.4l-0.3,8.3l-3.2,1l-2.1-1.8 l-6.6,3.9l-1.2,2.5l-4.8,1.9v-2.8l-3-1.6l-9.2-2l-2.3-4.8l2.8-2.4l-1-3.1l-1.8-2.2l-2.9-0.3l0.3-2.9l-2.6-1l-0.5-2.7l-3.5-0.7 l-0.2-4.8l5.6-2.5l0.1-2.7l-0.5-9.9l-5.6-3l-2.4-5.2l0.6-3.4h4.7l-0.7-2.9l2.3-2.2L493.9,167.9z">
                                        </path> @endif
                                        @if ($departement[52]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Haute-Marne" data-nom="Haute-Marne" data-numerodepartement="52" class="region-44 departement departement-52 departement-haute-marne" d="m493.9,167.9l8.6-2.2l3.4,5.2l16.9,10.4 l-2.4,2.3l12.7,9.5l-1.7,8.6l5.5,4.7l0.2,3.1l2.7-1.1l1.3,2.5v0.1l0.2,1.4l-2.3,3.2l-2.9-0.3l-2,2.4l-0.3,8.3l-3.2,1l-2.1-1.8 l-6.6,3.9l-1.2,2.5l-4.8,1.9v-2.8l-3-1.6l-9.2-2l-2.3-4.8l2.8-2.4l-1-3.1l-1.8-2.2l-2.9-0.3l0.3-2.9l-2.6-1l-0.5-2.7l-3.5-0.7 l-0.2-4.8l5.6-2.5l0.1-2.7l-0.5-9.9l-5.6-3l-2.4-5.2l0.6-3.4h4.7l-0.7-2.9l2.3-2.2L493.9,167.9z">
                                        </path> @endif
                                        @if ($departement[52]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Haute-Marne" data-nom="Haute-Marne" data-numerodepartement="52" class="region-44 departement departement-52 departement-haute-marne" d="m493.9,167.9l8.6-2.2l3.4,5.2l16.9,10.4 l-2.4,2.3l12.7,9.5l-1.7,8.6l5.5,4.7l0.2,3.1l2.7-1.1l1.3,2.5v0.1l0.2,1.4l-2.3,3.2l-2.9-0.3l-2,2.4l-0.3,8.3l-3.2,1l-2.1-1.8 l-6.6,3.9l-1.2,2.5l-4.8,1.9v-2.8l-3-1.6l-9.2-2l-2.3-4.8l2.8-2.4l-1-3.1l-1.8-2.2l-2.9-0.3l0.3-2.9l-2.6-1l-0.5-2.7l-3.5-0.7 l-0.2-4.8l5.6-2.5l0.1-2.7l-0.5-9.9l-5.6-3l-2.4-5.2l0.6-3.4h4.7l-0.7-2.9l2.3-2.2L493.9,167.9z">
                                        </path> @endif
                                        @if ($departement[52]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Haute-Marne" data-nom="Haute-Marne" data-numerodepartement="52" class="region-44 departement departement-52 departement-haute-marne" d="m493.9,167.9l8.6-2.2l3.4,5.2l16.9,10.4 l-2.4,2.3l12.7,9.5l-1.7,8.6l5.5,4.7l0.2,3.1l2.7-1.1l1.3,2.5v0.1l0.2,1.4l-2.3,3.2l-2.9-0.3l-2,2.4l-0.3,8.3l-3.2,1l-2.1-1.8 l-6.6,3.9l-1.2,2.5l-4.8,1.9v-2.8l-3-1.6l-9.2-2l-2.3-4.8l2.8-2.4l-1-3.1l-1.8-2.2l-2.9-0.3l0.3-2.9l-2.6-1l-0.5-2.7l-3.5-0.7 l-0.2-4.8l5.6-2.5l0.1-2.7l-0.5-9.9l-5.6-3l-2.4-5.2l0.6-3.4h4.7l-0.7-2.9l2.3-2.2L493.9,167.9z">
                                        </path> @endif

                                        @if ($departement[54]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Meurthe-et-Moselle" data-nom="Meurthe-et-Moselle" data-numerodepartement="54" class="region-44 departement departement-54 departement-meurthe-et-moselle" d="m588.2,170.9l1.9,1.3l-1.5,0.4l-10.6,7.6l-6.1-1.6l-1.6-2.7l-5.3,3.8 l-6,1l-2.4-1.8l-5.4,2l-1.1,2.8l-5.7,0.7l-4.1-4.8l0.1-2.9l-5.8-0.6l0.2-2.9l-2.5-2l1.7-2.8l-1.3-8.6l2.2-13.8l0.9-2.7l-4.9-11.5 l1.5-5.9l-1.2-2.7l-4.4-4.8l-5.3,2l-0.7-5.3l4.8-1.7l2-1.9h6.8l2.54,2.31L539.6,124l2.5,1.6l1.2,3.6l-1.7,3.1l1,5.6l-2.8,0.1 l4.3,7.5l11.5,4l-0.3,2.9l2.7,5.1l8.5,1.5l5.3,3.9l14.4,5.3L588.2,170.9z">
                                            </path>
                                            @endif
                                            @if ($departement[54]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Meurthe-et-Moselle" data-nom="Meurthe-et-Moselle" data-numerodepartement="54" class="region-44 departement departement-54 departement-meurthe-et-moselle" d="m588.2,170.9l1.9,1.3l-1.5,0.4l-10.6,7.6l-6.1-1.6l-1.6-2.7l-5.3,3.8 l-6,1l-2.4-1.8l-5.4,2l-1.1,2.8l-5.7,0.7l-4.1-4.8l0.1-2.9l-5.8-0.6l0.2-2.9l-2.5-2l1.7-2.8l-1.3-8.6l2.2-13.8l0.9-2.7l-4.9-11.5 l1.5-5.9l-1.2-2.7l-4.4-4.8l-5.3,2l-0.7-5.3l4.8-1.7l2-1.9h6.8l2.54,2.31L539.6,124l2.5,1.6l1.2,3.6l-1.7,3.1l1,5.6l-2.8,0.1 l4.3,7.5l11.5,4l-0.3,2.9l2.7,5.1l8.5,1.5l5.3,3.9l14.4,5.3L588.2,170.9z">
                                            </path> @endif
                                            @if ($departement[54]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Meurthe-et-Moselle" data-nom="Meurthe-et-Moselle" data-numerodepartement="54" class="region-44 departement departement-54 departement-meurthe-et-moselle" d="m588.2,170.9l1.9,1.3l-1.5,0.4l-10.6,7.6l-6.1-1.6l-1.6-2.7l-5.3,3.8 l-6,1l-2.4-1.8l-5.4,2l-1.1,2.8l-5.7,0.7l-4.1-4.8l0.1-2.9l-5.8-0.6l0.2-2.9l-2.5-2l1.7-2.8l-1.3-8.6l2.2-13.8l0.9-2.7l-4.9-11.5 l1.5-5.9l-1.2-2.7l-4.4-4.8l-5.3,2l-0.7-5.3l4.8-1.7l2-1.9h6.8l2.54,2.31L539.6,124l2.5,1.6l1.2,3.6l-1.7,3.1l1,5.6l-2.8,0.1 l4.3,7.5l11.5,4l-0.3,2.9l2.7,5.1l8.5,1.5l5.3,3.9l14.4,5.3L588.2,170.9z">
                                            </path> @endif
                                            @if ($departement[54]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Meurthe-et-Moselle" data-nom="Meurthe-et-Moselle" data-numerodepartement="54" class="region-44 departement departement-54 departement-meurthe-et-moselle" d="m588.2,170.9l1.9,1.3l-1.5,0.4l-10.6,7.6l-6.1-1.6l-1.6-2.7l-5.3,3.8 l-6,1l-2.4-1.8l-5.4,2l-1.1,2.8l-5.7,0.7l-4.1-4.8l0.1-2.9l-5.8-0.6l0.2-2.9l-2.5-2l1.7-2.8l-1.3-8.6l2.2-13.8l0.9-2.7l-4.9-11.5 l1.5-5.9l-1.2-2.7l-4.4-4.8l-5.3,2l-0.7-5.3l4.8-1.7l2-1.9h6.8l2.54,2.31L539.6,124l2.5,1.6l1.2,3.6l-1.7,3.1l1,5.6l-2.8,0.1 l4.3,7.5l11.5,4l-0.3,2.9l2.7,5.1l8.5,1.5l5.3,3.9l14.4,5.3L588.2,170.9z">
                                            </path> @endif
                                            @if ($departement[54]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Meurthe-et-Moselle" data-nom="Meurthe-et-Moselle" data-numerodepartement="54" class="region-44 departement departement-54 departement-meurthe-et-moselle" d="m588.2,170.9l1.9,1.3l-1.5,0.4l-10.6,7.6l-6.1-1.6l-1.6-2.7l-5.3,3.8 l-6,1l-2.4-1.8l-5.4,2l-1.1,2.8l-5.7,0.7l-4.1-4.8l0.1-2.9l-5.8-0.6l0.2-2.9l-2.5-2l1.7-2.8l-1.3-8.6l2.2-13.8l0.9-2.7l-4.9-11.5 l1.5-5.9l-1.2-2.7l-4.4-4.8l-5.3,2l-0.7-5.3l4.8-1.7l2-1.9h6.8l2.54,2.31L539.6,124l2.5,1.6l1.2,3.6l-1.7,3.1l1,5.6l-2.8,0.1 l4.3,7.5l11.5,4l-0.3,2.9l2.7,5.1l8.5,1.5l5.3,3.9l14.4,5.3L588.2,170.9z">
                                            </path> @endif

                                            @if ($departement[55]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Meuse" data-nom="Meuse" data-numerodepartement="55" class="region-44 departement departement-55 departement-meuse" d="m516.2,107.97l1.2-0.07l1.5,1.6l1.9,5.6 l0.7,5.3l5.3-2l4.4,4.8l1.2,2.7l-1.5,5.9l4.9,11.5l-0.9,2.7l-2.2,13.8l1.3,8.6l-1.7,2.8l2.5,2l-0.2,2.9l-1.9,2.3l-3-0.5l-6.9,3.4 l-16.9-10.4l-3.4-5.2l-0.5-4.1l-3.2-4.6l1.1-5.8l3.1-1.1l0.6-3.9l-2.6-1.3l1-4.1l-2.2-9v-0.1l4.2-3.6l-1.4-2.5l3.2-5.1l-0.8-8.8 l1.9-2l5.7,2.1l2-2.7L516.2,107.97z">
                                                </path>
                                                @endif
                                                @if ($departement[55]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Meuse" data-nom="Meuse" data-numerodepartement="55" class="region-44 departement departement-55 departement-meuse" d="m516.2,107.97l1.2-0.07l1.5,1.6l1.9,5.6 l0.7,5.3l5.3-2l4.4,4.8l1.2,2.7l-1.5,5.9l4.9,11.5l-0.9,2.7l-2.2,13.8l1.3,8.6l-1.7,2.8l2.5,2l-0.2,2.9l-1.9,2.3l-3-0.5l-6.9,3.4 l-16.9-10.4l-3.4-5.2l-0.5-4.1l-3.2-4.6l1.1-5.8l3.1-1.1l0.6-3.9l-2.6-1.3l1-4.1l-2.2-9v-0.1l4.2-3.6l-1.4-2.5l3.2-5.1l-0.8-8.8 l1.9-2l5.7,2.1l2-2.7L516.2,107.97z">
                                                </path> @endif
                                                @if ($departement[55]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Meuse" data-nom="Meuse" data-numerodepartement="55" class="region-44 departement departement-55 departement-meuse" d="m516.2,107.97l1.2-0.07l1.5,1.6l1.9,5.6 l0.7,5.3l5.3-2l4.4,4.8l1.2,2.7l-1.5,5.9l4.9,11.5l-0.9,2.7l-2.2,13.8l1.3,8.6l-1.7,2.8l2.5,2l-0.2,2.9l-1.9,2.3l-3-0.5l-6.9,3.4 l-16.9-10.4l-3.4-5.2l-0.5-4.1l-3.2-4.6l1.1-5.8l3.1-1.1l0.6-3.9l-2.6-1.3l1-4.1l-2.2-9v-0.1l4.2-3.6l-1.4-2.5l3.2-5.1l-0.8-8.8 l1.9-2l5.7,2.1l2-2.7L516.2,107.97z">
                                                </path> @endif
                                                @if ($departement[55]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Meuse" data-nom="Meuse" data-numerodepartement="55" class="region-44 departement departement-55 departement-meuse" d="m516.2,107.97l1.2-0.07l1.5,1.6l1.9,5.6 l0.7,5.3l5.3-2l4.4,4.8l1.2,2.7l-1.5,5.9l4.9,11.5l-0.9,2.7l-2.2,13.8l1.3,8.6l-1.7,2.8l2.5,2l-0.2,2.9l-1.9,2.3l-3-0.5l-6.9,3.4 l-16.9-10.4l-3.4-5.2l-0.5-4.1l-3.2-4.6l1.1-5.8l3.1-1.1l0.6-3.9l-2.6-1.3l1-4.1l-2.2-9v-0.1l4.2-3.6l-1.4-2.5l3.2-5.1l-0.8-8.8 l1.9-2l5.7,2.1l2-2.7L516.2,107.97z">
                                                </path> @endif
                                                @if ($departement[55]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Meuse" data-nom="Meuse" data-numerodepartement="55" class="region-44 departement departement-55 departement-meuse" d="m516.2,107.97l1.2-0.07l1.5,1.6l1.9,5.6 l0.7,5.3l5.3-2l4.4,4.8l1.2,2.7l-1.5,5.9l4.9,11.5l-0.9,2.7l-2.2,13.8l1.3,8.6l-1.7,2.8l2.5,2l-0.2,2.9l-1.9,2.3l-3-0.5l-6.9,3.4 l-16.9-10.4l-3.4-5.2l-0.5-4.1l-3.2-4.6l1.1-5.8l3.1-1.1l0.6-3.9l-2.6-1.3l1-4.1l-2.2-9v-0.1l4.2-3.6l-1.4-2.5l3.2-5.1l-0.8-8.8 l1.9-2l5.7,2.1l2-2.7L516.2,107.97z">
                                                </path> @endif

                                                @if ($departement[57]->hospitalises
                                                <= 50) <path class="region" style="fill: green" id="Moselle" data-nom="Moselle" data-numerodepartement="57" class="region-44 departement departement-57 departement-moselle" d="m539.6,124l-2.65-10.19l0.65,0.59h2.4l1.5,2.1 l2.3,0.7l2.3-0.5l1-2.3l2-1.2l2.2-0.2l4.5,2.3l4.9-0.1l3.1,3.8l2.3,1.9l-0.5,2l3.7,3.2l2.8,4.5v2.3l4.2,0.7l1.2-1.9l-0.3-2.4 l2.6-0.2l3.8,1.8l1.4,3.5l2.1-1.5l2.5,1.9l5.8-0.4l5.3-4.2l2.2,1.4l0.5,2.1l2.4,2.4l3.2,1.5h0.03l-1.73,4.4l-1.4,2.6l-8.9,0.3 l-9.1-4.6l-0.8-2.8l-5,10.8l5.5,2.4l-1.6,2.5l2.3,1.7l1.3-2.5l3,0.3l4.3,3.4l-3,13.3l-2.3,1.8l-3.4-0.3l-2-2.7l-14.4-5.3l-5.3-3.9 l-8.5-1.5l-2.7-5.1l0.3-2.9l-11.5-4l-4.3-7.5l2.8-0.1l-1-5.6l1.7-3.1l-1.2-3.6L539.6,124z">
                                                    </path>
                                                    @endif
                                                    @if ($departement[57]->hospitalises > 50)
                                                    <path class="region" style="fill: yellow" id="Moselle" data-nom="Moselle" data-numerodepartement="57" class="region-44 departement departement-57 departement-moselle" d="m539.6,124l-2.65-10.19l0.65,0.59h2.4l1.5,2.1 l2.3,0.7l2.3-0.5l1-2.3l2-1.2l2.2-0.2l4.5,2.3l4.9-0.1l3.1,3.8l2.3,1.9l-0.5,2l3.7,3.2l2.8,4.5v2.3l4.2,0.7l1.2-1.9l-0.3-2.4 l2.6-0.2l3.8,1.8l1.4,3.5l2.1-1.5l2.5,1.9l5.8-0.4l5.3-4.2l2.2,1.4l0.5,2.1l2.4,2.4l3.2,1.5h0.03l-1.73,4.4l-1.4,2.6l-8.9,0.3 l-9.1-4.6l-0.8-2.8l-5,10.8l5.5,2.4l-1.6,2.5l2.3,1.7l1.3-2.5l3,0.3l4.3,3.4l-3,13.3l-2.3,1.8l-3.4-0.3l-2-2.7l-14.4-5.3l-5.3-3.9 l-8.5-1.5l-2.7-5.1l0.3-2.9l-11.5-4l-4.3-7.5l2.8-0.1l-1-5.6l1.7-3.1l-1.2-3.6L539.6,124z">
                                                    </path> @endif
                                                    @if ($departement[57]->hospitalises >= 150)
                                                    <path class="region" style="fill: pink" id="Moselle" data-nom="Moselle" data-numerodepartement="57" class="region-44 departement departement-57 departement-moselle" d="m539.6,124l-2.65-10.19l0.65,0.59h2.4l1.5,2.1 l2.3,0.7l2.3-0.5l1-2.3l2-1.2l2.2-0.2l4.5,2.3l4.9-0.1l3.1,3.8l2.3,1.9l-0.5,2l3.7,3.2l2.8,4.5v2.3l4.2,0.7l1.2-1.9l-0.3-2.4 l2.6-0.2l3.8,1.8l1.4,3.5l2.1-1.5l2.5,1.9l5.8-0.4l5.3-4.2l2.2,1.4l0.5,2.1l2.4,2.4l3.2,1.5h0.03l-1.73,4.4l-1.4,2.6l-8.9,0.3 l-9.1-4.6l-0.8-2.8l-5,10.8l5.5,2.4l-1.6,2.5l2.3,1.7l1.3-2.5l3,0.3l4.3,3.4l-3,13.3l-2.3,1.8l-3.4-0.3l-2-2.7l-14.4-5.3l-5.3-3.9 l-8.5-1.5l-2.7-5.1l0.3-2.9l-11.5-4l-4.3-7.5l2.8-0.1l-1-5.6l1.7-3.1l-1.2-3.6L539.6,124z">
                                                    </path> @endif
                                                    @if ($departement[57]->hospitalises >= 250)
                                                    <path class="region" style="fill: purple" id="Moselle" data-nom="Moselle" data-numerodepartement="57" class="region-44 departement departement-57 departement-moselle" d="m539.6,124l-2.65-10.19l0.65,0.59h2.4l1.5,2.1 l2.3,0.7l2.3-0.5l1-2.3l2-1.2l2.2-0.2l4.5,2.3l4.9-0.1l3.1,3.8l2.3,1.9l-0.5,2l3.7,3.2l2.8,4.5v2.3l4.2,0.7l1.2-1.9l-0.3-2.4 l2.6-0.2l3.8,1.8l1.4,3.5l2.1-1.5l2.5,1.9l5.8-0.4l5.3-4.2l2.2,1.4l0.5,2.1l2.4,2.4l3.2,1.5h0.03l-1.73,4.4l-1.4,2.6l-8.9,0.3 l-9.1-4.6l-0.8-2.8l-5,10.8l5.5,2.4l-1.6,2.5l2.3,1.7l1.3-2.5l3,0.3l4.3,3.4l-3,13.3l-2.3,1.8l-3.4-0.3l-2-2.7l-14.4-5.3l-5.3-3.9 l-8.5-1.5l-2.7-5.1l0.3-2.9l-11.5-4l-4.3-7.5l2.8-0.1l-1-5.6l1.7-3.1l-1.2-3.6L539.6,124z">
                                                    </path> @endif
                                                    @if ($departement[57]->hospitalises >= 400)
                                                    <path class="region" style="fill: red" id="Moselle" data-nom="Moselle" data-numerodepartement="57" class="region-44 departement departement-57 departement-moselle" d="m539.6,124l-2.65-10.19l0.65,0.59h2.4l1.5,2.1 l2.3,0.7l2.3-0.5l1-2.3l2-1.2l2.2-0.2l4.5,2.3l4.9-0.1l3.1,3.8l2.3,1.9l-0.5,2l3.7,3.2l2.8,4.5v2.3l4.2,0.7l1.2-1.9l-0.3-2.4 l2.6-0.2l3.8,1.8l1.4,3.5l2.1-1.5l2.5,1.9l5.8-0.4l5.3-4.2l2.2,1.4l0.5,2.1l2.4,2.4l3.2,1.5h0.03l-1.73,4.4l-1.4,2.6l-8.9,0.3 l-9.1-4.6l-0.8-2.8l-5,10.8l5.5,2.4l-1.6,2.5l2.3,1.7l1.3-2.5l3,0.3l4.3,3.4l-3,13.3l-2.3,1.8l-3.4-0.3l-2-2.7l-14.4-5.3l-5.3-3.9 l-8.5-1.5l-2.7-5.1l0.3-2.9l-11.5-4l-4.3-7.5l2.8-0.1l-1-5.6l1.7-3.1l-1.2-3.6L539.6,124z">
                                                    </path> @endif

                                                    @if ($departement[67]->hospitalises
                                                    <= 50) <path class="region" style="fill: green" id="Bas-Rhin" data-nom="Bas-Rhin" data-numerodepartement="67" class="region-44 departement departement-67 departement-bas-rhin" d="m631.8,140.7l-2.8,9.4l-7.8,10.5l-2,1.5l-1.4,3.3l0.3,4.9l-2.4,7.2 l0.7,3.6l-1.5,2l-1.2,5.5l-3.16,6.23L605.9,193l-0.3-2.8l-8.5-5.6l-3.1-0.2l-5.2-2.2l1.3-10l-1.9-1.3l3.4,0.3l2.3-1.8l3-13.3 l-4.3-3.4l-3-0.3l-1.3,2.5l-2.3-1.7l1.6-2.5l-5.5-2.4l5-10.8l0.8,2.8l9.1,4.6l8.9-0.3l1.4-2.6l1.73-4.4l8.87,0.6l2.4-0.6 L631.8,140.7z">
                                                        </path>
                                                        @endif
                                                        @if ($departement[67]->hospitalises > 50)
                                                        <path class="region" style="fill: yellow" id="Bas-Rhin" data-nom="Bas-Rhin" data-numerodepartement="67" class="region-44 departement departement-67 departement-bas-rhin" d="m631.8,140.7l-2.8,9.4l-7.8,10.5l-2,1.5l-1.4,3.3l0.3,4.9l-2.4,7.2 l0.7,3.6l-1.5,2l-1.2,5.5l-3.16,6.23L605.9,193l-0.3-2.8l-8.5-5.6l-3.1-0.2l-5.2-2.2l1.3-10l-1.9-1.3l3.4,0.3l2.3-1.8l3-13.3 l-4.3-3.4l-3-0.3l-1.3,2.5l-2.3-1.7l1.6-2.5l-5.5-2.4l5-10.8l0.8,2.8l9.1,4.6l8.9-0.3l1.4-2.6l1.73-4.4l8.87,0.6l2.4-0.6 L631.8,140.7z">
                                                        </path> @endif
                                                        @if ($departement[67]->hospitalises >= 150)
                                                        <path class="region" style="fill: pink" id="Bas-Rhin" data-nom="Bas-Rhin" data-numerodepartement="67" class="region-44 departement departement-67 departement-bas-rhin" d="m631.8,140.7l-2.8,9.4l-7.8,10.5l-2,1.5l-1.4,3.3l0.3,4.9l-2.4,7.2 l0.7,3.6l-1.5,2l-1.2,5.5l-3.16,6.23L605.9,193l-0.3-2.8l-8.5-5.6l-3.1-0.2l-5.2-2.2l1.3-10l-1.9-1.3l3.4,0.3l2.3-1.8l3-13.3 l-4.3-3.4l-3-0.3l-1.3,2.5l-2.3-1.7l1.6-2.5l-5.5-2.4l5-10.8l0.8,2.8l9.1,4.6l8.9-0.3l1.4-2.6l1.73-4.4l8.87,0.6l2.4-0.6 L631.8,140.7z">
                                                        </path> @endif
                                                        @if ($departement[67]->hospitalises >= 250)
                                                        <path class="region" style="fill: purple" id="Bas-Rhin" data-nom="Bas-Rhin" data-numerodepartement="67" class="region-44 departement departement-67 departement-bas-rhin" d="m631.8,140.7l-2.8,9.4l-7.8,10.5l-2,1.5l-1.4,3.3l0.3,4.9l-2.4,7.2 l0.7,3.6l-1.5,2l-1.2,5.5l-3.16,6.23L605.9,193l-0.3-2.8l-8.5-5.6l-3.1-0.2l-5.2-2.2l1.3-10l-1.9-1.3l3.4,0.3l2.3-1.8l3-13.3 l-4.3-3.4l-3-0.3l-1.3,2.5l-2.3-1.7l1.6-2.5l-5.5-2.4l5-10.8l0.8,2.8l9.1,4.6l8.9-0.3l1.4-2.6l1.73-4.4l8.87,0.6l2.4-0.6 L631.8,140.7z">
                                                        </path> @endif
                                                        @if ($departement[67]->hospitalises >= 400)
                                                        <path class="region" style="fill: red" id="Bas-Rhin" data-nom="Bas-Rhin" data-numerodepartement="67" class="region-44 departement departement-67 departement-bas-rhin" d="m631.8,140.7l-2.8,9.4l-7.8,10.5l-2,1.5l-1.4,3.3l0.3,4.9l-2.4,7.2 l0.7,3.6l-1.5,2l-1.2,5.5l-3.16,6.23L605.9,193l-0.3-2.8l-8.5-5.6l-3.1-0.2l-5.2-2.2l1.3-10l-1.9-1.3l3.4,0.3l2.3-1.8l3-13.3 l-4.3-3.4l-3-0.3l-1.3,2.5l-2.3-1.7l1.6-2.5l-5.5-2.4l5-10.8l0.8,2.8l9.1,4.6l8.9-0.3l1.4-2.6l1.73-4.4l8.87,0.6l2.4-0.6 L631.8,140.7z">
                                                        </path> @endif

                                                        @if ($departement[68]->hospitalises
                                                        <= 50) <path class="region" style="fill: green" id="Haut-Rhin" data-nom="Haut-Rhin" data-numerodepartement="68" class="region-44 departement departement-68 departement-haut-rhin" d="m605.9,193l4.64,1.83l-0.04,0.07v5.3l1.6,1.9 l0.2,3.4l-2.2,11.1l0.1,6.7l1.8,1.5l0.6,3.5l-2.2,2l-0.2,2.3l-3.1,0.9l0.5,2.2l-1.5,1.6h-2.7l-3.8,1.4l-3-1.1l0.3-2.5l-2.4-1.1 l-0.4,0.1l-2-5l-2.8,0.2l-0.5-9l-7.6-5l2.8-2.4v-6.2l4.8-7.8l4.1-13.5l1.1-1l3.1,0.2l8.5,5.6L605.9,193z">
                                                            </path>
                                                            @endif
                                                            @if ($departement[68]->hospitalises > 50)
                                                            <path class="region" style="fill: yellow" id="Haut-Rhin" data-nom="Haut-Rhin" data-numerodepartement="68" class="region-44 departement departement-68 departement-haut-rhin" d="m605.9,193l4.64,1.83l-0.04,0.07v5.3l1.6,1.9 l0.2,3.4l-2.2,11.1l0.1,6.7l1.8,1.5l0.6,3.5l-2.2,2l-0.2,2.3l-3.1,0.9l0.5,2.2l-1.5,1.6h-2.7l-3.8,1.4l-3-1.1l0.3-2.5l-2.4-1.1 l-0.4,0.1l-2-5l-2.8,0.2l-0.5-9l-7.6-5l2.8-2.4v-6.2l4.8-7.8l4.1-13.5l1.1-1l3.1,0.2l8.5,5.6L605.9,193z">
                                                            </path> @endif
                                                            @if ($departement[68]->hospitalises >= 150)
                                                            <path class="region" style="fill: pink" id="Haut-Rhin" data-nom="Haut-Rhin" data-numerodepartement="68" class="region-44 departement departement-68 departement-haut-rhin" d="m605.9,193l4.64,1.83l-0.04,0.07v5.3l1.6,1.9 l0.2,3.4l-2.2,11.1l0.1,6.7l1.8,1.5l0.6,3.5l-2.2,2l-0.2,2.3l-3.1,0.9l0.5,2.2l-1.5,1.6h-2.7l-3.8,1.4l-3-1.1l0.3-2.5l-2.4-1.1 l-0.4,0.1l-2-5l-2.8,0.2l-0.5-9l-7.6-5l2.8-2.4v-6.2l4.8-7.8l4.1-13.5l1.1-1l3.1,0.2l8.5,5.6L605.9,193z">
                                                            </path> @endif
                                                            @if ($departement[68]->hospitalises >= 250)
                                                            <path class="region" style="fill: purple" id="Haut-Rhin" data-nom="Haut-Rhin" data-numerodepartement="68" class="region-44 departement departement-68 departement-haut-rhin" d="m605.9,193l4.64,1.83l-0.04,0.07v5.3l1.6,1.9 l0.2,3.4l-2.2,11.1l0.1,6.7l1.8,1.5l0.6,3.5l-2.2,2l-0.2,2.3l-3.1,0.9l0.5,2.2l-1.5,1.6h-2.7l-3.8,1.4l-3-1.1l0.3-2.5l-2.4-1.1 l-0.4,0.1l-2-5l-2.8,0.2l-0.5-9l-7.6-5l2.8-2.4v-6.2l4.8-7.8l4.1-13.5l1.1-1l3.1,0.2l8.5,5.6L605.9,193z">
                                                            </path> @endif
                                                            @if ($departement[68]->hospitalises >= 400)
                                                            <path class="region" style="fill: red" id="Haut-Rhin" data-nom="Haut-Rhin" data-numerodepartement="68" class="region-44 departement departement-68 departement-haut-rhin" d="m605.9,193l4.64,1.83l-0.04,0.07v5.3l1.6,1.9 l0.2,3.4l-2.2,11.1l0.1,6.7l1.8,1.5l0.6,3.5l-2.2,2l-0.2,2.3l-3.1,0.9l0.5,2.2l-1.5,1.6h-2.7l-3.8,1.4l-3-1.1l0.3-2.5l-2.4-1.1 l-0.4,0.1l-2-5l-2.8,0.2l-0.5-9l-7.6-5l2.8-2.4v-6.2l4.8-7.8l4.1-13.5l1.1-1l3.1,0.2l8.5,5.6L605.9,193z">
                                                            </path> @endif

                                                            @if ($departement[88]->hospitalises
                                                            <= 50) <path class="region" style="fill: green" id="Vosges" data-nom="Vosges" data-numerodepartement="88" class="region-44 departement departement-88 departement-vosges" d="m520.4,183.6l2.4-2.3l6.9-3.4l3,0.5l1.9-2.3 l5.8,0.6l-0.1,2.9l4.1,4.8l5.7-0.7l1.1-2.8l5.4-2l2.4,1.8l6-1l5.3-3.8l1.6,2.7l6.1,1.6l10.6-7.6l1.5-0.4l-1.3,10l5.2,2.2l-1.1,1 l-4.1,13.5l-4.8,7.8v6.2l-2.8,2.4l-0.9,0.6l-8.4-6.6l-5.1,2.2l-4.9-3.6l-5.8,1.6l-7-4.3l-8,5.8v-0.1l-1.3-2.5l-2.7,1.1l-0.2-3.1 l-5.5-4.7l1.7-8.6L520.4,183.6z">
                                                                </path>
                                                                @endif
                                                                @if ($departement[88]->hospitalises > 50)
                                                                <path class="region" style="fill: yellow" id="Vosges" data-nom="Vosges" data-numerodepartement="88" class="region-44 departement departement-88 departement-vosges" d="m520.4,183.6l2.4-2.3l6.9-3.4l3,0.5l1.9-2.3 l5.8,0.6l-0.1,2.9l4.1,4.8l5.7-0.7l1.1-2.8l5.4-2l2.4,1.8l6-1l5.3-3.8l1.6,2.7l6.1,1.6l10.6-7.6l1.5-0.4l-1.3,10l5.2,2.2l-1.1,1 l-4.1,13.5l-4.8,7.8v6.2l-2.8,2.4l-0.9,0.6l-8.4-6.6l-5.1,2.2l-4.9-3.6l-5.8,1.6l-7-4.3l-8,5.8v-0.1l-1.3-2.5l-2.7,1.1l-0.2-3.1 l-5.5-4.7l1.7-8.6L520.4,183.6z">
                                                                </path> @endif
                                                                @if ($departement[88]->hospitalises >= 150)
                                                                <path class="region" style="fill: pink" id="Vosges" data-nom="Vosges" data-numerodepartement="88" class="region-44 departement departement-88 departement-vosges" d="m520.4,183.6l2.4-2.3l6.9-3.4l3,0.5l1.9-2.3 l5.8,0.6l-0.1,2.9l4.1,4.8l5.7-0.7l1.1-2.8l5.4-2l2.4,1.8l6-1l5.3-3.8l1.6,2.7l6.1,1.6l10.6-7.6l1.5-0.4l-1.3,10l5.2,2.2l-1.1,1 l-4.1,13.5l-4.8,7.8v6.2l-2.8,2.4l-0.9,0.6l-8.4-6.6l-5.1,2.2l-4.9-3.6l-5.8,1.6l-7-4.3l-8,5.8v-0.1l-1.3-2.5l-2.7,1.1l-0.2-3.1 l-5.5-4.7l1.7-8.6L520.4,183.6z">
                                                                </path> @endif
                                                                @if ($departement[88]->hospitalises >= 250)
                                                                <path class="region" style="fill: purple" id="Vosges" data-nom="Vosges" data-numerodepartement="88" class="region-44 departement departement-88 departement-vosges" d="m520.4,183.6l2.4-2.3l6.9-3.4l3,0.5l1.9-2.3 l5.8,0.6l-0.1,2.9l4.1,4.8l5.7-0.7l1.1-2.8l5.4-2l2.4,1.8l6-1l5.3-3.8l1.6,2.7l6.1,1.6l10.6-7.6l1.5-0.4l-1.3,10l5.2,2.2l-1.1,1 l-4.1,13.5l-4.8,7.8v6.2l-2.8,2.4l-0.9,0.6l-8.4-6.6l-5.1,2.2l-4.9-3.6l-5.8,1.6l-7-4.3l-8,5.8v-0.1l-1.3-2.5l-2.7,1.1l-0.2-3.1 l-5.5-4.7l1.7-8.6L520.4,183.6z">
                                                                </path> @endif
                                                                @if ($departement[88]->hospitalises >= 400)
                                                                <path class="region" style="fill: red" id="Vosges" data-nom="Vosges" data-numerodepartement="88" class="region-44 departement departement-88 departement-vosges" d="m520.4,183.6l2.4-2.3l6.9-3.4l3,0.5l1.9-2.3 l5.8,0.6l-0.1,2.9l4.1,4.8l5.7-0.7l1.1-2.8l5.4-2l2.4,1.8l6-1l5.3-3.8l1.6,2.7l6.1,1.6l10.6-7.6l1.5-0.4l-1.3,10l5.2,2.2l-1.1,1 l-4.1,13.5l-4.8,7.8v6.2l-2.8,2.4l-0.9,0.6l-8.4-6.6l-5.1,2.2l-4.9-3.6l-5.8,1.6l-7-4.3l-8,5.8v-0.1l-1.3-2.5l-2.7,1.1l-0.2-3.1 l-5.5-4.7l1.7-8.6L520.4,183.6z">
                                                                </path> @endif
                    </g>

                    <g data-nom="Pays de la Loire">

                        @if ($departement[44]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Loire-Atlantique" data-nom="Loire-Atlantique" data-numerodepartement="44" class="region-52 departement departement-44 departement-loire-atlantique" d="m213.1,265.2l1.8-1l-2.8-4.1l-7.8-3l3-1.3 l0.6-2.2l-0.5-2.5l1.4-2.1l5.8-1.1l-5.5-0.7l-6.6,3.7l-4.1-3.2l-2.2,1l-2.2-1.2l-0.5-4.9l0.9-2.5l3-0.5l-0.9-2.2l-0.18-0.31 l13.18-3.89l0.4-6l5.2-3.4l13.2-0.4l1.6-2.9l9-3.9l6.8,3.6l7.2,13.3l-2.7-0.4l-1.9,2.4l8.5,3.3l0.3,5.9l-14.3,2.1l-2.9,2.2l3,0.8 l3.6,4.7l0.8,2.8l-2.8,4.5l2.8,1.4l0.4,3l-4.8-3.5l-1.5,2.4l-3.2,0.7l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5 L213.1,265.2z">
                            </path>
                            @endif
                            @if ($departement[44]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Loire-Atlantique" data-nom="Loire-Atlantique" data-numerodepartement="44" class="region-52 departement departement-44 departement-loire-atlantique" d="m213.1,265.2l1.8-1l-2.8-4.1l-7.8-3l3-1.3 l0.6-2.2l-0.5-2.5l1.4-2.1l5.8-1.1l-5.5-0.7l-6.6,3.7l-4.1-3.2l-2.2,1l-2.2-1.2l-0.5-4.9l0.9-2.5l3-0.5l-0.9-2.2l-0.18-0.31 l13.18-3.89l0.4-6l5.2-3.4l13.2-0.4l1.6-2.9l9-3.9l6.8,3.6l7.2,13.3l-2.7-0.4l-1.9,2.4l8.5,3.3l0.3,5.9l-14.3,2.1l-2.9,2.2l3,0.8 l3.6,4.7l0.8,2.8l-2.8,4.5l2.8,1.4l0.4,3l-4.8-3.5l-1.5,2.4l-3.2,0.7l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5 L213.1,265.2z">
                            </path> @endif
                            @if ($departement[44]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Loire-Atlantique" data-nom="Loire-Atlantique" data-numerodepartement="44" class="region-52 departement departement-44 departement-loire-atlantique" d="m213.1,265.2l1.8-1l-2.8-4.1l-7.8-3l3-1.3 l0.6-2.2l-0.5-2.5l1.4-2.1l5.8-1.1l-5.5-0.7l-6.6,3.7l-4.1-3.2l-2.2,1l-2.2-1.2l-0.5-4.9l0.9-2.5l3-0.5l-0.9-2.2l-0.18-0.31 l13.18-3.89l0.4-6l5.2-3.4l13.2-0.4l1.6-2.9l9-3.9l6.8,3.6l7.2,13.3l-2.7-0.4l-1.9,2.4l8.5,3.3l0.3,5.9l-14.3,2.1l-2.9,2.2l3,0.8 l3.6,4.7l0.8,2.8l-2.8,4.5l2.8,1.4l0.4,3l-4.8-3.5l-1.5,2.4l-3.2,0.7l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5 L213.1,265.2z">
                            </path> @endif
                            @if ($departement[44]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Loire-Atlantique" data-nom="Loire-Atlantique" data-numerodepartement="44" class="region-52 departement departement-44 departement-loire-atlantique" d="m213.1,265.2l1.8-1l-2.8-4.1l-7.8-3l3-1.3 l0.6-2.2l-0.5-2.5l1.4-2.1l5.8-1.1l-5.5-0.7l-6.6,3.7l-4.1-3.2l-2.2,1l-2.2-1.2l-0.5-4.9l0.9-2.5l3-0.5l-0.9-2.2l-0.18-0.31 l13.18-3.89l0.4-6l5.2-3.4l13.2-0.4l1.6-2.9l9-3.9l6.8,3.6l7.2,13.3l-2.7-0.4l-1.9,2.4l8.5,3.3l0.3,5.9l-14.3,2.1l-2.9,2.2l3,0.8 l3.6,4.7l0.8,2.8l-2.8,4.5l2.8,1.4l0.4,3l-4.8-3.5l-1.5,2.4l-3.2,0.7l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5 L213.1,265.2z">
                            </path> @endif
                            @if ($departement[44]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Loire-Atlantique" data-nom="Loire-Atlantique" data-numerodepartement="44" class="region-52 departement departement-44 departement-loire-atlantique" d="m213.1,265.2l1.8-1l-2.8-4.1l-7.8-3l3-1.3 l0.6-2.2l-0.5-2.5l1.4-2.1l5.8-1.1l-5.5-0.7l-6.6,3.7l-4.1-3.2l-2.2,1l-2.2-1.2l-0.5-4.9l0.9-2.5l3-0.5l-0.9-2.2l-0.18-0.31 l13.18-3.89l0.4-6l5.2-3.4l13.2-0.4l1.6-2.9l9-3.9l6.8,3.6l7.2,13.3l-2.7-0.4l-1.9,2.4l8.5,3.3l0.3,5.9l-14.3,2.1l-2.9,2.2l3,0.8 l3.6,4.7l0.8,2.8l-2.8,4.5l2.8,1.4l0.4,3l-4.8-3.5l-1.5,2.4l-3.2,0.7l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5 L213.1,265.2z">
                            </path> @endif

                            @if ($departement[49]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Maine-et-Loire" data-nom="Maine-et-Loire" data-numerodepartement="49" class="region-52 departement departement-49 departement-maine-et-loire" d="m270.6,269.2l-12.3,0.8l-10.6-3.8l-0.4-3 l-2.8-1.4l2.8-4.5l-0.8-2.8l-3.6-4.7l-3-0.8l2.9-2.2l14.3-2.1l-0.3-5.9l-8.5-3.3l1.9-2.4l2.7,0.4l-7.2-13.3l0.4-2.2l10.5,3.5 l2.1-1.9l8.7,3.6l3,0.4l5.9-2.7l5.1,1.7l0.6,2.7l6.7-0.2l0.2,3.5l2,2l3.1-1.3l5.2,3.3l7.4,0.1l-0.7,2.4l-1.7,9.3l-5.8,15.3v0.1 l-6.6,5.9l-2.3-2.3l-9.6,0.2l-5.6,0.8L270.6,269.2z">
                                </path>
                                @endif
                                @if ($departement[49]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Maine-et-Loire" data-nom="Maine-et-Loire" data-numerodepartement="49" class="region-52 departement departement-49 departement-maine-et-loire" d="m270.6,269.2l-12.3,0.8l-10.6-3.8l-0.4-3 l-2.8-1.4l2.8-4.5l-0.8-2.8l-3.6-4.7l-3-0.8l2.9-2.2l14.3-2.1l-0.3-5.9l-8.5-3.3l1.9-2.4l2.7,0.4l-7.2-13.3l0.4-2.2l10.5,3.5 l2.1-1.9l8.7,3.6l3,0.4l5.9-2.7l5.1,1.7l0.6,2.7l6.7-0.2l0.2,3.5l2,2l3.1-1.3l5.2,3.3l7.4,0.1l-0.7,2.4l-1.7,9.3l-5.8,15.3v0.1 l-6.6,5.9l-2.3-2.3l-9.6,0.2l-5.6,0.8L270.6,269.2z">
                                </path> @endif
                                @if ($departement[49]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Maine-et-Loire" data-nom="Maine-et-Loire" data-numerodepartement="49" class="region-52 departement departement-49 departement-maine-et-loire" d="m270.6,269.2l-12.3,0.8l-10.6-3.8l-0.4-3 l-2.8-1.4l2.8-4.5l-0.8-2.8l-3.6-4.7l-3-0.8l2.9-2.2l14.3-2.1l-0.3-5.9l-8.5-3.3l1.9-2.4l2.7,0.4l-7.2-13.3l0.4-2.2l10.5,3.5 l2.1-1.9l8.7,3.6l3,0.4l5.9-2.7l5.1,1.7l0.6,2.7l6.7-0.2l0.2,3.5l2,2l3.1-1.3l5.2,3.3l7.4,0.1l-0.7,2.4l-1.7,9.3l-5.8,15.3v0.1 l-6.6,5.9l-2.3-2.3l-9.6,0.2l-5.6,0.8L270.6,269.2z">
                                </path> @endif
                                @if ($departement[49]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Maine-et-Loire" data-nom="Maine-et-Loire" data-numerodepartement="49" class="region-52 departement departement-49 departement-maine-et-loire" d="m270.6,269.2l-12.3,0.8l-10.6-3.8l-0.4-3 l-2.8-1.4l2.8-4.5l-0.8-2.8l-3.6-4.7l-3-0.8l2.9-2.2l14.3-2.1l-0.3-5.9l-8.5-3.3l1.9-2.4l2.7,0.4l-7.2-13.3l0.4-2.2l10.5,3.5 l2.1-1.9l8.7,3.6l3,0.4l5.9-2.7l5.1,1.7l0.6,2.7l6.7-0.2l0.2,3.5l2,2l3.1-1.3l5.2,3.3l7.4,0.1l-0.7,2.4l-1.7,9.3l-5.8,15.3v0.1 l-6.6,5.9l-2.3-2.3l-9.6,0.2l-5.6,0.8L270.6,269.2z">
                                </path> @endif
                                @if ($departement[49]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Maine-et-Loire" data-nom="Maine-et-Loire" data-numerodepartement="49" class="region-52 departement departement-49 departement-maine-et-loire" d="m270.6,269.2l-12.3,0.8l-10.6-3.8l-0.4-3 l-2.8-1.4l2.8-4.5l-0.8-2.8l-3.6-4.7l-3-0.8l2.9-2.2l14.3-2.1l-0.3-5.9l-8.5-3.3l1.9-2.4l2.7,0.4l-7.2-13.3l0.4-2.2l10.5,3.5 l2.1-1.9l8.7,3.6l3,0.4l5.9-2.7l5.1,1.7l0.6,2.7l6.7-0.2l0.2,3.5l2,2l3.1-1.3l5.2,3.3l7.4,0.1l-0.7,2.4l-1.7,9.3l-5.8,15.3v0.1 l-6.6,5.9l-2.3-2.3l-9.6,0.2l-5.6,0.8L270.6,269.2z">
                                </path> @endif

                                @if ($departement[53]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Mayenne" data-nom="Mayenne" data-numerodepartement="53" class="region-52 departement departement-53 departement-mayenne" d="m256.6,221.5l-10.5-3.5l3.6-8.6l5.5-2.2 l-1.9-17.3l1.5-2.4l0.1-12.1l8.6,0.8h0.1l3.3,3.7l2.4-1.6l2.5,1.7l6.7-3.3h9.1l0.7-2.7l2.7,0.2l1.9,6l3.3,1.6v2.9v0.1l-4.3,2.7 l0.3,6.9l-4.4,4l1.2,2.9l-5,4.6l1.4,3.4l-5.5,7.7l1.5,5.6l-5.1-1.7l-5.9,2.7l-3-0.4l-8.7-3.6L256.6,221.5z">
                                    </path>
                                    @endif
                                    @if ($departement[53]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Mayenne" data-nom="Mayenne" data-numerodepartement="53" class="region-52 departement departement-53 departement-mayenne" d="m256.6,221.5l-10.5-3.5l3.6-8.6l5.5-2.2 l-1.9-17.3l1.5-2.4l0.1-12.1l8.6,0.8h0.1l3.3,3.7l2.4-1.6l2.5,1.7l6.7-3.3h9.1l0.7-2.7l2.7,0.2l1.9,6l3.3,1.6v2.9v0.1l-4.3,2.7 l0.3,6.9l-4.4,4l1.2,2.9l-5,4.6l1.4,3.4l-5.5,7.7l1.5,5.6l-5.1-1.7l-5.9,2.7l-3-0.4l-8.7-3.6L256.6,221.5z">
                                    </path> @endif
                                    @if ($departement[53]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Mayenne" data-nom="Mayenne" data-numerodepartement="53" class="region-52 departement departement-53 departement-mayenne" d="m256.6,221.5l-10.5-3.5l3.6-8.6l5.5-2.2 l-1.9-17.3l1.5-2.4l0.1-12.1l8.6,0.8h0.1l3.3,3.7l2.4-1.6l2.5,1.7l6.7-3.3h9.1l0.7-2.7l2.7,0.2l1.9,6l3.3,1.6v2.9v0.1l-4.3,2.7 l0.3,6.9l-4.4,4l1.2,2.9l-5,4.6l1.4,3.4l-5.5,7.7l1.5,5.6l-5.1-1.7l-5.9,2.7l-3-0.4l-8.7-3.6L256.6,221.5z">
                                    </path> @endif
                                    @if ($departement[53]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Mayenne" data-nom="Mayenne" data-numerodepartement="53" class="region-52 departement departement-53 departement-mayenne" d="m256.6,221.5l-10.5-3.5l3.6-8.6l5.5-2.2 l-1.9-17.3l1.5-2.4l0.1-12.1l8.6,0.8h0.1l3.3,3.7l2.4-1.6l2.5,1.7l6.7-3.3h9.1l0.7-2.7l2.7,0.2l1.9,6l3.3,1.6v2.9v0.1l-4.3,2.7 l0.3,6.9l-4.4,4l1.2,2.9l-5,4.6l1.4,3.4l-5.5,7.7l1.5,5.6l-5.1-1.7l-5.9,2.7l-3-0.4l-8.7-3.6L256.6,221.5z">
                                    </path> @endif
                                    @if ($departement[53]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Mayenne" data-nom="Mayenne" data-numerodepartement="53" class="region-52 departement departement-53 departement-mayenne" d="m256.6,221.5l-10.5-3.5l3.6-8.6l5.5-2.2 l-1.9-17.3l1.5-2.4l0.1-12.1l8.6,0.8h0.1l3.3,3.7l2.4-1.6l2.5,1.7l6.7-3.3h9.1l0.7-2.7l2.7,0.2l1.9,6l3.3,1.6v2.9v0.1l-4.3,2.7 l0.3,6.9l-4.4,4l1.2,2.9l-5,4.6l1.4,3.4l-5.5,7.7l1.5,5.6l-5.1-1.7l-5.9,2.7l-3-0.4l-8.7-3.6L256.6,221.5z">
                                    </path> @endif

                                    @if ($departement[72]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Sarthe" data-nom="Sarthe" data-numerodepartement="72" class="region-52 departement departement-72 departement-sarthe" d="m312.7,235.3l-6.1-2.6l-7.4-0.1l-5.2-3.3 l-3.1,1.3l-2-2l-0.2-3.5l-6.7,0.2l-0.6-2.7l-1.5-5.6l5.5-7.7l-1.4-3.4l5-4.6l-1.2-2.9l4.4-4l-0.3-6.9l4.3-2.7l3,0.1l11-5.9l2.8,1.5 l1.6,8.4l7.2,5l2.9-1l3.1,3.5l3.2,0.7l2.1,3.8l-0.4,1.8v0.1l-2,2.1l1.7,2.2l0.4,5.5l-6.3,10.6l-3.2,1.1l-0.6,3.5l-7.7,4.5l-2.8-0.3 L312.7,235.3z">
                                        </path>
                                        @endif
                                        @if ($departement[72]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Sarthe" data-nom="Sarthe" data-numerodepartement="72" class="region-52 departement departement-72 departement-sarthe" d="m312.7,235.3l-6.1-2.6l-7.4-0.1l-5.2-3.3 l-3.1,1.3l-2-2l-0.2-3.5l-6.7,0.2l-0.6-2.7l-1.5-5.6l5.5-7.7l-1.4-3.4l5-4.6l-1.2-2.9l4.4-4l-0.3-6.9l4.3-2.7l3,0.1l11-5.9l2.8,1.5 l1.6,8.4l7.2,5l2.9-1l3.1,3.5l3.2,0.7l2.1,3.8l-0.4,1.8v0.1l-2,2.1l1.7,2.2l0.4,5.5l-6.3,10.6l-3.2,1.1l-0.6,3.5l-7.7,4.5l-2.8-0.3 L312.7,235.3z">
                                        </path> @endif
                                        @if ($departement[72]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Sarthe" data-nom="Sarthe" data-numerodepartement="72" class="region-52 departement departement-72 departement-sarthe" d="m312.7,235.3l-6.1-2.6l-7.4-0.1l-5.2-3.3 l-3.1,1.3l-2-2l-0.2-3.5l-6.7,0.2l-0.6-2.7l-1.5-5.6l5.5-7.7l-1.4-3.4l5-4.6l-1.2-2.9l4.4-4l-0.3-6.9l4.3-2.7l3,0.1l11-5.9l2.8,1.5 l1.6,8.4l7.2,5l2.9-1l3.1,3.5l3.2,0.7l2.1,3.8l-0.4,1.8v0.1l-2,2.1l1.7,2.2l0.4,5.5l-6.3,10.6l-3.2,1.1l-0.6,3.5l-7.7,4.5l-2.8-0.3 L312.7,235.3z">
                                        </path> @endif
                                        @if ($departement[72]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Sarthe" data-nom="Sarthe" data-numerodepartement="72" class="region-52 departement departement-72 departement-sarthe" d="m312.7,235.3l-6.1-2.6l-7.4-0.1l-5.2-3.3 l-3.1,1.3l-2-2l-0.2-3.5l-6.7,0.2l-0.6-2.7l-1.5-5.6l5.5-7.7l-1.4-3.4l5-4.6l-1.2-2.9l4.4-4l-0.3-6.9l4.3-2.7l3,0.1l11-5.9l2.8,1.5 l1.6,8.4l7.2,5l2.9-1l3.1,3.5l3.2,0.7l2.1,3.8l-0.4,1.8v0.1l-2,2.1l1.7,2.2l0.4,5.5l-6.3,10.6l-3.2,1.1l-0.6,3.5l-7.7,4.5l-2.8-0.3 L312.7,235.3z">
                                        </path> @endif
                                        @if ($departement[72]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Sarthe" data-nom="Sarthe" data-numerodepartement="72" class="region-52 departement departement-72 departement-sarthe" d="m312.7,235.3l-6.1-2.6l-7.4-0.1l-5.2-3.3 l-3.1,1.3l-2-2l-0.2-3.5l-6.7,0.2l-0.6-2.7l-1.5-5.6l5.5-7.7l-1.4-3.4l5-4.6l-1.2-2.9l4.4-4l-0.3-6.9l4.3-2.7l3,0.1l11-5.9l2.8,1.5 l1.6,8.4l7.2,5l2.9-1l3.1,3.5l3.2,0.7l2.1,3.8l-0.4,1.8v0.1l-2,2.1l1.7,2.2l0.4,5.5l-6.3,10.6l-3.2,1.1l-0.6,3.5l-7.7,4.5l-2.8-0.3 L312.7,235.3z">
                                        </path> @endif

                                        @if ($departement[85]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Vendée" data-nom="Vendée" data-numerodepartement="85" class="region-52 departement departement-85 departement-vendee" d="m269.3,305.1l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l-10.6-3.8l-4.8-3.5l-1.5,2.4l-3.2,0.7 l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5l-5.6-5.6l-0.3,0.1l-0.8,2.6l-3.4,4.3l-1.2,2.3l0.2,2.4l8.7,9.5l2.7,5.6 l1.2,5.3l8,5.4l3.4,0.5l3.9,4.3l2.9-0.1l2,1.2l1.8,2.5l-0.9-2.1l3.9,3.3l0.5-2.7l2.4,0.3l7.1-2.7l-1.4,2.9l6.5-0.3l2.4,1.8l9.1-4.5 L269.3,305.1z">
                                            </path>
                                            @endif
                                            @if ($departement[85]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Vendée" data-nom="Vendée" data-numerodepartement="85" class="region-52 departement departement-85 departement-vendee" d="m269.3,305.1l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l-10.6-3.8l-4.8-3.5l-1.5,2.4l-3.2,0.7 l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5l-5.6-5.6l-0.3,0.1l-0.8,2.6l-3.4,4.3l-1.2,2.3l0.2,2.4l8.7,9.5l2.7,5.6 l1.2,5.3l8,5.4l3.4,0.5l3.9,4.3l2.9-0.1l2,1.2l1.8,2.5l-0.9-2.1l3.9,3.3l0.5-2.7l2.4,0.3l7.1-2.7l-1.4,2.9l6.5-0.3l2.4,1.8l9.1-4.5 L269.3,305.1z">
                                            </path> @endif
                                            @if ($departement[85]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Vendée" data-nom="Vendée" data-numerodepartement="85" class="region-52 departement departement-85 departement-vendee" d="m269.3,305.1l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l-10.6-3.8l-4.8-3.5l-1.5,2.4l-3.2,0.7 l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5l-5.6-5.6l-0.3,0.1l-0.8,2.6l-3.4,4.3l-1.2,2.3l0.2,2.4l8.7,9.5l2.7,5.6 l1.2,5.3l8,5.4l3.4,0.5l3.9,4.3l2.9-0.1l2,1.2l1.8,2.5l-0.9-2.1l3.9,3.3l0.5-2.7l2.4,0.3l7.1-2.7l-1.4,2.9l6.5-0.3l2.4,1.8l9.1-4.5 L269.3,305.1z">
                                            </path> @endif
                                            @if ($departement[85]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Vendée" data-nom="Vendée" data-numerodepartement="85" class="region-52 departement departement-85 departement-vendee" d="m269.3,305.1l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l-10.6-3.8l-4.8-3.5l-1.5,2.4l-3.2,0.7 l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5l-5.6-5.6l-0.3,0.1l-0.8,2.6l-3.4,4.3l-1.2,2.3l0.2,2.4l8.7,9.5l2.7,5.6 l1.2,5.3l8,5.4l3.4,0.5l3.9,4.3l2.9-0.1l2,1.2l1.8,2.5l-0.9-2.1l3.9,3.3l0.5-2.7l2.4,0.3l7.1-2.7l-1.4,2.9l6.5-0.3l2.4,1.8l9.1-4.5 L269.3,305.1z">
                                            </path> @endif
                                            @if ($departement[85]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Vendée" data-nom="Vendée" data-numerodepartement="85" class="region-52 departement departement-85 departement-vendee" d="m269.3,305.1l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l-10.6-3.8l-4.8-3.5l-1.5,2.4l-3.2,0.7 l0.5,3l-2.4,2.1l-2.3-1.7v-3.1l-3.4,0.2l-0.2,9.5l-11.7-5l-5.6-5.6l-0.3,0.1l-0.8,2.6l-3.4,4.3l-1.2,2.3l0.2,2.4l8.7,9.5l2.7,5.6 l1.2,5.3l8,5.4l3.4,0.5l3.9,4.3l2.9-0.1l2,1.2l1.8,2.5l-0.9-2.1l3.9,3.3l0.5-2.7l2.4,0.3l7.1-2.7l-1.4,2.9l6.5-0.3l2.4,1.8l9.1-4.5 L269.3,305.1z">
                                            </path> @endif
                    </g>

                    <g data-nom="Bretagne">

                        @if ($departement[20]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Côtes-d’Armor" data-nom="Côtes-d’Armor" data-numerodepartement="22" class="region-53 departement departement-22 departement-cotes-darmor" d="m208.7,188.9l-4.9,7.1l-2.9,1.1l-1.5-2.7 l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9l-12.9-6.5l-7.9,3l-12.46-3.29l2.06-4.11l-2.5-9.3l2.5-8.3l-3.6-4.7l1.1-4.3l1.2,1.4l3.2-0.4 l1.1-7.7l1.5-1.6l2.2-0.6l1.9,1.4h2.5l2.1-1l2.2,0.3l1.5-1.8l0.9,2L170,153l3-3.6l2.9-0.8l-0.1,2.3l-1.2,4.4l1.7-3.1l2.6-0.5l-1.1,2 l7.2,7.8l2.2,5.4l3,2l0.8,3.7l0.7-2.2l3-1l2.4-2.7l8.1-3.3l2.7-0.2l-2,2.5l2.9-1.1l1.8,4.4l1.3-1.9l2.5,0.2v-0.09l1.6,3.99h-0.3h0.3 l2.5,0.3l0.7,0.2l0.4,1.7l-1.9,13L208.7,188.9z">
                            </path>
                            @endif
                            @if ($departement[20]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Côtes-d’Armor" data-nom="Côtes-d’Armor" data-numerodepartement="22" class="region-53 departement departement-22 departement-cotes-darmor" d="m208.7,188.9l-4.9,7.1l-2.9,1.1l-1.5-2.7 l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9l-12.9-6.5l-7.9,3l-12.46-3.29l2.06-4.11l-2.5-9.3l2.5-8.3l-3.6-4.7l1.1-4.3l1.2,1.4l3.2-0.4 l1.1-7.7l1.5-1.6l2.2-0.6l1.9,1.4h2.5l2.1-1l2.2,0.3l1.5-1.8l0.9,2L170,153l3-3.6l2.9-0.8l-0.1,2.3l-1.2,4.4l1.7-3.1l2.6-0.5l-1.1,2 l7.2,7.8l2.2,5.4l3,2l0.8,3.7l0.7-2.2l3-1l2.4-2.7l8.1-3.3l2.7-0.2l-2,2.5l2.9-1.1l1.8,4.4l1.3-1.9l2.5,0.2v-0.09l1.6,3.99h-0.3h0.3 l2.5,0.3l0.7,0.2l0.4,1.7l-1.9,13L208.7,188.9z">
                            </path> @endif
                            @if ($departement[20]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Côtes-d’Armor" data-nom="Côtes-d’Armor" data-numerodepartement="22" class="region-53 departement departement-22 departement-cotes-darmor" d="m208.7,188.9l-4.9,7.1l-2.9,1.1l-1.5-2.7 l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9l-12.9-6.5l-7.9,3l-12.46-3.29l2.06-4.11l-2.5-9.3l2.5-8.3l-3.6-4.7l1.1-4.3l1.2,1.4l3.2-0.4 l1.1-7.7l1.5-1.6l2.2-0.6l1.9,1.4h2.5l2.1-1l2.2,0.3l1.5-1.8l0.9,2L170,153l3-3.6l2.9-0.8l-0.1,2.3l-1.2,4.4l1.7-3.1l2.6-0.5l-1.1,2 l7.2,7.8l2.2,5.4l3,2l0.8,3.7l0.7-2.2l3-1l2.4-2.7l8.1-3.3l2.7-0.2l-2,2.5l2.9-1.1l1.8,4.4l1.3-1.9l2.5,0.2v-0.09l1.6,3.99h-0.3h0.3 l2.5,0.3l0.7,0.2l0.4,1.7l-1.9,13L208.7,188.9z">
                            </path> @endif
                            @if ($departement[20]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Côtes-d’Armor" data-nom="Côtes-d’Armor" data-numerodepartement="22" class="region-53 departement departement-22 departement-cotes-darmor" d="m208.7,188.9l-4.9,7.1l-2.9,1.1l-1.5-2.7 l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9l-12.9-6.5l-7.9,3l-12.46-3.29l2.06-4.11l-2.5-9.3l2.5-8.3l-3.6-4.7l1.1-4.3l1.2,1.4l3.2-0.4 l1.1-7.7l1.5-1.6l2.2-0.6l1.9,1.4h2.5l2.1-1l2.2,0.3l1.5-1.8l0.9,2L170,153l3-3.6l2.9-0.8l-0.1,2.3l-1.2,4.4l1.7-3.1l2.6-0.5l-1.1,2 l7.2,7.8l2.2,5.4l3,2l0.8,3.7l0.7-2.2l3-1l2.4-2.7l8.1-3.3l2.7-0.2l-2,2.5l2.9-1.1l1.8,4.4l1.3-1.9l2.5,0.2v-0.09l1.6,3.99h-0.3h0.3 l2.5,0.3l0.7,0.2l0.4,1.7l-1.9,13L208.7,188.9z">
                            </path> @endif
                            @if ($departement[20]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Côtes-d’Armor" data-nom="Côtes-d’Armor" data-numerodepartement="22" class="region-53 departement departement-22 departement-cotes-darmor" d="m208.7,188.9l-4.9,7.1l-2.9,1.1l-1.5-2.7 l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9l-12.9-6.5l-7.9,3l-12.46-3.29l2.06-4.11l-2.5-9.3l2.5-8.3l-3.6-4.7l1.1-4.3l1.2,1.4l3.2-0.4 l1.1-7.7l1.5-1.6l2.2-0.6l1.9,1.4h2.5l2.1-1l2.2,0.3l1.5-1.8l0.9,2L170,153l3-3.6l2.9-0.8l-0.1,2.3l-1.2,4.4l1.7-3.1l2.6-0.5l-1.1,2 l7.2,7.8l2.2,5.4l3,2l0.8,3.7l0.7-2.2l3-1l2.4-2.7l8.1-3.3l2.7-0.2l-2,2.5l2.9-1.1l1.8,4.4l1.3-1.9l2.5,0.2v-0.09l1.6,3.99h-0.3h0.3 l2.5,0.3l0.7,0.2l0.4,1.7l-1.9,13L208.7,188.9z">
                            </path> @endif

                            @if ($departement[27]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Finistère" data-nom="Finistère" data-numerodepartement="29" class="region-53 departement departement-29 departement-finistere" d="m151.6,210.1l2,3.4l-0.8,1.4l-5.5-1.2l-1.2-1.9 l2.2-0.7l-3,0.8l-0.3-2.7v2.7l-2.5,0.7l-2.2-1l-4.2-6.1l-0.8,2.5l-2.3,0.2l-3.5-3.1l1.6-4.6l-2.4,4.3l1.3,1.9l-2.2,1l-1,2.8 l-5.9-0.2l-2.1-1.6l1.5-1.6l-1.5-5.5l-2.4-3.1l-2.8-1.8l1.6-1.7l-2.1,1.4l-7.5-2.2l2.2-1.3l12.5-1.8l1.8,1.8l2-1.3l0.7-2.5l-1.6-3.6 l-6.8-2.5l-1.5,2.6l-2.6-4.2l1.3-1.8l-0.3-2.2l1.7,2.3l4.9,1l4.6-0.8l2.1,3.1l5.4,1l-3.7-0.9l-2.8-2l2.2-0.5l-4.2-2l2-1.5l-2.6-0.2 l-2.7,0.8l-0.8-2.2l7.1-4.5l-4.4,2.2l-2.3,0.1l-7.5,2.9l-2.7-1.2l-2.7,1.2l-1.5-1.8l0.6-5.3l2.5-1.6l-2.2-0.9l0.8-2.6l1.8-1.6 l2.1-0.8l5.1,1.5l-1.9-1.1l2.5-1.2l1.6,1.4l-1.9-1.7l1.2-1.9l2.9-0.1l3.8-2l2.3,2.6l6.7-3.1l3,1.6l1-2.2l2.9-0.5l0.4,5l2.2-1.5 l1.3,2.5l1.2-4.5l4.7,0.3l1.2,1.7l-1.1,4.3l3.6,4.7l-2.5,8.3l2.5,9.3l-2.06,4.11l-0.04-0.01v0.1l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3 l0.1,5.4l-2.5,2.8L151.6,210.1z">
                                </path>
                                @endif
                                @if ($departement[27]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Finistère" data-nom="Finistère" data-numerodepartement="29" class="region-53 departement departement-29 departement-finistere" d="m151.6,210.1l2,3.4l-0.8,1.4l-5.5-1.2l-1.2-1.9 l2.2-0.7l-3,0.8l-0.3-2.7v2.7l-2.5,0.7l-2.2-1l-4.2-6.1l-0.8,2.5l-2.3,0.2l-3.5-3.1l1.6-4.6l-2.4,4.3l1.3,1.9l-2.2,1l-1,2.8 l-5.9-0.2l-2.1-1.6l1.5-1.6l-1.5-5.5l-2.4-3.1l-2.8-1.8l1.6-1.7l-2.1,1.4l-7.5-2.2l2.2-1.3l12.5-1.8l1.8,1.8l2-1.3l0.7-2.5l-1.6-3.6 l-6.8-2.5l-1.5,2.6l-2.6-4.2l1.3-1.8l-0.3-2.2l1.7,2.3l4.9,1l4.6-0.8l2.1,3.1l5.4,1l-3.7-0.9l-2.8-2l2.2-0.5l-4.2-2l2-1.5l-2.6-0.2 l-2.7,0.8l-0.8-2.2l7.1-4.5l-4.4,2.2l-2.3,0.1l-7.5,2.9l-2.7-1.2l-2.7,1.2l-1.5-1.8l0.6-5.3l2.5-1.6l-2.2-0.9l0.8-2.6l1.8-1.6 l2.1-0.8l5.1,1.5l-1.9-1.1l2.5-1.2l1.6,1.4l-1.9-1.7l1.2-1.9l2.9-0.1l3.8-2l2.3,2.6l6.7-3.1l3,1.6l1-2.2l2.9-0.5l0.4,5l2.2-1.5 l1.3,2.5l1.2-4.5l4.7,0.3l1.2,1.7l-1.1,4.3l3.6,4.7l-2.5,8.3l2.5,9.3l-2.06,4.11l-0.04-0.01v0.1l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3 l0.1,5.4l-2.5,2.8L151.6,210.1z">
                                </path> @endif
                                @if ($departement[27]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Finistère" data-nom="Finistère" data-numerodepartement="29" class="region-53 departement departement-29 departement-finistere" d="m151.6,210.1l2,3.4l-0.8,1.4l-5.5-1.2l-1.2-1.9 l2.2-0.7l-3,0.8l-0.3-2.7v2.7l-2.5,0.7l-2.2-1l-4.2-6.1l-0.8,2.5l-2.3,0.2l-3.5-3.1l1.6-4.6l-2.4,4.3l1.3,1.9l-2.2,1l-1,2.8 l-5.9-0.2l-2.1-1.6l1.5-1.6l-1.5-5.5l-2.4-3.1l-2.8-1.8l1.6-1.7l-2.1,1.4l-7.5-2.2l2.2-1.3l12.5-1.8l1.8,1.8l2-1.3l0.7-2.5l-1.6-3.6 l-6.8-2.5l-1.5,2.6l-2.6-4.2l1.3-1.8l-0.3-2.2l1.7,2.3l4.9,1l4.6-0.8l2.1,3.1l5.4,1l-3.7-0.9l-2.8-2l2.2-0.5l-4.2-2l2-1.5l-2.6-0.2 l-2.7,0.8l-0.8-2.2l7.1-4.5l-4.4,2.2l-2.3,0.1l-7.5,2.9l-2.7-1.2l-2.7,1.2l-1.5-1.8l0.6-5.3l2.5-1.6l-2.2-0.9l0.8-2.6l1.8-1.6 l2.1-0.8l5.1,1.5l-1.9-1.1l2.5-1.2l1.6,1.4l-1.9-1.7l1.2-1.9l2.9-0.1l3.8-2l2.3,2.6l6.7-3.1l3,1.6l1-2.2l2.9-0.5l0.4,5l2.2-1.5 l1.3,2.5l1.2-4.5l4.7,0.3l1.2,1.7l-1.1,4.3l3.6,4.7l-2.5,8.3l2.5,9.3l-2.06,4.11l-0.04-0.01v0.1l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3 l0.1,5.4l-2.5,2.8L151.6,210.1z">
                                </path> @endif
                                @if ($departement[27]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Finistère" data-nom="Finistère" data-numerodepartement="29" class="region-53 departement departement-29 departement-finistere" d="m151.6,210.1l2,3.4l-0.8,1.4l-5.5-1.2l-1.2-1.9 l2.2-0.7l-3,0.8l-0.3-2.7v2.7l-2.5,0.7l-2.2-1l-4.2-6.1l-0.8,2.5l-2.3,0.2l-3.5-3.1l1.6-4.6l-2.4,4.3l1.3,1.9l-2.2,1l-1,2.8 l-5.9-0.2l-2.1-1.6l1.5-1.6l-1.5-5.5l-2.4-3.1l-2.8-1.8l1.6-1.7l-2.1,1.4l-7.5-2.2l2.2-1.3l12.5-1.8l1.8,1.8l2-1.3l0.7-2.5l-1.6-3.6 l-6.8-2.5l-1.5,2.6l-2.6-4.2l1.3-1.8l-0.3-2.2l1.7,2.3l4.9,1l4.6-0.8l2.1,3.1l5.4,1l-3.7-0.9l-2.8-2l2.2-0.5l-4.2-2l2-1.5l-2.6-0.2 l-2.7,0.8l-0.8-2.2l7.1-4.5l-4.4,2.2l-2.3,0.1l-7.5,2.9l-2.7-1.2l-2.7,1.2l-1.5-1.8l0.6-5.3l2.5-1.6l-2.2-0.9l0.8-2.6l1.8-1.6 l2.1-0.8l5.1,1.5l-1.9-1.1l2.5-1.2l1.6,1.4l-1.9-1.7l1.2-1.9l2.9-0.1l3.8-2l2.3,2.6l6.7-3.1l3,1.6l1-2.2l2.9-0.5l0.4,5l2.2-1.5 l1.3,2.5l1.2-4.5l4.7,0.3l1.2,1.7l-1.1,4.3l3.6,4.7l-2.5,8.3l2.5,9.3l-2.06,4.11l-0.04-0.01v0.1l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3 l0.1,5.4l-2.5,2.8L151.6,210.1z">
                                </path> @endif
                                @if ($departement[27]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Finistère" data-nom="Finistère" data-numerodepartement="29" class="region-53 departement departement-29 departement-finistere" d="m151.6,210.1l2,3.4l-0.8,1.4l-5.5-1.2l-1.2-1.9 l2.2-0.7l-3,0.8l-0.3-2.7v2.7l-2.5,0.7l-2.2-1l-4.2-6.1l-0.8,2.5l-2.3,0.2l-3.5-3.1l1.6-4.6l-2.4,4.3l1.3,1.9l-2.2,1l-1,2.8 l-5.9-0.2l-2.1-1.6l1.5-1.6l-1.5-5.5l-2.4-3.1l-2.8-1.8l1.6-1.7l-2.1,1.4l-7.5-2.2l2.2-1.3l12.5-1.8l1.8,1.8l2-1.3l0.7-2.5l-1.6-3.6 l-6.8-2.5l-1.5,2.6l-2.6-4.2l1.3-1.8l-0.3-2.2l1.7,2.3l4.9,1l4.6-0.8l2.1,3.1l5.4,1l-3.7-0.9l-2.8-2l2.2-0.5l-4.2-2l2-1.5l-2.6-0.2 l-2.7,0.8l-0.8-2.2l7.1-4.5l-4.4,2.2l-2.3,0.1l-7.5,2.9l-2.7-1.2l-2.7,1.2l-1.5-1.8l0.6-5.3l2.5-1.6l-2.2-0.9l0.8-2.6l1.8-1.6 l2.1-0.8l5.1,1.5l-1.9-1.1l2.5-1.2l1.6,1.4l-1.9-1.7l1.2-1.9l2.9-0.1l3.8-2l2.3,2.6l6.7-3.1l3,1.6l1-2.2l2.9-0.5l0.4,5l2.2-1.5 l1.3,2.5l1.2-4.5l4.7,0.3l1.2,1.7l-1.1,4.3l3.6,4.7l-2.5,8.3l2.5,9.3l-2.06,4.11l-0.04-0.01v0.1l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3 l0.1,5.4l-2.5,2.8L151.6,210.1z">
                                </path> @endif

                                @if ($departement[35]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Ille-et-Vilaine" data-nom="Ille-et-Vilaine" data-numerodepartement="35" class="region-53 departement departement-35 departement-ille-et-vilaine" d="m255.2,207.2l-5.5,2.2l-3.6,8.6l-0.4,2.2 l-6.8-3.6l-9,3.9l-1.6,2.9l-13.2,0.4l-5.2,3.4l-1-5.8l3-0.7l-2.8-1.5l2.4-2.2l1-3.2l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8 l3.5-0.9l-3.6-0.1l-1-4.4l4.9-7.1l9-2.5l1.9-13l-0.4-1.7l-0.7-0.2l-2.5-0.3l-1.6-3.99l0.05-0.86l0.05-0.85l0.7-0.1h2.1v0.1l1.7,4.4 l1.3,2l-0.5,2.1l1.4-2.1l-2.3-5.1l0.7-2.5l2.2-1.5l2.3-0.6l2.2,1l-1.5,2.3l2.9,2.4l7.3-0.6l4.7,9.6l2.7,1l7.1-4.8l5.4,2.3l-0.1,12.1 l-1.5,2.4L255.2,207.2z">
                                    </path>
                                    @endif
                                    @if ($departement[35]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Ille-et-Vilaine" data-nom="Ille-et-Vilaine" data-numerodepartement="35" class="region-53 departement departement-35 departement-ille-et-vilaine" d="m255.2,207.2l-5.5,2.2l-3.6,8.6l-0.4,2.2 l-6.8-3.6l-9,3.9l-1.6,2.9l-13.2,0.4l-5.2,3.4l-1-5.8l3-0.7l-2.8-1.5l2.4-2.2l1-3.2l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8 l3.5-0.9l-3.6-0.1l-1-4.4l4.9-7.1l9-2.5l1.9-13l-0.4-1.7l-0.7-0.2l-2.5-0.3l-1.6-3.99l0.05-0.86l0.05-0.85l0.7-0.1h2.1v0.1l1.7,4.4 l1.3,2l-0.5,2.1l1.4-2.1l-2.3-5.1l0.7-2.5l2.2-1.5l2.3-0.6l2.2,1l-1.5,2.3l2.9,2.4l7.3-0.6l4.7,9.6l2.7,1l7.1-4.8l5.4,2.3l-0.1,12.1 l-1.5,2.4L255.2,207.2z">
                                    </path> @endif
                                    @if ($departement[35]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Ille-et-Vilaine" data-nom="Ille-et-Vilaine" data-numerodepartement="35" class="region-53 departement departement-35 departement-ille-et-vilaine" d="m255.2,207.2l-5.5,2.2l-3.6,8.6l-0.4,2.2 l-6.8-3.6l-9,3.9l-1.6,2.9l-13.2,0.4l-5.2,3.4l-1-5.8l3-0.7l-2.8-1.5l2.4-2.2l1-3.2l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8 l3.5-0.9l-3.6-0.1l-1-4.4l4.9-7.1l9-2.5l1.9-13l-0.4-1.7l-0.7-0.2l-2.5-0.3l-1.6-3.99l0.05-0.86l0.05-0.85l0.7-0.1h2.1v0.1l1.7,4.4 l1.3,2l-0.5,2.1l1.4-2.1l-2.3-5.1l0.7-2.5l2.2-1.5l2.3-0.6l2.2,1l-1.5,2.3l2.9,2.4l7.3-0.6l4.7,9.6l2.7,1l7.1-4.8l5.4,2.3l-0.1,12.1 l-1.5,2.4L255.2,207.2z">
                                    </path> @endif
                                    @if ($departement[35]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Ille-et-Vilaine" data-nom="Ille-et-Vilaine" data-numerodepartement="35" class="region-53 departement departement-35 departement-ille-et-vilaine" d="m255.2,207.2l-5.5,2.2l-3.6,8.6l-0.4,2.2 l-6.8-3.6l-9,3.9l-1.6,2.9l-13.2,0.4l-5.2,3.4l-1-5.8l3-0.7l-2.8-1.5l2.4-2.2l1-3.2l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8 l3.5-0.9l-3.6-0.1l-1-4.4l4.9-7.1l9-2.5l1.9-13l-0.4-1.7l-0.7-0.2l-2.5-0.3l-1.6-3.99l0.05-0.86l0.05-0.85l0.7-0.1h2.1v0.1l1.7,4.4 l1.3,2l-0.5,2.1l1.4-2.1l-2.3-5.1l0.7-2.5l2.2-1.5l2.3-0.6l2.2,1l-1.5,2.3l2.9,2.4l7.3-0.6l4.7,9.6l2.7,1l7.1-4.8l5.4,2.3l-0.1,12.1 l-1.5,2.4L255.2,207.2z">
                                    </path> @endif
                                    @if ($departement[35]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Ille-et-Vilaine" data-nom="Ille-et-Vilaine" data-numerodepartement="35" class="region-53 departement departement-35 departement-ille-et-vilaine" d="m255.2,207.2l-5.5,2.2l-3.6,8.6l-0.4,2.2 l-6.8-3.6l-9,3.9l-1.6,2.9l-13.2,0.4l-5.2,3.4l-1-5.8l3-0.7l-2.8-1.5l2.4-2.2l1-3.2l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8 l3.5-0.9l-3.6-0.1l-1-4.4l4.9-7.1l9-2.5l1.9-13l-0.4-1.7l-0.7-0.2l-2.5-0.3l-1.6-3.99l0.05-0.86l0.05-0.85l0.7-0.1h2.1v0.1l1.7,4.4 l1.3,2l-0.5,2.1l1.4-2.1l-2.3-5.1l0.7-2.5l2.2-1.5l2.3-0.6l2.2,1l-1.5,2.3l2.9,2.4l7.3-0.6l4.7,9.6l2.7,1l7.1-4.8l5.4,2.3l-0.1,12.1 l-1.5,2.4L255.2,207.2z">
                                    </path> @endif

                                    @if ($departement[56]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Morbihan" data-nom="Morbihan" data-numerodepartement="56" class="region-53 departement departement-56 departement-morbihan" d="M167.7,242.6l2.9,1.2l-1.1,2.1l-5.1-1.2l-1.3-2.7l0.4-3l2.1,1.4L167.7,242.6z M209.1,219.2l2.4-2.2l1-3.2 l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8l3.5-0.9l-3.6-0.1l-1-4.4l-2.9,1.1l-1.5-2.7l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9 l-12.9-6.5l-7.9,3l-12.46-3.29l-0.04,0.09l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3l0.1,5.4l-2.5,2.8l-2.8-0.8l2,3.4l0.1,1.5l2.9,4.4 l2.3-0.2l1.5-1.7l-0.8-5.1l0.6,2.4l1.7,1.7l1.9-1.7l-2.5,4.2l2.2,1.4l-2.3-0.6l3.2,1.9l0.1,0.1l1.6,1l1.7-2.5l-1.6,3.1l2.1,2.6 l0.6,3.5l-0.9,2.8l2.1,1.1l-1.2-3l0.5-3.8l2.2,1.6l5.1,0.1l-0.7-5l1.4,2l2.1,1.5l4.8-0.5l2.1,2.4l-1,2.2l-2.1-0.6l-4.8,0.4l3.8,3.3 l12.9-0.9l3.1,1.5l-3.4,0.1l1.42,2.39l13.18-3.89l0.4-6l-1-5.8l3-0.7L209.1,219.2z">
                                        </path>
                                        @endif
                                        @if ($departement[56]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Morbihan" data-nom="Morbihan" data-numerodepartement="56" class="region-53 departement departement-56 departement-morbihan" d="M167.7,242.6l2.9,1.2l-1.1,2.1l-5.1-1.2l-1.3-2.7l0.4-3l2.1,1.4L167.7,242.6z M209.1,219.2l2.4-2.2l1-3.2 l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8l3.5-0.9l-3.6-0.1l-1-4.4l-2.9,1.1l-1.5-2.7l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9 l-12.9-6.5l-7.9,3l-12.46-3.29l-0.04,0.09l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3l0.1,5.4l-2.5,2.8l-2.8-0.8l2,3.4l0.1,1.5l2.9,4.4 l2.3-0.2l1.5-1.7l-0.8-5.1l0.6,2.4l1.7,1.7l1.9-1.7l-2.5,4.2l2.2,1.4l-2.3-0.6l3.2,1.9l0.1,0.1l1.6,1l1.7-2.5l-1.6,3.1l2.1,2.6 l0.6,3.5l-0.9,2.8l2.1,1.1l-1.2-3l0.5-3.8l2.2,1.6l5.1,0.1l-0.7-5l1.4,2l2.1,1.5l4.8-0.5l2.1,2.4l-1,2.2l-2.1-0.6l-4.8,0.4l3.8,3.3 l12.9-0.9l3.1,1.5l-3.4,0.1l1.42,2.39l13.18-3.89l0.4-6l-1-5.8l3-0.7L209.1,219.2z">
                                        </path> @endif
                                        @if ($departement[56]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Morbihan" data-nom="Morbihan" data-numerodepartement="56" class="region-53 departement departement-56 departement-morbihan" d="M167.7,242.6l2.9,1.2l-1.1,2.1l-5.1-1.2l-1.3-2.7l0.4-3l2.1,1.4L167.7,242.6z M209.1,219.2l2.4-2.2l1-3.2 l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8l3.5-0.9l-3.6-0.1l-1-4.4l-2.9,1.1l-1.5-2.7l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9 l-12.9-6.5l-7.9,3l-12.46-3.29l-0.04,0.09l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3l0.1,5.4l-2.5,2.8l-2.8-0.8l2,3.4l0.1,1.5l2.9,4.4 l2.3-0.2l1.5-1.7l-0.8-5.1l0.6,2.4l1.7,1.7l1.9-1.7l-2.5,4.2l2.2,1.4l-2.3-0.6l3.2,1.9l0.1,0.1l1.6,1l1.7-2.5l-1.6,3.1l2.1,2.6 l0.6,3.5l-0.9,2.8l2.1,1.1l-1.2-3l0.5-3.8l2.2,1.6l5.1,0.1l-0.7-5l1.4,2l2.1,1.5l4.8-0.5l2.1,2.4l-1,2.2l-2.1-0.6l-4.8,0.4l3.8,3.3 l12.9-0.9l3.1,1.5l-3.4,0.1l1.42,2.39l13.18-3.89l0.4-6l-1-5.8l3-0.7L209.1,219.2z">
                                        </path> @endif
                                        @if ($departement[56]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Morbihan" data-nom="Morbihan" data-numerodepartement="56" class="region-53 departement departement-56 departement-morbihan" d="M167.7,242.6l2.9,1.2l-1.1,2.1l-5.1-1.2l-1.3-2.7l0.4-3l2.1,1.4L167.7,242.6z M209.1,219.2l2.4-2.2l1-3.2 l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8l3.5-0.9l-3.6-0.1l-1-4.4l-2.9,1.1l-1.5-2.7l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9 l-12.9-6.5l-7.9,3l-12.46-3.29l-0.04,0.09l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3l0.1,5.4l-2.5,2.8l-2.8-0.8l2,3.4l0.1,1.5l2.9,4.4 l2.3-0.2l1.5-1.7l-0.8-5.1l0.6,2.4l1.7,1.7l1.9-1.7l-2.5,4.2l2.2,1.4l-2.3-0.6l3.2,1.9l0.1,0.1l1.6,1l1.7-2.5l-1.6,3.1l2.1,2.6 l0.6,3.5l-0.9,2.8l2.1,1.1l-1.2-3l0.5-3.8l2.2,1.6l5.1,0.1l-0.7-5l1.4,2l2.1,1.5l4.8-0.5l2.1,2.4l-1,2.2l-2.1-0.6l-4.8,0.4l3.8,3.3 l12.9-0.9l3.1,1.5l-3.4,0.1l1.42,2.39l13.18-3.89l0.4-6l-1-5.8l3-0.7L209.1,219.2z">
                                        </path> @endif
                                        @if ($departement[56]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Morbihan" data-nom="Morbihan" data-numerodepartement="56" class="region-53 departement departement-56 departement-morbihan" d="M167.7,242.6l2.9,1.2l-1.1,2.1l-5.1-1.2l-1.3-2.7l0.4-3l2.1,1.4L167.7,242.6z M209.1,219.2l2.4-2.2l1-3.2 l-2.4-1.7l1.6-2.6l-1.2-2.5l-5.1-2.8l-0.5-2.8l3.5-0.9l-3.6-0.1l-1-4.4l-2.9,1.1l-1.5-2.7l-3.5-0.9l-6.2,7.5l-1.8-6l-3,0.9 l-12.9-6.5l-7.9,3l-12.46-3.29l-0.04,0.09l-6.8,3.2l0.5,3.5l3.4,5.5l8.1,1.3l0.1,5.4l-2.5,2.8l-2.8-0.8l2,3.4l0.1,1.5l2.9,4.4 l2.3-0.2l1.5-1.7l-0.8-5.1l0.6,2.4l1.7,1.7l1.9-1.7l-2.5,4.2l2.2,1.4l-2.3-0.6l3.2,1.9l0.1,0.1l1.6,1l1.7-2.5l-1.6,3.1l2.1,2.6 l0.6,3.5l-0.9,2.8l2.1,1.1l-1.2-3l0.5-3.8l2.2,1.6l5.1,0.1l-0.7-5l1.4,2l2.1,1.5l4.8-0.5l2.1,2.4l-1,2.2l-2.1-0.6l-4.8,0.4l3.8,3.3 l12.9-0.9l3.1,1.5l-3.4,0.1l1.42,2.39l13.18-3.89l0.4-6l-1-5.8l3-0.7L209.1,219.2z">
                                        </path> @endif
                    </g>

                    <g data-nom="Nouvelle-Aquitaine">

                        @if ($departement[16]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Charente" data-nom="Charente" data-numerodepartement="16" class="region-75 departement departement-16 departement-charente" d="m294.8,379.2l-2,2v-0.1l-6.3-6.3l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6 l1.7-2.6l-2.4-1.7l-0.3-3l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l2.7-1.6l0.3-3l5.8-2.5l3.5,0.4l0.8-0.8h0.1l9.1,3 l2.9-0.8l-1.4-2.4l2.2-1.8l4.1,3.9l3.8-1.4l1.3-2.5l4.8,0.6l-0.2,5.1l4.7,3.6l-0.6,3.2l-2.6,1.1l-4,8l-2.8,0.6l-3.4,3.8h0.1 l-5.7,6.1l-2.1,5.3l-7.9,5.9l-0.7,5.7l-4.1,5.8L294.8,379.2z">
                            </path>
                            @endif
                            @if ($departement[16]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Charente" data-nom="Charente" data-numerodepartement="16" class="region-75 departement departement-16 departement-charente" d="m294.8,379.2l-2,2v-0.1l-6.3-6.3l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6 l1.7-2.6l-2.4-1.7l-0.3-3l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l2.7-1.6l0.3-3l5.8-2.5l3.5,0.4l0.8-0.8h0.1l9.1,3 l2.9-0.8l-1.4-2.4l2.2-1.8l4.1,3.9l3.8-1.4l1.3-2.5l4.8,0.6l-0.2,5.1l4.7,3.6l-0.6,3.2l-2.6,1.1l-4,8l-2.8,0.6l-3.4,3.8h0.1 l-5.7,6.1l-2.1,5.3l-7.9,5.9l-0.7,5.7l-4.1,5.8L294.8,379.2z">
                            </path> @endif
                            @if ($departement[16]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Charente" data-nom="Charente" data-numerodepartement="16" class="region-75 departement departement-16 departement-charente" d="m294.8,379.2l-2,2v-0.1l-6.3-6.3l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6 l1.7-2.6l-2.4-1.7l-0.3-3l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l2.7-1.6l0.3-3l5.8-2.5l3.5,0.4l0.8-0.8h0.1l9.1,3 l2.9-0.8l-1.4-2.4l2.2-1.8l4.1,3.9l3.8-1.4l1.3-2.5l4.8,0.6l-0.2,5.1l4.7,3.6l-0.6,3.2l-2.6,1.1l-4,8l-2.8,0.6l-3.4,3.8h0.1 l-5.7,6.1l-2.1,5.3l-7.9,5.9l-0.7,5.7l-4.1,5.8L294.8,379.2z">
                            </path> @endif
                            @if ($departement[16]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Charente" data-nom="Charente" data-numerodepartement="16" class="region-75 departement departement-16 departement-charente" d="m294.8,379.2l-2,2v-0.1l-6.3-6.3l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6 l1.7-2.6l-2.4-1.7l-0.3-3l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l2.7-1.6l0.3-3l5.8-2.5l3.5,0.4l0.8-0.8h0.1l9.1,3 l2.9-0.8l-1.4-2.4l2.2-1.8l4.1,3.9l3.8-1.4l1.3-2.5l4.8,0.6l-0.2,5.1l4.7,3.6l-0.6,3.2l-2.6,1.1l-4,8l-2.8,0.6l-3.4,3.8h0.1 l-5.7,6.1l-2.1,5.3l-7.9,5.9l-0.7,5.7l-4.1,5.8L294.8,379.2z">
                            </path> @endif
                            @if ($departement[16]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Charente" data-nom="Charente" data-numerodepartement="16" class="region-75 departement departement-16 departement-charente" d="m294.8,379.2l-2,2v-0.1l-6.3-6.3l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6 l1.7-2.6l-2.4-1.7l-0.3-3l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l2.7-1.6l0.3-3l5.8-2.5l3.5,0.4l0.8-0.8h0.1l9.1,3 l2.9-0.8l-1.4-2.4l2.2-1.8l4.1,3.9l3.8-1.4l1.3-2.5l4.8,0.6l-0.2,5.1l4.7,3.6l-0.6,3.2l-2.6,1.1l-4,8l-2.8,0.6l-3.4,3.8h0.1 l-5.7,6.1l-2.1,5.3l-7.9,5.9l-0.7,5.7l-4.1,5.8L294.8,379.2z">
                            </path> @endif


                            @if ($departement[17]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Charente-Maritime" data-nom="Charente-Maritime" data-numerodepartement="17" class="region-75 departement departement-17 departement-charente-maritime" d="M242.8,341.1l-1.4-5l-3.5-3l-1.3-2.3l1.5-3.6l1.7,1.8l2.9,0.5l1.4,8.4L242.8,341.1z M241.9,318.9l-5.8-4.5 l-4.4-1.5l-0.6,2.9l2.7,0.1l4.8,3.3L241.9,318.9z M286.5,374.8l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6l1.7-2.6l-2.4-1.7l-0.3-3 l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l-3.6-4.7l-17.4-6.7l-5.9-6.5v-3.7l-2.4-1.8l-6.5,0.3l1.4-2.9l-7.1,2.7 l0.5,0.1l-0.6,3.4l-4.5,5.9l2.4,0.3l2.2,1.7l3,7.2l-1.5,1.9l-0.2,5.1l-3.3,3.1l-0.1,2.6l-2.2,0.4l-1.5,1.7l1.1,4.3l9,6.5l1.5,2.6 l4.3,2.7l3.7,4.8l1.81,7.3l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l2-5l0.1-0.4v-0.1L286.5,374.8z">
                                </path>
                                @endif
                                @if ($departement[17]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Charente-Maritime" data-nom="Charente-Maritime" data-numerodepartement="17" class="region-75 departement departement-17 departement-charente-maritime" d="M242.8,341.1l-1.4-5l-3.5-3l-1.3-2.3l1.5-3.6l1.7,1.8l2.9,0.5l1.4,8.4L242.8,341.1z M241.9,318.9l-5.8-4.5 l-4.4-1.5l-0.6,2.9l2.7,0.1l4.8,3.3L241.9,318.9z M286.5,374.8l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6l1.7-2.6l-2.4-1.7l-0.3-3 l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l-3.6-4.7l-17.4-6.7l-5.9-6.5v-3.7l-2.4-1.8l-6.5,0.3l1.4-2.9l-7.1,2.7 l0.5,0.1l-0.6,3.4l-4.5,5.9l2.4,0.3l2.2,1.7l3,7.2l-1.5,1.9l-0.2,5.1l-3.3,3.1l-0.1,2.6l-2.2,0.4l-1.5,1.7l1.1,4.3l9,6.5l1.5,2.6 l4.3,2.7l3.7,4.8l1.81,7.3l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l2-5l0.1-0.4v-0.1L286.5,374.8z">
                                </path> @endif
                                @if ($departement[17]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Charente-Maritime" data-nom="Charente-Maritime" data-numerodepartement="17" class="region-75 departement departement-17 departement-charente-maritime" d="M242.8,341.1l-1.4-5l-3.5-3l-1.3-2.3l1.5-3.6l1.7,1.8l2.9,0.5l1.4,8.4L242.8,341.1z M241.9,318.9l-5.8-4.5 l-4.4-1.5l-0.6,2.9l2.7,0.1l4.8,3.3L241.9,318.9z M286.5,374.8l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6l1.7-2.6l-2.4-1.7l-0.3-3 l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l-3.6-4.7l-17.4-6.7l-5.9-6.5v-3.7l-2.4-1.8l-6.5,0.3l1.4-2.9l-7.1,2.7 l0.5,0.1l-0.6,3.4l-4.5,5.9l2.4,0.3l2.2,1.7l3,7.2l-1.5,1.9l-0.2,5.1l-3.3,3.1l-0.1,2.6l-2.2,0.4l-1.5,1.7l1.1,4.3l9,6.5l1.5,2.6 l4.3,2.7l3.7,4.8l1.81,7.3l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l2-5l0.1-0.4v-0.1L286.5,374.8z">
                                </path> @endif
                                @if ($departement[17]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Charente-Maritime" data-nom="Charente-Maritime" data-numerodepartement="17" class="region-75 departement departement-17 departement-charente-maritime" d="M242.8,341.1l-1.4-5l-3.5-3l-1.3-2.3l1.5-3.6l1.7,1.8l2.9,0.5l1.4,8.4L242.8,341.1z M241.9,318.9l-5.8-4.5 l-4.4-1.5l-0.6,2.9l2.7,0.1l4.8,3.3L241.9,318.9z M286.5,374.8l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6l1.7-2.6l-2.4-1.7l-0.3-3 l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l-3.6-4.7l-17.4-6.7l-5.9-6.5v-3.7l-2.4-1.8l-6.5,0.3l1.4-2.9l-7.1,2.7 l0.5,0.1l-0.6,3.4l-4.5,5.9l2.4,0.3l2.2,1.7l3,7.2l-1.5,1.9l-0.2,5.1l-3.3,3.1l-0.1,2.6l-2.2,0.4l-1.5,1.7l1.1,4.3l9,6.5l1.5,2.6 l4.3,2.7l3.7,4.8l1.81,7.3l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l2-5l0.1-0.4v-0.1L286.5,374.8z">
                                </path> @endif
                                @if ($departement[17]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Charente-Maritime" data-nom="Charente-Maritime" data-numerodepartement="17" class="region-75 departement departement-17 departement-charente-maritime" d="M242.8,341.1l-1.4-5l-3.5-3l-1.3-2.3l1.5-3.6l1.7,1.8l2.9,0.5l1.4,8.4L242.8,341.1z M241.9,318.9l-5.8-4.5 l-4.4-1.5l-0.6,2.9l2.7,0.1l4.8,3.3L241.9,318.9z M286.5,374.8l-6-1.2l1.7-3l-2.3-2l2.4-1.7l-1.5-2.6l1.7-2.6l-2.4-1.7l-0.3-3 l-5-3.1l2.2-2.1l-3.2-5.6l8.1-3.3l2.3,2l2.7-0.1l2.7-11.6l-3.6-4.7l-17.4-6.7l-5.9-6.5v-3.7l-2.4-1.8l-6.5,0.3l1.4-2.9l-7.1,2.7 l0.5,0.1l-0.6,3.4l-4.5,5.9l2.4,0.3l2.2,1.7l3,7.2l-1.5,1.9l-0.2,5.1l-3.3,3.1l-0.1,2.6l-2.2,0.4l-1.5,1.7l1.1,4.3l9,6.5l1.5,2.6 l4.3,2.7l3.7,4.8l1.81,7.3l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l2-5l0.1-0.4v-0.1L286.5,374.8z">
                                </path> @endif


                                @if ($departement[19]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Corrèze" data-nom="Corrèze" data-numerodepartement="19" class="region-75 departement departement-19 departement-correze" d="m363.6,392.3l-8.1,0.8l-3.5-7l-3.2-0.7l-0.2-3 l-2.3-1.5l2-1.8l-1.7-3l3.6-4.6l-2.9-4.7l1.6-2.7l2.5,1.2l4.7-4l5.7-1.3l4.9-4.6l8.7-4l7-3.4l11.2,5.2l2.3-2.6l2.7,0.8l2.4-2.4 l1.2,5.6l-1.7,2.4l1.2,7.9l0.7,6l-6.2-2l-0.6,3.5l-7.6,9.5l1.8,2.2l-2.3,1.9l-0.3,3.5l-3.1,1.1l1.5,3.4l-3.2,1.9h-0.1l-6.7-0.2 l-5.3,2.7L363.6,392.3z">
                                    </path>
                                    @endif
                                    @if ($departement[19]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Corrèze" data-nom="Corrèze" data-numerodepartement="19" class="region-75 departement departement-19 departement-correze" d="m363.6,392.3l-8.1,0.8l-3.5-7l-3.2-0.7l-0.2-3 l-2.3-1.5l2-1.8l-1.7-3l3.6-4.6l-2.9-4.7l1.6-2.7l2.5,1.2l4.7-4l5.7-1.3l4.9-4.6l8.7-4l7-3.4l11.2,5.2l2.3-2.6l2.7,0.8l2.4-2.4 l1.2,5.6l-1.7,2.4l1.2,7.9l0.7,6l-6.2-2l-0.6,3.5l-7.6,9.5l1.8,2.2l-2.3,1.9l-0.3,3.5l-3.1,1.1l1.5,3.4l-3.2,1.9h-0.1l-6.7-0.2 l-5.3,2.7L363.6,392.3z">
                                    </path> @endif
                                    @if ($departement[19]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Corrèze" data-nom="Corrèze" data-numerodepartement="19" class="region-75 departement departement-19 departement-correze" d="m363.6,392.3l-8.1,0.8l-3.5-7l-3.2-0.7l-0.2-3 l-2.3-1.5l2-1.8l-1.7-3l3.6-4.6l-2.9-4.7l1.6-2.7l2.5,1.2l4.7-4l5.7-1.3l4.9-4.6l8.7-4l7-3.4l11.2,5.2l2.3-2.6l2.7,0.8l2.4-2.4 l1.2,5.6l-1.7,2.4l1.2,7.9l0.7,6l-6.2-2l-0.6,3.5l-7.6,9.5l1.8,2.2l-2.3,1.9l-0.3,3.5l-3.1,1.1l1.5,3.4l-3.2,1.9h-0.1l-6.7-0.2 l-5.3,2.7L363.6,392.3z">
                                    </path> @endif
                                    @if ($departement[19]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Corrèze" data-nom="Corrèze" data-numerodepartement="19" class="region-75 departement departement-19 departement-correze" d="m363.6,392.3l-8.1,0.8l-3.5-7l-3.2-0.7l-0.2-3 l-2.3-1.5l2-1.8l-1.7-3l3.6-4.6l-2.9-4.7l1.6-2.7l2.5,1.2l4.7-4l5.7-1.3l4.9-4.6l8.7-4l7-3.4l11.2,5.2l2.3-2.6l2.7,0.8l2.4-2.4 l1.2,5.6l-1.7,2.4l1.2,7.9l0.7,6l-6.2-2l-0.6,3.5l-7.6,9.5l1.8,2.2l-2.3,1.9l-0.3,3.5l-3.1,1.1l1.5,3.4l-3.2,1.9h-0.1l-6.7-0.2 l-5.3,2.7L363.6,392.3z">
                                    </path> @endif
                                    @if ($departement[19]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Corrèze" data-nom="Corrèze" data-numerodepartement="19" class="region-75 departement departement-19 departement-correze" d="m363.6,392.3l-8.1,0.8l-3.5-7l-3.2-0.7l-0.2-3 l-2.3-1.5l2-1.8l-1.7-3l3.6-4.6l-2.9-4.7l1.6-2.7l2.5,1.2l4.7-4l5.7-1.3l4.9-4.6l8.7-4l7-3.4l11.2,5.2l2.3-2.6l2.7,0.8l2.4-2.4 l1.2,5.6l-1.7,2.4l1.2,7.9l0.7,6l-6.2-2l-0.6,3.5l-7.6,9.5l1.8,2.2l-2.3,1.9l-0.3,3.5l-3.1,1.1l1.5,3.4l-3.2,1.9h-0.1l-6.7-0.2 l-5.3,2.7L363.6,392.3z">
                                    </path> @endif


                                    @if ($departement[23]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Creuse" data-nom="Creuse" data-numerodepartement="23" class="region-75 departement departement-23 departement-creuse" d="m396.6,343.5l4.4,5.5l-2.4,2.4l-2.7-0.8 l-2.3,2.6l-11.2-5.2l-7,3.4l-0.6-5.9l-4.7-3l-6.4-0.5l-0.1-2.8l-2.9-1.5l0.9-3.4l-1.8-5.2l-6.6-9.8l3-5.3l-1.2-2.6l2.8-2.9l11.5-1.1 l1.9-2.5l13.2,2.7l2.7-0.8l4.9,0.2l1.1,3.9c2.5,1.6,4.9,3.2,7.4,4.8l3.6,8.4l-0.5,4.1l2.3,6.7L396.6,343.5z">
                                        </path>
                                        @endif
                                        @if ($departement[23]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Creuse" data-nom="Creuse" data-numerodepartement="23" class="region-75 departement departement-23 departement-creuse" d="m396.6,343.5l4.4,5.5l-2.4,2.4l-2.7-0.8 l-2.3,2.6l-11.2-5.2l-7,3.4l-0.6-5.9l-4.7-3l-6.4-0.5l-0.1-2.8l-2.9-1.5l0.9-3.4l-1.8-5.2l-6.6-9.8l3-5.3l-1.2-2.6l2.8-2.9l11.5-1.1 l1.9-2.5l13.2,2.7l2.7-0.8l4.9,0.2l1.1,3.9c2.5,1.6,4.9,3.2,7.4,4.8l3.6,8.4l-0.5,4.1l2.3,6.7L396.6,343.5z">
                                        </path> @endif
                                        @if ($departement[23]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Creuse" data-nom="Creuse" data-numerodepartement="23" class="region-75 departement departement-23 departement-creuse" d="m396.6,343.5l4.4,5.5l-2.4,2.4l-2.7-0.8 l-2.3,2.6l-11.2-5.2l-7,3.4l-0.6-5.9l-4.7-3l-6.4-0.5l-0.1-2.8l-2.9-1.5l0.9-3.4l-1.8-5.2l-6.6-9.8l3-5.3l-1.2-2.6l2.8-2.9l11.5-1.1 l1.9-2.5l13.2,2.7l2.7-0.8l4.9,0.2l1.1,3.9c2.5,1.6,4.9,3.2,7.4,4.8l3.6,8.4l-0.5,4.1l2.3,6.7L396.6,343.5z">
                                        </path> @endif
                                        @if ($departement[23]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Creuse" data-nom="Creuse" data-numerodepartement="23" class="region-75 departement departement-23 departement-creuse" d="m396.6,343.5l4.4,5.5l-2.4,2.4l-2.7-0.8 l-2.3,2.6l-11.2-5.2l-7,3.4l-0.6-5.9l-4.7-3l-6.4-0.5l-0.1-2.8l-2.9-1.5l0.9-3.4l-1.8-5.2l-6.6-9.8l3-5.3l-1.2-2.6l2.8-2.9l11.5-1.1 l1.9-2.5l13.2,2.7l2.7-0.8l4.9,0.2l1.1,3.9c2.5,1.6,4.9,3.2,7.4,4.8l3.6,8.4l-0.5,4.1l2.3,6.7L396.6,343.5z">
                                        </path> @endif
                                        @if ($departement[23]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Creuse" data-nom="Creuse" data-numerodepartement="23" class="region-75 departement departement-23 departement-creuse" d="m396.6,343.5l4.4,5.5l-2.4,2.4l-2.7-0.8 l-2.3,2.6l-11.2-5.2l-7,3.4l-0.6-5.9l-4.7-3l-6.4-0.5l-0.1-2.8l-2.9-1.5l0.9-3.4l-1.8-5.2l-6.6-9.8l3-5.3l-1.2-2.6l2.8-2.9l11.5-1.1 l1.9-2.5l13.2,2.7l2.7-0.8l4.9,0.2l1.1,3.9c2.5,1.6,4.9,3.2,7.4,4.8l3.6,8.4l-0.5,4.1l2.3,6.7L396.6,343.5z">
                                        </path> @endif

                                        @if ($departement[24]->hospitalises
                                        <= 50)<path class="region" style="fill: green" id="Dordogne" data-nom="Dordogne" data-numerodepartement="24" class="region-75 departement departement-24 departement-dordogne" d="m307.7,414.3l-2.8-6.4l-1-1.3l0.9-2.9l-2.4-2.6l-2,3.2l-9.8-2.3l2-2 l0.2-5.7l2.8-5.5l-1.2-2.8l-3.7,0.6l2-5l0.1-0.4l2-2l5.5-0.7l4.1-5.8l0.7-5.7l7.9-5.9l2.1-5.3l5.7-6.1l6.2,3l-0.1,4.7l9.5-1.1 l7.2,5.6l-2,2.7l5.7,2.2l2.9,4.7l-3.6,4.6l1.7,3l-2,1.8l2.3,1.5l0.2,3l3.2,0.7l3.5,7l-0.7,5l-1.4,5.3l-4.5,3.2l0.6,3.6l-6,3.4 l-4.7,6.5l-4.2-4.2l-5.4,2.7l-1.5-6l-6.1,1l-2.2-1.8l-2.8,2L307.7,414.3z">
                                            </path>
                                            @endif
                                            @if ($departement[24]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Dordogne" data-nom="Dordogne" data-numerodepartement="24" class="region-75 departement departement-24 departement-dordogne" d="m307.7,414.3l-2.8-6.4l-1-1.3l0.9-2.9l-2.4-2.6l-2,3.2l-9.8-2.3l2-2 l0.2-5.7l2.8-5.5l-1.2-2.8l-3.7,0.6l2-5l0.1-0.4l2-2l5.5-0.7l4.1-5.8l0.7-5.7l7.9-5.9l2.1-5.3l5.7-6.1l6.2,3l-0.1,4.7l9.5-1.1 l7.2,5.6l-2,2.7l5.7,2.2l2.9,4.7l-3.6,4.6l1.7,3l-2,1.8l2.3,1.5l0.2,3l3.2,0.7l3.5,7l-0.7,5l-1.4,5.3l-4.5,3.2l0.6,3.6l-6,3.4 l-4.7,6.5l-4.2-4.2l-5.4,2.7l-1.5-6l-6.1,1l-2.2-1.8l-2.8,2L307.7,414.3z">
                                            </path> @endif
                                            @if ($departement[24]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Dordogne" data-nom="Dordogne" data-numerodepartement="24" class="region-75 departement departement-24 departement-dordogne" d="m307.7,414.3l-2.8-6.4l-1-1.3l0.9-2.9l-2.4-2.6l-2,3.2l-9.8-2.3l2-2 l0.2-5.7l2.8-5.5l-1.2-2.8l-3.7,0.6l2-5l0.1-0.4l2-2l5.5-0.7l4.1-5.8l0.7-5.7l7.9-5.9l2.1-5.3l5.7-6.1l6.2,3l-0.1,4.7l9.5-1.1 l7.2,5.6l-2,2.7l5.7,2.2l2.9,4.7l-3.6,4.6l1.7,3l-2,1.8l2.3,1.5l0.2,3l3.2,0.7l3.5,7l-0.7,5l-1.4,5.3l-4.5,3.2l0.6,3.6l-6,3.4 l-4.7,6.5l-4.2-4.2l-5.4,2.7l-1.5-6l-6.1,1l-2.2-1.8l-2.8,2L307.7,414.3z">
                                            </path> @endif
                                            @if ($departement[24]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Dordogne" data-nom="Dordogne" data-numerodepartement="24" class="region-75 departement departement-24 departement-dordogne" d="m307.7,414.3l-2.8-6.4l-1-1.3l0.9-2.9l-2.4-2.6l-2,3.2l-9.8-2.3l2-2 l0.2-5.7l2.8-5.5l-1.2-2.8l-3.7,0.6l2-5l0.1-0.4l2-2l5.5-0.7l4.1-5.8l0.7-5.7l7.9-5.9l2.1-5.3l5.7-6.1l6.2,3l-0.1,4.7l9.5-1.1 l7.2,5.6l-2,2.7l5.7,2.2l2.9,4.7l-3.6,4.6l1.7,3l-2,1.8l2.3,1.5l0.2,3l3.2,0.7l3.5,7l-0.7,5l-1.4,5.3l-4.5,3.2l0.6,3.6l-6,3.4 l-4.7,6.5l-4.2-4.2l-5.4,2.7l-1.5-6l-6.1,1l-2.2-1.8l-2.8,2L307.7,414.3z">
                                            </path> @endif
                                            @if ($departement[24]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Dordogne" data-nom="Dordogne" data-numerodepartement="24" class="region-75 departement departement-24 departement-dordogne" d="m307.7,414.3l-2.8-6.4l-1-1.3l0.9-2.9l-2.4-2.6l-2,3.2l-9.8-2.3l2-2 l0.2-5.7l2.8-5.5l-1.2-2.8l-3.7,0.6l2-5l0.1-0.4l2-2l5.5-0.7l4.1-5.8l0.7-5.7l7.9-5.9l2.1-5.3l5.7-6.1l6.2,3l-0.1,4.7l9.5-1.1 l7.2,5.6l-2,2.7l5.7,2.2l2.9,4.7l-3.6,4.6l1.7,3l-2,1.8l2.3,1.5l0.2,3l3.2,0.7l3.5,7l-0.7,5l-1.4,5.3l-4.5,3.2l0.6,3.6l-6,3.4 l-4.7,6.5l-4.2-4.2l-5.4,2.7l-1.5-6l-6.1,1l-2.2-1.8l-2.8,2L307.7,414.3z">
                                            </path> @endif

                                            @if ($departement[33]->hospitalises
                                            <= 50)<path class="region" style="fill: green" id="Gironde" data-nom="Gironde" data-numerodepartement="33" class="region-75 departement departement-33 departement-gironde" d="m243.9,420.1l-5.8,2.6v-4.6l2.2-3.2l0.5-2.3 l1.9-1.7l1.8,1.4l3.1-0.2l-1.1-4.6l-3.5-3.4l-2.8,4l-1.2,3.8l6.2-50l0.9-2.8l3.3-3.4l1.4,4.7l9,9l2.8,7.6l1.7-3.1l-0.59-2.4 l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l3.7-0.6l1.2,2.8l-2.8,5.5l-0.2,5.7l-2,2l9.8,2.3l2-3.2l2.4,2.6l-0.9,2.9l1,1.3 l-3.1-0.1l-1.2,2.5l-2.7-0.9l-1.1,3.3l2.9,1.4l-8.5,8.6l-0.6,8.9l-3,2.3l1.5,2.5l-4.5,4l-2.1-2.7l-1.6,3.6h-6.4l-0.6-4.7l-11-7.7 l0.4-2.8l-17.2,0.7l1.5-5.4L243.9,420.1z">
                                                </path>
                                                @endif
                                                @if ($departement[33]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Gironde" data-nom="Gironde" data-numerodepartement="33" class="region-75 departement departement-33 departement-gironde" d="m243.9,420.1l-5.8,2.6v-4.6l2.2-3.2l0.5-2.3 l1.9-1.7l1.8,1.4l3.1-0.2l-1.1-4.6l-3.5-3.4l-2.8,4l-1.2,3.8l6.2-50l0.9-2.8l3.3-3.4l1.4,4.7l9,9l2.8,7.6l1.7-3.1l-0.59-2.4 l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l3.7-0.6l1.2,2.8l-2.8,5.5l-0.2,5.7l-2,2l9.8,2.3l2-3.2l2.4,2.6l-0.9,2.9l1,1.3 l-3.1-0.1l-1.2,2.5l-2.7-0.9l-1.1,3.3l2.9,1.4l-8.5,8.6l-0.6,8.9l-3,2.3l1.5,2.5l-4.5,4l-2.1-2.7l-1.6,3.6h-6.4l-0.6-4.7l-11-7.7 l0.4-2.8l-17.2,0.7l1.5-5.4L243.9,420.1z">
                                                </path> @endif
                                                @if ($departement[33]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Gironde" data-nom="Gironde" data-numerodepartement="33" class="region-75 departement departement-33 departement-gironde" d="m243.9,420.1l-5.8,2.6v-4.6l2.2-3.2l0.5-2.3 l1.9-1.7l1.8,1.4l3.1-0.2l-1.1-4.6l-3.5-3.4l-2.8,4l-1.2,3.8l6.2-50l0.9-2.8l3.3-3.4l1.4,4.7l9,9l2.8,7.6l1.7-3.1l-0.59-2.4 l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l3.7-0.6l1.2,2.8l-2.8,5.5l-0.2,5.7l-2,2l9.8,2.3l2-3.2l2.4,2.6l-0.9,2.9l1,1.3 l-3.1-0.1l-1.2,2.5l-2.7-0.9l-1.1,3.3l2.9,1.4l-8.5,8.6l-0.6,8.9l-3,2.3l1.5,2.5l-4.5,4l-2.1-2.7l-1.6,3.6h-6.4l-0.6-4.7l-11-7.7 l0.4-2.8l-17.2,0.7l1.5-5.4L243.9,420.1z">
                                                </path> @endif
                                                @if ($departement[33]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Gironde" data-nom="Gironde" data-numerodepartement="33" class="region-75 departement departement-33 departement-gironde" d="m243.9,420.1l-5.8,2.6v-4.6l2.2-3.2l0.5-2.3 l1.9-1.7l1.8,1.4l3.1-0.2l-1.1-4.6l-3.5-3.4l-2.8,4l-1.2,3.8l6.2-50l0.9-2.8l3.3-3.4l1.4,4.7l9,9l2.8,7.6l1.7-3.1l-0.59-2.4 l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l3.7-0.6l1.2,2.8l-2.8,5.5l-0.2,5.7l-2,2l9.8,2.3l2-3.2l2.4,2.6l-0.9,2.9l1,1.3 l-3.1-0.1l-1.2,2.5l-2.7-0.9l-1.1,3.3l2.9,1.4l-8.5,8.6l-0.6,8.9l-3,2.3l1.5,2.5l-4.5,4l-2.1-2.7l-1.6,3.6h-6.4l-0.6-4.7l-11-7.7 l0.4-2.8l-17.2,0.7l1.5-5.4L243.9,420.1z">
                                                </path> @endif
                                                @if ($departement[33]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Gironde" data-nom="Gironde" data-numerodepartement="33" class="region-75 departement departement-33 departement-gironde" d="m243.9,420.1l-5.8,2.6v-4.6l2.2-3.2l0.5-2.3 l1.9-1.7l1.8,1.4l3.1-0.2l-1.1-4.6l-3.5-3.4l-2.8,4l-1.2,3.8l6.2-50l0.9-2.8l3.3-3.4l1.4,4.7l9,9l2.8,7.6l1.7-3.1l-0.59-2.4 l3.79-0.5l0.7,2.8l6.4,1.7l0.6,5.8l6.1,4.3l9.4,1l3.7-0.6l1.2,2.8l-2.8,5.5l-0.2,5.7l-2,2l9.8,2.3l2-3.2l2.4,2.6l-0.9,2.9l1,1.3 l-3.1-0.1l-1.2,2.5l-2.7-0.9l-1.1,3.3l2.9,1.4l-8.5,8.6l-0.6,8.9l-3,2.3l1.5,2.5l-4.5,4l-2.1-2.7l-1.6,3.6h-6.4l-0.6-4.7l-11-7.7 l0.4-2.8l-17.2,0.7l1.5-5.4L243.9,420.1z">
                                                </path>@endif


                                                @if ($departement[40]->hospitalises
                                                <= 50)<path class="region" style="fill: green" id="Landes" data-nom="Landes" data-numerodepartement="40" class="region-75 departement departement-40 departement-landes" d="m222.32,481.21l1.08-1.51l3.9-7.1l8.8-37.8 l2-11.7v-0.4l5.8-2.6l3.7,1.3l-1.5,5.4l17.2-0.7l-0.4,2.8l11,7.7l0.6,4.7h6.4l1.6-3.6l2.1,2.7l0.4,4.6l11.7,2.9l-3.6,5.2l0.7,2.6 l-0.4,2.9l-2.5,1.3l-0.6-3l-9.4,2.7l0.5,6.4l-4.2,11.1l1.6,2.7l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2 l-1.6,2.2l-2.5-1.4l-2.7,1.3l-1.2-2.8l-11,2.5L222.32,481.21z">
                                                    </path>
                                                    @endif
                                                    @if ($departement[40]->hospitalises > 50)
                                                    <path class="region" style="fill: yellow" id="Landes" data-nom="Landes" data-numerodepartement="40" class="region-75 departement departement-40 departement-landes" d="m222.32,481.21l1.08-1.51l3.9-7.1l8.8-37.8 l2-11.7v-0.4l5.8-2.6l3.7,1.3l-1.5,5.4l17.2-0.7l-0.4,2.8l11,7.7l0.6,4.7h6.4l1.6-3.6l2.1,2.7l0.4,4.6l11.7,2.9l-3.6,5.2l0.7,2.6 l-0.4,2.9l-2.5,1.3l-0.6-3l-9.4,2.7l0.5,6.4l-4.2,11.1l1.6,2.7l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2 l-1.6,2.2l-2.5-1.4l-2.7,1.3l-1.2-2.8l-11,2.5L222.32,481.21z">
                                                    </path> @endif
                                                    @if ($departement[40]->hospitalises >= 150)
                                                    <path class="region" style="fill: pink" id="Landes" data-nom="Landes" data-numerodepartement="40" class="region-75 departement departement-40 departement-landes" d="m222.32,481.21l1.08-1.51l3.9-7.1l8.8-37.8 l2-11.7v-0.4l5.8-2.6l3.7,1.3l-1.5,5.4l17.2-0.7l-0.4,2.8l11,7.7l0.6,4.7h6.4l1.6-3.6l2.1,2.7l0.4,4.6l11.7,2.9l-3.6,5.2l0.7,2.6 l-0.4,2.9l-2.5,1.3l-0.6-3l-9.4,2.7l0.5,6.4l-4.2,11.1l1.6,2.7l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2 l-1.6,2.2l-2.5-1.4l-2.7,1.3l-1.2-2.8l-11,2.5L222.32,481.21z">
                                                    </path> @endif
                                                    @if ($departement[40]->hospitalises >= 250)
                                                    <path class="region" style="fill: purple" id="Landes" data-nom="Landes" data-numerodepartement="40" class="region-75 departement departement-40 departement-landes" d="m222.32,481.21l1.08-1.51l3.9-7.1l8.8-37.8 l2-11.7v-0.4l5.8-2.6l3.7,1.3l-1.5,5.4l17.2-0.7l-0.4,2.8l11,7.7l0.6,4.7h6.4l1.6-3.6l2.1,2.7l0.4,4.6l11.7,2.9l-3.6,5.2l0.7,2.6 l-0.4,2.9l-2.5,1.3l-0.6-3l-9.4,2.7l0.5,6.4l-4.2,11.1l1.6,2.7l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2 l-1.6,2.2l-2.5-1.4l-2.7,1.3l-1.2-2.8l-11,2.5L222.32,481.21z">
                                                    </path> @endif
                                                    @if ($departement[40]->hospitalises >= 400)
                                                    <path class="region" style="fill: red" id="Landes" data-nom="Landes" data-numerodepartement="40" class="region-75 departement departement-40 departement-landes" d="m222.32,481.21l1.08-1.51l3.9-7.1l8.8-37.8 l2-11.7v-0.4l5.8-2.6l3.7,1.3l-1.5,5.4l17.2-0.7l-0.4,2.8l11,7.7l0.6,4.7h6.4l1.6-3.6l2.1,2.7l0.4,4.6l11.7,2.9l-3.6,5.2l0.7,2.6 l-0.4,2.9l-2.5,1.3l-0.6-3l-9.4,2.7l0.5,6.4l-4.2,11.1l1.6,2.7l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2 l-1.6,2.2l-2.5-1.4l-2.7,1.3l-1.2-2.8l-11,2.5L222.32,481.21z">
                                                    </path> @endif

                                                    @if ($departement[47]->hospitalises
                                                    <= 50) <path class="region" style="fill: green" id="Lot-et-Garonne" data-nom="Lot-et-Garonne" data-numerodepartement="47" class="region-75 departement departement-47 departement-lot-et-garonne" d="m293.8,455.6v0.1l-0.7-2.6l3.6-5.2L285,445 l-0.4-4.6l4.5-4l-1.5-2.5l3-2.3l0.6-8.9l8.5-8.6l-2.9-1.4l1.1-3.3l2.7,0.9l1.2-2.5l3.1,0.1l2.8,6.4l8.9-0.5l2.8-2l2.2,1.8l6.1-1 l1.5,6l5.4-2.7l4.2,4.2l-3.4,3.1l2.7,9.1l-7.5,2v2.9l2.4,1.4l-4.4,5.5l1.3,2.7l-2.8-0.2l-3.6,4.7l-2.7,1.3l-8.6-1l-5,2.9l-8.3-0.7 l-1.4,2.5L293.8,455.6z">
                                                        </path>
                                                        @endif
                                                        @if ($departement[47]->hospitalises > 50)
                                                        <path class="region" style="fill: yellow" id="Lot-et-Garonne" data-nom="Lot-et-Garonne" data-numerodepartement="47" class="region-75 departement departement-47 departement-lot-et-garonne" d="m293.8,455.6v0.1l-0.7-2.6l3.6-5.2L285,445 l-0.4-4.6l4.5-4l-1.5-2.5l3-2.3l0.6-8.9l8.5-8.6l-2.9-1.4l1.1-3.3l2.7,0.9l1.2-2.5l3.1,0.1l2.8,6.4l8.9-0.5l2.8-2l2.2,1.8l6.1-1 l1.5,6l5.4-2.7l4.2,4.2l-3.4,3.1l2.7,9.1l-7.5,2v2.9l2.4,1.4l-4.4,5.5l1.3,2.7l-2.8-0.2l-3.6,4.7l-2.7,1.3l-8.6-1l-5,2.9l-8.3-0.7 l-1.4,2.5L293.8,455.6z">
                                                        </path> @endif
                                                        @if ($departement[47]->hospitalises >= 150)
                                                        <path class="region" style="fill: pink" id="Lot-et-Garonne" data-nom="Lot-et-Garonne" data-numerodepartement="47" class="region-75 departement departement-47 departement-lot-et-garonne" d="m293.8,455.6v0.1l-0.7-2.6l3.6-5.2L285,445 l-0.4-4.6l4.5-4l-1.5-2.5l3-2.3l0.6-8.9l8.5-8.6l-2.9-1.4l1.1-3.3l2.7,0.9l1.2-2.5l3.1,0.1l2.8,6.4l8.9-0.5l2.8-2l2.2,1.8l6.1-1 l1.5,6l5.4-2.7l4.2,4.2l-3.4,3.1l2.7,9.1l-7.5,2v2.9l2.4,1.4l-4.4,5.5l1.3,2.7l-2.8-0.2l-3.6,4.7l-2.7,1.3l-8.6-1l-5,2.9l-8.3-0.7 l-1.4,2.5L293.8,455.6z">
                                                        </path> @endif
                                                        @if ($departement[47]->hospitalises >= 250)
                                                        <path class="region" style="fill: purple" id="Lot-et-Garonne" data-nom="Lot-et-Garonne" data-numerodepartement="47" class="region-75 departement departement-47 departement-lot-et-garonne" d="m293.8,455.6v0.1l-0.7-2.6l3.6-5.2L285,445 l-0.4-4.6l4.5-4l-1.5-2.5l3-2.3l0.6-8.9l8.5-8.6l-2.9-1.4l1.1-3.3l2.7,0.9l1.2-2.5l3.1,0.1l2.8,6.4l8.9-0.5l2.8-2l2.2,1.8l6.1-1 l1.5,6l5.4-2.7l4.2,4.2l-3.4,3.1l2.7,9.1l-7.5,2v2.9l2.4,1.4l-4.4,5.5l1.3,2.7l-2.8-0.2l-3.6,4.7l-2.7,1.3l-8.6-1l-5,2.9l-8.3-0.7 l-1.4,2.5L293.8,455.6z">
                                                        </path> @endif
                                                        @if ($departement[47]->hospitalises >= 400)
                                                        <path class="region" style="fill: red" id="Lot-et-Garonne" data-nom="Lot-et-Garonne" data-numerodepartement="47" class="region-75 departement departement-47 departement-lot-et-garonne" d="m293.8,455.6v0.1l-0.7-2.6l3.6-5.2L285,445 l-0.4-4.6l4.5-4l-1.5-2.5l3-2.3l0.6-8.9l8.5-8.6l-2.9-1.4l1.1-3.3l2.7,0.9l1.2-2.5l3.1,0.1l2.8,6.4l8.9-0.5l2.8-2l2.2,1.8l6.1-1 l1.5,6l5.4-2.7l4.2,4.2l-3.4,3.1l2.7,9.1l-7.5,2v2.9l2.4,1.4l-4.4,5.5l1.3,2.7l-2.8-0.2l-3.6,4.7l-2.7,1.3l-8.6-1l-5,2.9l-8.3-0.7 l-1.4,2.5L293.8,455.6z">
                                                        </path> @endif

                                                        @if ($departement[64]->hospitalises
                                                        <= 50) <path class="region" style="fill: green" id="Pyrénées-Atlantiques" data-nom="Pyrénées-Atlantiques" data-numerodepartement="64" class="region-75 departement departement-64 departement-pyrenees-atlantiques" d="m276.9,513.4l3.4-0.8l-0.4-2.9l8-9.3l-0.8-3.1 l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l-6.6-0.3l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2l-1.6,2.2l-2.5-1.4 l-2.7,1.3l-1.2-2.8l-11,2.5l-3.98-1.89l-3.52,4.89l-2.7,1.9l-4.5,0.9l1.9,4.5l4.5-0.2l0.2,2.2l2.4,1l2.2-2.1l2.4,1.3l2.5,0.1 l1.4,2.8l-2.5,6.7l-2.1,2.2l1.3,2.2l4.3-0.1l0.7-3.4l2.3-0.1l-1.3,2.4l5.9,2.3l1.5,1.8h2.5l6.1,3.8l5.8,0.4l2.3-1l1.4,2.1l0.3,2.8 l2.7,1.3l3.9,4l2.1,0.9l1.1-2.1l2.7,2.1l3.6-1.1l0.19-0.16l1.41-9.34L276.9,513.4z">
                                                            </path>
                                                            @endif
                                                            @if ($departement[64]->hospitalises > 50)
                                                            <path class="region" style="fill: yellow" id="Pyrénées-Atlantiques" data-nom="Pyrénées-Atlantiques" data-numerodepartement="64" class="region-75 departement departement-64 departement-pyrenees-atlantiques" d="m276.9,513.4l3.4-0.8l-0.4-2.9l8-9.3l-0.8-3.1 l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l-6.6-0.3l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2l-1.6,2.2l-2.5-1.4 l-2.7,1.3l-1.2-2.8l-11,2.5l-3.98-1.89l-3.52,4.89l-2.7,1.9l-4.5,0.9l1.9,4.5l4.5-0.2l0.2,2.2l2.4,1l2.2-2.1l2.4,1.3l2.5,0.1 l1.4,2.8l-2.5,6.7l-2.1,2.2l1.3,2.2l4.3-0.1l0.7-3.4l2.3-0.1l-1.3,2.4l5.9,2.3l1.5,1.8h2.5l6.1,3.8l5.8,0.4l2.3-1l1.4,2.1l0.3,2.8 l2.7,1.3l3.9,4l2.1,0.9l1.1-2.1l2.7,2.1l3.6-1.1l0.19-0.16l1.41-9.34L276.9,513.4z">
                                                            </path> @endif
                                                            @if ($departement[64]->hospitalises >= 150)
                                                            <path class="region" style="fill: pink" id="Pyrénées-Atlantiques" data-nom="Pyrénées-Atlantiques" data-numerodepartement="64" class="region-75 departement departement-64 departement-pyrenees-atlantiques" d="m276.9,513.4l3.4-0.8l-0.4-2.9l8-9.3l-0.8-3.1 l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l-6.6-0.3l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2l-1.6,2.2l-2.5-1.4 l-2.7,1.3l-1.2-2.8l-11,2.5l-3.98-1.89l-3.52,4.89l-2.7,1.9l-4.5,0.9l1.9,4.5l4.5-0.2l0.2,2.2l2.4,1l2.2-2.1l2.4,1.3l2.5,0.1 l1.4,2.8l-2.5,6.7l-2.1,2.2l1.3,2.2l4.3-0.1l0.7-3.4l2.3-0.1l-1.3,2.4l5.9,2.3l1.5,1.8h2.5l6.1,3.8l5.8,0.4l2.3-1l1.4,2.1l0.3,2.8 l2.7,1.3l3.9,4l2.1,0.9l1.1-2.1l2.7,2.1l3.6-1.1l0.19-0.16l1.41-9.34L276.9,513.4z">
                                                            </path> @endif
                                                            @if ($departement[64]->hospitalises >= 250)
                                                            <path class="region" style="fill: purple" id="Pyrénées-Atlantiques" data-nom="Pyrénées-Atlantiques" data-numerodepartement="64" class="region-75 departement departement-64 departement-pyrenees-atlantiques" d="m276.9,513.4l3.4-0.8l-0.4-2.9l8-9.3l-0.8-3.1 l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l-6.6-0.3l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2l-1.6,2.2l-2.5-1.4 l-2.7,1.3l-1.2-2.8l-11,2.5l-3.98-1.89l-3.52,4.89l-2.7,1.9l-4.5,0.9l1.9,4.5l4.5-0.2l0.2,2.2l2.4,1l2.2-2.1l2.4,1.3l2.5,0.1 l1.4,2.8l-2.5,6.7l-2.1,2.2l1.3,2.2l4.3-0.1l0.7-3.4l2.3-0.1l-1.3,2.4l5.9,2.3l1.5,1.8h2.5l6.1,3.8l5.8,0.4l2.3-1l1.4,2.1l0.3,2.8 l2.7,1.3l3.9,4l2.1,0.9l1.1-2.1l2.7,2.1l3.6-1.1l0.19-0.16l1.41-9.34L276.9,513.4z">
                                                            </path> @endif
                                                            @if ($departement[64]->hospitalises >= 400)
                                                            <path class="region" style="fill: red" id="Pyrénées-Atlantiques" data-nom="Pyrénées-Atlantiques" data-numerodepartement="64" class="region-75 departement departement-64 departement-pyrenees-atlantiques" d="m276.9,513.4l3.4-0.8l-0.4-2.9l8-9.3l-0.8-3.1 l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l-6.6-0.3l-8.6,1.5l-3.3-1.1l-4.8,1.9l-2.2-2l-2.3,1.5l-2.5-2.3l-9.8,2l-1.6,2.2l-2.5-1.4 l-2.7,1.3l-1.2-2.8l-11,2.5l-3.98-1.89l-3.52,4.89l-2.7,1.9l-4.5,0.9l1.9,4.5l4.5-0.2l0.2,2.2l2.4,1l2.2-2.1l2.4,1.3l2.5,0.1 l1.4,2.8l-2.5,6.7l-2.1,2.2l1.3,2.2l4.3-0.1l0.7-3.4l2.3-0.1l-1.3,2.4l5.9,2.3l1.5,1.8h2.5l6.1,3.8l5.8,0.4l2.3-1l1.4,2.1l0.3,2.8 l2.7,1.3l3.9,4l2.1,0.9l1.1-2.1l2.7,2.1l3.6-1.1l0.19-0.16l1.41-9.34L276.9,513.4z">
                                                            </path> @endif


                                                            @if ($departement[79]->hospitalises
                                                            <= 50) <path class="region" style="fill: green" id="Deux-Sèvres" data-nom="Deux-Sèvres" data-numerodepartement="79" class="region-75 departement departement-79 departement-deux-sevres" d="m292.3,331.6l-2.7,1.6l-3.6-4.7l-17.4-6.7 l-5.9-6.5v-3.7l9.1-4.5l-2.5-2l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l12.3-0.8l3.7-4.8l5.6-0.8l9.6-0.2l2.3,2.3l3.4,9l-0.8,3l2.7,1.2 l-4.5,14.1l2.7-0.9l1.5,3l-3.4,5.5l0.5,5.8l2.1,2l-0.1,2.8l6.4,0.2l-3.2,8.5l4.5,3l-0.8,2.8h-0.1l-0.8,0.8l-3.5-0.4l-5.8,2.5 L292.3,331.6z">
                                                                </path>
                                                                @endif
                                                                @if ($departement[79]->hospitalises > 50)
                                                                <path class="region" style="fill: yellow" id="Deux-Sèvres" data-nom="Deux-Sèvres" data-numerodepartement="79" class="region-75 departement departement-79 departement-deux-sevres" d="m292.3,331.6l-2.7,1.6l-3.6-4.7l-17.4-6.7 l-5.9-6.5v-3.7l9.1-4.5l-2.5-2l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l12.3-0.8l3.7-4.8l5.6-0.8l9.6-0.2l2.3,2.3l3.4,9l-0.8,3l2.7,1.2 l-4.5,14.1l2.7-0.9l1.5,3l-3.4,5.5l0.5,5.8l2.1,2l-0.1,2.8l6.4,0.2l-3.2,8.5l4.5,3l-0.8,2.8h-0.1l-0.8,0.8l-3.5-0.4l-5.8,2.5 L292.3,331.6z">
                                                                </path> @endif
                                                                @if ($departement[79]->hospitalises >= 150)
                                                                <path class="region" style="fill: pink" id="Deux-Sèvres" data-nom="Deux-Sèvres" data-numerodepartement="79" class="region-75 departement departement-79 departement-deux-sevres" d="m292.3,331.6l-2.7,1.6l-3.6-4.7l-17.4-6.7 l-5.9-6.5v-3.7l9.1-4.5l-2.5-2l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l12.3-0.8l3.7-4.8l5.6-0.8l9.6-0.2l2.3,2.3l3.4,9l-0.8,3l2.7,1.2 l-4.5,14.1l2.7-0.9l1.5,3l-3.4,5.5l0.5,5.8l2.1,2l-0.1,2.8l6.4,0.2l-3.2,8.5l4.5,3l-0.8,2.8h-0.1l-0.8,0.8l-3.5-0.4l-5.8,2.5 L292.3,331.6z">
                                                                </path> @endif
                                                                @if ($departement[79]->hospitalises >= 250)
                                                                <path class="region" style="fill: purple" id="Deux-Sèvres" data-nom="Deux-Sèvres" data-numerodepartement="79" class="region-75 departement departement-79 departement-deux-sevres" d="m292.3,331.6l-2.7,1.6l-3.6-4.7l-17.4-6.7 l-5.9-6.5v-3.7l9.1-4.5l-2.5-2l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l12.3-0.8l3.7-4.8l5.6-0.8l9.6-0.2l2.3,2.3l3.4,9l-0.8,3l2.7,1.2 l-4.5,14.1l2.7-0.9l1.5,3l-3.4,5.5l0.5,5.8l2.1,2l-0.1,2.8l6.4,0.2l-3.2,8.5l4.5,3l-0.8,2.8h-0.1l-0.8,0.8l-3.5-0.4l-5.8,2.5 L292.3,331.6z">
                                                                </path> @endif
                                                                @if ($departement[79]->hospitalises >= 400)
                                                                <path class="region" style="fill: red" id="Deux-Sèvres" data-nom="Deux-Sèvres" data-numerodepartement="79" class="region-75 departement departement-79 departement-deux-sevres" d="m292.3,331.6l-2.7,1.6l-3.6-4.7l-17.4-6.7 l-5.9-6.5v-3.7l9.1-4.5l-2.5-2l0.2-7.4l-4.7-17.9l-4.2-4.1l-2.3-5.7l12.3-0.8l3.7-4.8l5.6-0.8l9.6-0.2l2.3,2.3l3.4,9l-0.8,3l2.7,1.2 l-4.5,14.1l2.7-0.9l1.5,3l-3.4,5.5l0.5,5.8l2.1,2l-0.1,2.8l6.4,0.2l-3.2,8.5l4.5,3l-0.8,2.8h-0.1l-0.8,0.8l-3.5-0.4l-5.8,2.5 L292.3,331.6z">
                                                                </path> @endif

                                                                @if ($departement[86]->hospitalises
                                                                <= 50) <path class="region" style="fill: green" id="Vienne" data-nom="Vienne" data-numerodepartement="86" class="region-75 departement departement-86 departement-vienne" d="m329.6,320.8v3.5l-4.8-0.6l-1.3,2.5l-3.8,1.4 l-4.1-3.9l-2.2,1.8l1.4,2.4l-2.9,0.8l-9.1-3l0.8-2.8l-4.5-3l3.2-8.5l-6.4-0.2l0.1-2.8l-2.1-2l-0.5-5.8l3.4-5.5l-1.5-3l-2.7,0.9 l4.5-14.1l-2.7-1.2l0.8-3l-3.4-9l6.6-5.9l5.5,3.2l0.3,3.2l2.9-0.3l1.3,6.1l2.8,1.4l10-0.4l-1.4-2.9l5.3,3l0.3,3.1l7.1,10l2.1,3 l-0.8,5.8l4.6,4.4h2.9l2.6,5.4l2.5,1.3l-1.5,2.8l-0.8-0.3l-1.3,2.4l-3.3-0.9l-1.3,3l-5.6,2.7L329.6,320.8z">
                                                                    </path>
                                                                    @endif
                                                                    @if ($departement[86]->hospitalises > 50)
                                                                    <path class="region" style="fill: yellow" id="Vienne" data-nom="Vienne" data-numerodepartement="86" class="region-75 departement departement-86 departement-vienne" d="m329.6,320.8v3.5l-4.8-0.6l-1.3,2.5l-3.8,1.4 l-4.1-3.9l-2.2,1.8l1.4,2.4l-2.9,0.8l-9.1-3l0.8-2.8l-4.5-3l3.2-8.5l-6.4-0.2l0.1-2.8l-2.1-2l-0.5-5.8l3.4-5.5l-1.5-3l-2.7,0.9 l4.5-14.1l-2.7-1.2l0.8-3l-3.4-9l6.6-5.9l5.5,3.2l0.3,3.2l2.9-0.3l1.3,6.1l2.8,1.4l10-0.4l-1.4-2.9l5.3,3l0.3,3.1l7.1,10l2.1,3 l-0.8,5.8l4.6,4.4h2.9l2.6,5.4l2.5,1.3l-1.5,2.8l-0.8-0.3l-1.3,2.4l-3.3-0.9l-1.3,3l-5.6,2.7L329.6,320.8z">
                                                                    </path> @endif
                                                                    @if ($departement[86]->hospitalises >= 150)
                                                                    <path class="region" style="fill: pink" id="Vienne" data-nom="Vienne" data-numerodepartement="86" class="region-75 departement departement-86 departement-vienne" d="m329.6,320.8v3.5l-4.8-0.6l-1.3,2.5l-3.8,1.4 l-4.1-3.9l-2.2,1.8l1.4,2.4l-2.9,0.8l-9.1-3l0.8-2.8l-4.5-3l3.2-8.5l-6.4-0.2l0.1-2.8l-2.1-2l-0.5-5.8l3.4-5.5l-1.5-3l-2.7,0.9 l4.5-14.1l-2.7-1.2l0.8-3l-3.4-9l6.6-5.9l5.5,3.2l0.3,3.2l2.9-0.3l1.3,6.1l2.8,1.4l10-0.4l-1.4-2.9l5.3,3l0.3,3.1l7.1,10l2.1,3 l-0.8,5.8l4.6,4.4h2.9l2.6,5.4l2.5,1.3l-1.5,2.8l-0.8-0.3l-1.3,2.4l-3.3-0.9l-1.3,3l-5.6,2.7L329.6,320.8z">
                                                                    </path> @endif
                                                                    @if ($departement[86]->hospitalises >= 250)
                                                                    <path class="region" style="fill: purple" id="Vienne" data-nom="Vienne" data-numerodepartement="86" class="region-75 departement departement-86 departement-vienne" d="m329.6,320.8v3.5l-4.8-0.6l-1.3,2.5l-3.8,1.4 l-4.1-3.9l-2.2,1.8l1.4,2.4l-2.9,0.8l-9.1-3l0.8-2.8l-4.5-3l3.2-8.5l-6.4-0.2l0.1-2.8l-2.1-2l-0.5-5.8l3.4-5.5l-1.5-3l-2.7,0.9 l4.5-14.1l-2.7-1.2l0.8-3l-3.4-9l6.6-5.9l5.5,3.2l0.3,3.2l2.9-0.3l1.3,6.1l2.8,1.4l10-0.4l-1.4-2.9l5.3,3l0.3,3.1l7.1,10l2.1,3 l-0.8,5.8l4.6,4.4h2.9l2.6,5.4l2.5,1.3l-1.5,2.8l-0.8-0.3l-1.3,2.4l-3.3-0.9l-1.3,3l-5.6,2.7L329.6,320.8z">
                                                                    </path> @endif
                                                                    @if ($departement[86]->hospitalises >= 400)
                                                                    <path class="region" style="fill: red" id="Vienne" data-nom="Vienne" data-numerodepartement="86" class="region-75 departement departement-86 departement-vienne" d="m329.6,320.8v3.5l-4.8-0.6l-1.3,2.5l-3.8,1.4 l-4.1-3.9l-2.2,1.8l1.4,2.4l-2.9,0.8l-9.1-3l0.8-2.8l-4.5-3l3.2-8.5l-6.4-0.2l0.1-2.8l-2.1-2l-0.5-5.8l3.4-5.5l-1.5-3l-2.7,0.9 l4.5-14.1l-2.7-1.2l0.8-3l-3.4-9l6.6-5.9l5.5,3.2l0.3,3.2l2.9-0.3l1.3,6.1l2.8,1.4l10-0.4l-1.4-2.9l5.3,3l0.3,3.1l7.1,10l2.1,3 l-0.8,5.8l4.6,4.4h2.9l2.6,5.4l2.5,1.3l-1.5,2.8l-0.8-0.3l-1.3,2.4l-3.3-0.9l-1.3,3l-5.6,2.7L329.6,320.8z">
                                                                    </path> @endif

                                                                    @if ($departement[87]->hospitalises
                                                                    <= 50) <path class="region" style="fill: green" id="Haute-Vienne" data-nom="Haute-Vienne" data-numerodepartement="87" class="region-75 departement departement-87 departement-haute-vienne" d="m348.9,364.1l-1.6,2.7l-5.7-2.2l2-2.7l-7.2-5.6 l-9.5,1.1l0.1-4.7l-6.2-3h-0.1l3.4-3.8l2.8-0.6l4-8l2.6-1.1l0.6-3.2l-4.7-3.6l0.2-5.1v-3.5l3-5l5.6-2.7l1.3-3l3.3,0.9l1.3-2.4 l0.8,0.3l2.6,1.1l5.8-1.1l1.7,2.5l1.2,2.6l-3,5.3l6.6,9.8l1.8,5.2l-0.9,3.4l2.9,1.5l0.1,2.8l6.4,0.5l4.7,3l0.6,5.9l-8.7,4l-4.9,4.6 l-5.7,1.3l-4.7,4L348.9,364.1z">
                                                                        </path>
                                                                        @endif
                                                                        @if ($departement[87]->hospitalises > 50)
                                                                        <path class="region" style="fill: yellow" id="Haute-Vienne" data-nom="Haute-Vienne" data-numerodepartement="87" class="region-75 departement departement-87 departement-haute-vienne" d="m348.9,364.1l-1.6,2.7l-5.7-2.2l2-2.7l-7.2-5.6 l-9.5,1.1l0.1-4.7l-6.2-3h-0.1l3.4-3.8l2.8-0.6l4-8l2.6-1.1l0.6-3.2l-4.7-3.6l0.2-5.1v-3.5l3-5l5.6-2.7l1.3-3l3.3,0.9l1.3-2.4 l0.8,0.3l2.6,1.1l5.8-1.1l1.7,2.5l1.2,2.6l-3,5.3l6.6,9.8l1.8,5.2l-0.9,3.4l2.9,1.5l0.1,2.8l6.4,0.5l4.7,3l0.6,5.9l-8.7,4l-4.9,4.6 l-5.7,1.3l-4.7,4L348.9,364.1z">
                                                                        </path> @endif
                                                                        @if ($departement[87]->hospitalises >= 150)
                                                                        <path class="region" style="fill: pink" id="Haute-Vienne" data-nom="Haute-Vienne" data-numerodepartement="87" class="region-75 departement departement-87 departement-haute-vienne" d="m348.9,364.1l-1.6,2.7l-5.7-2.2l2-2.7l-7.2-5.6 l-9.5,1.1l0.1-4.7l-6.2-3h-0.1l3.4-3.8l2.8-0.6l4-8l2.6-1.1l0.6-3.2l-4.7-3.6l0.2-5.1v-3.5l3-5l5.6-2.7l1.3-3l3.3,0.9l1.3-2.4 l0.8,0.3l2.6,1.1l5.8-1.1l1.7,2.5l1.2,2.6l-3,5.3l6.6,9.8l1.8,5.2l-0.9,3.4l2.9,1.5l0.1,2.8l6.4,0.5l4.7,3l0.6,5.9l-8.7,4l-4.9,4.6 l-5.7,1.3l-4.7,4L348.9,364.1z">
                                                                        </path> @endif
                                                                        @if ($departement[87]->hospitalises >= 250)
                                                                        <path class="region" style="fill: purple" id="Haute-Vienne" data-nom="Haute-Vienne" data-numerodepartement="87" class="region-75 departement departement-87 departement-haute-vienne" d="m348.9,364.1l-1.6,2.7l-5.7-2.2l2-2.7l-7.2-5.6 l-9.5,1.1l0.1-4.7l-6.2-3h-0.1l3.4-3.8l2.8-0.6l4-8l2.6-1.1l0.6-3.2l-4.7-3.6l0.2-5.1v-3.5l3-5l5.6-2.7l1.3-3l3.3,0.9l1.3-2.4 l0.8,0.3l2.6,1.1l5.8-1.1l1.7,2.5l1.2,2.6l-3,5.3l6.6,9.8l1.8,5.2l-0.9,3.4l2.9,1.5l0.1,2.8l6.4,0.5l4.7,3l0.6,5.9l-8.7,4l-4.9,4.6 l-5.7,1.3l-4.7,4L348.9,364.1z">
                                                                        </path> @endif
                                                                        @if ($departement[87]->hospitalises >= 400)
                                                                        <path class="region" style="fill: red" id="Haute-Vienne" data-nom="Haute-Vienne" data-numerodepartement="87" class="region-75 departement departement-87 departement-haute-vienne" d="m348.9,364.1l-1.6,2.7l-5.7-2.2l2-2.7l-7.2-5.6 l-9.5,1.1l0.1-4.7l-6.2-3h-0.1l3.4-3.8l2.8-0.6l4-8l2.6-1.1l0.6-3.2l-4.7-3.6l0.2-5.1v-3.5l3-5l5.6-2.7l1.3-3l3.3,0.9l1.3-2.4 l0.8,0.3l2.6,1.1l5.8-1.1l1.7,2.5l1.2,2.6l-3,5.3l6.6,9.8l1.8,5.2l-0.9,3.4l2.9,1.5l0.1,2.8l6.4,0.5l4.7,3l0.6,5.9l-8.7,4l-4.9,4.6 l-5.7,1.3l-4.7,4L348.9,364.1z">
                                                                        </path> @endif



                    </g>

                    <g data-nom="Occitanie">

                        @if ($departement[8]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Ariège" data-nom="Ariège" data-numerodepartement="09" class="region-76 departement departement-09 departement-ariege" d="m369.82,543.59l0.78-0.89l-2.6-1.1l-2-2.1 l-3.7-0.1l-1.7-1.7l-2.8,0.4l-1.3,2.1l-2.4-0.8l-2.8-5.9l-10-0.6l-1.3-2.8l-13.2-3.9l-0.5-1.4l3.8-5.2l2.8-1v-5.9l3.9-4l2.8-1.1 l6.2,4.1l-0.4-5.6l5.4-1.6l-3-4.8l2.8-1.1l3.4,5.5l2.8-0.5l0.6-2.8l5.7,2.2l2-2.3l2.2,5.5l8.7,3.9l2.2,5.2l0.2,3.1l-2.2,2.3l2.4,2.5 l-1.2,3l-3.2,0.6l0.8,5.7l3.4,1.5l3.3-1.2l4.8,5.6l-7.4,0.2l-1.3,2.6L369.82,543.59z">
                            </path>
                            @endif
                            @if ($departement[8]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Ariège" data-nom="Ariège" data-numerodepartement="09" class="region-76 departement departement-09 departement-ariege" d="m369.82,543.59l0.78-0.89l-2.6-1.1l-2-2.1 l-3.7-0.1l-1.7-1.7l-2.8,0.4l-1.3,2.1l-2.4-0.8l-2.8-5.9l-10-0.6l-1.3-2.8l-13.2-3.9l-0.5-1.4l3.8-5.2l2.8-1v-5.9l3.9-4l2.8-1.1 l6.2,4.1l-0.4-5.6l5.4-1.6l-3-4.8l2.8-1.1l3.4,5.5l2.8-0.5l0.6-2.8l5.7,2.2l2-2.3l2.2,5.5l8.7,3.9l2.2,5.2l0.2,3.1l-2.2,2.3l2.4,2.5 l-1.2,3l-3.2,0.6l0.8,5.7l3.4,1.5l3.3-1.2l4.8,5.6l-7.4,0.2l-1.3,2.6L369.82,543.59z">
                            </path> @endif
                            @if ($departement[8]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Ariège" data-nom="Ariège" data-numerodepartement="09" class="region-76 departement departement-09 departement-ariege" d="m369.82,543.59l0.78-0.89l-2.6-1.1l-2-2.1 l-3.7-0.1l-1.7-1.7l-2.8,0.4l-1.3,2.1l-2.4-0.8l-2.8-5.9l-10-0.6l-1.3-2.8l-13.2-3.9l-0.5-1.4l3.8-5.2l2.8-1v-5.9l3.9-4l2.8-1.1 l6.2,4.1l-0.4-5.6l5.4-1.6l-3-4.8l2.8-1.1l3.4,5.5l2.8-0.5l0.6-2.8l5.7,2.2l2-2.3l2.2,5.5l8.7,3.9l2.2,5.2l0.2,3.1l-2.2,2.3l2.4,2.5 l-1.2,3l-3.2,0.6l0.8,5.7l3.4,1.5l3.3-1.2l4.8,5.6l-7.4,0.2l-1.3,2.6L369.82,543.59z">
                            </path> @endif
                            @if ($departement[8]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Ariège" data-nom="Ariège" data-numerodepartement="09" class="region-76 departement departement-09 departement-ariege" d="m369.82,543.59l0.78-0.89l-2.6-1.1l-2-2.1 l-3.7-0.1l-1.7-1.7l-2.8,0.4l-1.3,2.1l-2.4-0.8l-2.8-5.9l-10-0.6l-1.3-2.8l-13.2-3.9l-0.5-1.4l3.8-5.2l2.8-1v-5.9l3.9-4l2.8-1.1 l6.2,4.1l-0.4-5.6l5.4-1.6l-3-4.8l2.8-1.1l3.4,5.5l2.8-0.5l0.6-2.8l5.7,2.2l2-2.3l2.2,5.5l8.7,3.9l2.2,5.2l0.2,3.1l-2.2,2.3l2.4,2.5 l-1.2,3l-3.2,0.6l0.8,5.7l3.4,1.5l3.3-1.2l4.8,5.6l-7.4,0.2l-1.3,2.6L369.82,543.59z">
                            </path> @endif
                            @if ($departement[8]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Ariège" data-nom="Ariège" data-numerodepartement="09" class="region-76 departement departement-09 departement-ariege" d="m369.82,543.59l0.78-0.89l-2.6-1.1l-2-2.1 l-3.7-0.1l-1.7-1.7l-2.8,0.4l-1.3,2.1l-2.4-0.8l-2.8-5.9l-10-0.6l-1.3-2.8l-13.2-3.9l-0.5-1.4l3.8-5.2l2.8-1v-5.9l3.9-4l2.8-1.1 l6.2,4.1l-0.4-5.6l5.4-1.6l-3-4.8l2.8-1.1l3.4,5.5l2.8-0.5l0.6-2.8l5.7,2.2l2-2.3l2.2,5.5l8.7,3.9l2.2,5.2l0.2,3.1l-2.2,2.3l2.4,2.5 l-1.2,3l-3.2,0.6l0.8,5.7l3.4,1.5l3.3-1.2l4.8,5.6l-7.4,0.2l-1.3,2.6L369.82,543.59z">
                            </path> @endif


                            @if ($departement[10]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Aude" data-nom="Aude" data-numerodepartement="11" class="region-76 departement departement-11 departement-aude" d="m435.07,504.37l-1.47,1.53l-5.2,9.3l-0.9,3.5 l0.15,9.57l-9.45-5.57l-8.2,5.4l-13.6-1l-2.7,1.4l1.4,6l-8.6,3.9l-4.8-5.6l-3.3,1.2l-3.4-1.5l-0.8-5.7l3.2-0.6l1.2-3l-2.4-2.5 l2.2-2.3l-0.2-3.1l-2.2-5.2l-8.7-3.9l-2.2-5.5l8.4-10l1.4,2.7l5.2-1.8l0.5-0.8l1.8,2.3l6.3,0.9l1.1-3.3l2.8-0.5l12,1.4l-0.5,2.8 l3.5,5l2.5-1.6l1.4,2.9l3.1-0.8l3.8-5.3l1,2.9l13.8,4.7l1.7,2L435.07,504.37z">
                                </path>
                                @endif
                                @if ($departement[10]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Aude" data-nom="Aude" data-numerodepartement="11" class="region-76 departement departement-11 departement-aude" d="m435.07,504.37l-1.47,1.53l-5.2,9.3l-0.9,3.5 l0.15,9.57l-9.45-5.57l-8.2,5.4l-13.6-1l-2.7,1.4l1.4,6l-8.6,3.9l-4.8-5.6l-3.3,1.2l-3.4-1.5l-0.8-5.7l3.2-0.6l1.2-3l-2.4-2.5 l2.2-2.3l-0.2-3.1l-2.2-5.2l-8.7-3.9l-2.2-5.5l8.4-10l1.4,2.7l5.2-1.8l0.5-0.8l1.8,2.3l6.3,0.9l1.1-3.3l2.8-0.5l12,1.4l-0.5,2.8 l3.5,5l2.5-1.6l1.4,2.9l3.1-0.8l3.8-5.3l1,2.9l13.8,4.7l1.7,2L435.07,504.37z">
                                </path>@endif
                                @if ($departement[10]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Aude" data-nom="Aude" data-numerodepartement="11" class="region-76 departement departement-11 departement-aude" d="m435.07,504.37l-1.47,1.53l-5.2,9.3l-0.9,3.5 l0.15,9.57l-9.45-5.57l-8.2,5.4l-13.6-1l-2.7,1.4l1.4,6l-8.6,3.9l-4.8-5.6l-3.3,1.2l-3.4-1.5l-0.8-5.7l3.2-0.6l1.2-3l-2.4-2.5 l2.2-2.3l-0.2-3.1l-2.2-5.2l-8.7-3.9l-2.2-5.5l8.4-10l1.4,2.7l5.2-1.8l0.5-0.8l1.8,2.3l6.3,0.9l1.1-3.3l2.8-0.5l12,1.4l-0.5,2.8 l3.5,5l2.5-1.6l1.4,2.9l3.1-0.8l3.8-5.3l1,2.9l13.8,4.7l1.7,2L435.07,504.37z">
                                </path> @endif
                                @if ($departement[10]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Aude" data-nom="Aude" data-numerodepartement="11" class="region-76 departement departement-11 departement-aude" d="m435.07,504.37l-1.47,1.53l-5.2,9.3l-0.9,3.5 l0.15,9.57l-9.45-5.57l-8.2,5.4l-13.6-1l-2.7,1.4l1.4,6l-8.6,3.9l-4.8-5.6l-3.3,1.2l-3.4-1.5l-0.8-5.7l3.2-0.6l1.2-3l-2.4-2.5 l2.2-2.3l-0.2-3.1l-2.2-5.2l-8.7-3.9l-2.2-5.5l8.4-10l1.4,2.7l5.2-1.8l0.5-0.8l1.8,2.3l6.3,0.9l1.1-3.3l2.8-0.5l12,1.4l-0.5,2.8 l3.5,5l2.5-1.6l1.4,2.9l3.1-0.8l3.8-5.3l1,2.9l13.8,4.7l1.7,2L435.07,504.37z">
                                </path> @endif
                                @if ($departement[10]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Aude" data-nom="Aude" data-numerodepartement="11" class="region-76 departement departement-11 departement-aude" d="m435.07,504.37l-1.47,1.53l-5.2,9.3l-0.9,3.5 l0.15,9.57l-9.45-5.57l-8.2,5.4l-13.6-1l-2.7,1.4l1.4,6l-8.6,3.9l-4.8-5.6l-3.3,1.2l-3.4-1.5l-0.8-5.7l3.2-0.6l1.2-3l-2.4-2.5 l2.2-2.3l-0.2-3.1l-2.2-5.2l-8.7-3.9l-2.2-5.5l8.4-10l1.4,2.7l5.2-1.8l0.5-0.8l1.8,2.3l6.3,0.9l1.1-3.3l2.8-0.5l12,1.4l-0.5,2.8 l3.5,5l2.5-1.6l1.4,2.9l3.1-0.8l3.8-5.3l1,2.9l13.8,4.7l1.7,2L435.07,504.37z">
                                </path> @endif


                                @if ($departement[11]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Aveyron" data-nom="Aveyron" data-numerodepartement="12" class="region-76 departement departement-12 departement-aveyron" d="m430.8,440.7l9.4,4.5l-2,3.9l-2.8,1.1l8.4,4.1 l-4.3,5.3l0.3,1.5l-3.7,1l-3,5.3l-6.3-1.3l-0.1,8.7l-5.7-0.1l-1.3-2.8l-11.1-1.3l-4.2-5l-4.3-11.5l-4.8-4.3L385,444l-6.1,2.8 l-4.3-3.6l2.3-2.4l-3.1-2.7l0.4-3l-0.8-9.1l7.6-5l5.9-1.4l1.7-1.5h0.1l5.1-3.2l6.4,1.5l3.8-4.8l3-9.1l4.7-4.2l5.2,4l1.3,4.2l2.4,1.6 l-0.5,3l2.6,5.1v0.1l4.2,4.5l2.9,8.8l-0.5,8.7L430.8,440.7z">
                                    </path>
                                    @endif
                                    @if ($departement[11]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Aveyron" data-nom="Aveyron" data-numerodepartement="12" class="region-76 departement departement-12 departement-aveyron" d="m430.8,440.7l9.4,4.5l-2,3.9l-2.8,1.1l8.4,4.1 l-4.3,5.3l0.3,1.5l-3.7,1l-3,5.3l-6.3-1.3l-0.1,8.7l-5.7-0.1l-1.3-2.8l-11.1-1.3l-4.2-5l-4.3-11.5l-4.8-4.3L385,444l-6.1,2.8 l-4.3-3.6l2.3-2.4l-3.1-2.7l0.4-3l-0.8-9.1l7.6-5l5.9-1.4l1.7-1.5h0.1l5.1-3.2l6.4,1.5l3.8-4.8l3-9.1l4.7-4.2l5.2,4l1.3,4.2l2.4,1.6 l-0.5,3l2.6,5.1v0.1l4.2,4.5l2.9,8.8l-0.5,8.7L430.8,440.7z">
                                    </path> @endif
                                    @if ($departement[11]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Aveyron" data-nom="Aveyron" data-numerodepartement="12" class="region-76 departement departement-12 departement-aveyron" d="m430.8,440.7l9.4,4.5l-2,3.9l-2.8,1.1l8.4,4.1 l-4.3,5.3l0.3,1.5l-3.7,1l-3,5.3l-6.3-1.3l-0.1,8.7l-5.7-0.1l-1.3-2.8l-11.1-1.3l-4.2-5l-4.3-11.5l-4.8-4.3L385,444l-6.1,2.8 l-4.3-3.6l2.3-2.4l-3.1-2.7l0.4-3l-0.8-9.1l7.6-5l5.9-1.4l1.7-1.5h0.1l5.1-3.2l6.4,1.5l3.8-4.8l3-9.1l4.7-4.2l5.2,4l1.3,4.2l2.4,1.6 l-0.5,3l2.6,5.1v0.1l4.2,4.5l2.9,8.8l-0.5,8.7L430.8,440.7z">
                                    </path> @endif
                                    @if ($departement[11]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Aveyron" data-nom="Aveyron" data-numerodepartement="12" class="region-76 departement departement-12 departement-aveyron" d="m430.8,440.7l9.4,4.5l-2,3.9l-2.8,1.1l8.4,4.1 l-4.3,5.3l0.3,1.5l-3.7,1l-3,5.3l-6.3-1.3l-0.1,8.7l-5.7-0.1l-1.3-2.8l-11.1-1.3l-4.2-5l-4.3-11.5l-4.8-4.3L385,444l-6.1,2.8 l-4.3-3.6l2.3-2.4l-3.1-2.7l0.4-3l-0.8-9.1l7.6-5l5.9-1.4l1.7-1.5h0.1l5.1-3.2l6.4,1.5l3.8-4.8l3-9.1l4.7-4.2l5.2,4l1.3,4.2l2.4,1.6 l-0.5,3l2.6,5.1v0.1l4.2,4.5l2.9,8.8l-0.5,8.7L430.8,440.7z">
                                    </path> @endif
                                    @if ($departement[11]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Aveyron" data-nom="Aveyron" data-numerodepartement="12" class="region-76 departement departement-12 departement-aveyron" d="m430.8,440.7l9.4,4.5l-2,3.9l-2.8,1.1l8.4,4.1 l-4.3,5.3l0.3,1.5l-3.7,1l-3,5.3l-6.3-1.3l-0.1,8.7l-5.7-0.1l-1.3-2.8l-11.1-1.3l-4.2-5l-4.3-11.5l-4.8-4.3L385,444l-6.1,2.8 l-4.3-3.6l2.3-2.4l-3.1-2.7l0.4-3l-0.8-9.1l7.6-5l5.9-1.4l1.7-1.5h0.1l5.1-3.2l6.4,1.5l3.8-4.8l3-9.1l4.7-4.2l5.2,4l1.3,4.2l2.4,1.6 l-0.5,3l2.6,5.1v0.1l4.2,4.5l2.9,8.8l-0.5,8.7L430.8,440.7z">
                                    </path> @endif


                                    @if ($departement[30]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Gard" data-nom="Gard" data-numerodepartement="30" class="region-76 departement departement-30 departement-gard" d="m480,487.2l-2.8-0.6l-1.9-1.6l-1.1-3.4h-0.1 l3.3-4.4l-1.5-3l-6.1-6.7l-3-0.2l-0.2-3l-6.8-1.4l0.9-2.7l-1.9-2.6l-3.9,0.6l-4.2,3.9l-0.1,2.8l-5.3-2.5l-2.2,1.7l-0.4-2.9l-2.9-0.1 l-0.3-1.5l4.3-5.3l-8.4-4.1l2.8-1.1l2-3.9l7.8,3.4l3.9-0.5l0.1-3.3l8.7,2.2l6.3-1.8l-1.4-3l1.2-2.9l-3.9-7.7l3.6-2.5l1.1-2.1 l2.7,5.9l7.8,5l7.1-4.3l0.1,3.1l2.5-2.3h2.8l6,3.5l2.6,4.4l0.2,5.5l6.3,6.4l-4.5,5l-3.9,4.1l-1.9,10.6l-3.3-0.9l-4.2,4.8l1,2.7 l-5.8,1.8L480,487.2z">
                                        </path>
                                        @endif
                                        @if ($departement[30]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Gard" data-nom="Gard" data-numerodepartement="30" class="region-76 departement departement-30 departement-gard" d="m480,487.2l-2.8-0.6l-1.9-1.6l-1.1-3.4h-0.1 l3.3-4.4l-1.5-3l-6.1-6.7l-3-0.2l-0.2-3l-6.8-1.4l0.9-2.7l-1.9-2.6l-3.9,0.6l-4.2,3.9l-0.1,2.8l-5.3-2.5l-2.2,1.7l-0.4-2.9l-2.9-0.1 l-0.3-1.5l4.3-5.3l-8.4-4.1l2.8-1.1l2-3.9l7.8,3.4l3.9-0.5l0.1-3.3l8.7,2.2l6.3-1.8l-1.4-3l1.2-2.9l-3.9-7.7l3.6-2.5l1.1-2.1 l2.7,5.9l7.8,5l7.1-4.3l0.1,3.1l2.5-2.3h2.8l6,3.5l2.6,4.4l0.2,5.5l6.3,6.4l-4.5,5l-3.9,4.1l-1.9,10.6l-3.3-0.9l-4.2,4.8l1,2.7 l-5.8,1.8L480,487.2z">
                                        </path> @endif
                                        @if ($departement[30]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Gard" data-nom="Gard" data-numerodepartement="30" class="region-76 departement departement-30 departement-gard" d="m480,487.2l-2.8-0.6l-1.9-1.6l-1.1-3.4h-0.1 l3.3-4.4l-1.5-3l-6.1-6.7l-3-0.2l-0.2-3l-6.8-1.4l0.9-2.7l-1.9-2.6l-3.9,0.6l-4.2,3.9l-0.1,2.8l-5.3-2.5l-2.2,1.7l-0.4-2.9l-2.9-0.1 l-0.3-1.5l4.3-5.3l-8.4-4.1l2.8-1.1l2-3.9l7.8,3.4l3.9-0.5l0.1-3.3l8.7,2.2l6.3-1.8l-1.4-3l1.2-2.9l-3.9-7.7l3.6-2.5l1.1-2.1 l2.7,5.9l7.8,5l7.1-4.3l0.1,3.1l2.5-2.3h2.8l6,3.5l2.6,4.4l0.2,5.5l6.3,6.4l-4.5,5l-3.9,4.1l-1.9,10.6l-3.3-0.9l-4.2,4.8l1,2.7 l-5.8,1.8L480,487.2z">
                                        </path> @endif
                                        @if ($departement[30]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Gard" data-nom="Gard" data-numerodepartement="30" class="region-76 departement departement-30 departement-gard" d="m480,487.2l-2.8-0.6l-1.9-1.6l-1.1-3.4h-0.1 l3.3-4.4l-1.5-3l-6.1-6.7l-3-0.2l-0.2-3l-6.8-1.4l0.9-2.7l-1.9-2.6l-3.9,0.6l-4.2,3.9l-0.1,2.8l-5.3-2.5l-2.2,1.7l-0.4-2.9l-2.9-0.1 l-0.3-1.5l4.3-5.3l-8.4-4.1l2.8-1.1l2-3.9l7.8,3.4l3.9-0.5l0.1-3.3l8.7,2.2l6.3-1.8l-1.4-3l1.2-2.9l-3.9-7.7l3.6-2.5l1.1-2.1 l2.7,5.9l7.8,5l7.1-4.3l0.1,3.1l2.5-2.3h2.8l6,3.5l2.6,4.4l0.2,5.5l6.3,6.4l-4.5,5l-3.9,4.1l-1.9,10.6l-3.3-0.9l-4.2,4.8l1,2.7 l-5.8,1.8L480,487.2z">
                                        </path> @endif
                                        @if ($departement[30]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Gard" data-nom="Gard" data-numerodepartement="30" class="region-76 departement departement-30 departement-gard" d="m480,487.2l-2.8-0.6l-1.9-1.6l-1.1-3.4h-0.1 l3.3-4.4l-1.5-3l-6.1-6.7l-3-0.2l-0.2-3l-6.8-1.4l0.9-2.7l-1.9-2.6l-3.9,0.6l-4.2,3.9l-0.1,2.8l-5.3-2.5l-2.2,1.7l-0.4-2.9l-2.9-0.1 l-0.3-1.5l4.3-5.3l-8.4-4.1l2.8-1.1l2-3.9l7.8,3.4l3.9-0.5l0.1-3.3l8.7,2.2l6.3-1.8l-1.4-3l1.2-2.9l-3.9-7.7l3.6-2.5l1.1-2.1 l2.7,5.9l7.8,5l7.1-4.3l0.1,3.1l2.5-2.3h2.8l6,3.5l2.6,4.4l0.2,5.5l6.3,6.4l-4.5,5l-3.9,4.1l-1.9,10.6l-3.3-0.9l-4.2,4.8l1,2.7 l-5.8,1.8L480,487.2z">
                                        </path> @endif


                                        @if ($departement[31]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Haute-Garonne" data-nom="Haute-Garonne" data-numerodepartement="31" class="region-76 departement departement-31 departement-haute-garonne" d="m326.8,526.2l-5.5-1.5l-1.2,2.4l0.2,7.6 l-8.8-0.7l-1.7,0.3l-0.6-7l5.5-3.2l2.6-5.3l-0.8-2.7l-3.1,0.3l0.6-3.5l-4.6-4l7.1-11.2l3.1-1.1l3.5-5.3l11.4,2.5l0.7-5.8l6.5-6.1 l-9.1-13.3l9.9-0.9l1.7,2.3l5.8-2.5l-2.2-2.3l11.7-4.3l1.4,6.3l2.6,1.2l0.2,2.8l2.3,2.1l-0.7,5.4l14.3,9.3l1,2.8l-0.5,0.8l-5.2,1.8 l-1.4-2.7l-8.4,10l-2,2.3l-5.7-2.2l-0.6,2.8l-2.8,0.5l-3.4-5.5l-2.8,1.1l3,4.8l-5.4,1.6l0.4,5.6l-6.2-4.1l-2.8,1.1l-3.9,4v5.9 l-2.8,1l-3.8,5.2L326.8,526.2z">
                                            </path>
                                            @endif
                                            @if ($departement[31]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Haute-Garonne" data-nom="Haute-Garonne" data-numerodepartement="31" class="region-76 departement departement-31 departement-haute-garonne" d="m326.8,526.2l-5.5-1.5l-1.2,2.4l0.2,7.6 l-8.8-0.7l-1.7,0.3l-0.6-7l5.5-3.2l2.6-5.3l-0.8-2.7l-3.1,0.3l0.6-3.5l-4.6-4l7.1-11.2l3.1-1.1l3.5-5.3l11.4,2.5l0.7-5.8l6.5-6.1 l-9.1-13.3l9.9-0.9l1.7,2.3l5.8-2.5l-2.2-2.3l11.7-4.3l1.4,6.3l2.6,1.2l0.2,2.8l2.3,2.1l-0.7,5.4l14.3,9.3l1,2.8l-0.5,0.8l-5.2,1.8 l-1.4-2.7l-8.4,10l-2,2.3l-5.7-2.2l-0.6,2.8l-2.8,0.5l-3.4-5.5l-2.8,1.1l3,4.8l-5.4,1.6l0.4,5.6l-6.2-4.1l-2.8,1.1l-3.9,4v5.9 l-2.8,1l-3.8,5.2L326.8,526.2z">
                                            </path> @endif
                                            @if ($departement[31]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Haute-Garonne" data-nom="Haute-Garonne" data-numerodepartement="31" class="region-76 departement departement-31 departement-haute-garonne" d="m326.8,526.2l-5.5-1.5l-1.2,2.4l0.2,7.6 l-8.8-0.7l-1.7,0.3l-0.6-7l5.5-3.2l2.6-5.3l-0.8-2.7l-3.1,0.3l0.6-3.5l-4.6-4l7.1-11.2l3.1-1.1l3.5-5.3l11.4,2.5l0.7-5.8l6.5-6.1 l-9.1-13.3l9.9-0.9l1.7,2.3l5.8-2.5l-2.2-2.3l11.7-4.3l1.4,6.3l2.6,1.2l0.2,2.8l2.3,2.1l-0.7,5.4l14.3,9.3l1,2.8l-0.5,0.8l-5.2,1.8 l-1.4-2.7l-8.4,10l-2,2.3l-5.7-2.2l-0.6,2.8l-2.8,0.5l-3.4-5.5l-2.8,1.1l3,4.8l-5.4,1.6l0.4,5.6l-6.2-4.1l-2.8,1.1l-3.9,4v5.9 l-2.8,1l-3.8,5.2L326.8,526.2z">
                                            </path> @endif
                                            @if ($departement[31]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Haute-Garonne" data-nom="Haute-Garonne" data-numerodepartement="31" class="region-76 departement departement-31 departement-haute-garonne" d="m326.8,526.2l-5.5-1.5l-1.2,2.4l0.2,7.6 l-8.8-0.7l-1.7,0.3l-0.6-7l5.5-3.2l2.6-5.3l-0.8-2.7l-3.1,0.3l0.6-3.5l-4.6-4l7.1-11.2l3.1-1.1l3.5-5.3l11.4,2.5l0.7-5.8l6.5-6.1 l-9.1-13.3l9.9-0.9l1.7,2.3l5.8-2.5l-2.2-2.3l11.7-4.3l1.4,6.3l2.6,1.2l0.2,2.8l2.3,2.1l-0.7,5.4l14.3,9.3l1,2.8l-0.5,0.8l-5.2,1.8 l-1.4-2.7l-8.4,10l-2,2.3l-5.7-2.2l-0.6,2.8l-2.8,0.5l-3.4-5.5l-2.8,1.1l3,4.8l-5.4,1.6l0.4,5.6l-6.2-4.1l-2.8,1.1l-3.9,4v5.9 l-2.8,1l-3.8,5.2L326.8,526.2z">
                                            </path> @endif
                                            @if ($departement[31]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Haute-Garonne" data-nom="Haute-Garonne" data-numerodepartement="31" class="region-76 departement departement-31 departement-haute-garonne" d="m326.8,526.2l-5.5-1.5l-1.2,2.4l0.2,7.6 l-8.8-0.7l-1.7,0.3l-0.6-7l5.5-3.2l2.6-5.3l-0.8-2.7l-3.1,0.3l0.6-3.5l-4.6-4l7.1-11.2l3.1-1.1l3.5-5.3l11.4,2.5l0.7-5.8l6.5-6.1 l-9.1-13.3l9.9-0.9l1.7,2.3l5.8-2.5l-2.2-2.3l11.7-4.3l1.4,6.3l2.6,1.2l0.2,2.8l2.3,2.1l-0.7,5.4l14.3,9.3l1,2.8l-0.5,0.8l-5.2,1.8 l-1.4-2.7l-8.4,10l-2,2.3l-5.7-2.2l-0.6,2.8l-2.8,0.5l-3.4-5.5l-2.8,1.1l3,4.8l-5.4,1.6l0.4,5.6l-6.2-4.1l-2.8,1.1l-3.9,4v5.9 l-2.8,1l-3.8,5.2L326.8,526.2z">
                                            </path> @endif


                                            @if ($departement[32]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Gers" data-nom="Gers" data-numerodepartement="32" class="region-76 departement departement-32 departement-gers" d="m330.6,461.7l2,6.9l9.1,13.3l-6.5,6.1l-0.7,5.8 l-11.4-2.5l-3.5,5.3l-3.1,1.1l-12.4-2.2l-1.4-3l-5.5,0.6l-2.6-8.7l-3.3-1.3l-2-3.5l-3.9,0.5l-6.6-0.3l-1.6-2.7l4.2-11.1l-0.5-6.4 l9.4-2.7l0.6,3l2.5-1.3l0.4-2.9v-0.1l3.7,0.7l1.4-2.5l8.3,0.7l5-2.9l8.6,1l2.7-1.3l5.3,1.7l-3.3,4.6L330.6,461.7z">
                                                </path>
                                                @endif
                                                @if ($departement[32]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Gers" data-nom="Gers" data-numerodepartement="32" class="region-76 departement departement-32 departement-gers" d="m330.6,461.7l2,6.9l9.1,13.3l-6.5,6.1l-0.7,5.8 l-11.4-2.5l-3.5,5.3l-3.1,1.1l-12.4-2.2l-1.4-3l-5.5,0.6l-2.6-8.7l-3.3-1.3l-2-3.5l-3.9,0.5l-6.6-0.3l-1.6-2.7l4.2-11.1l-0.5-6.4 l9.4-2.7l0.6,3l2.5-1.3l0.4-2.9v-0.1l3.7,0.7l1.4-2.5l8.3,0.7l5-2.9l8.6,1l2.7-1.3l5.3,1.7l-3.3,4.6L330.6,461.7z">
                                                </path> @endif
                                                @if ($departement[32]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Gers" data-nom="Gers" data-numerodepartement="32" class="region-76 departement departement-32 departement-gers" d="m330.6,461.7l2,6.9l9.1,13.3l-6.5,6.1l-0.7,5.8 l-11.4-2.5l-3.5,5.3l-3.1,1.1l-12.4-2.2l-1.4-3l-5.5,0.6l-2.6-8.7l-3.3-1.3l-2-3.5l-3.9,0.5l-6.6-0.3l-1.6-2.7l4.2-11.1l-0.5-6.4 l9.4-2.7l0.6,3l2.5-1.3l0.4-2.9v-0.1l3.7,0.7l1.4-2.5l8.3,0.7l5-2.9l8.6,1l2.7-1.3l5.3,1.7l-3.3,4.6L330.6,461.7z">
                                                </path> @endif
                                                @if ($departement[32]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Gers" data-nom="Gers" data-numerodepartement="32" class="region-76 departement departement-32 departement-gers" d="m330.6,461.7l2,6.9l9.1,13.3l-6.5,6.1l-0.7,5.8 l-11.4-2.5l-3.5,5.3l-3.1,1.1l-12.4-2.2l-1.4-3l-5.5,0.6l-2.6-8.7l-3.3-1.3l-2-3.5l-3.9,0.5l-6.6-0.3l-1.6-2.7l4.2-11.1l-0.5-6.4 l9.4-2.7l0.6,3l2.5-1.3l0.4-2.9v-0.1l3.7,0.7l1.4-2.5l8.3,0.7l5-2.9l8.6,1l2.7-1.3l5.3,1.7l-3.3,4.6L330.6,461.7z">
                                                </path> @endif
                                                @if ($departement[32]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Gers" data-nom="Gers" data-numerodepartement="32" class="region-76 departement departement-32 departement-gers" d="m330.6,461.7l2,6.9l9.1,13.3l-6.5,6.1l-0.7,5.8 l-11.4-2.5l-3.5,5.3l-3.1,1.1l-12.4-2.2l-1.4-3l-5.5,0.6l-2.6-8.7l-3.3-1.3l-2-3.5l-3.9,0.5l-6.6-0.3l-1.6-2.7l4.2-11.1l-0.5-6.4 l9.4-2.7l0.6,3l2.5-1.3l0.4-2.9v-0.1l3.7,0.7l1.4-2.5l8.3,0.7l5-2.9l8.6,1l2.7-1.3l5.3,1.7l-3.3,4.6L330.6,461.7z">
                                                </path> @endif

                                                @if ($departement[34]->hospitalises
                                                <= 50) <path class="region" style="fill: green" id="Hérault" data-nom="Hérault" data-numerodepartement="34" class="region-76 departement departement-34 departement-herault" d="m474.1,481.6l-2.4-0.1l-5.9,2.6l-3.6,3.2 l-7.2,4.6l-4.3,4.2l2.1-3.5l-4.3,6.6h-6.8l-5.5,4l-1.13,1.17l-0.17-0.17l-1.7-2l-13.8-4.7l-1-2.9l-3.8,5.3l-3.1,0.8l-1.4-2.9 l-2.5,1.6l-3.5-5l0.5-2.8l3.4-2l0.8-3l-0.7-9.7l6.1,2.2c2.3-1.5,4.6-2.9,6.8-4.4l5.7,0.1l0.1-8.7l6.3,1.3l3-5.3l3.7-1l2.9,0.1 l0.4,2.9l2.2-1.7l5.3,2.5l0.1-2.8l4.2-3.9l3.9-0.6l1.9,2.6l-0.9,2.7l6.8,1.4l0.2,3l3,0.2l6.1,6.7l1.5,3L474.1,481.6z">
                                                    </path>
                                                    @endif
                                                    @if ($departement[34]->hospitalises > 50)
                                                    <path class="region" style="fill: yellow" id="Hérault" data-nom="Hérault" data-numerodepartement="34" class="region-76 departement departement-34 departement-herault" d="m474.1,481.6l-2.4-0.1l-5.9,2.6l-3.6,3.2 l-7.2,4.6l-4.3,4.2l2.1-3.5l-4.3,6.6h-6.8l-5.5,4l-1.13,1.17l-0.17-0.17l-1.7-2l-13.8-4.7l-1-2.9l-3.8,5.3l-3.1,0.8l-1.4-2.9 l-2.5,1.6l-3.5-5l0.5-2.8l3.4-2l0.8-3l-0.7-9.7l6.1,2.2c2.3-1.5,4.6-2.9,6.8-4.4l5.7,0.1l0.1-8.7l6.3,1.3l3-5.3l3.7-1l2.9,0.1 l0.4,2.9l2.2-1.7l5.3,2.5l0.1-2.8l4.2-3.9l3.9-0.6l1.9,2.6l-0.9,2.7l6.8,1.4l0.2,3l3,0.2l6.1,6.7l1.5,3L474.1,481.6z">
                                                    </path> @endif
                                                    @if ($departement[34]->hospitalises >= 150)
                                                    <path class="region" style="fill: pink" id="Hérault" data-nom="Hérault" data-numerodepartement="34" class="region-76 departement departement-34 departement-herault" d="m474.1,481.6l-2.4-0.1l-5.9,2.6l-3.6,3.2 l-7.2,4.6l-4.3,4.2l2.1-3.5l-4.3,6.6h-6.8l-5.5,4l-1.13,1.17l-0.17-0.17l-1.7-2l-13.8-4.7l-1-2.9l-3.8,5.3l-3.1,0.8l-1.4-2.9 l-2.5,1.6l-3.5-5l0.5-2.8l3.4-2l0.8-3l-0.7-9.7l6.1,2.2c2.3-1.5,4.6-2.9,6.8-4.4l5.7,0.1l0.1-8.7l6.3,1.3l3-5.3l3.7-1l2.9,0.1 l0.4,2.9l2.2-1.7l5.3,2.5l0.1-2.8l4.2-3.9l3.9-0.6l1.9,2.6l-0.9,2.7l6.8,1.4l0.2,3l3,0.2l6.1,6.7l1.5,3L474.1,481.6z">
                                                    </path> @endif
                                                    @if ($departement[34]->hospitalises >= 250)
                                                    <path class="region" style="fill: purple" id="Hérault" data-nom="Hérault" data-numerodepartement="34" class="region-76 departement departement-34 departement-herault" d="m474.1,481.6l-2.4-0.1l-5.9,2.6l-3.6,3.2 l-7.2,4.6l-4.3,4.2l2.1-3.5l-4.3,6.6h-6.8l-5.5,4l-1.13,1.17l-0.17-0.17l-1.7-2l-13.8-4.7l-1-2.9l-3.8,5.3l-3.1,0.8l-1.4-2.9 l-2.5,1.6l-3.5-5l0.5-2.8l3.4-2l0.8-3l-0.7-9.7l6.1,2.2c2.3-1.5,4.6-2.9,6.8-4.4l5.7,0.1l0.1-8.7l6.3,1.3l3-5.3l3.7-1l2.9,0.1 l0.4,2.9l2.2-1.7l5.3,2.5l0.1-2.8l4.2-3.9l3.9-0.6l1.9,2.6l-0.9,2.7l6.8,1.4l0.2,3l3,0.2l6.1,6.7l1.5,3L474.1,481.6z">
                                                    </path> @endif
                                                    @if ($departement[34]->hospitalises >= 400)
                                                    <path class="region" style="fill: red" id="Hérault" data-nom="Hérault" data-numerodepartement="34" class="region-76 departement departement-34 departement-herault" d="m474.1,481.6l-2.4-0.1l-5.9,2.6l-3.6,3.2 l-7.2,4.6l-4.3,4.2l2.1-3.5l-4.3,6.6h-6.8l-5.5,4l-1.13,1.17l-0.17-0.17l-1.7-2l-13.8-4.7l-1-2.9l-3.8,5.3l-3.1,0.8l-1.4-2.9 l-2.5,1.6l-3.5-5l0.5-2.8l3.4-2l0.8-3l-0.7-9.7l6.1,2.2c2.3-1.5,4.6-2.9,6.8-4.4l5.7,0.1l0.1-8.7l6.3,1.3l3-5.3l3.7-1l2.9,0.1 l0.4,2.9l2.2-1.7l5.3,2.5l0.1-2.8l4.2-3.9l3.9-0.6l1.9,2.6l-0.9,2.7l6.8,1.4l0.2,3l3,0.2l6.1,6.7l1.5,3L474.1,481.6z">
                                                    </path> @endif


                                                    @if ($departement[46]->hospitalises
                                                    <= 50) <path class="region" style="fill: green" id="Lot" data-nom="Lot" data-numerodepartement="46" class="region-76 departement departement-46 departement-lot" d="m385.4,413.1l3.3,5h-0.1l-1.7,1.5L381,421 l-7.6,5l0.8,9.1l-6.2,0.8l-7.5,5.5l-2.6-2.3l-8.7,2.5l-0.5-4l-2.4,1.5l-2.7-1l-4.5-4l2.1-2.3l-3.1,0.5l-2.7-9.1l3.4-3.1l4.7-6.5 l6-3.4l-0.6-3.6l4.5-3.2l1.4-5.3l0.7-5l8.1-0.8l6.7,6.1l5.3-2.7l6.7,0.2l1,5.4l3.8,6L385.4,413.1z">
                                                        </path>
                                                        @endif
                                                        @if ($departement[46]->hospitalises > 50)
                                                        <path class="region" style="fill: yellow" id="Lot" data-nom="Lot" data-numerodepartement="46" class="region-76 departement departement-46 departement-lot" d="m385.4,413.1l3.3,5h-0.1l-1.7,1.5L381,421 l-7.6,5l0.8,9.1l-6.2,0.8l-7.5,5.5l-2.6-2.3l-8.7,2.5l-0.5-4l-2.4,1.5l-2.7-1l-4.5-4l2.1-2.3l-3.1,0.5l-2.7-9.1l3.4-3.1l4.7-6.5 l6-3.4l-0.6-3.6l4.5-3.2l1.4-5.3l0.7-5l8.1-0.8l6.7,6.1l5.3-2.7l6.7,0.2l1,5.4l3.8,6L385.4,413.1z">
                                                        </path> @endif
                                                        @if ($departement[46]->hospitalises >= 150)
                                                        <path class="region" style="fill: pink" id="Lot" data-nom="Lot" data-numerodepartement="46" class="region-76 departement departement-46 departement-lot" d="m385.4,413.1l3.3,5h-0.1l-1.7,1.5L381,421 l-7.6,5l0.8,9.1l-6.2,0.8l-7.5,5.5l-2.6-2.3l-8.7,2.5l-0.5-4l-2.4,1.5l-2.7-1l-4.5-4l2.1-2.3l-3.1,0.5l-2.7-9.1l3.4-3.1l4.7-6.5 l6-3.4l-0.6-3.6l4.5-3.2l1.4-5.3l0.7-5l8.1-0.8l6.7,6.1l5.3-2.7l6.7,0.2l1,5.4l3.8,6L385.4,413.1z">
                                                        </path> @endif
                                                        @if ($departement[46]->hospitalises >= 250)
                                                        <path class="region" style="fill: purple" id="Lot" data-nom="Lot" data-numerodepartement="46" class="region-76 departement departement-46 departement-lot" d="m385.4,413.1l3.3,5h-0.1l-1.7,1.5L381,421 l-7.6,5l0.8,9.1l-6.2,0.8l-7.5,5.5l-2.6-2.3l-8.7,2.5l-0.5-4l-2.4,1.5l-2.7-1l-4.5-4l2.1-2.3l-3.1,0.5l-2.7-9.1l3.4-3.1l4.7-6.5 l6-3.4l-0.6-3.6l4.5-3.2l1.4-5.3l0.7-5l8.1-0.8l6.7,6.1l5.3-2.7l6.7,0.2l1,5.4l3.8,6L385.4,413.1z">
                                                        </path> @endif
                                                        @if ($departement[46]->hospitalises >= 400)
                                                        <path class="region" style="fill: red" id="Lot" data-nom="Lot" data-numerodepartement="46" class="region-76 departement departement-46 departement-lot" d="m385.4,413.1l3.3,5h-0.1l-1.7,1.5L381,421 l-7.6,5l0.8,9.1l-6.2,0.8l-7.5,5.5l-2.6-2.3l-8.7,2.5l-0.5-4l-2.4,1.5l-2.7-1l-4.5-4l2.1-2.3l-3.1,0.5l-2.7-9.1l3.4-3.1l4.7-6.5 l6-3.4l-0.6-3.6l4.5-3.2l1.4-5.3l0.7-5l8.1-0.8l6.7,6.1l5.3-2.7l6.7,0.2l1,5.4l3.8,6L385.4,413.1z">
                                                        </path> @endif


                                                        @if ($departement[48]->hospitalises
                                                        <= 50) <path class="region" style="fill: green" id="Lozère" data-nom="Lozère" data-numerodepartement="48" class="region-76 departement departement-48 departement-lozere" d="m463.4,418.7l4.2,8.3l-1.1,2.1l-3.6,2.5 l3.9,7.7l-1.2,2.9l1.4,3l-6.3,1.8l-8.7-2.2l-0.1,3.3l-3.9,0.5l-7.8-3.4l-9.4-4.5l-1.5-2.4l0.5-8.7l-2.9-8.8l-4.2-4.5v-0.1l6.9-15.9 l1.7,2.3l6.8-5.7l1-1l2.3,1.7l1.5,5.7l6.4,1.2l0.1-2.8l2.9,0.2l9,7.7L463.4,418.7z">
                                                            </path>
                                                            @endif
                                                            @if ($departement[48]->hospitalises > 50)
                                                            <path class="region" style="fill: yellow" id="Lozère" data-nom="Lozère" data-numerodepartement="48" class="region-76 departement departement-48 departement-lozere" d="m463.4,418.7l4.2,8.3l-1.1,2.1l-3.6,2.5 l3.9,7.7l-1.2,2.9l1.4,3l-6.3,1.8l-8.7-2.2l-0.1,3.3l-3.9,0.5l-7.8-3.4l-9.4-4.5l-1.5-2.4l0.5-8.7l-2.9-8.8l-4.2-4.5v-0.1l6.9-15.9 l1.7,2.3l6.8-5.7l1-1l2.3,1.7l1.5,5.7l6.4,1.2l0.1-2.8l2.9,0.2l9,7.7L463.4,418.7z">
                                                            </path> @endif
                                                            @if ($departement[48]->hospitalises >= 150)
                                                            <path class="region" style="fill: pink" id="Lozère" data-nom="Lozère" data-numerodepartement="48" class="region-76 departement departement-48 departement-lozere" d="m463.4,418.7l4.2,8.3l-1.1,2.1l-3.6,2.5 l3.9,7.7l-1.2,2.9l1.4,3l-6.3,1.8l-8.7-2.2l-0.1,3.3l-3.9,0.5l-7.8-3.4l-9.4-4.5l-1.5-2.4l0.5-8.7l-2.9-8.8l-4.2-4.5v-0.1l6.9-15.9 l1.7,2.3l6.8-5.7l1-1l2.3,1.7l1.5,5.7l6.4,1.2l0.1-2.8l2.9,0.2l9,7.7L463.4,418.7z">
                                                            </path> @endif
                                                            @if ($departement[48]->hospitalises >= 250)
                                                            <path class="region" style="fill: purple" id="Lozère" data-nom="Lozère" data-numerodepartement="48" class="region-76 departement departement-48 departement-lozere" d="m463.4,418.7l4.2,8.3l-1.1,2.1l-3.6,2.5 l3.9,7.7l-1.2,2.9l1.4,3l-6.3,1.8l-8.7-2.2l-0.1,3.3l-3.9,0.5l-7.8-3.4l-9.4-4.5l-1.5-2.4l0.5-8.7l-2.9-8.8l-4.2-4.5v-0.1l6.9-15.9 l1.7,2.3l6.8-5.7l1-1l2.3,1.7l1.5,5.7l6.4,1.2l0.1-2.8l2.9,0.2l9,7.7L463.4,418.7z">
                                                            </path> @endif
                                                            @if ($departement[48]->hospitalises >= 400)
                                                            <path class="region" style="fill: red" id="Lozère" data-nom="Lozère" data-numerodepartement="48" class="region-76 departement departement-48 departement-lozere" d="m463.4,418.7l4.2,8.3l-1.1,2.1l-3.6,2.5 l3.9,7.7l-1.2,2.9l1.4,3l-6.3,1.8l-8.7-2.2l-0.1,3.3l-3.9,0.5l-7.8-3.4l-9.4-4.5l-1.5-2.4l0.5-8.7l-2.9-8.8l-4.2-4.5v-0.1l6.9-15.9 l1.7,2.3l6.8-5.7l1-1l2.3,1.7l1.5,5.7l6.4,1.2l0.1-2.8l2.9,0.2l9,7.7L463.4,418.7z">
                                                            </path>@endif


                                                            @if ($departement[65]->hospitalises
                                                            <= 50) <path class="region" style="fill: green" id="Hautes-Pyrénées" data-nom="Hautes-Pyrénées" data-numerodepartement="65" class="region-76 departement departement-65 departement-hautes-pyrenees" d="m314.7,524.1l-5.5,3.2l0.6,7l-0.7,0.2l-2.3-1.6 l-2.4,1.8l-2.5-0.5l-1.9-1.7l-3.9-0.3l-6.9,2.1l-2.2-0.9l-2.1-1.7l-1.1-2.5l-7.8-5.5l-2.11,1.84l1.41-9.34l1.6-2.8l3.4-0.8l-0.4-2.9 l8-9.3l-0.8-3.1l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l3.9-0.5l2,3.5l3.3,1.3l2.6,8.7l5.5-0.6l1.4,3l12.4,2.2l-7.1,11.2l4.6,4 l-0.6,3.5l3.1-0.3l0.8,2.7L314.7,524.1z">
                                                                </path>
                                                                @endif
                                                                @if ($departement[65]->hospitalises > 50)
                                                                <path class="region" style="fill: yellow" id="Hautes-Pyrénées" data-nom="Hautes-Pyrénées" data-numerodepartement="65" class="region-76 departement departement-65 departement-hautes-pyrenees" d="m314.7,524.1l-5.5,3.2l0.6,7l-0.7,0.2l-2.3-1.6 l-2.4,1.8l-2.5-0.5l-1.9-1.7l-3.9-0.3l-6.9,2.1l-2.2-0.9l-2.1-1.7l-1.1-2.5l-7.8-5.5l-2.11,1.84l1.41-9.34l1.6-2.8l3.4-0.8l-0.4-2.9 l8-9.3l-0.8-3.1l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l3.9-0.5l2,3.5l3.3,1.3l2.6,8.7l5.5-0.6l1.4,3l12.4,2.2l-7.1,11.2l4.6,4 l-0.6,3.5l3.1-0.3l0.8,2.7L314.7,524.1z">
                                                                </path> @endif
                                                                @if ($departement[65]->hospitalises >= 150)
                                                                <path class="region" style="fill: pink" id="Hautes-Pyrénées" data-nom="Hautes-Pyrénées" data-numerodepartement="65" class="region-76 departement departement-65 departement-hautes-pyrenees" d="m314.7,524.1l-5.5,3.2l0.6,7l-0.7,0.2l-2.3-1.6 l-2.4,1.8l-2.5-0.5l-1.9-1.7l-3.9-0.3l-6.9,2.1l-2.2-0.9l-2.1-1.7l-1.1-2.5l-7.8-5.5l-2.11,1.84l1.41-9.34l1.6-2.8l3.4-0.8l-0.4-2.9 l8-9.3l-0.8-3.1l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l3.9-0.5l2,3.5l3.3,1.3l2.6,8.7l5.5-0.6l1.4,3l12.4,2.2l-7.1,11.2l4.6,4 l-0.6,3.5l3.1-0.3l0.8,2.7L314.7,524.1z">
                                                                </path> @endif
                                                                @if ($departement[65]->hospitalises >= 250)
                                                                <path class="region" style="fill: purple" id="Hautes-Pyrénées" data-nom="Hautes-Pyrénées" data-numerodepartement="65" class="region-76 departement departement-65 departement-hautes-pyrenees" d="m314.7,524.1l-5.5,3.2l0.6,7l-0.7,0.2l-2.3-1.6 l-2.4,1.8l-2.5-0.5l-1.9-1.7l-3.9-0.3l-6.9,2.1l-2.2-0.9l-2.1-1.7l-1.1-2.5l-7.8-5.5l-2.11,1.84l1.41-9.34l1.6-2.8l3.4-0.8l-0.4-2.9 l8-9.3l-0.8-3.1l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l3.9-0.5l2,3.5l3.3,1.3l2.6,8.7l5.5-0.6l1.4,3l12.4,2.2l-7.1,11.2l4.6,4 l-0.6,3.5l3.1-0.3l0.8,2.7L314.7,524.1z">
                                                                </path> @endif
                                                                @if ($departement[65]->hospitalises >= 400)
                                                                <path class="region" style="fill: red" id="Hautes-Pyrénées" data-nom="Hautes-Pyrénées" data-numerodepartement="65" class="region-76 departement departement-65 departement-hautes-pyrenees" d="m314.7,524.1l-5.5,3.2l0.6,7l-0.7,0.2l-2.3-1.6 l-2.4,1.8l-2.5-0.5l-1.9-1.7l-3.9-0.3l-6.9,2.1l-2.2-0.9l-2.1-1.7l-1.1-2.5l-7.8-5.5l-2.11,1.84l1.41-9.34l1.6-2.8l3.4-0.8l-0.4-2.9 l8-9.3l-0.8-3.1l2.7-1.4l-0.5-7.2h-2.9l1.5-2.8l-2.5-5.8l3.9-0.5l2,3.5l3.3,1.3l2.6,8.7l5.5-0.6l1.4,3l12.4,2.2l-7.1,11.2l4.6,4 l-0.6,3.5l3.1-0.3l0.8,2.7L314.7,524.1z">
                                                                </path> @endif


                                                                @if ($departement[66]->hospitalises
                                                                <= 50) <path class="region" style="fill: green" id="Pyrénées-Orientales" data-nom="Pyrénées-Orientales" data-numerodepartement="66" class="region-76 departement departement-66 departement-pyrenees-orientales" d="m427.65,528.27l0.25,15.63l3.9,3.3l1.9,3.8 h-2.3l-8.1-2.7l-6.9,3.9l-3-0.2l-2.4,1.1l-0.6,2.4l-2.1,1.2l-2.4-0.7l-2.9,1l-4-3.1l-7-2.9l-2.5,1.4h-3l-1,2.1l-4.6,2l-1.9-1.7 l-1.7-4.8l-7.5-2l-2-2.1l2.02-2.31l7.98-2.39l1.3-2.6l7.4-0.2l8.6-3.9l-1.4-6l2.7-1.4l13.6,1l8.2-5.4L427.65,528.27z">
                                                                    </path>
                                                                    @endif
                                                                    @if ($departement[66]->hospitalises > 50)
                                                                    <path class="region" style="fill: yellow" id="Pyrénées-Orientales" data-nom="Pyrénées-Orientales" data-numerodepartement="66" class="region-76 departement departement-66 departement-pyrenees-orientales" d="m427.65,528.27l0.25,15.63l3.9,3.3l1.9,3.8 h-2.3l-8.1-2.7l-6.9,3.9l-3-0.2l-2.4,1.1l-0.6,2.4l-2.1,1.2l-2.4-0.7l-2.9,1l-4-3.1l-7-2.9l-2.5,1.4h-3l-1,2.1l-4.6,2l-1.9-1.7 l-1.7-4.8l-7.5-2l-2-2.1l2.02-2.31l7.98-2.39l1.3-2.6l7.4-0.2l8.6-3.9l-1.4-6l2.7-1.4l13.6,1l8.2-5.4L427.65,528.27z">
                                                                    </path> @endif
                                                                    @if ($departement[66]->hospitalises >= 150)
                                                                    <path class="region" style="fill: pink" id="Pyrénées-Orientales" data-nom="Pyrénées-Orientales" data-numerodepartement="66" class="region-76 departement departement-66 departement-pyrenees-orientales" d="m427.65,528.27l0.25,15.63l3.9,3.3l1.9,3.8 h-2.3l-8.1-2.7l-6.9,3.9l-3-0.2l-2.4,1.1l-0.6,2.4l-2.1,1.2l-2.4-0.7l-2.9,1l-4-3.1l-7-2.9l-2.5,1.4h-3l-1,2.1l-4.6,2l-1.9-1.7 l-1.7-4.8l-7.5-2l-2-2.1l2.02-2.31l7.98-2.39l1.3-2.6l7.4-0.2l8.6-3.9l-1.4-6l2.7-1.4l13.6,1l8.2-5.4L427.65,528.27z">
                                                                    </path> @endif
                                                                    @if ($departement[66]->hospitalises >= 250)
                                                                    <path class="region" style="fill: purple" id="Pyrénées-Orientales" data-nom="Pyrénées-Orientales" data-numerodepartement="66" class="region-76 departement departement-66 departement-pyrenees-orientales" d="m427.65,528.27l0.25,15.63l3.9,3.3l1.9,3.8 h-2.3l-8.1-2.7l-6.9,3.9l-3-0.2l-2.4,1.1l-0.6,2.4l-2.1,1.2l-2.4-0.7l-2.9,1l-4-3.1l-7-2.9l-2.5,1.4h-3l-1,2.1l-4.6,2l-1.9-1.7 l-1.7-4.8l-7.5-2l-2-2.1l2.02-2.31l7.98-2.39l1.3-2.6l7.4-0.2l8.6-3.9l-1.4-6l2.7-1.4l13.6,1l8.2-5.4L427.65,528.27z">
                                                                    </path> @endif
                                                                    @if ($departement[66]->hospitalises >= 400)
                                                                    <path class="region" style="fill: red" id="Pyrénées-Orientales" data-nom="Pyrénées-Orientales" data-numerodepartement="66" class="region-76 departement departement-66 departement-pyrenees-orientales" d="m427.65,528.27l0.25,15.63l3.9,3.3l1.9,3.8 h-2.3l-8.1-2.7l-6.9,3.9l-3-0.2l-2.4,1.1l-0.6,2.4l-2.1,1.2l-2.4-0.7l-2.9,1l-4-3.1l-7-2.9l-2.5,1.4h-3l-1,2.1l-4.6,2l-1.9-1.7 l-1.7-4.8l-7.5-2l-2-2.1l2.02-2.31l7.98-2.39l1.3-2.6l7.4-0.2l8.6-3.9l-1.4-6l2.7-1.4l13.6,1l8.2-5.4L427.65,528.27z">
                                                                    </path> @endif


                                                                    @if ($departement[81]->hospitalises
                                                                    <= 50) <path class="region" style="fill: green" id="Tarn" data-nom="Tarn" data-numerodepartement="81" class="region-76 departement departement-81 departement-tarn" d="m419.7,471.9l1.3,2.8c-2.2,1.5-4.5,2.9-6.8,4.4 l-6.1-2.2l0.7,9.7l-0.8,3l-3.4,2l-12-1.4l-2.8,0.5l-1.1,3.3l-6.3-0.9l-1.8-2.3l-1-2.8l-14.3-9.3l0.7-5.4l-2.3-2.1l-0.2-2.8l-2.6-1.2 l-1.4-6.3l0.5-2.8l4.8-3.2l1-2.7L364,450l3-1.1l2.7,1.1l9.2-3.2l6.1-2.8l10.3,5.8l4.8,4.3l4.3,11.5l4.2,5L419.7,471.9z">
                                                                        </path>
                                                                        @endif
                                                                        @if ($departement[81]->hospitalises > 50)
                                                                        <path class="region" style="fill: yellow" id="Tarn" data-nom="Tarn" data-numerodepartement="81" class="region-76 departement departement-81 departement-tarn" d="m419.7,471.9l1.3,2.8c-2.2,1.5-4.5,2.9-6.8,4.4 l-6.1-2.2l0.7,9.7l-0.8,3l-3.4,2l-12-1.4l-2.8,0.5l-1.1,3.3l-6.3-0.9l-1.8-2.3l-1-2.8l-14.3-9.3l0.7-5.4l-2.3-2.1l-0.2-2.8l-2.6-1.2 l-1.4-6.3l0.5-2.8l4.8-3.2l1-2.7L364,450l3-1.1l2.7,1.1l9.2-3.2l6.1-2.8l10.3,5.8l4.8,4.3l4.3,11.5l4.2,5L419.7,471.9z">
                                                                        </path> @endif
                                                                        @if ($departement[81]->hospitalises >= 150)
                                                                        <path class="region" style="fill: pink" id="Tarn" data-nom="Tarn" data-numerodepartement="81" class="region-76 departement departement-81 departement-tarn" d="m419.7,471.9l1.3,2.8c-2.2,1.5-4.5,2.9-6.8,4.4 l-6.1-2.2l0.7,9.7l-0.8,3l-3.4,2l-12-1.4l-2.8,0.5l-1.1,3.3l-6.3-0.9l-1.8-2.3l-1-2.8l-14.3-9.3l0.7-5.4l-2.3-2.1l-0.2-2.8l-2.6-1.2 l-1.4-6.3l0.5-2.8l4.8-3.2l1-2.7L364,450l3-1.1l2.7,1.1l9.2-3.2l6.1-2.8l10.3,5.8l4.8,4.3l4.3,11.5l4.2,5L419.7,471.9z">
                                                                        </path> @endif
                                                                        @if ($departement[81]->hospitalises >= 250)
                                                                        <path class="region" style="fill: purple" id="Tarn" data-nom="Tarn" data-numerodepartement="81" class="region-76 departement departement-81 departement-tarn" d="m419.7,471.9l1.3,2.8c-2.2,1.5-4.5,2.9-6.8,4.4 l-6.1-2.2l0.7,9.7l-0.8,3l-3.4,2l-12-1.4l-2.8,0.5l-1.1,3.3l-6.3-0.9l-1.8-2.3l-1-2.8l-14.3-9.3l0.7-5.4l-2.3-2.1l-0.2-2.8l-2.6-1.2 l-1.4-6.3l0.5-2.8l4.8-3.2l1-2.7L364,450l3-1.1l2.7,1.1l9.2-3.2l6.1-2.8l10.3,5.8l4.8,4.3l4.3,11.5l4.2,5L419.7,471.9z">
                                                                        </path> @endif
                                                                        @if ($departement[81]->hospitalises >= 400)
                                                                        <path class="region" style="fill: red" id="Tarn" data-nom="Tarn" data-numerodepartement="81" class="region-76 departement departement-81 departement-tarn" d="m419.7,471.9l1.3,2.8c-2.2,1.5-4.5,2.9-6.8,4.4 l-6.1-2.2l0.7,9.7l-0.8,3l-3.4,2l-12-1.4l-2.8,0.5l-1.1,3.3l-6.3-0.9l-1.8-2.3l-1-2.8l-14.3-9.3l0.7-5.4l-2.3-2.1l-0.2-2.8l-2.6-1.2 l-1.4-6.3l0.5-2.8l4.8-3.2l1-2.7L364,450l3-1.1l2.7,1.1l9.2-3.2l6.1-2.8l10.3,5.8l4.8,4.3l4.3,11.5l4.2,5L419.7,471.9z">
                                                                        </path> @endif


                                                                        @if ($departement[82]->hospitalises
                                                                        <= 50) <path class="region" style="fill: green" id="Tarn-et-Garonne" data-nom="Tarn-et-Garonne" data-numerodepartement="82" class="region-76 departement departement-82 departement-tarn-et-garonne" d="m360,458.1l-0.5,2.8l-11.7,4.3l2.2,2.3 l-5.8,2.5l-1.7-2.3l-9.9,0.9l-2-6.9l-5.1-4.1l3.3-4.6l-5.3-1.7l3.6-4.7l2.8,0.2l-1.3-2.7l4.4-5.5l-2.4-1.4v-2.9l7.5-2l3.1-0.5 l-2.1,2.3l4.5,4l2.7,1l2.4-1.5l0.5,4l8.7-2.5l2.6,2.3l7.5-5.5l6.2-0.8l-0.4,3l3.1,2.7l-2.3,2.4l4.3,3.6l-9.2,3.2l-2.7-1.1l-3,1.1 l1.8,2.2l-1,2.7L360,458.1z">
                                                                            </path>
                                                                            @endif
                                                                            @if ($departement[82]->hospitalises > 50)
                                                                            <path class="region" style="fill: yellow" id="Tarn-et-Garonne" data-nom="Tarn-et-Garonne" data-numerodepartement="82" class="region-76 departement departement-82 departement-tarn-et-garonne" d="m360,458.1l-0.5,2.8l-11.7,4.3l2.2,2.3 l-5.8,2.5l-1.7-2.3l-9.9,0.9l-2-6.9l-5.1-4.1l3.3-4.6l-5.3-1.7l3.6-4.7l2.8,0.2l-1.3-2.7l4.4-5.5l-2.4-1.4v-2.9l7.5-2l3.1-0.5 l-2.1,2.3l4.5,4l2.7,1l2.4-1.5l0.5,4l8.7-2.5l2.6,2.3l7.5-5.5l6.2-0.8l-0.4,3l3.1,2.7l-2.3,2.4l4.3,3.6l-9.2,3.2l-2.7-1.1l-3,1.1 l1.8,2.2l-1,2.7L360,458.1z">
                                                                            </path> @endif
                                                                            @if ($departement[82]->hospitalises >= 150)
                                                                            <path class="region" style="fill: pink" id="Tarn-et-Garonne" data-nom="Tarn-et-Garonne" data-numerodepartement="82" class="region-76 departement departement-82 departement-tarn-et-garonne" d="m360,458.1l-0.5,2.8l-11.7,4.3l2.2,2.3 l-5.8,2.5l-1.7-2.3l-9.9,0.9l-2-6.9l-5.1-4.1l3.3-4.6l-5.3-1.7l3.6-4.7l2.8,0.2l-1.3-2.7l4.4-5.5l-2.4-1.4v-2.9l7.5-2l3.1-0.5 l-2.1,2.3l4.5,4l2.7,1l2.4-1.5l0.5,4l8.7-2.5l2.6,2.3l7.5-5.5l6.2-0.8l-0.4,3l3.1,2.7l-2.3,2.4l4.3,3.6l-9.2,3.2l-2.7-1.1l-3,1.1 l1.8,2.2l-1,2.7L360,458.1z">
                                                                            </path> @endif
                                                                            @if ($departement[82]->hospitalises >= 250)
                                                                            <path class="region" style="fill: purple" id="Tarn-et-Garonne" data-nom="Tarn-et-Garonne" data-numerodepartement="82" class="region-76 departement departement-82 departement-tarn-et-garonne" d="m360,458.1l-0.5,2.8l-11.7,4.3l2.2,2.3 l-5.8,2.5l-1.7-2.3l-9.9,0.9l-2-6.9l-5.1-4.1l3.3-4.6l-5.3-1.7l3.6-4.7l2.8,0.2l-1.3-2.7l4.4-5.5l-2.4-1.4v-2.9l7.5-2l3.1-0.5 l-2.1,2.3l4.5,4l2.7,1l2.4-1.5l0.5,4l8.7-2.5l2.6,2.3l7.5-5.5l6.2-0.8l-0.4,3l3.1,2.7l-2.3,2.4l4.3,3.6l-9.2,3.2l-2.7-1.1l-3,1.1 l1.8,2.2l-1,2.7L360,458.1z">
                                                                            </path> @endif
                                                                            @if ($departement[82]->hospitalises >= 400)
                                                                            <path class="region" style="fill: red" id="Tarn-et-Garonne" data-nom="Tarn-et-Garonne" data-numerodepartement="82" class="region-76 departement departement-82 departement-tarn-et-garonne" d="m360,458.1l-0.5,2.8l-11.7,4.3l2.2,2.3 l-5.8,2.5l-1.7-2.3l-9.9,0.9l-2-6.9l-5.1-4.1l3.3-4.6l-5.3-1.7l3.6-4.7l2.8,0.2l-1.3-2.7l4.4-5.5l-2.4-1.4v-2.9l7.5-2l3.1-0.5 l-2.1,2.3l4.5,4l2.7,1l2.4-1.5l0.5,4l8.7-2.5l2.6,2.3l7.5-5.5l6.2-0.8l-0.4,3l3.1,2.7l-2.3,2.4l4.3,3.6l-9.2,3.2l-2.7-1.1l-3,1.1 l1.8,2.2l-1,2.7L360,458.1z">
                                                                            </path> @endif

                    </g>

                    <g data-nom="Auvergne-Rhône-Alpes">

                        @if ($departement[0]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Ain" data-nom="Ain" data-numerodepartement="01" class="region-84 departement departement-01 departement-ain" d="m542,347l-5.7,6.7l-11.2-15.2l-2.8,0.7l-3,5.1 l-6-2l-6.4,0.5l-3.7-5.7l-2.8,0.5l-3.1-9.2l1.5-8l5.9-20.9l5.9,1.5l5.4-1.3l4.8,3.3l4.3,7.7h2.9l0.1,3l2.9-0.1l4-4.4l3.4,1.6 l0.4,2.8l3.8-0.2l5.5-3.2l5.3-7.2l4.5,2.7l-1.8,4.7l0.3,2.5l-4.4,1.5l-1.9,2l0.2,2.8l0.46,0.19l-4.36,4.71h-2.9l0.8,9.3L542,347z">
                            </path>
                            @endif
                            @if ($departement[0]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Ain" data-nom="Ain" data-numerodepartement="01" class="region-84 departement departement-01 departement-ain" d="m542,347l-5.7,6.7l-11.2-15.2l-2.8,0.7l-3,5.1 l-6-2l-6.4,0.5l-3.7-5.7l-2.8,0.5l-3.1-9.2l1.5-8l5.9-20.9l5.9,1.5l5.4-1.3l4.8,3.3l4.3,7.7h2.9l0.1,3l2.9-0.1l4-4.4l3.4,1.6 l0.4,2.8l3.8-0.2l5.5-3.2l5.3-7.2l4.5,2.7l-1.8,4.7l0.3,2.5l-4.4,1.5l-1.9,2l0.2,2.8l0.46,0.19l-4.36,4.71h-2.9l0.8,9.3L542,347z">
                            </path> @endif
                            @if ($departement[0]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Ain" data-nom="Ain" data-numerodepartement="01" class="region-84 departement departement-01 departement-ain" d="m542,347l-5.7,6.7l-11.2-15.2l-2.8,0.7l-3,5.1 l-6-2l-6.4,0.5l-3.7-5.7l-2.8,0.5l-3.1-9.2l1.5-8l5.9-20.9l5.9,1.5l5.4-1.3l4.8,3.3l4.3,7.7h2.9l0.1,3l2.9-0.1l4-4.4l3.4,1.6 l0.4,2.8l3.8-0.2l5.5-3.2l5.3-7.2l4.5,2.7l-1.8,4.7l0.3,2.5l-4.4,1.5l-1.9,2l0.2,2.8l0.46,0.19l-4.36,4.71h-2.9l0.8,9.3L542,347z">
                            </path> @endif
                            @if ($departement[0]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Ain" data-nom="Ain" data-numerodepartement="01" class="region-84 departement departement-01 departement-ain" d="m542,347l-5.7,6.7l-11.2-15.2l-2.8,0.7l-3,5.1 l-6-2l-6.4,0.5l-3.7-5.7l-2.8,0.5l-3.1-9.2l1.5-8l5.9-20.9l5.9,1.5l5.4-1.3l4.8,3.3l4.3,7.7h2.9l0.1,3l2.9-0.1l4-4.4l3.4,1.6 l0.4,2.8l3.8-0.2l5.5-3.2l5.3-7.2l4.5,2.7l-1.8,4.7l0.3,2.5l-4.4,1.5l-1.9,2l0.2,2.8l0.46,0.19l-4.36,4.71h-2.9l0.8,9.3L542,347z">
                            </path> @endif
                            @if ($departement[0]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Ain" data-nom="Ain" data-numerodepartement="01" class="region-84 departement departement-01 departement-ain" d="m542,347l-5.7,6.7l-11.2-15.2l-2.8,0.7l-3,5.1 l-6-2l-6.4,0.5l-3.7-5.7l-2.8,0.5l-3.1-9.2l1.5-8l5.9-20.9l5.9,1.5l5.4-1.3l4.8,3.3l4.3,7.7h2.9l0.1,3l2.9-0.1l4-4.4l3.4,1.6 l0.4,2.8l3.8-0.2l5.5-3.2l5.3-7.2l4.5,2.7l-1.8,4.7l0.3,2.5l-4.4,1.5l-1.9,2l0.2,2.8l0.46,0.19l-4.36,4.71h-2.9l0.8,9.3L542,347z">
                            </path> @endif


                            @if ($departement[2]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Allier" data-nom="Allier" data-numerodepartement="03" class="region-84 departement departement-03 departement-allier" d="m443.1,292.3l5.9-6l6.7,13.5l7.9,2.9l1.6,2.4l-0.5,5.5l-3.7,4.6 l-3.9,1.3l-0.5,3l1.5,12.4l-5.5,4.8l-3.5-4.3l-6.4-0.4l-1.4-3.2l-13.1-0.5l-1.6-2.5l-3.3,0.5l-4.4-4.5l1.2-2.8l-2.3-1.7l-11.2,8 l-2.5-1.2l-3.6-8.4c-2.5-1.6-4.9-3.2-7.4-4.8L392,307v-0.1l3.5-5.9l8.7-1l1.7-2.4l-1.7-5.3l2.3-1.9l8.4-2.9l4.8-3.7h4h0.1l5.7,6.3 l6.4,0.2l2.8-1.7L443.1,292.3z">
                                </path>
                                @endif
                                @if ($departement[2]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Allier" data-nom="Allier" data-numerodepartement="03" class="region-84 departement departement-03 departement-allier" d="m443.1,292.3l5.9-6l6.7,13.5l7.9,2.9l1.6,2.4l-0.5,5.5l-3.7,4.6 l-3.9,1.3l-0.5,3l1.5,12.4l-5.5,4.8l-3.5-4.3l-6.4-0.4l-1.4-3.2l-13.1-0.5l-1.6-2.5l-3.3,0.5l-4.4-4.5l1.2-2.8l-2.3-1.7l-11.2,8 l-2.5-1.2l-3.6-8.4c-2.5-1.6-4.9-3.2-7.4-4.8L392,307v-0.1l3.5-5.9l8.7-1l1.7-2.4l-1.7-5.3l2.3-1.9l8.4-2.9l4.8-3.7h4h0.1l5.7,6.3 l6.4,0.2l2.8-1.7L443.1,292.3z">
                                </path> @endif
                                @if ($departement[2]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Allier" data-nom="Allier" data-numerodepartement="03" class="region-84 departement departement-03 departement-allier" d="m443.1,292.3l5.9-6l6.7,13.5l7.9,2.9l1.6,2.4l-0.5,5.5l-3.7,4.6 l-3.9,1.3l-0.5,3l1.5,12.4l-5.5,4.8l-3.5-4.3l-6.4-0.4l-1.4-3.2l-13.1-0.5l-1.6-2.5l-3.3,0.5l-4.4-4.5l1.2-2.8l-2.3-1.7l-11.2,8 l-2.5-1.2l-3.6-8.4c-2.5-1.6-4.9-3.2-7.4-4.8L392,307v-0.1l3.5-5.9l8.7-1l1.7-2.4l-1.7-5.3l2.3-1.9l8.4-2.9l4.8-3.7h4h0.1l5.7,6.3 l6.4,0.2l2.8-1.7L443.1,292.3z">
                                </path> @endif
                                @if ($departement[2]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Allier" data-nom="Allier" data-numerodepartement="03" class="region-84 departement departement-03 departement-allier" d="m443.1,292.3l5.9-6l6.7,13.5l7.9,2.9l1.6,2.4l-0.5,5.5l-3.7,4.6 l-3.9,1.3l-0.5,3l1.5,12.4l-5.5,4.8l-3.5-4.3l-6.4-0.4l-1.4-3.2l-13.1-0.5l-1.6-2.5l-3.3,0.5l-4.4-4.5l1.2-2.8l-2.3-1.7l-11.2,8 l-2.5-1.2l-3.6-8.4c-2.5-1.6-4.9-3.2-7.4-4.8L392,307v-0.1l3.5-5.9l8.7-1l1.7-2.4l-1.7-5.3l2.3-1.9l8.4-2.9l4.8-3.7h4h0.1l5.7,6.3 l6.4,0.2l2.8-1.7L443.1,292.3z">
                                </path> @endif
                                @if ($departement[2]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Allier" data-nom="Allier" data-numerodepartement="03" class="region-84 departement departement-03 departement-allier" d="m443.1,292.3l5.9-6l6.7,13.5l7.9,2.9l1.6,2.4l-0.5,5.5l-3.7,4.6 l-3.9,1.3l-0.5,3l1.5,12.4l-5.5,4.8l-3.5-4.3l-6.4-0.4l-1.4-3.2l-13.1-0.5l-1.6-2.5l-3.3,0.5l-4.4-4.5l1.2-2.8l-2.3-1.7l-11.2,8 l-2.5-1.2l-3.6-8.4c-2.5-1.6-4.9-3.2-7.4-4.8L392,307v-0.1l3.5-5.9l8.7-1l1.7-2.4l-1.7-5.3l2.3-1.9l8.4-2.9l4.8-3.7h4h0.1l5.7,6.3 l6.4,0.2l2.8-1.7L443.1,292.3z">
                                </path> @endif


                                @if ($departement[6]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Ardèche" data-nom="Ardèche" data-numerodepartement="07" class="region-84 departement departement-07 departement-ardeche" d="m496.5,434.2l0.1,3.7l-6-3.5h-2.8l-2.5,2.3 l-0.1-3.1l-7.1,4.3l-7.8-5l-2.7-5.9l-4.2-8.3l-2.1-9.1l6.7-6.4l5.9-1.9l3.4-5.9l3.4-0.4l-0.7-2.8l2.6-2.3l1.5-5.2l2.6,1.2v-3.1 l0.9-4.1l3.5-0.8l3.2-4.9l5-2.7l2,4.2l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9L496.5,434.2z">
                                    </path>
                                    @endif
                                    @if ($departement[6]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Ardèche" data-nom="Ardèche" data-numerodepartement="07" class="region-84 departement departement-07 departement-ardeche" d="m496.5,434.2l0.1,3.7l-6-3.5h-2.8l-2.5,2.3 l-0.1-3.1l-7.1,4.3l-7.8-5l-2.7-5.9l-4.2-8.3l-2.1-9.1l6.7-6.4l5.9-1.9l3.4-5.9l3.4-0.4l-0.7-2.8l2.6-2.3l1.5-5.2l2.6,1.2v-3.1 l0.9-4.1l3.5-0.8l3.2-4.9l5-2.7l2,4.2l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9L496.5,434.2z">
                                    </path> @endif
                                    @if ($departement[6]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Ardèche" data-nom="Ardèche" data-numerodepartement="07" class="region-84 departement departement-07 departement-ardeche" d="m496.5,434.2l0.1,3.7l-6-3.5h-2.8l-2.5,2.3 l-0.1-3.1l-7.1,4.3l-7.8-5l-2.7-5.9l-4.2-8.3l-2.1-9.1l6.7-6.4l5.9-1.9l3.4-5.9l3.4-0.4l-0.7-2.8l2.6-2.3l1.5-5.2l2.6,1.2v-3.1 l0.9-4.1l3.5-0.8l3.2-4.9l5-2.7l2,4.2l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9L496.5,434.2z">
                                    </path> @endif
                                    @if ($departement[6]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Ardèche" data-nom="Ardèche" data-numerodepartement="07" class="region-84 departement departement-07 departement-ardeche" d="m496.5,434.2l0.1,3.7l-6-3.5h-2.8l-2.5,2.3 l-0.1-3.1l-7.1,4.3l-7.8-5l-2.7-5.9l-4.2-8.3l-2.1-9.1l6.7-6.4l5.9-1.9l3.4-5.9l3.4-0.4l-0.7-2.8l2.6-2.3l1.5-5.2l2.6,1.2v-3.1 l0.9-4.1l3.5-0.8l3.2-4.9l5-2.7l2,4.2l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9L496.5,434.2z">
                                    </path> @endif
                                    @if ($departement[6]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Ardèche" data-nom="Ardèche" data-numerodepartement="07" class="region-84 departement departement-07 departement-ardeche" d="m496.5,434.2l0.1,3.7l-6-3.5h-2.8l-2.5,2.3 l-0.1-3.1l-7.1,4.3l-7.8-5l-2.7-5.9l-4.2-8.3l-2.1-9.1l6.7-6.4l5.9-1.9l3.4-5.9l3.4-0.4l-0.7-2.8l2.6-2.3l1.5-5.2l2.6,1.2v-3.1 l0.9-4.1l3.5-0.8l3.2-4.9l5-2.7l2,4.2l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9L496.5,434.2z">
                                    </path> @endif


                                    @if ($departement[14]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Cantal" data-nom="Cantal" data-numerodepartement="15" class="region-84 departement departement-15 departement-cantal" d="m435.6,387.9l3.5,8l-1,1l-6.8,5.7l-1.7-2.3 l-6.9,15.9l-2.6-5.1l0.5-3l-2.4-1.6l-1.3-4.2l-5.2-4l-4.7,4.2l-3,9.1l-3.8,4.8l-6.4-1.5l-5.1,3.2l-3.3-5l1.7-5.8l-3.8-6l-1-5.4h0.1 l3.2-1.9l-1.5-3.4l3.1-1.1l0.3-3.5l2.3-1.9l-1.8-2.2l7.6-9.5l0.6-3.5l6.2,2l-0.7-6l7.5,3.5l1.5,2.5l6.7,0.3l6.5,5.4l3.7-4.1v3.9 l5.5,1.5l3.3,8.7l2.6,1.1L435.6,387.9z">
                                        </path>
                                        @endif
                                        @if ($departement[14]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Cantal" data-nom="Cantal" data-numerodepartement="15" class="region-84 departement departement-15 departement-cantal" d="m435.6,387.9l3.5,8l-1,1l-6.8,5.7l-1.7-2.3 l-6.9,15.9l-2.6-5.1l0.5-3l-2.4-1.6l-1.3-4.2l-5.2-4l-4.7,4.2l-3,9.1l-3.8,4.8l-6.4-1.5l-5.1,3.2l-3.3-5l1.7-5.8l-3.8-6l-1-5.4h0.1 l3.2-1.9l-1.5-3.4l3.1-1.1l0.3-3.5l2.3-1.9l-1.8-2.2l7.6-9.5l0.6-3.5l6.2,2l-0.7-6l7.5,3.5l1.5,2.5l6.7,0.3l6.5,5.4l3.7-4.1v3.9 l5.5,1.5l3.3,8.7l2.6,1.1L435.6,387.9z">
                                        </path> @endif
                                        @if ($departement[14]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Cantal" data-nom="Cantal" data-numerodepartement="15" class="region-84 departement departement-15 departement-cantal" d="m435.6,387.9l3.5,8l-1,1l-6.8,5.7l-1.7-2.3 l-6.9,15.9l-2.6-5.1l0.5-3l-2.4-1.6l-1.3-4.2l-5.2-4l-4.7,4.2l-3,9.1l-3.8,4.8l-6.4-1.5l-5.1,3.2l-3.3-5l1.7-5.8l-3.8-6l-1-5.4h0.1 l3.2-1.9l-1.5-3.4l3.1-1.1l0.3-3.5l2.3-1.9l-1.8-2.2l7.6-9.5l0.6-3.5l6.2,2l-0.7-6l7.5,3.5l1.5,2.5l6.7,0.3l6.5,5.4l3.7-4.1v3.9 l5.5,1.5l3.3,8.7l2.6,1.1L435.6,387.9z">
                                        </path> @endif
                                        @if ($departement[14]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Cantal" data-nom="Cantal" data-numerodepartement="15" class="region-84 departement departement-15 departement-cantal" d="m435.6,387.9l3.5,8l-1,1l-6.8,5.7l-1.7-2.3 l-6.9,15.9l-2.6-5.1l0.5-3l-2.4-1.6l-1.3-4.2l-5.2-4l-4.7,4.2l-3,9.1l-3.8,4.8l-6.4-1.5l-5.1,3.2l-3.3-5l1.7-5.8l-3.8-6l-1-5.4h0.1 l3.2-1.9l-1.5-3.4l3.1-1.1l0.3-3.5l2.3-1.9l-1.8-2.2l7.6-9.5l0.6-3.5l6.2,2l-0.7-6l7.5,3.5l1.5,2.5l6.7,0.3l6.5,5.4l3.7-4.1v3.9 l5.5,1.5l3.3,8.7l2.6,1.1L435.6,387.9z">
                                        </path> @endif
                                        @if ($departement[14]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Cantal" data-nom="Cantal" data-numerodepartement="15" class="region-84 departement departement-15 departement-cantal" d="m435.6,387.9l3.5,8l-1,1l-6.8,5.7l-1.7-2.3 l-6.9,15.9l-2.6-5.1l0.5-3l-2.4-1.6l-1.3-4.2l-5.2-4l-4.7,4.2l-3,9.1l-3.8,4.8l-6.4-1.5l-5.1,3.2l-3.3-5l1.7-5.8l-3.8-6l-1-5.4h0.1 l3.2-1.9l-1.5-3.4l3.1-1.1l0.3-3.5l2.3-1.9l-1.8-2.2l7.6-9.5l0.6-3.5l6.2,2l-0.7-6l7.5,3.5l1.5,2.5l6.7,0.3l6.5,5.4l3.7-4.1v3.9 l5.5,1.5l3.3,8.7l2.6,1.1L435.6,387.9z">
                                        </path> @endif


                                        @if ($departement[24]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Drôme" data-nom="Drôme" data-numerodepartement="26" class="region-84 departement departement-26 departement-drome" d="m535.1,404.4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9 l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9l-2.1,14.4l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l4.3-4.8l2.3-0.1l1-0.2l0.2-4.7l-10-5.7l-1.5-2.6l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3 l2.5-6.7l5.8-0.3l0.3-3.4l-5.9-0.8L535.1,404.4z">
                                            </path>
                                            @endif
                                            @if ($departement[24]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Drôme" data-nom="Drôme" data-numerodepartement="26" class="region-84 departement departement-26 departement-drome" d="m535.1,404.4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9 l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9l-2.1,14.4l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l4.3-4.8l2.3-0.1l1-0.2l0.2-4.7l-10-5.7l-1.5-2.6l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3 l2.5-6.7l5.8-0.3l0.3-3.4l-5.9-0.8L535.1,404.4z">
                                            </path> @endif
                                            @if ($departement[24]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Drôme" data-nom="Drôme" data-numerodepartement="26" class="region-84 departement departement-26 departement-drome" d="m535.1,404.4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9 l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9l-2.1,14.4l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l4.3-4.8l2.3-0.1l1-0.2l0.2-4.7l-10-5.7l-1.5-2.6l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3 l2.5-6.7l5.8-0.3l0.3-3.4l-5.9-0.8L535.1,404.4z">
                                            </path> @endif
                                            @if ($departement[24]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Drôme" data-nom="Drôme" data-numerodepartement="26" class="region-84 departement departement-26 departement-drome" d="m535.1,404.4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9 l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9l-2.1,14.4l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l4.3-4.8l2.3-0.1l1-0.2l0.2-4.7l-10-5.7l-1.5-2.6l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3 l2.5-6.7l5.8-0.3l0.3-3.4l-5.9-0.8L535.1,404.4z">
                                            </path> @endif
                                            @if ($departement[24]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Drôme" data-nom="Drôme" data-numerodepartement="26" class="region-84 departement departement-26 departement-drome" d="m535.1,404.4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9 l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l0.5,10.3l3.8,11.3l-1.5,6.2l-3.5,4.5l1,7.1l-3,5.9l-2.1,14.4l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l4.3-4.8l2.3-0.1l1-0.2l0.2-4.7l-10-5.7l-1.5-2.6l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3 l2.5-6.7l5.8-0.3l0.3-3.4l-5.9-0.8L535.1,404.4z">
                                            </path> @endif


                                            @if ($departement[38]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Isère" data-nom="Isère" data-numerodepartement="38" class="region-84 departement departement-38 departement-isere" d="m513.6,349.4l-0.3-7.1l6,2l3-5.1l2.8-0.7 l11.2,15.2l6.5,10.5l6.2,0.2l0.3-2.8l9.4,2.1l2.7,6.3l-2.3,5.5l1,5.4l5.2,1.5l-1.6,3.8l1.8,4.2l4.4,3.1l-0.4,5.8l-3.1-1.1l-12.6,3.9 l-0.9,2.8l-5.5,1.2l-1,3.1l-5.9-0.8l-5.4-4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l-2-4.2v-4.4 l-0.2-1.1h0.1l4.4-3.9l-1.9-2.5l2.5-2.5l6.9-1.5L513.6,349.4z">
                                                </path>
                                                @endif
                                                @if ($departement[38]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Isère" data-nom="Isère" data-numerodepartement="38" class="region-84 departement departement-38 departement-isere" d="m513.6,349.4l-0.3-7.1l6,2l3-5.1l2.8-0.7 l11.2,15.2l6.5,10.5l6.2,0.2l0.3-2.8l9.4,2.1l2.7,6.3l-2.3,5.5l1,5.4l5.2,1.5l-1.6,3.8l1.8,4.2l4.4,3.1l-0.4,5.8l-3.1-1.1l-12.6,3.9 l-0.9,2.8l-5.5,1.2l-1,3.1l-5.9-0.8l-5.4-4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l-2-4.2v-4.4 l-0.2-1.1h0.1l4.4-3.9l-1.9-2.5l2.5-2.5l6.9-1.5L513.6,349.4z">
                                                </path> @endif
                                                @if ($departement[38]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Isère" data-nom="Isère" data-numerodepartement="38" class="region-84 departement departement-38 departement-isere" d="m513.6,349.4l-0.3-7.1l6,2l3-5.1l2.8-0.7 l11.2,15.2l6.5,10.5l6.2,0.2l0.3-2.8l9.4,2.1l2.7,6.3l-2.3,5.5l1,5.4l5.2,1.5l-1.6,3.8l1.8,4.2l4.4,3.1l-0.4,5.8l-3.1-1.1l-12.6,3.9 l-0.9,2.8l-5.5,1.2l-1,3.1l-5.9-0.8l-5.4-4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l-2-4.2v-4.4 l-0.2-1.1h0.1l4.4-3.9l-1.9-2.5l2.5-2.5l6.9-1.5L513.6,349.4z">
                                                </path> @endif
                                                @if ($departement[38]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Isère" data-nom="Isère" data-numerodepartement="38" class="region-84 departement departement-38 departement-isere" d="m513.6,349.4l-0.3-7.1l6,2l3-5.1l2.8-0.7 l11.2,15.2l6.5,10.5l6.2,0.2l0.3-2.8l9.4,2.1l2.7,6.3l-2.3,5.5l1,5.4l5.2,1.5l-1.6,3.8l1.8,4.2l4.4,3.1l-0.4,5.8l-3.1-1.1l-12.6,3.9 l-0.9,2.8l-5.5,1.2l-1,3.1l-5.9-0.8l-5.4-4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l-2-4.2v-4.4 l-0.2-1.1h0.1l4.4-3.9l-1.9-2.5l2.5-2.5l6.9-1.5L513.6,349.4z">
                                                </path> @endif
                                                @if ($departement[38]->hospitalises >= 400)
                                                <path class="region" style="fill: green" id="Isère" data-nom="Isère" data-numerodepartement="38" class="region-84 departement departement-38 departement-isere" d="m513.6,349.4l-0.3-7.1l6,2l3-5.1l2.8-0.7 l11.2,15.2l6.5,10.5l6.2,0.2l0.3-2.8l9.4,2.1l2.7,6.3l-2.3,5.5l1,5.4l5.2,1.5l-1.6,3.8l1.8,4.2l4.4,3.1l-0.4,5.8l-3.1-1.1l-12.6,3.9 l-0.9,2.8l-5.5,1.2l-1,3.1l-5.9-0.8l-5.4-4l-3,0.5l-0.8-17.5l-3,1.7l-8.2-1.9l-2.7,1l1.1-6.3l-3.3-7.8l-4.9-2.7l-9,3.1l-2-4.2v-4.4 l-0.2-1.1h0.1l4.4-3.9l-1.9-2.5l2.5-2.5l6.9-1.5L513.6,349.4z">
                                                </path> @endif


                                                @if ($departement[42]->hospitalises
                                                <= 50) <path class="region" style="fill: green" id="Loire" data-nom="Loire" data-numerodepartement="42" class="region-84 departement departement-42 departement-loire" d="m499.3,365.9v4.4l-5,2.7l-3.2,4.9l-3.5,0.8 l-2.2-2.4l-2.6,1l-0.7-5.5l-6-2.2l-6.2,3l-2.8,0.4l-2.3-2l-2.8,0.8l3-7.1l-2.7-7.5l-4.6-3.8l-4.7-7.7l2.1-6.3l-2.5-2.7l5.5-4.8 l-1.5-12.4l0.5-3l3.9-1.3v3l5.2,3.3l8-1.5l2.1,2.1l5.7-3.8l0.01-0.09l2.09,2.99l-4.9,3.5l-1.6,8.6l5.2,6.7l-1.7,5.9l2.3,1.6 l-1.3,2.5l1.1,3l4.6,4.1l5.9,2.1l0.9,3l4.6,2.6h-0.1L499.3,365.9z">
                                                    </path>
                                                    @endif
                                                    @if ($departement[42]->hospitalises > 50)
                                                    <path class="region" style="fill: yellow" id="Loire" data-nom="Loire" data-numerodepartement="42" class="region-84 departement departement-42 departement-loire" d="m499.3,365.9v4.4l-5,2.7l-3.2,4.9l-3.5,0.8 l-2.2-2.4l-2.6,1l-0.7-5.5l-6-2.2l-6.2,3l-2.8,0.4l-2.3-2l-2.8,0.8l3-7.1l-2.7-7.5l-4.6-3.8l-4.7-7.7l2.1-6.3l-2.5-2.7l5.5-4.8 l-1.5-12.4l0.5-3l3.9-1.3v3l5.2,3.3l8-1.5l2.1,2.1l5.7-3.8l0.01-0.09l2.09,2.99l-4.9,3.5l-1.6,8.6l5.2,6.7l-1.7,5.9l2.3,1.6 l-1.3,2.5l1.1,3l4.6,4.1l5.9,2.1l0.9,3l4.6,2.6h-0.1L499.3,365.9z">
                                                    </path> @endif
                                                    @if ($departement[42]->hospitalises >= 150)
                                                    <path class="region" style="fill: pink" id="Loire" data-nom="Loire" data-numerodepartement="42" class="region-84 departement departement-42 departement-loire" d="m499.3,365.9v4.4l-5,2.7l-3.2,4.9l-3.5,0.8 l-2.2-2.4l-2.6,1l-0.7-5.5l-6-2.2l-6.2,3l-2.8,0.4l-2.3-2l-2.8,0.8l3-7.1l-2.7-7.5l-4.6-3.8l-4.7-7.7l2.1-6.3l-2.5-2.7l5.5-4.8 l-1.5-12.4l0.5-3l3.9-1.3v3l5.2,3.3l8-1.5l2.1,2.1l5.7-3.8l0.01-0.09l2.09,2.99l-4.9,3.5l-1.6,8.6l5.2,6.7l-1.7,5.9l2.3,1.6 l-1.3,2.5l1.1,3l4.6,4.1l5.9,2.1l0.9,3l4.6,2.6h-0.1L499.3,365.9z">
                                                    </path> @endif
                                                    @if ($departement[42]->hospitalises >= 250)
                                                    <path class="region" style="fill: purple" id="Loire" data-nom="Loire" data-numerodepartement="42" class="region-84 departement departement-42 departement-loire" d="m499.3,365.9v4.4l-5,2.7l-3.2,4.9l-3.5,0.8 l-2.2-2.4l-2.6,1l-0.7-5.5l-6-2.2l-6.2,3l-2.8,0.4l-2.3-2l-2.8,0.8l3-7.1l-2.7-7.5l-4.6-3.8l-4.7-7.7l2.1-6.3l-2.5-2.7l5.5-4.8 l-1.5-12.4l0.5-3l3.9-1.3v3l5.2,3.3l8-1.5l2.1,2.1l5.7-3.8l0.01-0.09l2.09,2.99l-4.9,3.5l-1.6,8.6l5.2,6.7l-1.7,5.9l2.3,1.6 l-1.3,2.5l1.1,3l4.6,4.1l5.9,2.1l0.9,3l4.6,2.6h-0.1L499.3,365.9z">
                                                    </path> @endif
                                                    @if ($departement[42]->hospitalises >= 400)
                                                    <path class="region" style="fill: red" id="Loire" data-nom="Loire" data-numerodepartement="42" class="region-84 departement departement-42 departement-loire" d="m499.3,365.9v4.4l-5,2.7l-3.2,4.9l-3.5,0.8 l-2.2-2.4l-2.6,1l-0.7-5.5l-6-2.2l-6.2,3l-2.8,0.4l-2.3-2l-2.8,0.8l3-7.1l-2.7-7.5l-4.6-3.8l-4.7-7.7l2.1-6.3l-2.5-2.7l5.5-4.8 l-1.5-12.4l0.5-3l3.9-1.3v3l5.2,3.3l8-1.5l2.1,2.1l5.7-3.8l0.01-0.09l2.09,2.99l-4.9,3.5l-1.6,8.6l5.2,6.7l-1.7,5.9l2.3,1.6 l-1.3,2.5l1.1,3l4.6,4.1l5.9,2.1l0.9,3l4.6,2.6h-0.1L499.3,365.9z">
                                                    </path> @endif

                                                    @if ($departement[43]->hospitalises
                                                    <= 50) <path class="region" style="fill: green" id="Haute-Loire" data-nom="Haute-Loire" data-numerodepartement="43" class="region-84 departement departement-43 departement-haute-loire" d="m485.4,376.3l2.2,2.4l-0.9,4.1v3.1l-2.6-1.2 l-1.5,5.2l-2.6,2.3l0.7,2.8l-3.4,0.4l-3.4,5.9l-5.9,1.9l-6.7,6.4l-9-7.7l-2.9-0.2l-0.1,2.8l-6.4-1.2l-1.5-5.7l-2.3-1.7l-3.5-8 l3.4-0.2l-2.6-1.1l-3.3-8.7l-5.5-1.5v-3.9v-0.1l9.6-3.2l8.5,0.1l5.2,3.2l11.1-0.7l2.8-0.8l2.3,2l2.8-0.4l6.2-3l6,2.2l0.7,5.5 L485.4,376.3z">
                                                        </path>
                                                        @endif
                                                        @if ($departement[43]->hospitalises > 50)
                                                        <path class="region" style="fill: yellow" id="Haute-Loire" data-nom="Haute-Loire" data-numerodepartement="43" class="region-84 departement departement-43 departement-haute-loire" d="m485.4,376.3l2.2,2.4l-0.9,4.1v3.1l-2.6-1.2 l-1.5,5.2l-2.6,2.3l0.7,2.8l-3.4,0.4l-3.4,5.9l-5.9,1.9l-6.7,6.4l-9-7.7l-2.9-0.2l-0.1,2.8l-6.4-1.2l-1.5-5.7l-2.3-1.7l-3.5-8 l3.4-0.2l-2.6-1.1l-3.3-8.7l-5.5-1.5v-3.9v-0.1l9.6-3.2l8.5,0.1l5.2,3.2l11.1-0.7l2.8-0.8l2.3,2l2.8-0.4l6.2-3l6,2.2l0.7,5.5 L485.4,376.3z">
                                                        </path> @endif
                                                        @if ($departement[43]->hospitalises >= 150)
                                                        <path class="region" style="fill: pink" id="Haute-Loire" data-nom="Haute-Loire" data-numerodepartement="43" class="region-84 departement departement-43 departement-haute-loire" d="m485.4,376.3l2.2,2.4l-0.9,4.1v3.1l-2.6-1.2 l-1.5,5.2l-2.6,2.3l0.7,2.8l-3.4,0.4l-3.4,5.9l-5.9,1.9l-6.7,6.4l-9-7.7l-2.9-0.2l-0.1,2.8l-6.4-1.2l-1.5-5.7l-2.3-1.7l-3.5-8 l3.4-0.2l-2.6-1.1l-3.3-8.7l-5.5-1.5v-3.9v-0.1l9.6-3.2l8.5,0.1l5.2,3.2l11.1-0.7l2.8-0.8l2.3,2l2.8-0.4l6.2-3l6,2.2l0.7,5.5 L485.4,376.3z">
                                                        </path> @endif
                                                        @if ($departement[43]->hospitalises >= 250)
                                                        <path class="region" style="fill: purple" id="Haute-Loire" data-nom="Haute-Loire" data-numerodepartement="43" class="region-84 departement departement-43 departement-haute-loire" d="m485.4,376.3l2.2,2.4l-0.9,4.1v3.1l-2.6-1.2 l-1.5,5.2l-2.6,2.3l0.7,2.8l-3.4,0.4l-3.4,5.9l-5.9,1.9l-6.7,6.4l-9-7.7l-2.9-0.2l-0.1,2.8l-6.4-1.2l-1.5-5.7l-2.3-1.7l-3.5-8 l3.4-0.2l-2.6-1.1l-3.3-8.7l-5.5-1.5v-3.9v-0.1l9.6-3.2l8.5,0.1l5.2,3.2l11.1-0.7l2.8-0.8l2.3,2l2.8-0.4l6.2-3l6,2.2l0.7,5.5 L485.4,376.3z">
                                                        </path> @endif
                                                        @if ($departement[43]->hospitalises >= 400)
                                                        <path class="region" style="fill: red" id="Haute-Loire" data-nom="Haute-Loire" data-numerodepartement="43" class="region-84 departement departement-43 departement-haute-loire" d="m485.4,376.3l2.2,2.4l-0.9,4.1v3.1l-2.6-1.2 l-1.5,5.2l-2.6,2.3l0.7,2.8l-3.4,0.4l-3.4,5.9l-5.9,1.9l-6.7,6.4l-9-7.7l-2.9-0.2l-0.1,2.8l-6.4-1.2l-1.5-5.7l-2.3-1.7l-3.5-8 l3.4-0.2l-2.6-1.1l-3.3-8.7l-5.5-1.5v-3.9v-0.1l9.6-3.2l8.5,0.1l5.2,3.2l11.1-0.7l2.8-0.8l2.3,2l2.8-0.4l6.2-3l6,2.2l0.7,5.5 L485.4,376.3z">
                                                        </path> @endif



                                                        @if ($departement[63]->hospitalises
                                                        <= 50) <path class="region" style="fill: green" id="Puy-de-Dôme" data-nom="Puy-de-Dôme" data-numerodepartement="63" class="region-84 departement departement-63 departement-puy-de-dome" d="m449.1,332.4l3.5,4.3l2.5,2.7l-2.1,6.3l4.7,7.7 l4.6,3.8l2.7,7.5l-3,7.1l-11.1,0.7l-5.2-3.2l-8.5-0.1l-9.6,3.2v0.1l-3.7,4.1l-6.5-5.4l-6.7-0.3l-1.5-2.5l-7.5-3.5l-1.2-7.9l1.7-2.4 L401,349l-4.4-5.5l9.3-8.6l-2.3-6.7l0.5-4.1l2.5,1.2l11.2-8l2.3,1.7l-1.2,2.8l4.4,4.5l3.3-0.5l1.6,2.5l13.1,0.5l1.4,3.2L449.1,332.4z">
                                                            </path>
                                                            @endif
                                                            @if ($departement[63]->hospitalises > 50)
                                                            <path class="region" style="fill: yellow" id="Puy-de-Dôme" data-nom="Puy-de-Dôme" data-numerodepartement="63" class="region-84 departement departement-63 departement-puy-de-dome" d="m449.1,332.4l3.5,4.3l2.5,2.7l-2.1,6.3l4.7,7.7 l4.6,3.8l2.7,7.5l-3,7.1l-11.1,0.7l-5.2-3.2l-8.5-0.1l-9.6,3.2v0.1l-3.7,4.1l-6.5-5.4l-6.7-0.3l-1.5-2.5l-7.5-3.5l-1.2-7.9l1.7-2.4 L401,349l-4.4-5.5l9.3-8.6l-2.3-6.7l0.5-4.1l2.5,1.2l11.2-8l2.3,1.7l-1.2,2.8l4.4,4.5l3.3-0.5l1.6,2.5l13.1,0.5l1.4,3.2L449.1,332.4z">
                                                            </path> @endif
                                                            @if ($departement[63]->hospitalises >= 150)
                                                            <path class="region" style="fill: pink" id="Puy-de-Dôme" data-nom="Puy-de-Dôme" data-numerodepartement="63" class="region-84 departement departement-63 departement-puy-de-dome" d="m449.1,332.4l3.5,4.3l2.5,2.7l-2.1,6.3l4.7,7.7 l4.6,3.8l2.7,7.5l-3,7.1l-11.1,0.7l-5.2-3.2l-8.5-0.1l-9.6,3.2v0.1l-3.7,4.1l-6.5-5.4l-6.7-0.3l-1.5-2.5l-7.5-3.5l-1.2-7.9l1.7-2.4 L401,349l-4.4-5.5l9.3-8.6l-2.3-6.7l0.5-4.1l2.5,1.2l11.2-8l2.3,1.7l-1.2,2.8l4.4,4.5l3.3-0.5l1.6,2.5l13.1,0.5l1.4,3.2L449.1,332.4z">
                                                            </path> @endif
                                                            @if ($departement[63]->hospitalises >= 250)
                                                            <path class="region" style="fill: purple" id="Puy-de-Dôme" data-nom="Puy-de-Dôme" data-numerodepartement="63" class="region-84 departement departement-63 departement-puy-de-dome" d="m449.1,332.4l3.5,4.3l2.5,2.7l-2.1,6.3l4.7,7.7 l4.6,3.8l2.7,7.5l-3,7.1l-11.1,0.7l-5.2-3.2l-8.5-0.1l-9.6,3.2v0.1l-3.7,4.1l-6.5-5.4l-6.7-0.3l-1.5-2.5l-7.5-3.5l-1.2-7.9l1.7-2.4 L401,349l-4.4-5.5l9.3-8.6l-2.3-6.7l0.5-4.1l2.5,1.2l11.2-8l2.3,1.7l-1.2,2.8l4.4,4.5l3.3-0.5l1.6,2.5l13.1,0.5l1.4,3.2L449.1,332.4z">
                                                            </path> @endif
                                                            @if ($departement[63]->hospitalises >= 400)
                                                            <path class="region" style="fill: red" id="Puy-de-Dôme" data-nom="Puy-de-Dôme" data-numerodepartement="63" class="region-84 departement departement-63 departement-puy-de-dome" d="m449.1,332.4l3.5,4.3l2.5,2.7l-2.1,6.3l4.7,7.7 l4.6,3.8l2.7,7.5l-3,7.1l-11.1,0.7l-5.2-3.2l-8.5-0.1l-9.6,3.2v0.1l-3.7,4.1l-6.5-5.4l-6.7-0.3l-1.5-2.5l-7.5-3.5l-1.2-7.9l1.7-2.4 L401,349l-4.4-5.5l9.3-8.6l-2.3-6.7l0.5-4.1l2.5,1.2l11.2-8l2.3,1.7l-1.2,2.8l4.4,4.5l3.3-0.5l1.6,2.5l13.1,0.5l1.4,3.2L449.1,332.4z">
                                                            </path> @endif


                                                            @if ($departement[69]->hospitalises
                                                            <= 50) <path class="region" style="fill: green" id="Rhône" data-nom="Rhône" data-numerodepartement="69" class="region-84 departement departement-69 departement-rhone" d="m493.1,312.7l5.7,7.7l-1.5,8l3.1,9.2l2.8-0.5 l3.7,5.7l6.4-0.5l0.3,7.1l-2.5,5l-6.9,1.5l-2.5,2.5l1.9,2.5l-4.4,3.9l-4.6-2.6l-0.9-3l-5.9-2.1l-4.6-4.1l-1.1-3l1.3-2.5l-2.3-1.6 l1.7-5.9l-5.2-6.7l1.6-8.6l4.9-3.5l-2.09-2.99l0.29-2.91l2.3-1.9l2.2,1.7l2.2-1.6l2.5,1.5L493.1,312.7z">
                                                                </path>
                                                                @endif
                                                                @if ($departement[69]->hospitalises > 50)
                                                                <path class="region" style="fill: yellow" id="Rhône" data-nom="Rhône" data-numerodepartement="69" class="region-84 departement departement-69 departement-rhone" d="m493.1,312.7l5.7,7.7l-1.5,8l3.1,9.2l2.8-0.5 l3.7,5.7l6.4-0.5l0.3,7.1l-2.5,5l-6.9,1.5l-2.5,2.5l1.9,2.5l-4.4,3.9l-4.6-2.6l-0.9-3l-5.9-2.1l-4.6-4.1l-1.1-3l1.3-2.5l-2.3-1.6 l1.7-5.9l-5.2-6.7l1.6-8.6l4.9-3.5l-2.09-2.99l0.29-2.91l2.3-1.9l2.2,1.7l2.2-1.6l2.5,1.5L493.1,312.7z">
                                                                </path> @endif
                                                                @if ($departement[69]->hospitalises >= 150)
                                                                <path class="region" style="fill: pink" id="Rhône" data-nom="Rhône" data-numerodepartement="69" class="region-84 departement departement-69 departement-rhone" d="m493.1,312.7l5.7,7.7l-1.5,8l3.1,9.2l2.8-0.5 l3.7,5.7l6.4-0.5l0.3,7.1l-2.5,5l-6.9,1.5l-2.5,2.5l1.9,2.5l-4.4,3.9l-4.6-2.6l-0.9-3l-5.9-2.1l-4.6-4.1l-1.1-3l1.3-2.5l-2.3-1.6 l1.7-5.9l-5.2-6.7l1.6-8.6l4.9-3.5l-2.09-2.99l0.29-2.91l2.3-1.9l2.2,1.7l2.2-1.6l2.5,1.5L493.1,312.7z">
                                                                </path> @endif
                                                                @if ($departement[69]->hospitalises >= 250)
                                                                <path class="region" style="fill: purple" id="Rhône" data-nom="Rhône" data-numerodepartement="69" class="region-84 departement departement-69 departement-rhone" d="m493.1,312.7l5.7,7.7l-1.5,8l3.1,9.2l2.8-0.5 l3.7,5.7l6.4-0.5l0.3,7.1l-2.5,5l-6.9,1.5l-2.5,2.5l1.9,2.5l-4.4,3.9l-4.6-2.6l-0.9-3l-5.9-2.1l-4.6-4.1l-1.1-3l1.3-2.5l-2.3-1.6 l1.7-5.9l-5.2-6.7l1.6-8.6l4.9-3.5l-2.09-2.99l0.29-2.91l2.3-1.9l2.2,1.7l2.2-1.6l2.5,1.5L493.1,312.7z">
                                                                </path> @endif
                                                                @if ($departement[69]->hospitalises >= 400)
                                                                <path class="region" style="fill: red" id="Rhône" data-nom="Rhône" data-numerodepartement="69" class="region-84 departement departement-69 departement-rhone" d="m493.1,312.7l5.7,7.7l-1.5,8l3.1,9.2l2.8-0.5 l3.7,5.7l6.4-0.5l0.3,7.1l-2.5,5l-6.9,1.5l-2.5,2.5l1.9,2.5l-4.4,3.9l-4.6-2.6l-0.9-3l-5.9-2.1l-4.6-4.1l-1.1-3l1.3-2.5l-2.3-1.6 l1.7-5.9l-5.2-6.7l1.6-8.6l4.9-3.5l-2.09-2.99l0.29-2.91l2.3-1.9l2.2,1.7l2.2-1.6l2.5,1.5L493.1,312.7z">
                                                                </path> @endif


                                                                @if ($departement[73]->hospitalises
                                                                <= 50) <path class="region" style="fill: green" id="Savoie" data-nom="Savoie" data-numerodepartement="73" class="region-84 departement departement-73 departement-savoie" d="m603.7,362l-1,10.3l-3.1,1.4l-2.2,0.7l-4.5,3.4 l-1.5,2.4l-2.5-1.4l-5.1,1.3l-2,1.8v0.1l-6.8,1.9l-2,2l-7.7-3.5l-5.2-1.5l-1-5.4l2.3-5.5l-2.7-6.3l-9.4-2.1l-0.3,2.8l-6.2-0.2 l-6.5-10.5l5.7-6.7l2.3-13.6l2.7,6.7l2.7,0.9l1.3,2.5l3,1.7l2.6-1.6l3.2,0.8l4.6,3.6l9.4-13.9l2.4,1.6l-0.6,3l2.3,1.8l6.2,2.3 l2.2-1.5l0.62-0.76l1.88,4.66l2.7,1.1l1.5,1.9l2.8,0.4l-0.7,3l1.3,5.2l5.1,4L603.7,362z">
                                                                    </path>
                                                                    @endif
                                                                    @if ($departement[73]->hospitalises > 50)
                                                                    <path class="region" style="fill: yellow" id="Savoie" data-nom="Savoie" data-numerodepartement="73" class="region-84 departement departement-73 departement-savoie" d="m603.7,362l-1,10.3l-3.1,1.4l-2.2,0.7l-4.5,3.4 l-1.5,2.4l-2.5-1.4l-5.1,1.3l-2,1.8v0.1l-6.8,1.9l-2,2l-7.7-3.5l-5.2-1.5l-1-5.4l2.3-5.5l-2.7-6.3l-9.4-2.1l-0.3,2.8l-6.2-0.2 l-6.5-10.5l5.7-6.7l2.3-13.6l2.7,6.7l2.7,0.9l1.3,2.5l3,1.7l2.6-1.6l3.2,0.8l4.6,3.6l9.4-13.9l2.4,1.6l-0.6,3l2.3,1.8l6.2,2.3 l2.2-1.5l0.62-0.76l1.88,4.66l2.7,1.1l1.5,1.9l2.8,0.4l-0.7,3l1.3,5.2l5.1,4L603.7,362z">
                                                                    </path> @endif
                                                                    @if ($departement[73]->hospitalises >= 150)
                                                                    <path class="region" style="fill: pink" id="Savoie" data-nom="Savoie" data-numerodepartement="73" class="region-84 departement departement-73 departement-savoie" d="m603.7,362l-1,10.3l-3.1,1.4l-2.2,0.7l-4.5,3.4 l-1.5,2.4l-2.5-1.4l-5.1,1.3l-2,1.8v0.1l-6.8,1.9l-2,2l-7.7-3.5l-5.2-1.5l-1-5.4l2.3-5.5l-2.7-6.3l-9.4-2.1l-0.3,2.8l-6.2-0.2 l-6.5-10.5l5.7-6.7l2.3-13.6l2.7,6.7l2.7,0.9l1.3,2.5l3,1.7l2.6-1.6l3.2,0.8l4.6,3.6l9.4-13.9l2.4,1.6l-0.6,3l2.3,1.8l6.2,2.3 l2.2-1.5l0.62-0.76l1.88,4.66l2.7,1.1l1.5,1.9l2.8,0.4l-0.7,3l1.3,5.2l5.1,4L603.7,362z">
                                                                    </path> @endif
                                                                    @if ($departement[73]->hospitalises >= 250)
                                                                    <path class="region" style="fill: purple" id="Savoie" data-nom="Savoie" data-numerodepartement="73" class="region-84 departement departement-73 departement-savoie" d="m603.7,362l-1,10.3l-3.1,1.4l-2.2,0.7l-4.5,3.4 l-1.5,2.4l-2.5-1.4l-5.1,1.3l-2,1.8v0.1l-6.8,1.9l-2,2l-7.7-3.5l-5.2-1.5l-1-5.4l2.3-5.5l-2.7-6.3l-9.4-2.1l-0.3,2.8l-6.2-0.2 l-6.5-10.5l5.7-6.7l2.3-13.6l2.7,6.7l2.7,0.9l1.3,2.5l3,1.7l2.6-1.6l3.2,0.8l4.6,3.6l9.4-13.9l2.4,1.6l-0.6,3l2.3,1.8l6.2,2.3 l2.2-1.5l0.62-0.76l1.88,4.66l2.7,1.1l1.5,1.9l2.8,0.4l-0.7,3l1.3,5.2l5.1,4L603.7,362z">
                                                                    </path> @endif
                                                                    @if ($departement[73]->hospitalises >= 400)
                                                                    <path class="region" style="fill: red" id="Savoie" data-nom="Savoie" data-numerodepartement="73" class="region-84 departement departement-73 departement-savoie" d="m603.7,362l-1,10.3l-3.1,1.4l-2.2,0.7l-4.5,3.4 l-1.5,2.4l-2.5-1.4l-5.1,1.3l-2,1.8v0.1l-6.8,1.9l-2,2l-7.7-3.5l-5.2-1.5l-1-5.4l2.3-5.5l-2.7-6.3l-9.4-2.1l-0.3,2.8l-6.2-0.2 l-6.5-10.5l5.7-6.7l2.3-13.6l2.7,6.7l2.7,0.9l1.3,2.5l3,1.7l2.6-1.6l3.2,0.8l4.6,3.6l9.4-13.9l2.4,1.6l-0.6,3l2.3,1.8l6.2,2.3 l2.2-1.5l0.62-0.76l1.88,4.66l2.7,1.1l1.5,1.9l2.8,0.4l-0.7,3l1.3,5.2l5.1,4L603.7,362z">
                                                                    </path> @endif


                                                                    @if ($departement[74]->hospitalises
                                                                    <= 50) <path class="region" style="fill: green" id="Haute-Savoie" data-nom="Haute-Savoie" data-numerodepartement="74" class="region-84 departement departement-74 departement-haute-savoie" d="m547,340.1l-2.7-6.7l-0.8-9.3h2.9l4.36-4.71 l2.24,0.91l2.3-1l2.3,0.1l3.4-3.5l2.1-1l1-2.3l-2.8-1.3l1.8-5.1l2.4-0.8l2.3,1l3.6-2.9l9.5-1.3l3.2,0.6l-0.5,2.7l4.2,4.1l-2.1,6.4 l-0.6,1.5l4.6,1.7l-0.1,4.8l2-1.4l4.6,6.6l-1.3,5l-2.5,1.7l-4.9,0.9l-0.6,3.7l0.02,0.04l-0.62,0.76l-2.2,1.5l-6.2-2.3l-2.3-1.8 l0.6-3l-2.4-1.6l-9.4,13.9l-4.6-3.6l-3.2-0.8l-2.6,1.6l-3-1.7l-1.3-2.5L547,340.1z">
                                                                        </path>
                                                                        @endif
                                                                        @if ($departement[74]->hospitalises > 50)
                                                                        <path class="region" style="fill: yellow" id="Haute-Savoie" data-nom="Haute-Savoie" data-numerodepartement="74" class="region-84 departement departement-74 departement-haute-savoie" d="m547,340.1l-2.7-6.7l-0.8-9.3h2.9l4.36-4.71 l2.24,0.91l2.3-1l2.3,0.1l3.4-3.5l2.1-1l1-2.3l-2.8-1.3l1.8-5.1l2.4-0.8l2.3,1l3.6-2.9l9.5-1.3l3.2,0.6l-0.5,2.7l4.2,4.1l-2.1,6.4 l-0.6,1.5l4.6,1.7l-0.1,4.8l2-1.4l4.6,6.6l-1.3,5l-2.5,1.7l-4.9,0.9l-0.6,3.7l0.02,0.04l-0.62,0.76l-2.2,1.5l-6.2-2.3l-2.3-1.8 l0.6-3l-2.4-1.6l-9.4,13.9l-4.6-3.6l-3.2-0.8l-2.6,1.6l-3-1.7l-1.3-2.5L547,340.1z">
                                                                        </path> @endif
                                                                        @if ($departement[74]->hospitalises >= 150)
                                                                        <path class="region" style="fill: pink" id="Haute-Savoie" data-nom="Haute-Savoie" data-numerodepartement="74" class="region-84 departement departement-74 departement-haute-savoie" d="m547,340.1l-2.7-6.7l-0.8-9.3h2.9l4.36-4.71 l2.24,0.91l2.3-1l2.3,0.1l3.4-3.5l2.1-1l1-2.3l-2.8-1.3l1.8-5.1l2.4-0.8l2.3,1l3.6-2.9l9.5-1.3l3.2,0.6l-0.5,2.7l4.2,4.1l-2.1,6.4 l-0.6,1.5l4.6,1.7l-0.1,4.8l2-1.4l4.6,6.6l-1.3,5l-2.5,1.7l-4.9,0.9l-0.6,3.7l0.02,0.04l-0.62,0.76l-2.2,1.5l-6.2-2.3l-2.3-1.8 l0.6-3l-2.4-1.6l-9.4,13.9l-4.6-3.6l-3.2-0.8l-2.6,1.6l-3-1.7l-1.3-2.5L547,340.1z">
                                                                        </path> @endif
                                                                        @if ($departement[74]->hospitalises >= 250)
                                                                        <path class="region" style="fill: purple" id="Haute-Savoie" data-nom="Haute-Savoie" data-numerodepartement="74" class="region-84 departement departement-74 departement-haute-savoie" d="m547,340.1l-2.7-6.7l-0.8-9.3h2.9l4.36-4.71 l2.24,0.91l2.3-1l2.3,0.1l3.4-3.5l2.1-1l1-2.3l-2.8-1.3l1.8-5.1l2.4-0.8l2.3,1l3.6-2.9l9.5-1.3l3.2,0.6l-0.5,2.7l4.2,4.1l-2.1,6.4 l-0.6,1.5l4.6,1.7l-0.1,4.8l2-1.4l4.6,6.6l-1.3,5l-2.5,1.7l-4.9,0.9l-0.6,3.7l0.02,0.04l-0.62,0.76l-2.2,1.5l-6.2-2.3l-2.3-1.8 l0.6-3l-2.4-1.6l-9.4,13.9l-4.6-3.6l-3.2-0.8l-2.6,1.6l-3-1.7l-1.3-2.5L547,340.1z">
                                                                        </path> @endif
                                                                        @if ($departement[74]->hospitalises >= 400)
                                                                        <path class="region" style="fill: red" id="Haute-Savoie" data-nom="Haute-Savoie" data-numerodepartement="74" class="region-84 departement departement-74 departement-haute-savoie" d="m547,340.1l-2.7-6.7l-0.8-9.3h2.9l4.36-4.71 l2.24,0.91l2.3-1l2.3,0.1l3.4-3.5l2.1-1l1-2.3l-2.8-1.3l1.8-5.1l2.4-0.8l2.3,1l3.6-2.9l9.5-1.3l3.2,0.6l-0.5,2.7l4.2,4.1l-2.1,6.4 l-0.6,1.5l4.6,1.7l-0.1,4.8l2-1.4l4.6,6.6l-1.3,5l-2.5,1.7l-4.9,0.9l-0.6,3.7l0.02,0.04l-0.62,0.76l-2.2,1.5l-6.2-2.3l-2.3-1.8 l0.6-3l-2.4-1.6l-9.4,13.9l-4.6-3.6l-3.2-0.8l-2.6,1.6l-3-1.7l-1.3-2.5L547,340.1z">
                                                                        </path> @endif

                    </g>

                    <g data-nom="Provence-Alpes-Côte d&#39;Azur">
                        @if ($departement[3]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Alpes-de-Haute-Provence" data-nom="Alpes-de-Haute-Provence" data-numerodepartement="04" class="region-93 departement departement-04 departement-alpes-de-haute-provence" d="m596.5,409.9l0.57-0.5l-0.37,4.5l-2.2,1.5 l-0.6,2.9l3.5,4l-1.8,4.8l0.19,0.21L589,435.1l-2,5.3l4.3,8.5l7,7.7l-5.2-0.6l-5.2,3.8l1.2,2.6l-3,1.4l-9.8,0.4l-1.2,3.5l-5.9-3.6 l-10.1,8.5l-4-4.8l-2.7,1.8l-5.3-0.2l-6.1-6l-3.4-1.1l1.7-2.5l-3.7-5.2l1.2-3l-2.2-5.4l4.3-4.8l2.3-0.1l1-0.2l5.9-1.4l3.8,1 l-3.4-4.9l3.9,1.1l1.4-8.6l5.3-4l3.3-0.7l3.5,4.5l0.7-3.8l3.8-4.2l11.1,3.3l9-10.2L596.5,409.9z">
                            </path>
                            @endif
                            @if ($departement[3]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Alpes-de-Haute-Provence" data-nom="Alpes-de-Haute-Provence" data-numerodepartement="04" class="region-93 departement departement-04 departement-alpes-de-haute-provence" d="m596.5,409.9l0.57-0.5l-0.37,4.5l-2.2,1.5 l-0.6,2.9l3.5,4l-1.8,4.8l0.19,0.21L589,435.1l-2,5.3l4.3,8.5l7,7.7l-5.2-0.6l-5.2,3.8l1.2,2.6l-3,1.4l-9.8,0.4l-1.2,3.5l-5.9-3.6 l-10.1,8.5l-4-4.8l-2.7,1.8l-5.3-0.2l-6.1-6l-3.4-1.1l1.7-2.5l-3.7-5.2l1.2-3l-2.2-5.4l4.3-4.8l2.3-0.1l1-0.2l5.9-1.4l3.8,1 l-3.4-4.9l3.9,1.1l1.4-8.6l5.3-4l3.3-0.7l3.5,4.5l0.7-3.8l3.8-4.2l11.1,3.3l9-10.2L596.5,409.9z">
                            </path> @endif
                            @if ($departement[3]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Alpes-de-Haute-Provence" data-nom="Alpes-de-Haute-Provence" data-numerodepartement="04" class="region-93 departement departement-04 departement-alpes-de-haute-provence" d="m596.5,409.9l0.57-0.5l-0.37,4.5l-2.2,1.5 l-0.6,2.9l3.5,4l-1.8,4.8l0.19,0.21L589,435.1l-2,5.3l4.3,8.5l7,7.7l-5.2-0.6l-5.2,3.8l1.2,2.6l-3,1.4l-9.8,0.4l-1.2,3.5l-5.9-3.6 l-10.1,8.5l-4-4.8l-2.7,1.8l-5.3-0.2l-6.1-6l-3.4-1.1l1.7-2.5l-3.7-5.2l1.2-3l-2.2-5.4l4.3-4.8l2.3-0.1l1-0.2l5.9-1.4l3.8,1 l-3.4-4.9l3.9,1.1l1.4-8.6l5.3-4l3.3-0.7l3.5,4.5l0.7-3.8l3.8-4.2l11.1,3.3l9-10.2L596.5,409.9z">
                            </path> @endif
                            @if ($departement[3]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Alpes-de-Haute-Provence" data-nom="Alpes-de-Haute-Provence" data-numerodepartement="04" class="region-93 departement departement-04 departement-alpes-de-haute-provence" d="m596.5,409.9l0.57-0.5l-0.37,4.5l-2.2,1.5 l-0.6,2.9l3.5,4l-1.8,4.8l0.19,0.21L589,435.1l-2,5.3l4.3,8.5l7,7.7l-5.2-0.6l-5.2,3.8l1.2,2.6l-3,1.4l-9.8,0.4l-1.2,3.5l-5.9-3.6 l-10.1,8.5l-4-4.8l-2.7,1.8l-5.3-0.2l-6.1-6l-3.4-1.1l1.7-2.5l-3.7-5.2l1.2-3l-2.2-5.4l4.3-4.8l2.3-0.1l1-0.2l5.9-1.4l3.8,1 l-3.4-4.9l3.9,1.1l1.4-8.6l5.3-4l3.3-0.7l3.5,4.5l0.7-3.8l3.8-4.2l11.1,3.3l9-10.2L596.5,409.9z">
                            </path> @endif
                            @if ($departement[3]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Alpes-de-Haute-Provence" data-nom="Alpes-de-Haute-Provence" data-numerodepartement="04" class="region-93 departement departement-04 departement-alpes-de-haute-provence" d="m596.5,409.9l0.57-0.5l-0.37,4.5l-2.2,1.5 l-0.6,2.9l3.5,4l-1.8,4.8l0.19,0.21L589,435.1l-2,5.3l4.3,8.5l7,7.7l-5.2-0.6l-5.2,3.8l1.2,2.6l-3,1.4l-9.8,0.4l-1.2,3.5l-5.9-3.6 l-10.1,8.5l-4-4.8l-2.7,1.8l-5.3-0.2l-6.1-6l-3.4-1.1l1.7-2.5l-3.7-5.2l1.2-3l-2.2-5.4l4.3-4.8l2.3-0.1l1-0.2l5.9-1.4l3.8,1 l-3.4-4.9l3.9,1.1l1.4-8.6l5.3-4l3.3-0.7l3.5,4.5l0.7-3.8l3.8-4.2l11.1,3.3l9-10.2L596.5,409.9z">
                            </path> @endif


                            @if ($departement[4]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Hautes-Alpes" data-nom="Hautes-Alpes" data-numerodepartement="05" class="region-93 departement departement-05 departement-hautes-alpes" d="m597.1,409l-0.03,0.4l-0.57,0.5l-6,3.3l-9,10.2 l-11.1-3.3l-3.8,4.2l-0.7,3.8l-3.5-4.5l-3.3,0.7l-5.3,4l-1.4,8.6l-3.9-1.1l3.4,4.9l-3.8-1l-5.9,1.4l0.2-4.7l-10-5.7l-1.5-2.6 l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3l2.5-6.7l5.8-0.3l0.3-3.4l1-3.1l5.5-1.2l0.9-2.8l12.6-3.9l3.1,1.1l0.4-5.8l-4.4-3.1l-1.8-4.2 l1.6-3.8l7.7,3.5l2-2l6.8-1.9l1.8,4.5l2.4,0.6l1.1,2l0.4,3l1.2,2.2l3,2.3l5.7,0.5l2.2,1.3l-0.7,2.1l3.2,4.7l-3,1.5L597.1,409z">
                                </path>
                                @endif
                                @if ($departement[4]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Hautes-Alpes" data-nom="Hautes-Alpes" data-numerodepartement="05" class="region-93 departement departement-05 departement-hautes-alpes" d="m597.1,409l-0.03,0.4l-0.57,0.5l-6,3.3l-9,10.2 l-11.1-3.3l-3.8,4.2l-0.7,3.8l-3.5-4.5l-3.3,0.7l-5.3,4l-1.4,8.6l-3.9-1.1l3.4,4.9l-3.8-1l-5.9,1.4l0.2-4.7l-10-5.7l-1.5-2.6 l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3l2.5-6.7l5.8-0.3l0.3-3.4l1-3.1l5.5-1.2l0.9-2.8l12.6-3.9l3.1,1.1l0.4-5.8l-4.4-3.1l-1.8-4.2 l1.6-3.8l7.7,3.5l2-2l6.8-1.9l1.8,4.5l2.4,0.6l1.1,2l0.4,3l1.2,2.2l3,2.3l5.7,0.5l2.2,1.3l-0.7,2.1l3.2,4.7l-3,1.5L597.1,409z">
                                </path> @endif
                                @if ($departement[4]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Hautes-Alpes" data-nom="Hautes-Alpes" data-numerodepartement="05" class="region-93 departement departement-05 departement-hautes-alpes" d="m597.1,409l-0.03,0.4l-0.57,0.5l-6,3.3l-9,10.2 l-11.1-3.3l-3.8,4.2l-0.7,3.8l-3.5-4.5l-3.3,0.7l-5.3,4l-1.4,8.6l-3.9-1.1l3.4,4.9l-3.8-1l-5.9,1.4l0.2-4.7l-10-5.7l-1.5-2.6 l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3l2.5-6.7l5.8-0.3l0.3-3.4l1-3.1l5.5-1.2l0.9-2.8l12.6-3.9l3.1,1.1l0.4-5.8l-4.4-3.1l-1.8-4.2 l1.6-3.8l7.7,3.5l2-2l6.8-1.9l1.8,4.5l2.4,0.6l1.1,2l0.4,3l1.2,2.2l3,2.3l5.7,0.5l2.2,1.3l-0.7,2.1l3.2,4.7l-3,1.5L597.1,409z">
                                </path> @endif
                                @if ($departement[4]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Hautes-Alpes" data-nom="Hautes-Alpes" data-numerodepartement="05" class="region-93 departement departement-05 departement-hautes-alpes" d="m597.1,409l-0.03,0.4l-0.57,0.5l-6,3.3l-9,10.2 l-11.1-3.3l-3.8,4.2l-0.7,3.8l-3.5-4.5l-3.3,0.7l-5.3,4l-1.4,8.6l-3.9-1.1l3.4,4.9l-3.8-1l-5.9,1.4l0.2-4.7l-10-5.7l-1.5-2.6 l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3l2.5-6.7l5.8-0.3l0.3-3.4l1-3.1l5.5-1.2l0.9-2.8l12.6-3.9l3.1,1.1l0.4-5.8l-4.4-3.1l-1.8-4.2 l1.6-3.8l7.7,3.5l2-2l6.8-1.9l1.8,4.5l2.4,0.6l1.1,2l0.4,3l1.2,2.2l3,2.3l5.7,0.5l2.2,1.3l-0.7,2.1l3.2,4.7l-3,1.5L597.1,409z">
                                </path> @endif
                                @if ($departement[4]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Hautes-Alpes" data-nom="Hautes-Alpes" data-numerodepartement="05" class="region-93 departement departement-05 departement-hautes-alpes" d="m597.1,409l-0.03,0.4l-0.57,0.5l-6,3.3l-9,10.2 l-11.1-3.3l-3.8,4.2l-0.7,3.8l-3.5-4.5l-3.3,0.7l-5.3,4l-1.4,8.6l-3.9-1.1l3.4,4.9l-3.8-1l-5.9,1.4l0.2-4.7l-10-5.7l-1.5-2.6 l3.2-5.1l4.2,1.4l2.5-2.5l-3-2.3l2.5-6.7l5.8-0.3l0.3-3.4l1-3.1l5.5-1.2l0.9-2.8l12.6-3.9l3.1,1.1l0.4-5.8l-4.4-3.1l-1.8-4.2 l1.6-3.8l7.7,3.5l2-2l6.8-1.9l1.8,4.5l2.4,0.6l1.1,2l0.4,3l1.2,2.2l3,2.3l5.7,0.5l2.2,1.3l-0.7,2.1l3.2,4.7l-3,1.5L597.1,409z">
                                </path> @endif


                                @if ($departement[5]->hospitalises
                                <= 50) <path class="region" style="fill: green" id="Alpes-Maritimes" data-nom="Alpes-Maritimes" data-numerodepartement="06" class="region-93 departement departement-06 departement-alpes-maritimes" d="m605.3,477.1l-3.2-0.1l-1.3,1.8l-0.1,2.2 l-0.42,0.77l-2.18-3.97l0.8-2.9l-5.6-2.6l-1.7-5.6l-5.5-2.9l3-1.4l-1.2-2.6l5.2-3.8l5.2,0.6l-7-7.7l-4.3-8.5l2-5.3l6.79-7.79 l6.91,7.79l6.9,1.6l4.2,2.8l2.5-0.4l1.8,1.4l10.3-2.4l2.7-1.8l-0.3,2.6l1.5,2.2l0.3,3.2l-1.6,1.9l-0.2,2.3l-2.7,1.6l-3.3,5l-0.5,1.6 l1.1,2.7l-1.1,2.7l-3.5,2.9l-2.3,0.5l-0.9,2.4l-3-0.9l-1.5,2.1l-2.3,0.5L609,472l0.1,2.8l-2.4,0.6L605.3,477.1z">
                                    </path>
                                    @endif
                                    @if ($departement[5]->hospitalises > 50)
                                    <path class="region" style="fill: yellow" id="Alpes-Maritimes" data-nom="Alpes-Maritimes" data-numerodepartement="06" class="region-93 departement departement-06 departement-alpes-maritimes" d="m605.3,477.1l-3.2-0.1l-1.3,1.8l-0.1,2.2 l-0.42,0.77l-2.18-3.97l0.8-2.9l-5.6-2.6l-1.7-5.6l-5.5-2.9l3-1.4l-1.2-2.6l5.2-3.8l5.2,0.6l-7-7.7l-4.3-8.5l2-5.3l6.79-7.79 l6.91,7.79l6.9,1.6l4.2,2.8l2.5-0.4l1.8,1.4l10.3-2.4l2.7-1.8l-0.3,2.6l1.5,2.2l0.3,3.2l-1.6,1.9l-0.2,2.3l-2.7,1.6l-3.3,5l-0.5,1.6 l1.1,2.7l-1.1,2.7l-3.5,2.9l-2.3,0.5l-0.9,2.4l-3-0.9l-1.5,2.1l-2.3,0.5L609,472l0.1,2.8l-2.4,0.6L605.3,477.1z">
                                    </path> @endif
                                    @if ($departement[5]->hospitalises >= 150)
                                    <path class="region" style="fill: pink" id="Alpes-Maritimes" data-nom="Alpes-Maritimes" data-numerodepartement="06" class="region-93 departement departement-06 departement-alpes-maritimes" d="m605.3,477.1l-3.2-0.1l-1.3,1.8l-0.1,2.2 l-0.42,0.77l-2.18-3.97l0.8-2.9l-5.6-2.6l-1.7-5.6l-5.5-2.9l3-1.4l-1.2-2.6l5.2-3.8l5.2,0.6l-7-7.7l-4.3-8.5l2-5.3l6.79-7.79 l6.91,7.79l6.9,1.6l4.2,2.8l2.5-0.4l1.8,1.4l10.3-2.4l2.7-1.8l-0.3,2.6l1.5,2.2l0.3,3.2l-1.6,1.9l-0.2,2.3l-2.7,1.6l-3.3,5l-0.5,1.6 l1.1,2.7l-1.1,2.7l-3.5,2.9l-2.3,0.5l-0.9,2.4l-3-0.9l-1.5,2.1l-2.3,0.5L609,472l0.1,2.8l-2.4,0.6L605.3,477.1z">
                                    </path> @endif
                                    @if ($departement[5]->hospitalises >= 250)
                                    <path class="region" style="fill: purple" id="Alpes-Maritimes" data-nom="Alpes-Maritimes" data-numerodepartement="06" class="region-93 departement departement-06 departement-alpes-maritimes" d="m605.3,477.1l-3.2-0.1l-1.3,1.8l-0.1,2.2 l-0.42,0.77l-2.18-3.97l0.8-2.9l-5.6-2.6l-1.7-5.6l-5.5-2.9l3-1.4l-1.2-2.6l5.2-3.8l5.2,0.6l-7-7.7l-4.3-8.5l2-5.3l6.79-7.79 l6.91,7.79l6.9,1.6l4.2,2.8l2.5-0.4l1.8,1.4l10.3-2.4l2.7-1.8l-0.3,2.6l1.5,2.2l0.3,3.2l-1.6,1.9l-0.2,2.3l-2.7,1.6l-3.3,5l-0.5,1.6 l1.1,2.7l-1.1,2.7l-3.5,2.9l-2.3,0.5l-0.9,2.4l-3-0.9l-1.5,2.1l-2.3,0.5L609,472l0.1,2.8l-2.4,0.6L605.3,477.1z">
                                    </path> @endif
                                    @if ($departement[5]->hospitalises >= 400)
                                    <path class="region" style="fill: red" id="Alpes-Maritimes" data-nom="Alpes-Maritimes" data-numerodepartement="06" class="region-93 departement departement-06 departement-alpes-maritimes" d="m605.3,477.1l-3.2-0.1l-1.3,1.8l-0.1,2.2 l-0.42,0.77l-2.18-3.97l0.8-2.9l-5.6-2.6l-1.7-5.6l-5.5-2.9l3-1.4l-1.2-2.6l5.2-3.8l5.2,0.6l-7-7.7l-4.3-8.5l2-5.3l6.79-7.79 l6.91,7.79l6.9,1.6l4.2,2.8l2.5-0.4l1.8,1.4l10.3-2.4l2.7-1.8l-0.3,2.6l1.5,2.2l0.3,3.2l-1.6,1.9l-0.2,2.3l-2.7,1.6l-3.3,5l-0.5,1.6 l1.1,2.7l-1.1,2.7l-3.5,2.9l-2.3,0.5l-0.9,2.4l-3-0.9l-1.5,2.1l-2.3,0.5L609,472l0.1,2.8l-2.4,0.6L605.3,477.1z">
                                    </path> @endif


                                    @if ($departement[12]->hospitalises
                                    <= 50) <path class="region" style="fill: green" id="Bouches-du-Rhône" data-nom="Bouches-du-Rhône" data-numerodepartement="13" class="region-93 departement departement-13 departement-bouches-du-rhone" d="m545,500.2l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5 l-5.5-9.1l2-5.3l3.3-0.8l-1.9-3.8l-0.1-0.1l-6.6,4.3l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l-3.9,4.1l-1.9,10.6 l-3.3-0.9l-4.2,4.8l1,2.7l-5.8,1.8l-3.1,4.9l0.2,0.1h13.2l2.2,0.9l1,2.2l-1.6,1.5l2.2,1.4l7.4,0.1l3.2,1.3l1.8-1.7l-1.5-2.8l0.4-2.4 l4.9,1l3,5.3l10-0.8l2.6-1.1l1.8,2l-0.2,2.5l1,2l-1.2,2.2h9.2l1.3,2l2.2-0.8l1.7,0.2L545,500.2z">
                                        </path>
                                        @endif
                                        @if ($departement[12]->hospitalises > 50)
                                        <path class="region" style="fill: yellow" id="Bouches-du-Rhône" data-nom="Bouches-du-Rhône" data-numerodepartement="13" class="region-93 departement departement-13 departement-bouches-du-rhone" d="m545,500.2l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5 l-5.5-9.1l2-5.3l3.3-0.8l-1.9-3.8l-0.1-0.1l-6.6,4.3l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l-3.9,4.1l-1.9,10.6 l-3.3-0.9l-4.2,4.8l1,2.7l-5.8,1.8l-3.1,4.9l0.2,0.1h13.2l2.2,0.9l1,2.2l-1.6,1.5l2.2,1.4l7.4,0.1l3.2,1.3l1.8-1.7l-1.5-2.8l0.4-2.4 l4.9,1l3,5.3l10-0.8l2.6-1.1l1.8,2l-0.2,2.5l1,2l-1.2,2.2h9.2l1.3,2l2.2-0.8l1.7,0.2L545,500.2z">
                                        </path> @endif
                                        @if ($departement[12]->hospitalises >= 150)
                                        <path class="region" style="fill: pink" id="Bouches-du-Rhône" data-nom="Bouches-du-Rhône" data-numerodepartement="13" class="region-93 departement departement-13 departement-bouches-du-rhone" d="m545,500.2l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5 l-5.5-9.1l2-5.3l3.3-0.8l-1.9-3.8l-0.1-0.1l-6.6,4.3l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l-3.9,4.1l-1.9,10.6 l-3.3-0.9l-4.2,4.8l1,2.7l-5.8,1.8l-3.1,4.9l0.2,0.1h13.2l2.2,0.9l1,2.2l-1.6,1.5l2.2,1.4l7.4,0.1l3.2,1.3l1.8-1.7l-1.5-2.8l0.4-2.4 l4.9,1l3,5.3l10-0.8l2.6-1.1l1.8,2l-0.2,2.5l1,2l-1.2,2.2h9.2l1.3,2l2.2-0.8l1.7,0.2L545,500.2z">
                                        </path> @endif
                                        @if ($departement[12]->hospitalises >= 250)
                                        <path class="region" style="fill: purple" id="Bouches-du-Rhône" data-nom="Bouches-du-Rhône" data-numerodepartement="13" class="region-93 departement departement-13 departement-bouches-du-rhone" d="m545,500.2l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5 l-5.5-9.1l2-5.3l3.3-0.8l-1.9-3.8l-0.1-0.1l-6.6,4.3l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l-3.9,4.1l-1.9,10.6 l-3.3-0.9l-4.2,4.8l1,2.7l-5.8,1.8l-3.1,4.9l0.2,0.1h13.2l2.2,0.9l1,2.2l-1.6,1.5l2.2,1.4l7.4,0.1l3.2,1.3l1.8-1.7l-1.5-2.8l0.4-2.4 l4.9,1l3,5.3l10-0.8l2.6-1.1l1.8,2l-0.2,2.5l1,2l-1.2,2.2h9.2l1.3,2l2.2-0.8l1.7,0.2L545,500.2z">
                                        </path> @endif
                                        @if ($departement[12]->hospitalises >= 400)
                                        <path class="region" style="fill: red" id="Bouches-du-Rhône" data-nom="Bouches-du-Rhône" data-numerodepartement="13" class="region-93 departement departement-13 departement-bouches-du-rhone" d="m545,500.2l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5 l-5.5-9.1l2-5.3l3.3-0.8l-1.9-3.8l-0.1-0.1l-6.6,4.3l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l-3.9,4.1l-1.9,10.6 l-3.3-0.9l-4.2,4.8l1,2.7l-5.8,1.8l-3.1,4.9l0.2,0.1h13.2l2.2,0.9l1,2.2l-1.6,1.5l2.2,1.4l7.4,0.1l3.2,1.3l1.8-1.7l-1.5-2.8l0.4-2.4 l4.9,1l3,5.3l10-0.8l2.6-1.1l1.8,2l-0.2,2.5l1,2l-1.2,2.2h9.2l1.3,2l2.2-0.8l1.7,0.2L545,500.2z">
                                        </path> @endif

                                        @if ($departement[83]->hospitalises
                                        <= 50) <path class="region" style="fill: green" id="Var" data-nom="Var" data-numerodepartement="83" class="region-93 departement departement-83 departement-var" d="m600.28,481.77l-1.38,2.53l-6.8,1.7l-0.7,2.5 l-5.5,5.7l5,0.7l-2,4.8l-4,0.2l-4.8,2.5l-3.5,1.1l0.1,2.7l-4.9-1.5l-2.7,0.5l-1.6,1.6l-0.4,2.3l-2.2,1.6l1.4-1.8l-2.4-1.7l-2.2,0.7 l-1.6-1.6l-3.1,0.1l0.9,2.2l-2.3-0.4l-1.5,1.7l-3-1.1l0.6-2.3l-6.4-4.1l-0.5-0.1l0.2-2.1l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5l-5.5-9.1 l2-5.3l3.3-0.8l-1.9-3.8l0.1-0.4l5.3,0.2l2.7-1.8l4,4.8l10.1-8.5l5.9,3.6l1.2-3.5l9.8-0.4l5.5,2.9l1.7,5.6l5.6,2.6l-0.8,2.9 L600.28,481.77z">
                                            </path>
                                            @endif
                                            @if ($departement[83]->hospitalises > 50)
                                            <path class="region" style="fill: yellow" id="Var" data-nom="Var" data-numerodepartement="83" class="region-93 departement departement-83 departement-var" d="m600.28,481.77l-1.38,2.53l-6.8,1.7l-0.7,2.5 l-5.5,5.7l5,0.7l-2,4.8l-4,0.2l-4.8,2.5l-3.5,1.1l0.1,2.7l-4.9-1.5l-2.7,0.5l-1.6,1.6l-0.4,2.3l-2.2,1.6l1.4-1.8l-2.4-1.7l-2.2,0.7 l-1.6-1.6l-3.1,0.1l0.9,2.2l-2.3-0.4l-1.5,1.7l-3-1.1l0.6-2.3l-6.4-4.1l-0.5-0.1l0.2-2.1l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5l-5.5-9.1 l2-5.3l3.3-0.8l-1.9-3.8l0.1-0.4l5.3,0.2l2.7-1.8l4,4.8l10.1-8.5l5.9,3.6l1.2-3.5l9.8-0.4l5.5,2.9l1.7,5.6l5.6,2.6l-0.8,2.9 L600.28,481.77z">
                                            </path> @endif
                                            @if ($departement[83]->hospitalises >= 150)
                                            <path class="region" style="fill: pink" id="Var" data-nom="Var" data-numerodepartement="83" class="region-93 departement departement-83 departement-var" d="m600.28,481.77l-1.38,2.53l-6.8,1.7l-0.7,2.5 l-5.5,5.7l5,0.7l-2,4.8l-4,0.2l-4.8,2.5l-3.5,1.1l0.1,2.7l-4.9-1.5l-2.7,0.5l-1.6,1.6l-0.4,2.3l-2.2,1.6l1.4-1.8l-2.4-1.7l-2.2,0.7 l-1.6-1.6l-3.1,0.1l0.9,2.2l-2.3-0.4l-1.5,1.7l-3-1.1l0.6-2.3l-6.4-4.1l-0.5-0.1l0.2-2.1l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5l-5.5-9.1 l2-5.3l3.3-0.8l-1.9-3.8l0.1-0.4l5.3,0.2l2.7-1.8l4,4.8l10.1-8.5l5.9,3.6l1.2-3.5l9.8-0.4l5.5,2.9l1.7,5.6l5.6,2.6l-0.8,2.9 L600.28,481.77z">
                                            </path> @endif
                                            @if ($departement[83]->hospitalises >= 250)
                                            <path class="region" style="fill: purple" id="Var" data-nom="Var" data-numerodepartement="83" class="region-93 departement departement-83 departement-var" d="m600.28,481.77l-1.38,2.53l-6.8,1.7l-0.7,2.5 l-5.5,5.7l5,0.7l-2,4.8l-4,0.2l-4.8,2.5l-3.5,1.1l0.1,2.7l-4.9-1.5l-2.7,0.5l-1.6,1.6l-0.4,2.3l-2.2,1.6l1.4-1.8l-2.4-1.7l-2.2,0.7 l-1.6-1.6l-3.1,0.1l0.9,2.2l-2.3-0.4l-1.5,1.7l-3-1.1l0.6-2.3l-6.4-4.1l-0.5-0.1l0.2-2.1l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5l-5.5-9.1 l2-5.3l3.3-0.8l-1.9-3.8l0.1-0.4l5.3,0.2l2.7-1.8l4,4.8l10.1-8.5l5.9,3.6l1.2-3.5l9.8-0.4l5.5,2.9l1.7,5.6l5.6,2.6l-0.8,2.9 L600.28,481.77z">
                                            </path> @endif
                                            @if ($departement[83]->hospitalises >= 400)
                                            <path class="region" style="fill: red" id="Var" data-nom="Var" data-numerodepartement="83" class="region-93 departement departement-83 departement-var" d="m600.28,481.77l-1.38,2.53l-6.8,1.7l-0.7,2.5 l-5.5,5.7l5,0.7l-2,4.8l-4,0.2l-4.8,2.5l-3.5,1.1l0.1,2.7l-4.9-1.5l-2.7,0.5l-1.6,1.6l-0.4,2.3l-2.2,1.6l1.4-1.8l-2.4-1.7l-2.2,0.7 l-1.6-1.6l-3.1,0.1l0.9,2.2l-2.3-0.4l-1.5,1.7l-3-1.1l0.6-2.3l-6.4-4.1l-0.5-0.1l0.2-2.1l2.5-2l-2.2-6.3l1.1-2.6l2.7-0.5l-5.5-9.1 l2-5.3l3.3-0.8l-1.9-3.8l0.1-0.4l5.3,0.2l2.7-1.8l4,4.8l10.1-8.5l5.9,3.6l1.2-3.5l9.8-0.4l5.5,2.9l1.7,5.6l5.6,2.6l-0.8,2.9 L600.28,481.77z">
                                            </path>@endif


                                            @if ($departement[84]->hospitalises
                                            <= 50) <path class="region" style="fill: green" id="Vaucluse" data-nom="Vaucluse" data-numerodepartement="84" class="region-93 departement departement-84 departement-vaucluse" d="m541,463.4l6.1,6l-0.1,0.4l-0.1-0.1l-6.6,4.3 l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l4.5-5l-6.3-6.4l-0.2-5.5l-2.6-4.4l-0.1-3.7l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l2.2,5.4l-1.2,3l3.7,5.2l-1.7,2.5L541,463.4z">
                                                </path>
                                                @endif
                                                @if ($departement[84]->hospitalises > 50)
                                                <path class="region" style="fill: yellow" id="Vaucluse" data-nom="Vaucluse" data-numerodepartement="84" class="region-93 departement departement-84 departement-vaucluse" d="m541,463.4l6.1,6l-0.1,0.4l-0.1-0.1l-6.6,4.3 l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l4.5-5l-6.3-6.4l-0.2-5.5l-2.6-4.4l-0.1-3.7l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l2.2,5.4l-1.2,3l3.7,5.2l-1.7,2.5L541,463.4z">
                                                </path> @endif
                                                @if ($departement[84]->hospitalises >= 150)
                                                <path class="region" style="fill: pink" id="Vaucluse" data-nom="Vaucluse" data-numerodepartement="84" class="region-93 departement departement-84 departement-vaucluse" d="m541,463.4l6.1,6l-0.1,0.4l-0.1-0.1l-6.6,4.3 l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l4.5-5l-6.3-6.4l-0.2-5.5l-2.6-4.4l-0.1-3.7l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l2.2,5.4l-1.2,3l3.7,5.2l-1.7,2.5L541,463.4z">
                                                </path>@endif
                                                @if ($departement[84]->hospitalises >= 250)
                                                <path class="region" style="fill: purple" id="Vaucluse" data-nom="Vaucluse" data-numerodepartement="84" class="region-93 departement departement-84 departement-vaucluse" d="m541,463.4l6.1,6l-0.1,0.4l-0.1-0.1l-6.6,4.3 l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l4.5-5l-6.3-6.4l-0.2-5.5l-2.6-4.4l-0.1-3.7l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l2.2,5.4l-1.2,3l3.7,5.2l-1.7,2.5L541,463.4z">
                                                </path> @endif
                                                @if ($departement[84]->hospitalises >= 400)
                                                <path class="region" style="fill: red" id="Vaucluse" data-nom="Vaucluse" data-numerodepartement="84" class="region-93 departement departement-84 departement-vaucluse" d="m541,463.4l6.1,6l-0.1,0.4l-0.1-0.1l-6.6,4.3 l-3.2,0.2l-12-4.8l-3.5,0.7l-4.5-2.3l-5.5-5.7l-10.4-2.9l4.5-5l-6.3-6.4l-0.2-5.5l-2.6-4.4l-0.1-3.7l5.9,0.7l3.5,4.2l8.7-3.9 l2.4,1.4l2.5-2.2l0.5,5.8l9.3,0.9l0.1,2.8l5.2,2.3l2.2,5.4l-1.2,3l3.7,5.2l-1.7,2.5L541,463.4z">
                                                </path>@endif
                    </g>

                    <g data-nom="Corse">

                        @if ($departement[28]->hospitalises
                        <= 50) <path class="region" style="fill: green" id="Corse-du-Sud" data-nom="Corse-du-Sud" data-numerodepartement="2A" class="region-94 departement departement-2A departement-corse-du-sud" d="m640.5,554.2l3.2-1.7l0.7,8.4l-0.15,0.54 l-1.85,4.86l-2.7,1.9l3.3,0.4l-5.8,14.7l-3.1-1.2l-1.2-2.8l-11.2-3.4l-4.8-4.4l0.2-3l4.9-3.3l-9.5-1.9l2.7-7l-0.9-5.8l-7.3,2.6 l3-8.4l2.6-1.6l-7.9-4.4l-1.1-5.5l5.3-3.8l-3.8-4.2l-2.6,1l0.5-2.7l13.6,2.1l1.2,3.5l6,3.4l6,5.9l0.5,3.2l2.7,1.1l3.7,11 L640.5,554.2z">
                            </path>

                            @endif
                            @if ($departement[28]->hospitalises > 50)
                            <path class="region" style="fill: yellow" id="Corse-du-Sud" data-nom="Corse-du-Sud" data-numerodepartement="2A" class="region-94 departement departement-2A departement-corse-du-sud" d="m640.5,554.2l3.2-1.7l0.7,8.4l-0.15,0.54 l-1.85,4.86l-2.7,1.9l3.3,0.4l-5.8,14.7l-3.1-1.2l-1.2-2.8l-11.2-3.4l-4.8-4.4l0.2-3l4.9-3.3l-9.5-1.9l2.7-7l-0.9-5.8l-7.3,2.6 l3-8.4l2.6-1.6l-7.9-4.4l-1.1-5.5l5.3-3.8l-3.8-4.2l-2.6,1l0.5-2.7l13.6,2.1l1.2,3.5l6,3.4l6,5.9l0.5,3.2l2.7,1.1l3.7,11 L640.5,554.2z"></path>
                            @endif
                            @if ($departement[28]->hospitalises >= 150)
                            <path class="region" style="fill: pink" id="Corse-du-Sud" data-nom="Corse-du-Sud" data-numerodepartement="2A" class="region-94 departement departement-2A departement-corse-du-sud" d="m640.5,554.2l3.2-1.7l0.7,8.4l-0.15,0.54 l-1.85,4.86l-2.7,1.9l3.3,0.4l-5.8,14.7l-3.1-1.2l-1.2-2.8l-11.2-3.4l-4.8-4.4l0.2-3l4.9-3.3l-9.5-1.9l2.7-7l-0.9-5.8l-7.3,2.6 l3-8.4l2.6-1.6l-7.9-4.4l-1.1-5.5l5.3-3.8l-3.8-4.2l-2.6,1l0.5-2.7l13.6,2.1l1.2,3.5l6,3.4l6,5.9l0.5,3.2l2.7,1.1l3.7,11 L640.5,554.2z"></path>
                            @endif
                            @if ($departement[28]->hospitalises >= 250)
                            <path class="region" style="fill: purple" id="Corse-du-Sud" data-nom="Corse-du-Sud" data-numerodepartement="2A" class="region-94 departement departement-2A departement-corse-du-sud" d="m640.5,554.2l3.2-1.7l0.7,8.4l-0.15,0.54 l-1.85,4.86l-2.7,1.9l3.3,0.4l-5.8,14.7l-3.1-1.2l-1.2-2.8l-11.2-3.4l-4.8-4.4l0.2-3l4.9-3.3l-9.5-1.9l2.7-7l-0.9-5.8l-7.3,2.6 l3-8.4l2.6-1.6l-7.9-4.4l-1.1-5.5l5.3-3.8l-3.8-4.2l-2.6,1l0.5-2.7l13.6,2.1l1.2,3.5l6,3.4l6,5.9l0.5,3.2l2.7,1.1l3.7,11 L640.5,554.2z"></path>
                            @endif
                            @if ($departement[28]->hospitalises >= 400)
                            <path class="region" style="fill: red" id="Corse-du-Sud" data-nom="Corse-du-Sud" data-numerodepartement="2A" class="region-94 departement departement-2A departement-corse-du-sud" d="m640.5,554.2l3.2-1.7l0.7,8.4l-0.15,0.54 l-1.85,4.86l-2.7,1.9l3.3,0.4l-5.8,14.7l-3.1-1.2l-1.2-2.8l-11.2-3.4l-4.8-4.4l0.2-3l4.9-3.3l-9.5-1.9l2.7-7l-0.9-5.8l-7.3,2.6 l3-8.4l2.6-1.6l-7.9-4.4l-1.1-5.5l5.3-3.8l-3.8-4.2l-2.6,1l0.5-2.7l13.6,2.1l1.2,3.5l6,3.4l6,5.9l0.5,3.2l2.7,1.1l3.7,11 L640.5,554.2z"></path>
                            @endif


                            @if ($departement[29]->hospitalises
                            <= 50) <path class="region" style="fill: green" id="Haute-Corse" data-nom="Haute-Corse" data-numerodepartement="2B" class="region-94 departement departement-2B departement-haute-corse" d="m643.7,551.5v1l-3.2,1.7l-3.8-0.5l-3.7-11 l-2.7-1.1l-0.5-3.2l-6-5.9l-6-3.4l-1.2-3.5l-13.6-2.1v-0.2l3.9-5l-0.3-3.4l2.2-2.8l2.8-0.3l0.9-2.9l10.7-4.2l3.5-4.9l8.6,1.3 l-0.5-17.4l2.4-2l2.9,1.1l0.18,0.89l1.52,8.21l-0.5,10.6l4,5.6l3.8,26l-5.4,11.9V551.5L643.7,551.5z">
                                </path>

                                @endif
                                @if ($departement[29]->hospitalises > 50)
                                <path class="region" style="fill: yellow" id="Haute-Corse" data-nom="Haute-Corse" data-numerodepartement="2B" class="region-94 departement departement-2B departement-haute-corse" d="m643.7,551.5v1l-3.2,1.7l-3.8-0.5l-3.7-11 l-2.7-1.1l-0.5-3.2l-6-5.9l-6-3.4l-1.2-3.5l-13.6-2.1v-0.2l3.9-5l-0.3-3.4l2.2-2.8l2.8-0.3l0.9-2.9l10.7-4.2l3.5-4.9l8.6,1.3 l-0.5-17.4l2.4-2l2.9,1.1l0.18,0.89l1.52,8.21l-0.5,10.6l4,5.6l3.8,26l-5.4,11.9V551.5L643.7,551.5z"></path>
                                @endif
                                @if ($departement[29]->hospitalises >= 150)
                                <path class="region" style="fill: pink" id="Haute-Corse" data-nom="Haute-Corse" data-numerodepartement="2B" class="region-94 departement departement-2B departement-haute-corse" d="m643.7,551.5v1l-3.2,1.7l-3.8-0.5l-3.7-11 l-2.7-1.1l-0.5-3.2l-6-5.9l-6-3.4l-1.2-3.5l-13.6-2.1v-0.2l3.9-5l-0.3-3.4l2.2-2.8l2.8-0.3l0.9-2.9l10.7-4.2l3.5-4.9l8.6,1.3 l-0.5-17.4l2.4-2l2.9,1.1l0.18,0.89l1.52,8.21l-0.5,10.6l4,5.6l3.8,26l-5.4,11.9V551.5L643.7,551.5z"></path>
                                @endif
                                @if ($departement[29]->hospitalises >= 250)
                                <path class="region" style="fill: purple" id="Haute-Corse" data-nom="Haute-Corse" data-numerodepartement="2B" class="region-94 departement departement-2B departement-haute-corse" d="m643.7,551.5v1l-3.2,1.7l-3.8-0.5l-3.7-11 l-2.7-1.1l-0.5-3.2l-6-5.9l-6-3.4l-1.2-3.5l-13.6-2.1v-0.2l3.9-5l-0.3-3.4l2.2-2.8l2.8-0.3l0.9-2.9l10.7-4.2l3.5-4.9l8.6,1.3 l-0.5-17.4l2.4-2l2.9,1.1l0.18,0.89l1.52,8.21l-0.5,10.6l4,5.6l3.8,26l-5.4,11.9V551.5L643.7,551.5z"></path>
                                @endif
                                @if ($departement[29]->hospitalises >= 400)
                                <path class="region" style="fill: red" id="Haute-Corse" data-nom="Haute-Corse" data-numerodepartement="2B" class="region-94 departement departement-2B departement-haute-corse" d="m643.7,551.5v1l-3.2,1.7l-3.8-0.5l-3.7-11 l-2.7-1.1l-0.5-3.2l-6-5.9l-6-3.4l-1.2-3.5l-13.6-2.1v-0.2l3.9-5l-0.3-3.4l2.2-2.8l2.8-0.3l0.9-2.9l10.7-4.2l3.5-4.9l8.6,1.3 l-0.5-17.4l2.4-2l2.9,1.1l0.18,0.89l1.52,8.21l-0.5,10.6l4,5.6l3.8,26l-5.4,11.9V551.5L643.7,551.5z"></path>
                                @endif
                    </g>
                </svg>

                <!-- Création d'une fenêtre détail quand on clique sur un département de la carte afin de voir les données relatives au département. -->


                <div class="region-detail" id="Guadeloupe-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Guadeloupe</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[96]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[96]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[96]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[96]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[96]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Martinique-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Martinique</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[97]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[97]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[97]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[97]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[97]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Guyane-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Guyane</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[98]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[98]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[98]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[98]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[98]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="La-Réunion-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">La-Réunion</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[99]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[99]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[99]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[99]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[99]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Mayotte-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Mayotte</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[100]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[100]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[100]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[100]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[100]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Paris-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Paris</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[75]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[75]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[75]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[75]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[75]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Seine-et-Marne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Seine-et-Marne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[77]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[77]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[77]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[77]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[77]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Yvelines-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Yvelines</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[78]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[78]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[78]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[78]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[78]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Essonne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Essonne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[91]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[91]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[91]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[91]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[91]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Hauts-de-Seine-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Hauts-de-Seine</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[92]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[92]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[92]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[92]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[92]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Seine-Saint-Denis-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Seine-Saint-Denis</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[93]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[93]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[93]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[93]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[93]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Val-de-Marne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Val-de-Marne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[94]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[94]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[94]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[94]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[94]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Val-d’Oise-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Val-d’Oise</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[95]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[95]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[95]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[95]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[95]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Cher-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Cher</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[17]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[17]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[17]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[17]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[17]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Eure-et-Loir-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Eure-et-Loir</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[26]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[26]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[26]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[26]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[26]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Indre-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Indre</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[36]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[36]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[36]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[36]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[36]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Indre-et-Loire-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Indre-et-Loire</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[37]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[37]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[37]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[37]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[37]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Loir-et-Cher-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Loir-et-Cher</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[41]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[41]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[41]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[41]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[41]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Loiret-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Loiret</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[45]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[45]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[45]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[45]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[45]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Côte-d’Or-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Côte-d’Or</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[19]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[19]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[19]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[19]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[19]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Doubs-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Doubs</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[23]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[23]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[23]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[23]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[23]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Jura-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Jura</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[39]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[39]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[39]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[39]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[39]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Nièvre-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Nièvre</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[58]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[58]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[58]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[58]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[58]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Saône-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute-Saône</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[70]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[70]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[70]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[70]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[70]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Saône-et-Loire-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Saône-et-Loire</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[71]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[71]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[71]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[71]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[71]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Yonne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Yonne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[89]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[89]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[89]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[89]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[89]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Territoire de Belfort-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Territoire de Belfort</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[90]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[90]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[90]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[90]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[90]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Calvados-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Calvados</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[13]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[13]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[13]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[13]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[13]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Eure-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Eure</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[25]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[25]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[25]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[25]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[25]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Manche-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Manche</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[50]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[50]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[50]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[50]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[50]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Orne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Orne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[61]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[61]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[61]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[61]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[61]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Seine-Maritime-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Seine-Maritime</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[76]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[76]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[76]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[76]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[76]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Aisne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Aisne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[1]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[1]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[1]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[1]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[1]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Nord-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Nord</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[59]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[59]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[59]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[59]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[59]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Oise-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Oise</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[60]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[60]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[60]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[60]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[60]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Pas-de-Calais-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Pas-de-Calais</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[62]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[62]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[62]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[62]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[62]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Somme-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Somme</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[80]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[80]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[80]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[80]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[80]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Ardennes-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Ardennes</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[7]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[7]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[7]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[7]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[7]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Aube-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Aube</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[9]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[9]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[9]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[9]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[9]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Marne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Marne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[51]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[51]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[51]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[51]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[51]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Marne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute-Marne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[52]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[52]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[52]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[52]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[52]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Meurthe-et-Moselle-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Meurthe-et-Moselle</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[54]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[54]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[54]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[54]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[54]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Meuse-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Meuse</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[55]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[55]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[55]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[55]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[55]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Moselle-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Moselle</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[57]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[57]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[57]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[57]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[57]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Bas-Rhin-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Bas-Rhin</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[67]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[67]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[67]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[67]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[67]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haut-Rhin-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haut-Rhin</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[68]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[68]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[68]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[68]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[68]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Vosges-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Vosges</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[88]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[88]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[88]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[88]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[88]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Loire-Atlantique-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Loire-Atlantique</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[44]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[44]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[44]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[44]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[44]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Maine-et-Loire-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Maine-et-Loire</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[49]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[49]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[49]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[49]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[49]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Mayenne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Mayenne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[53]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[53]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[53]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[53]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[53]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Sarthe-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Sarthe</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[72]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[72]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[72]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[72]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[72]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Vendée-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Vendée</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[85]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[85]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[85]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[85]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[85]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Côtes-d’Armor-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Côtes-d’Armor</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[20]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[20]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[20]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[20]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[20]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Finistère-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Finistère</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[27]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[27]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[27]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[27]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[27]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Ille-et-Vilaine-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Ille-et-Vilaine</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[35]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[35]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[35]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[35]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[35]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Morbihan-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Morbihan</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[56]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[56]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[56]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[56]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[56]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Charente-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Charente</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[15]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[15]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[15]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[15]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[15]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Charente-Maritime-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Charente-Maritime</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[16]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[16]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[16]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[16]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[16]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Corrèze-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Corrèze</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[18]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[18]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[18]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[18]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[18]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Creuse-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Creuse</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[21]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[21]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[21]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[21]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[21]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Dordogne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Dordogne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[22]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[22]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[22]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[22]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[22]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Gironde-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Gironde</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[33]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[33]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[33]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[33]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[33]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Landes-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Landes</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[40]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[40]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[40]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[40]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[40]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Lot-et-Garonne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Lot-et-Garonne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[47]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[47]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[47]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[47]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[47]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Pyrénées-Atlantiques-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Pyrénées-Atlantiques</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[64]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[64]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[64]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[64]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[64]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Deux-Sèvres-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Deux-Sèvres</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[79]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[79]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[79]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[79]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[79]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Vienne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Vienne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[86]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[86]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[86]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[86]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[86]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Vienne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute-Vienne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[87]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[87]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[87]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[87]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[87]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Ariège-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Ariège</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[8]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[8]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[8]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[8]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[8]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Aude-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Aude</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[10]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[10]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[10]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[10]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[10]->maille_code}} </li> positifs :&nbsp;</li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Aveyron-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Aveyron</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[11]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[11]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[11]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[11]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[11]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Gard-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Gard</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[30]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[30]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[30]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[30]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[30]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Garonne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute-Garonne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[31]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[31]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[31]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[31]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[31]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Gers-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Gers</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[32]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[32]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[32]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[32]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[32]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Hérault-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Hérault</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[34]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[34]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[34]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[34]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[34]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Lot-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Lot</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[46]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[46]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[46]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[46]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[46]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Lozère-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Lozère</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[48]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[48]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[48]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[48]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[48]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Hautes-Pyrénées-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Hautes-Pyrénées</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[65]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[65]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[65]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[65]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[65]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Pyrénées-Orientales-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Pyrénées-Orientales</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[66]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[66]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[66]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[66]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[66]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Tarn-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Tarn</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[81]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[81]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[81]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[81]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[81]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Tarn-et-Garonne-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Tarn-et-Garonne</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[82]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[82]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[82]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[82]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[82]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Ain-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Ain</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[0]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[0]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[0]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[0]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[0]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Allier-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Allier</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[2]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[2]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[2]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[2]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[2]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Ardèche-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Ardèche</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[6]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[6]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[6]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[6]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[6]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Cantal-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Cantal</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[14]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[14]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[14]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[14]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[14]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Drôme-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Drôme</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[22]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[22]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[22]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[22]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[22]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Isère-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Isère</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[38]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[38]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[38]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[38]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[38]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Loire-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Loire</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[42]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[42]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[42]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[42]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[42]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Loire-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute-Loire</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[43]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[43]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[43]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[43]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[43]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Puy-de-Dôme-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Puy-de-Dôme</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[63]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[63]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[63]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[63]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[63]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Rhône-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Rhône</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[69]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[69]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[69]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[69]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[69]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Savoie-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Savoie</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[73]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[73]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[73]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[73]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[73]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Savoie-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute-Savoie</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[74]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[74]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[74]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[74]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[74]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Alpes-de-Haute-Provence-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Alpes-de-Haute-Provence</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[3]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[3]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[3]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[3]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[3]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Hautes-Alpes-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Hautes-Alpes</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[4]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[4]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[4]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[4]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[4]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Alpes-Maritimes-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Alpes-Maritimes</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[5]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[5]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[5]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[5]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[5]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Bouches-du-Rhône-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Bouches-du-Rhône</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[12]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[12]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[12]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[12]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[12]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Var-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Var</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[83]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[83]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[83]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[83]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[83]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Vaucluse-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Vaucluse</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[84]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[84]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[84]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[84]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[84]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Haute-Corse-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Haute Corse</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[29]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[29]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[29]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[29]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[29]->maille_code}} </li>
                        </ul>
                    </div>
                </div>

                <div class="region-detail" id="Corse-du-Sud-detail">
                    <a href="#" class="close"><svg class="js-close-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="23" height="23" xml:space="preserve">
                            <path fill="none" stroke="#B1AAA1" stroke-width="2" stroke-miterlimit="10" d="M0 0l23 23M23 0L0 23" />
                        </svg></a>
                    <a class="title">Corse du Sud</a>
                    <div class="scrolling-menu">
                        <ul class="menu">
                            <li style="font-size:12px ;color:black"><span>Département</span>: {{$departement[28]->maille_nom}} </li>
                            <li style="font-size:12px ;color:black"><span>Hospitalisés</span>: {{$departement[28]->hospitalises}} </li>
                            <li style="font-size:12px ;color:black"><span>Décès</span>: {{$departement[28]->deces}} </li>
                            <li style="font-size:12px ;color:black"><span>Guéris</span>: {{$departement[28]->gueris}} </li>
                            <li style="font-size:12px ;color:black"><span>Code Département</span>: {{$departement[28]->maille_code}} </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section>
            <br>
            <br>
            <div class='my-legend' style="padding-right: 570px; margin-bottom: 50px;">
                <div class='legend-scale'>
                    <ul class='legend-labels'>
                        <li><span style='background:red;'></span>400 +</li>
                        <li><span style='background:purple;'></span>250-400</li>
                        <li><span style='background:pink;'></span>150-250</li>
                        <li><span style='background:yellow;'></span>50-150</li>
                        <li><span style='background:green;'></span>0-50</li>

                    </ul>
                </div>
                <br>
                <br>
        </section>

        </div>
        </div>
        </section>



        <!--==================== FOOTER ====================-->
        <footer class="footer section" style="background: #222a8e; color: white">
            <div class="footer__container container grid">
                <div class="footer__content grid">
                    <div class="footer__data">
                        <h3 style="color: white" class="footer__title">Covid Timelapse</h3>
                        <p class="footer__description">Suivez l'évolution du covid dans les <br> départements Français.</p>
                        <div>
                            <a style="color: white" href="https://www.facebook.com/" target="_blank" class="footer__social">
                                <i class="ri-facebook-box-fill"></i>
                            </a>
                            <a style="color: white" href="https://twitter.com/" target="_blank" class="footer__social">
                                <i class="ri-twitter-fill"></i>
                            </a>
                            <a style="color: white" href="https://www.instagram.com/" target="_blank" class="footer__social">
                                <i class="ri-instagram-fill"></i>
                            </a>
                            <a style="color: white" href="https://www.youtube.com/" target="_blank" class="footer__social">
                                <i class="ri-youtube-fill"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer__data" style="margin: 0 auto;">
                        <h3 style="color: white; text-align: center;" class="footer__subtitle">Équipe du projet</h3>
                        <div class="teamate">
                            <ul>
                                <li class="footer__item">
                                    <a style="color: white" href="" class="footer__link">Lucie Granier</a>
                                </li>
                                <li class="footer__item">
                                    <a style="color: white" href="" class="footer__link">Anaïs Puig</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="footer__item">
                                    <a style="color: white" href="" class="footer__link">Lucas Rechauchere</a>
                                </li>
                                <li class="footer__item">
                                    <a style="color: white" href="" class="footer__link">Kevin Scholtes</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer__rights">
                    <p style="color: white; margin: auto;" class="footer__copy">&#169; 2021 ETNA. Code Camp DATA.</p>
                </div>
            </div>
        </footer>
        <script src="{{ asset('js/maps.js') }}" defer></script>
        <script src="{{ asset('js/main.js') }}" defer></script>
        <script src="{{ asset('js/general.js') }}" defer></script>



</body>

</html>