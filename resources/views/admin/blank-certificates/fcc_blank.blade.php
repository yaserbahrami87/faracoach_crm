<html lang="fa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <link rel="stylesheet" type="text/css" href="{{public_path('css/reset.css')}}">

    <style>



        body {
            font-family: 'vazir';

        }


        @font-face {
            src: url("{{public_path('fonts/iransansweb.ttf')}}");
            font-family: 'iransans';
        }




        .bg
        {
            background-image: url("{{public_path('images/blank-certificates/FCC_blank.jpg')}}");

        }



        .fname
        {
            position:absolute;
            top:540px;
            left:180px;
            font-size:70px;
            color:#1b273f;
        }

        .instagram
        {
            position:absolute;
            top:640px;
            left:180px;
            font-size:70px;
            color:#ffffff;
        }

        .images
        {
            border-radius: 30px;
            width:100px;
            position:absolute;
            top:200px;
            left:300px;
        }

        .table_pdf
        {
            width:100%;
            border:1px solid;
        }


    </style>
</head>
<body class="container-fluid position-relative" style="background-image:url('{{public_path('images/blank-certificates/FCC_blank.jpg')}}');background-size: 100% 100% " >


@if(mb_strlen($student->user->fname.' '.$student->user->lname)>10 && mb_strlen($student->user->fname.' '.$student->user->lname)<12)
    <h1 class="fname" style="font-family:'iransans';font-size:60px;top:550px;left:150px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)==12)
    <h1 class="fname" style="font-family:'iransans';font-size:70px;top:550px;left:150px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)>12 && mb_strlen($student->user->fname.' '.$student->user->lname)<15)
    <h1 class="fname" style="font-family:'iransans';font-size:70px;top:550px;left:165px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)==15)
    <h1 class="fname" style="font-family:'iransans';font-size:55px;top:550px;left:150px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)>15 && mb_strlen($student->user->fname.' '.$student->user->lname)<26)
    <h1 class="fname" style="font-family:'iransans';font-size:52px;top:550px;left:150px">{{$student->user->fname.' '.$student->user->lname}}</h1>

@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)>=26 && mb_strlen($student->user->fname.' '.$student->user->lname)<36)
    <h1 class="fname" style="font-family:'iransans';font-size:50px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)<=10)
    <h1 class="fname" style="font-family:'iransans';font-size:80px;top:530px;left:170px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@elseif(mb_strlen($student->user->fname.' '.$student->user->lname)<=10)
    <h1 class="fname" style="font-family:'iransans';font-size:60px;top:530px;left:150px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@else
    <h1 class="fname" style="font-family:'iransans';font-size:45px;top:550px">{{$student->user->fname.' '.$student->user->lname}}</h1>
@endif


    @if((mb_strlen($student->user->instagram)==14))
        <h1 class="instagram" style="font-family:'english';font-size:45px;left:160px;top:645px"  >{{$student->user->instagram}}</h1>
    @elseif((mb_strlen($student->user->instagram)>15) && (mb_strlen($student->user->instagram)<=17))
        <h1 class="instagram" style="font-family:'english';font-size:45px;left:160px;top:645px"  >{{$student->user->instagram}}</h1>
    @elseif((mb_strlen($student->user->instagram)>2)&&(mb_strlen($student->user->instagram)<=15))
        <h1 class="instagram" style="font-family:'english';font-size:40px;left:180px;top:645px"  >{{$student->user->instagram}}</h1>
    @elseif(mb_strlen($student->user->instagram)>17)
        <h1 class="instagram" style="font-family:'english';font-size:38px;left:150px" >{{$student->user->instagram}}</h1>
    @else
        <h1 class="instagram" style="font-family:'english' " >{{$student->user->instagram}}</h1>
    @endif


    @if(is_null($student->user->personal_image))
        <img src="{{public_path('documents/users/default-avatar.png')}}" class="images" style="width:300px;height:360px;position:absolute;margin-top:260px;padding-left:605px;border-radius:20px 20px 20px 20px" />
    @else
        <img src="{{public_path('documents/users/'.$student->user->personal_image)}}" class="images" style="width:300px;height:360px;position:absolute;margin-top:260px;padding-left:605px;border-radius:20px 20px 20px 20px" />
    @endif

    <div class="row">
        <div class="col-12">


        </div>
    </div>
<div  class="div_main">





</div>
</body>
</html>
