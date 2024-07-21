<!doctype html>
<html lang='fa'>
<head>
    <meta charset='UTF-8'>
    <link href='{{public_path('css/reset.css') }}' rel='stylesheet' />

    <style>

        .cls
        {
            background-image: url({{public_path('images/blank-certificates/ambassador.jpg') }});
            /*
            background-image: url({{public_path('images/blank-certificates/level1.jpg') }});
             */
            width: 100%;
            height: 100vh;
            background-size: 100% 100%;

        }

        .cls_pdf{
            background-image: url('{{public_path('images/blank-certificates/ambassador.jpg') }}');
            width: 100%;
            height: 100%;
            background-size: 100% 100%;

        }

        .tag_h1
        {
            position: absolute;
            text-align: center;
            font-size: 60px;
            color: #fa9416;
            top: 1250px;
            left:400px;
            font-weight: bold;
        }

        body {
            /*font-family: 'vazir';*/

        }

        .images
        {
            border-radius: 30px;
            width:100px;
            position:absolute;
            top:200px;
            left:20px;
        }


        @font-face {
            src: url("{{public_path('fonts/iransansweb.ttf')}}");
            font-family: 'iransans';
        }
        @font-face {
            src: url("{{public_path('fonts/iransansweb.ttf')}}");
            font-family: 'iransans';
        }

    </style>

</head>
<body class='cls_pdf container-fluid' @if(Auth::user()->introduced_verified==2) style="background-image:url('{{public_path('images/blank-certificates/Honorary_Ambassador.jpg')}}');background-size: 100% 100%;position: relative" @elseif(Auth::user()->introduced_verified==4) style="background-image:url('{{public_path('images/blank-certificates/official_ambassador.jpg')}}'); background-size: 100% 100%;position: relative"@endif   >

            @if(is_null(Auth::user()->personal_image))
                <img src="{{public_path('documents/users/default-avatar.png')}}" class="images" style="width:410px;height:460px;position:absolute;margin-top:635px;padding-left:290px;border-radius:20px 20px 20px 20px" />
            @else
                <img src="{{public_path('documents/users/'.Auth::user()->personal_image)}}" class="images" style="width:410px;height:460px;position:absolute;margin-top:635px;padding-left:290px;border-radius:20px 20px 20px 20px" />
            @endif

            @if(Auth::user()->introduced_verified==2 )
                @if(mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)<15)
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;left:330px;color:#038d8f'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @elseif(mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)>15  && mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)<20)
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;left:240px;color:#038d8f'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @elseif(mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)>20)
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;left:250px;color:#038d8f'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @else
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;color:#038d8f'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @endif
            @elseif(Auth::user()->introduced_verified==4)
                @if(mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)<15)
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;left:330px;color:#fa9418'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @elseif(mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)>15  && mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)<20)
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;left:240px;color: #fa9418'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @elseif(mb_strlen(Auth::user()->fname.' '.Auth::user()->lname)>20)
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;left:250px;color: #fa9418'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @else
                    <p class="tag_h1" style='font-family:vazir;font-size: 60px;color: #fa9418'>{{Auth::user()->fname.'  '.Auth::user()->lname}}</p>
                @endif
            @endif



            @if(!is_null(Auth::user()->Validity_date) )
                @if(Auth::user()->introduced_verified==2 )
                <p class="tag_h1" style='font-size: 30px ;left:400px;margin-top:235px;color:#038d8f  '>{{Auth::user()->Validity_date}}</p>
                @elseif(Auth::user()->introduced_verified==4 )
                    <p class="tag_h1" style='font-size: 30px ;left:400px;margin-top:235px;color: #102250'>{{Auth::user()->Validity_date}}</p>
                @endif
            @endif
</body>
</html>
