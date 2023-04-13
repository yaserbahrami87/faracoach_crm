<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">

    <link href="{{public_path('css/reset.css') }}" rel="stylesheet" />
    <!--
    <link href="//db.onlinewebfonts.com/c/8be4a2f403c2dc27187d892cca388e24?family=Britannic+Bold" rel="stylesheet" type="text/css"/>
    -->
    <style>
        @font-face
        {
            font-family: 'BRITANIC';
            src: url("{{public_path('fonts/other/BRITANIC.TTF')}}");
        }

        @font-face {
            font-family: 'Lato-Regular';
            src: url("{{public_path('fonts/other/Lato-Regular.ttf')}}");
        }

        *{
            font-family: Lato-Regular;
        }




        .cls
        {
            background-image: url({{public_path('images/blank-certificates/FCC_blank.jpg') }});
            width: 100%;
            height: 150vh;
            background-size: 100% 100%;

        }

        .cls_pdf{
            background-image: url({{public_path('images/blank-certificates/FCC_blank.jpg') }});
            width: 100%;
            height: 100%;
            background-size: 100% 100%;
            position: relative;

        }



        .h1_size
        {
            position: absolute;
            top: 735px;
            left: 180px;
            font-size: 60px;
            color: #FFFFFF;

        }



        #number_certificates
        {
            position: absolute;
            top: 952px;
            left: 920px;
            font-size: 35px;
            color: #38383a;
        }




        img
        {
            position: absolute;
            top: 370px;
            left: 800px;
            border-radius: 20px;
            box-shadow: 1px 1px 20px #828387;
        }
    </style>
</head>
<body>

<div class="cls_pdf">
    @if(strlen($student->user->fname_en.' '.$student->user->lname_en)>20 && strlen($student->user->fname_en.' '.$student->user->lname_en)<26)
        <p class="h1_size" style="font-size: 112px; font-family: BRITANIC">{{Str::upper($student->user->instagram)}}</p>s
    @elseif(strlen($student->user->fname_en.' '.$student->user->lname_en)>=26)
        <p class="h1_size" style="font-size: 40px;font-family: BRITANIC">{{Str::upper($student->user->instagram)}}</p>
    @else
        <p class="h1_size" style="font-family: BRITANIC">{{Str::upper($student->user->instagram)}}</p>
    @endif

    <img src="{{public_path('documents/users/'.$student->user->personal_image) }}" width="360px" height="420px" />

    <p id="number_certificates">{{$student->code}}</p>

</div>
</body>
</html>
