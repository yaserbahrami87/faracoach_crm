<html lang="fa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <link rel="stylesheet" type="text/css" href="{{public_path('css/reset.css')}}">

    <style>





        body
        {
            font-family: Tahoma;
            font-weight: bold;
        }


        .bg
        {
            background-image: url("{{public_path('images/blank-certificates/attendance_certificate.jpg')}}");

        }



        .fname
        {
            position:absolute;
            top:400px;
            left:300px;
            font-size:170px;
            color:#052347;
            text-transform:uppercase ;
        }

        .code
        {
            position: absolute;
            top:830px;
            left: 765px;
            font-size: 30px;
            font-family: english;
            color:#052347;
        }


    </style>
</head>
<body class="container-fluid position-relative" style="background-image:url('{{public_path('images/blank-certificates/attendance_certificate.jpg')}}');background-size: 100% 100% " >
@if(mb_strlen($student->fname_en.'.'.$student->lname_en)<=21)
    <h1 class="fname" style="font-size:140px;top:980px;left:430px">{{$student->fname_en.' '.$student->lname_en}}</h1>
@else
    <h1 class="fname" style="font-size:80px;top:1000px;left:430px">{{$student->fname_en.' '.$student->lname_en}}</h1>
@endif

<div class="row">
    <div class="col-12">


    </div>
</div>
<div  class="div_main">





</div>
</body>
</html>
