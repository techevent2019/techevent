{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Tech Event
                </div>

                <div class="links">
                    <a href="{{ route('admin.admin') }}">Admin</a>
                    <a href="{{ route('collegeadmin.dashbord') }}">College Admin</a>
                    <a href="{{ route('hod.dashbord') }}">HOD</a>
                    <a href="{{ route('eventcodinator.dashbord') }}">Event Codinator</a>
                    <a href="{{ route('student.index') }}">Student</a>
                </div>

                <div class="panel-body">
                        @component('components.who')
                        @endcomponent
                    </div>
            </div>
        </div>
    </body>
</html>
 --}}

 <!DOCTYPE html>
<html>
<head>
    <title>TECH EVENT</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            box-sizing:border-box;
            font-family: 'Montserrat',sans-serif;
        }
        .site-header{
            width: 100%;
            height: 100vh;
            background: linear-gradient(57deg,#ffea00,#ff0000);
            clip-path: polygon(0% 0%,100% 0%,100% 75%,0% 100%);
            box-shadow: 0 100px;
        }
        .line{width: 100%;background-color: #ffffff;height: 5px;rotation-point:100% 75%;}
        nav{
            width: 100%;
            height: 100px;
            display: flex;
            color: white;
        }
        .logo,.menu{
            width: 50%;
            height: 100px;
        }
        .logo h1{
            line-height: 100px;
            padding-left: 50px;
        }
        .menu ul{
            width: 100%;
            height: 100px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
        }
        .menu ul li{
            list-style: none;
            font-size:18px;
            text-transform: uppercase;
        }
        .menu ul li a{text-decoration: none;color: white;}
        section{display: flex;}
        .left-side{
            width: 45%;
            height: auto;
            overflow: hidden;
            margin-top: 20px;
        }
        .left-side img{
            width: 600px;
            height: 500px;
            margin: 25px;
        }
        .right-side{
            width: 55%;
            height: 300px;
            color: white;
            text-align: center; 
            margin-top: 80px;
            padding: 40px;
        }
        .right-side h1{
            color: #ffffff;
            font-size: 50px;
            font-weight: 900;
            text-transform: uppercase;
        }
        .right-side p{font-size:1.1rem;padding: 30px 0;}
        .right-side select{
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            background: linear-gradient(57deg,#00c6a7,#1E4D92);
            border-radius: 4px;
            padding: 20px 35px;
            border:none;
        }
        .right-side select:hover{
            background: linear-gradient(57deg,#1E4D92,#00c6a7);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
 
        }

         option{
            font-weight: 600;
            font-size: 15px;
            color: grey;
            text-transform: uppercase;
            background: linear-gradient(57deg,#00c6a7,#1E4D92);
            border-radius: 4px;
            padding : 2px 5px;
            border:none;
        }
        .right-side option:hover{
            background: linear-gradient(57deg,#1E4D92,#00c6a7);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
 
        }
    </style>
</head>
<body>
    <header class="site-header">
        <nav>
            <div class="logo">
                <h1>TECH EVENT</h1>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#"> Home</a></li>
                    <li><a href="#"> Services</a></li>
                    <li><a href="#"> About Us</a></li>
                    <li><a href="#"> Contact us</a></li>
                </ul>
            </div>
        </nav>
        <section>
            <div class="left-side">
                <img src="{{ asset('public/dist/img/webkit.png') }}">
            </div>
            <div class="right-side">
                <h1>our modern website</h1>  
                <p>Select Login Type</p>
                <SELECT onchange="location = this.value;">
                    <option>Select</option>
                    <option value="{{ route('admin.admin') }}">Admin</option>
                    <option value="{{ route('collegeadmin.dashbord') }}">College Admin</option>
                    <option value="{{ route('eventcodinator.dashbord') }}">Event Codinator</option>
                    <option value="{{ route('student.index') }}">Student</option>
                </SELECT>

            </div>
        </section>
    
    </header>
</body>
</html>