<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">

    <link href="{{asset('/css/reset.css') }}" rel="stylesheet" />
    <!--
    <link href="//db.onlinewebfonts.com/c/8be4a2f403c2dc27187d892cca388e24?family=Britannic+Bold" rel="stylesheet" type="text/css"/>
    -->
    <style>
        @font-face
        {
            font-family: 'BRITANIC';
            src: url("{{asset('/fonts/other/BRITANIC.TTF')}}");
            /*font-family: "Britannic Bold";*/
            /*src: url("//db.onlinewebfonts.com/t/8be4a2f403c2dc27187d892cca388e24.eot");*/
            /*src: url("//db.onlinewebfonts.com/t/8be4a2f403c2dc27187d892cca388e24.eot?#iefix") format("embedded-opentype"),*/
            /*url("//db.onlinewebfonts.com/t/8be4a2f403c2dc27187d892cca388e24.woff2") format("woff2"),*/
            /*url("//db.onlinewebfonts.com/t/8be4a2f403c2dc27187d892cca388e24.woff") format("woff"),*/
            /*url("//db.onlinewebfonts.com/t/8be4a2f403c2dc27187d892cca388e24.ttf") format("truetype"),*/
            /*url("//db.onlinewebfonts.com/t/8be4a2f403c2dc27187d892cca388e24.svg#Britannic Bold") format("svg");*/
        }

        @font-face {
            font-family: 'Lato-Regular';
            src: url("{{asset('/fonts/other/Lato-Regular.TTF')}}");
        }

        *{
            font-family: Lato-Regular;
        }




        .cls
        {
            background-image: url({{asset('/images/blank-certificates/acsth_blank.jpg') }});
            width: 100%;
            height: 100vh;
            background-size: 100% 100%;

        }

        .cls_pdf{
            background-image: url({{asset('/images/blank-certificates/acsth_blank.jpg') }});
            width: 100%;
            height: 100%;
            background-size: 100% 100%;
            position: relative;

        }



        .h1_size
        {
            position: absolute;
            top: 950px;
            left: 270px;
            font-size: 160px;
            color: #000000;

        }



        #number_certificates
        {
            position: absolute;
            top: 2050px;
            left: 1010px;
            font-size: 35px;
            color: #38383a;
        }


        #date_certificates
        {
            position: absolute;
            top: 2095px;
            left: 870px;
            font-size: 35px;
            color: #38383a;
        }

    </style>
</head>
<body>
<div class="cls_pdf">
    @if(strlen(Auth::user()->fname_en.' '.Auth::user()->lname_en)>20 && strlen(Auth::user()->fname_en.' '.Auth::user()->lname_en)<26)
        <p class="h1_size" style="font-size: 112px; font-family: BRITANIC">{{Str::upper(Auth::user()->fname_en).' '.Str::upper(Auth::user()->lname_en)}}</p>
    @elseif(strlen(Auth::user()->fname_en.' '.Auth::user()->lname_en)>=26)
        <p class="h1_size" style="font-size: 80px;font-family: BRITANIC">{{Str::upper(Auth::user()->fname_en).' '.Str::upper(Auth::user()->lname_en)}}</p>
    @else
        <p class="h1_size" style="font-family: BRITANIC">{{Str::upper(Auth::user()->fname_en).' '.Str::upper(Auth::user()->lname_en)}}</p>
    @endif

    <p id="number_certificates">3216541</p>
    <p id="date_certificates">04/05/2023</p>

</div>
</body>
</html>
