<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/reset.css')}}">

    <style>
        body {
            font-family: 'vazir';
            padding:0px;

        }

        body *
        {
            margin:0px;
            padding:0px;
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

        body .image
        {
            position: absolute;
            top: 570px;
            left: 800px;
            border-radius: 20px;
            box-shadow: 1px 1px 20px #828387;
            width: 360px;
            height: 420px;
            margin-right: 900px;
            margin-top: 200px;
        }

        body .test
        {
            position: absolute;
            top: 710px;
            left: 180px;
            color: silver;
            margin-top:100px;
            margin-left: 180px;
        }

        .relative{
            position: relative !important;
        }

    </style>
</head>
<body >

<div class="relative" style="background-image: url({{public_path('images/blank-certificates/FCC_blank.jpg') }});width: 100%;height: 100%;background-size: 100% 100%;position: relative;">
    @if(strlen($student->user->fname_en.' '.$student->user->lname_en)>20 && strlen($student->user->fname_en.' '.$student->user->lname_en)<26)

        <p  style=" position: absolute;
            top: 710px;
            left: 180px;
            font-size: 60px;
            color: silver;font-size: 150px; font-family: Vazir">{{$student->user->fname.' '.$student->user->lname}}</p>
    @elseif(strlen($student->user->fname_en.' '.$student->user->lname_en)>=26)

        <p style=" position: absolute;
            top: 710px;
            left: 180px;
            font-size: 60px;
            color: silver;font-size: 60px;font-family: Arial">{{$student->user->fname.' '.$student->user->lname}}</p>
    @else

        <p  class="test" >یاسر حسینی</p>
    @endif

    @if(is_null($student->user->personal_image))
            <img src="{{public_path('documents/users/default-avatar.png') }}" class="image" />
    @else
            <img src="{{public_path('documents/users/default-avatar.png') }}" class="image" />
    @endif


    <p id="number_certificates">{{$student->code}}</p>

</div>
</body>
</html>
