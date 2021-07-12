<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Covid Timelapse</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
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
        <section class="home" id="home" style="max-width: 100%; padding: 0">
            <img class="img-fluid" src="{{ asset('img/covid.png') }}" alt="" class="home__img">
            </div>
        </section>

        <!--==================== ABOUT ====================-->
        <div class="colour-block">
            <section id="discover">
                <div class="nous">A propos de Nous</div>
                <div class="discover__container container swiper-container">
                    <div class="swiper-wrapper">
                        <p style="margin-top: 75px; font-size: 23px; color: black; text-align: justify;">Pour ce projet, notre équipe est composée de Lucie Granier, Anaïs Puig, Lucas Rechauchere et Kevin Scholtes.<br> Afin de le réaliser, nous nous sommes répartis les tâches par groupe. Lucas a travaillé sur la partie Back, Lucie, Anaïs, et Kevin ont travaillés sur la partie front du site web. <br> <br> Nous sommes quatre étudiants en première année d'informatique à l'ETNA. Une école qui propose l'alternance dès la première année ainsi qu'un bac +5 reconnu par l'état à la fin de notre formation.</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="skew-cc"></div>
        <div class="white-block">
            <div class="pourquoi" style="margin-top: 80px">Pourquoi Covid Timelapse</div>
            <p style="margin-top: 75px; font-size: 23px; color: white; text-align: justify;">Nous avons réalisé ce projet durant le code camp SDC DATA du 28 juin 2021 au 08 Juillet 2021.
                <br><br>L'objectif étant de mettre en place une carte de France interactive capable de montrer l'historique de la crise du COVID-19.
                <br> Pour ce faire, nous avons récupéré les données officielles du gouvernement français qui recense les cas sur le territoire. <br><br>
                Notre choix s'est orienté vers les technologies suivantes : Le framework Laravel que ce soit pour le Back ou le Front (html, css scss, javascript, php). Et pour notre base de données nous avons choisi MySql.
            </p>
        </div>


        <!--==================== FOOTER ====================-->
        <footer class="footer section" style="background: white; color: black">
            <div class="footer__container container grid">
                <div class="footer__content grid">
                    <div class="footer__data">
                        <h3 style="color: black" class="footer__title">Covid Timelapse</h3>
                        <p class="footer__description">Suivez l'évolution du covid dans les <br> départements Français.</p>
                        <div>
                            <a style="color: black" href="https://www.facebook.com/" target="_blank" class="footer__social">
                                <i class="ri-facebook-box-fill"></i>
                            </a>
                            <a style="color: black" href="https://twitter.com/" target="_blank" class="footer__social">
                                <i class="ri-twitter-fill"></i>
                            </a>
                            <a style="color: black" href="https://www.instagram.com/" target="_blank" class="footer__social">
                                <i class="ri-instagram-fill"></i>
                            </a>
                            <a style="color: black" href="https://www.youtube.com/" target="_blank" class="footer__social">
                                <i class="ri-youtube-fill"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer__data" style="margin: 0 auto;">
                        <h3 style="color: black; text-align: center;" class="footer__subtitle">Équipe du projet</h3>
                        <div class="teamate">
                            <ul>
                                <li class="footer__item">
                                    <a style="color: black" href="" class="footer__link">Lucie Granier</a>
                                </li>
                                <li class="footer__item">
                                    <a style="color: black" href="" class="footer__link">Anaïs Puig</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="footer__item">
                                    <a style="color: black" href="" class="footer__link">Lucas Rechauchere</a>
                                </li>
                                <li class="footer__item">
                                    <a style="color: black" href="" class="footer__link">Kevin Scholtes</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer__rights">
                    <p style="color: black; margin: auto;" class="footer__copy">&#169; 2021 ETNA. Code Camp DATA.</p>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/main.js') }}" defer></script>
        <script src="{{ asset('js/general.js') }}" defer></script>

</body>
</html>