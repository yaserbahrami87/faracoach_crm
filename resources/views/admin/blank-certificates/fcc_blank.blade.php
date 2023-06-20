<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">




    <!--
    <link href="//db.onlinewebfonts.com/c/8be4a2f403c2dc27187d892cca388e24?family=Britannic+Bold" rel="stylesheet" type="text/css"/>
    -->
    <style>
        html, body, div, span, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        abbr, address, cite, code,
        del, dfn, em, img, ins, kbd, q, samp,
        small, strong, sub, sup, var,
        b, i,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section, summary,
        time, mark, audio, video {
            margin:0;
            padding:0;
            border:0;
            outline:0;
            font-size:100%;
            vertical-align:baseline;
            background:transparent;
        }

        body {
            line-height:1;
            font-family:'vazir';
        }

        article,aside,details,figcaption,figure,
        footer,header,hgroup,menu,nav,section {
            display:block;
        }

        nav ul {
            list-style:none;
        }

        blockquote, q {
            quotes:none;
        }

        blockquote:before, blockquote:after,
        q:before, q:after {
            content:'';
            content:none;
        }

        a {
            margin:0;
            padding:0;
            font-size:100%;
            vertical-align:baseline;
            background:transparent;
        }

        /* change colours to suit your needs */
        ins {
            background-color:#ff9;
            color:#000;
            text-decoration:none;
        }

        /* change colours to suit your needs */
        mark {
            background-color:#ff9;
            color:#000;
            font-style:italic;
            font-weight:bold;
        }

        del {
            text-decoration: line-through;
        }

        abbr[title], dfn[title] {
            border-bottom:1px dotted;
            cursor:help;
        }

        table {
            border-collapse:collapse;
            border-spacing:0;
        }

        /* change border colour to suit your needs */
        hr {
            display:block;
            height:1px;
            border:0;
            border-top:1px solid #cccccc;
            margin:1em 0;
            padding:0;
        }

        input, select {
            vertical-align:middle;
        }




        @font-face
        {
            font-family: 'BRITANIC';
            src: url("{{public_path('fonts/other/BRITANIC.TTF')}}");
        }

        @font-face {
            font-family: 'Anjoman-Bold';
            src: url("{{public_path('fonts/Vazir-Bold-FD-WOL.ttf')}}");
        }

        @font-face {
            font-family: 'Lato-Regular';
            src: url("{{public_path('fonts/other/Lato-Regular.ttf')}}");
        }

        *{
            font-family: Lato-Regular,DejaVu Sans;
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
            top: 710px;
            left: 180px;
            font-size: 80px;
            color: silver;

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

<div  style="background-image: url({{public_path('images/blank-certificates/FCC_blank.jpg') }});width: 100%;height: 100%;background-size: 100% 100%;position: relative;">
    @if(strlen($student->user->fname_en.' '.$student->user->lname_en)>20 && strlen($student->user->fname_en.' '.$student->user->lname_en)<26)

        <p  style=" position: absolute;
            top: 710px;
            left: 180px;
            font-size: 60px;
            color: silver;font-size: 150px; font-family: vazir">{{$student->user->fname.' '.$student->user->lname}}</p>s
    @elseif(strlen($student->user->fname_en.' '.$student->user->lname_en)>=26)

        <p style=" position: absolute;
            top: 710px;
            left: 180px;
            font-size: 60px;
            color: silver;font-size: 60px;font-family: vazir">{{$student->user->fname.' '.$student->user->lname}}</p>
    @else

        <p  style=" position: absolute;
            top: 710px;
            left: 180px;
            font-size: 60px;
            color: silver;font-family: vazir">{{$student->user->fname.' '.$student->user->lname}}</p>
    @endif

    @if(is_null($student->user->personal_image))
            <img src="{{public_path('documents/users/default-avatar.png') }}" width="360px" height="420px" />
    @else
            <img src="{{public_path('documents/users/'.$student->user->personal_image) }}" width="360px" height="420px" />
    @endif


    <p id="number_certificates">{{$student->code}}</p>

</div>
</body>
</html>
