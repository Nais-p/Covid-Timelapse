// configuration du date picker pour le mettre en français + determiner date minimum et maximum du calendrier.
(function($) {
    $.fn.datepicker.dates['fr'] = {
        days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
        daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
        daysMin: ["di", "lu", "ma", "me", "je", "ve", "sa"],
        months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
        monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
        today: "Aujourd'hui",
        monthsTitle: "Mois",
        clear: "Effacer",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };
}(jQuery));
$('.date').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '2020-04-16',
    endDate: '2021-06-28',
    language: 'fr',
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

//fonction pour récupérer la date entrée dans le date picker pour l'enregistrer dans les cookies et pouvoir nous en resservir.
function load_day() {
    window.localStorage.setItem('current_date', $('.date').val());
    var date = $('.date').val().toString();

    document.cookie = "date_cookie=" + date;
    console.log(getCookie("date_cookie"));
    $( "#carte" ).load(window.location.href + " #map_dep" );
    document.location.reload(true)
    
}

//fonction permettant de réaliser le timelapse de la carte en définissant la valeur du cookie au 2020-04-16 pour boucler jusqu'à la date maximum tout en mettant à jour la carte.
async function timelapse() 
{
    var i = 0;
    document.cookie = "date_cookie=2020-04-16";
    while (i < 438)
    {
        var myDate =  new Date(getCookie("date_cookie"));
        myDate.setDate(myDate.getDate() + 1);
        date_string = myDate.toISOString().split('T')[0];
        if (date_string === "2021-06-28") {
            break;
          }
        if (date_string === "2021-03-28" || date_string === "2019-03-30") {
            myDate.setDate(myDate.getDate() + 1);
        date_string = myDate.toISOString().split('T')[0];
          }
        document.cookie = "date_cookie=" + date_string;
        $( "#carte" ).load(window.location.href + " #map_dep" );
        i+=1;
    }
}