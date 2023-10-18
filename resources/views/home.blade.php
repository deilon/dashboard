<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | PoundForPound Fitness Gym</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <header class="flex h-screen">
        <div class="flex-initial px-10 py-10 w-[55%] min-h-screen header-left" style="background-image: url({{asset('storage/assets/img/landingpage/header_bg_left.jpg')}})">
            <div class="logo"><a href="#"><img src="{{asset('storage/assets/img/logo/logo.svg')}}" alt="" srcset=""></a></div>
            <div class="hero-section-1 mt-20 font-montserrat">
                <h1 class="font-bold" style="color: white"><span style="color: #CD8900">UNLOCK</span> YOUR<br/> POTENTIAL,<br/> <span style="color: #AE2221">ONE POUND</span> AT A TIME!</h1>
                <p class="font-normal mt-5">Welcome to Pound for Pound Fitness, where we're more than<br/> 
                    just a gym; we're a community of fitness enthusiasts, a hub for<br/>
                    transformation, and a place where your health and well-being<br/>
                    come first.</p>
                <a href="{{ url('register') }}" class="font-bold bg-blue-800 text-white mt-10 py-2 px-10 rounded-md">Create account and Login</a>
            </div>
        </div>
        <div class="relative flex-initial px-10 py-10 w-[45%] min-h-screen header-right" style="background-image: url({{asset('storage/assets/img/landingpage/header_bg_right.jpg')}})">
            <nav>
                <ul class="flex justify-center space-x-4 text-white">
                    <li><a href="#" class="font-bold">Home</a></li>
                    <li><a href="#" class="font-normal">About Us</a></li>
                    <li><a href="#" class="font-normal">Gallery</a></li>
                    <li><a href="#" class="font-normal">Contacts</a></li>
                </ul>
            </nav>
            <img src="{{asset('storage/assets/img/landingpage/header_pic_1.jpg')}}" id="hero-image-1" alt="hero image">
            <img src="{{asset('storage/assets/img/landingpage/header_pic_2.jpg')}}" id="hero-image-2" alt="hero image">
        </div>
    </header>
    <main>
        <section id="about">

            {{-- About: Main --}}
            <div class="flex h-screen">
                <div class="flex-initial px-10 py-10 w-[55%] min-h-screen">
                    <h1 class="font-bold mb-5" style="color: #CD8900">OUR STORY</h1>
                    <p class="mb-5">Pound for Pound Fitness was founded with a simple yet powerful vision: to<br/> 
                        empower individuals to lead healthier, more fulfilling lives. Our journey<br/> 
                        began in the heart of the Philippines, and today, we proudly stand as a<br/> 
                        beacon of fitness excellence with multiple branches across the country.</p>
                    <img src="{{asset('storage/assets/img/landingpage/our-story-pic.png')}}" class="our-story ml-5" alt="" srcset="">
                </div>
                <div class="flex-initial py-10 w-[45%] min-h-screen">
                    <h1 class="font-bold mb-5 mt-[100px]" style="color: #CD8900">OUR MISSION</h1>
                    <p class="mx-0 mb-5">Inspiring Wellness: Our mission is to inspire and guide individuals<br/> 
                        on their path to wellness. We believe that everyone deserves the<br/> 
                        opportunity to be the best version of themselves, and we're here to<br/> 
                        support you every step of the way.</p>
                    <img src="{{asset('storage/assets/img/landingpage/our-mission-pic.png')}}" class="our-story" alt="" srcset="">
                </div>
            </div>
        </section>
        <section id="contact">
            {{-- Locations --}}
            <div class="px-10 py-10 text-center">
                <h1 class="font-bold mb-5 mt-[100px]" style="color: #CD8900">WE PROUDLY SERVE MULTIPLE LOCATIONS THROUGHOUT MANILA</h1>
            </div>
        </section>
    </main>
</body>
</html>