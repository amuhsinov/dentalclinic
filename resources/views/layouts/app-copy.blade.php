<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/appointment.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">    
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/appointment-picker.css') }}">
</head>
<body>
    <section class="section-main">
        <div class="container">
            <div class="header-container">
                <header>
                    <div class="header-logo">
                        <img class="logo" src="{{ asset('images/logo.png') }}">
                    </div>   
                    <div class="header-nav">
                        <ul class="nav">
                            <li><a href="#section-about-us">За нас</a></li>
                            <li><a href="#section-services">Услуги</a></li>
                            <li><a href="#section-team">Екип</a></li>
                            <li><a href="#section-appointment">Запази час</a></li>
                            <li><a href="#section-contact">Контакти</a></li>
                        </ul>

                        <div class="vertical-nav">
                            <img src="{{ asset('images/icons/list-icon.png') }}" class="list-icon">
                            <div class="nav-list hide">
                                <a href="#section-about-us">За нас</a>
                                <a href="#section-services">Услуги</a>
                                <a href="#section-team">Екип</a>
                                <a href="#section-appointment">Запази час</a>
                                <a href="#section-contact">Контакти</a>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

            <div class="appointment-box">
                <div class="row">
                    <p class="appointment-header">Запази час</p>
                </div>
            
                <form action="{{ route('appointment.create_appointment') }}" method="POST">
                    <div class="row">
                        @csrf
                        @method('PUT')
                        <div class="half-row">
                            <p class="appointment-text-fields">Доктор: </p>
                            <select class="doctors" name="doctor">
                                <option value="0">-Избери-</option>
                            </select>
                        </div>
                        <div class="app-date hide half-row">
                            <p class="appointment-text-fields">Дата: </p>
                            <input type="text" name="date" class="date" readonly="readonly" autocomplete="off">
                        </div>
                        <div class="app-hour hide confirm half-row">
                            <p class="appointment-text-fields">Час: </p>
                            <select class="time" name="time">
                                <option value="0">-Избери-</option>
                            </select>
                        </div>
                        <div class="patient-name hide confirm half-row">
                            <p class="appointment-text-fields">Име: </p> <input type="text" name="name" class="name" autocomplete="off">
                        </div>
                        <div class="patient-phone hide confirm half-row">
                            <p class="appointment-text-fields">Телефон: </p> <input type="text" name="phone_number" class="phone" autocomplete="off">
                        </div>
                        <div class="patient-email hide confirm half-row">
                            <p class="appointment-text-fields">Имейл: </p> <input type="email" name="email" class="email" autocomplete="off">
                        </div>
                        <div class="half-row hide confirm">
                            <p class="appointment-text-fields">Колко е <span class="question-text"></span> ?</p>
                            <input type="text" name="captcha" class="captcha" autocomplete="off">
                        </div>
                    </div>

                    <div class="row div-input-submit">
                        <input type="submit" name="submit" value="Запази час" class="submit">
                        @if(session()->has('success'))
                            <p class="success"> {{ session()->get('success') }} </p>
                        @endif
                        <p class="hide alert-text">Попълни всички полета.</p>
                    </div>
                </form>       
            </div>
        </div>
            
    </section>

    <section class="section-about-us">
        <div class="container">
            <div class="center-container">
                <p class="header-text">За нас</p>
                <img src="{{ asset('images/clinic.jpg') }}" class="clinic">

                <p class="text-about-us">Дентална клиника AM Clinic отвори врати през 2013 г., за да предложи на своите пациенти най-висок стандарт и качество на услугите в областта на естетичната стоматология, протетика, ендодонтия, детска дентална медицина, имплантология и орална хирургия. При нас ще намерите адекватно решение за всички проблеми, свързани с оралното здраве, както и индивидуален подход за най-добри резултати.</p>
            </div>
        </div>
    </section>

    <section class="section-services">
        <div class="container">
            <div class="center-container">
                <p class="header-text">Услуги</p>
                <div class="col-33">
                    <img src="{{ asset('images/service1.png') }}" class="img-150">
                    <p class="text-header-service">Дентална имплантология</p>
                    <p class="text-description-service">Имплантите са Вашето дългосрочно решение за заместване на липсващите зъби, заедно с техните корени</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service2.png') }}" class="img-150">
                    <p class="text-header-service">Орална хирургия</p>
                    <p class="text-description-service">Всички видове хирургични лечения се провеждат във високотехнологично оборудван операционен блок с възможност за прилагане на различни видове анестезии</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service3.png') }}" class="img-150">
                    <p class="text-header-service">Лечение на зъбен кариес и ендодонтия</p>
                    <p class="text-description-service">Ендодонтско лечение се налага в резултат от усложнения на зъбния кариес, травма и понякога е единственият вариант да бъде спасен зъба</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service4.png') }}" class="img-150">
                    <p class="text-header-service">Детска дентална медицина</p>
                    <p class="text-description-service">Комплексни дентални грижи за съхраняването, поддържането и оздравяването на съзъбието на пациентите от най-ранна детска възраст</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service5.png') }}" class="img-150">
                    <p class="text-header-service">Пародонтология</p>
                    <p class="text-description-service">Пълен спектър от манипулации за профилактика и лечение на заболяванията на венците</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service6.png') }}" class="img-150">
                    <p class="text-header-service">Протезиране</p>
                    <p class="text-description-service">Подвижно и неподвижно протезиране, както на единични липсващи зъби, така и при по-големи обеззъбявания</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service7.png') }}" class="img-150">
                    <p class="text-header-service">Ортодонтия</p>
                    <p class="text-description-service">Ортодонтията се концентрира върху правилното подреждане на зъбите, коригирането на захапката, подобряването на функцията на съзъбието</p>
                </div>
                <div class="col-33">
                    <img src="{{ asset('images/service8.png') }}" class="img-150">
                    <p class="text-header-service">Лечение под анестезия</p>
                    <p class="text-description-service">Анестезията се прилага за обезболяване при оперативни интервенции, като по този начин се осигурява максимален комфорт за пациента</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-team">
        <div class="container">
            <div class="center-container">
                <p class="header-text">Екип</p>
                
                @if(isset($users))
                    @foreach($users as $user)
                        <div class="col-33">
                            <img class="img-150" src="{{ asset($user->profile_image) }}">
                            <p>{{ $user->name }}</p>
                        </div> 
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-appointment">
        <div class="container">
            <div class="center-container">
                <p class="header-text">Запази час</p>

                <form action="{{ route('appointment.create_appointment') }}" method="POST">
                    <div class="row">
                        @csrf
                        @method('PUT')
                        <div class="half-row">
                            <p class="appointment-text-fields">Доктор: </p>
                            <select class="doctors" name="doctor">
                                <option value="0">-Избери-</option>
                            </select>
                        </div>
                        <div class="app-date hide half-row">
                            <p class="appointment-text-fields">Дата: </p>
                            <input type="text" name="date" class="date" readonly="readonly" autocomplete="off">
                        </div>
                        <div class="app-hour hide confirm half-row">
                            <p class="appointment-text-fields">Час: </p>
                            <select class="time" name="time">
                                <option value="0">-Избери-</option>
                            </select>
                        </div>
                        <div class="patient-name hide confirm half-row">
                            <p class="appointment-text-fields">Име: </p> <input type="text" name="name" class="name" autocomplete="off">
                        </div>
                        <div class="patient-phone hide confirm half-row">
                            <p class="appointment-text-fields">Телефон: </p> <input type="text" name="phone_number" class="phone" autocomplete="off">
                        </div>
                        <div class="patient-email hide confirm half-row">
                            <p class="appointment-text-fields">Имейл: </p> <input type="email" name="email" class="email" autocomplete="off">
                        </div>
                        <div class="half-row hide confirm">
                            <p class="appointment-text-fields">Колко е <span class="question-text"></span> ?</p>
                            <input type="text" name="captcha" class="captcha" autocomplete="off">
                        </div>
                    </div>

                    <div class="row div-input-submit">
                        <input type="submit" name="submit" value="Запази час" class="submit">
                        @if(session()->has('success'))
                            <p class="success"> {{ session()->get('success') }} </p>
                        @endif
                        <p class="hide alert-text">Попълни всички полета.</p>
                    </div>
                </form>
            </div> 
        </div>
    </section><!doctype html>
    <section class="section-contact">
        <div class="container">
            <div class="center-container">
                <p class="header-text">Контакти</p>
                <div class="col-50">
                    <p class="contact-text">Телефон: 052 56 56 56</p>
                    <p class="contact-text">E-mail: amclinic@gmail.com</p>
                </div>

                <div class="col-50">
                    <p class="contact-text">Facebook: AM Clinic</p>
                    <p class="contact-text">Адрес: гр. Варна</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-footer">
        <div class="container">
            <div class="center-container">
                <p>АМ Clinic - сайтът е с учебна цел. Благодаря за вниманието!</p>
            </div> 
        </div>
    </section>

</body>
</html>
