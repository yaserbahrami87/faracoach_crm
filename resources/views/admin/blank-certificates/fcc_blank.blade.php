<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
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



        *{
            font-family: vazir;
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
            color: silver;font-size: 150px; font-family: Vazir">{{$student->user->fname.' '.$student->user->lname}}</p>
    @elseif(strlen($student->user->fname_en.' '.$student->user->lname_en)>=26)

        <p style=" position: absolute;
            top: 710px;
            left: 180px;
            font-size: 60px;
            color: silver;font-size: 60px;font-family: Arial">{{$student->user->fname.' '.$student->user->lname}}</p>
    @else

        <p  style=" position: absolute;
            top: 710px;
            left: 180px;

            color: silver;">علی حسینی</p>
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
