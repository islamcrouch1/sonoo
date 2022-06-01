@extends('layouts.front.app')

@section('contentFront')
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-0 overflow-hidden light" id="banner">

        <div class="bg-holder overlay"
            style="background-image:url({{ asset('/assets/img/generic/bg-1.jpg') }});background-position: center bottom;">
        </div>
        <!--/.bg-holder-->


        <div class="container ">
            <div class="row flex-center pt-8 pt-lg-10 pb-lg-9 pb-xl-0">
                <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-start"><a
                        class="btn btn-outline-danger disabled ready mb-4 fs--1 border-2 rounded-pill"><span
                            class="me-2" role="img" aria-label="Gift"></span>{{ __('Catch Your Profit') }} !!</a>
                    <h1 class="text-white fw-light">{{ __('Faster') }} <span class="typed-text fw-bold"
                            data-typed-text='["{{ __('Delivery') }}","{{ __('Profit') }}","{{ __('Success')}}"]'></span></h1>
                    <p class="lead text-white opacity-75">{{ __('Our first goal is for you earn and increase your profit!')}} {{ __('You are not just a normal individual, you are a person who share our goals and our ambitions') }}, {{ __('and you are a') }}
                        <br> <span class="first typed-text fw-bold">{{__('success partner')}}.</span>

                    </p><a class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2" href="#!">{{ __('START NOW') }}<span class="fas fa-play ms-2" data-fa-transform="shrink-6 down-1"></span></a>
                </div>
                <div class="col-xl-7 offset-xl-1 align-self-end mt-4 mt-xl-0"><a class="img-landing-banner rounded"
                        href="../index.html"><img class="img-fluid" src="../assets/img/generic/dashboard-alt.jpg"
                            alt="" /></a></div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    {{-- <section class="py-3 bg-light shadow-sm">

        <div class="container">
            <div class="row flex-center">
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="40"
                        src="{{ asset('/assets/img/logos/b&amp;w/6.png') }}" alt="" /></div>
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="45"
                        src="{{ asset('/assets/img/logos/b&amp;w/11.png') }}" alt="" /></div>
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="30"
                        src="{{ asset('/assets/img/logos/b&amp;w/2.png') }}" alt="" /></div>
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="30"
                        src="{{ asset('/assets/img/logos/b&amp;w/4.png') }}" alt="" /></div>
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="35"
                        src="{{ asset('/assets/img/logos/b&amp;w/1.png') }}" alt="" /></div>
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="40"
                        src="{{ asset('/assets/img/logos/b&amp;w/10.png') }}" alt="" /></div>
                <div class="col-3 col-sm-auto my-1 my-sm-3 px-card"><img class="landing-cta-img" height="40"
                        src="{{ asset('/assets/img/logos/b&amp;w/12.png') }}" alt="" /></div>
            </div>
        </div>
        <!-- end of .container-->

    </section> --}}
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>

        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h1 class=" ncolorr fs-2 fs-sm-4 fs-md-5">{{ __('How do you increase your income with Sonoo?') }}
                    </h1>
                    <p class="lead ncolor">{{ __('Without any time, commitment or place. You can work on your mobile phone and be in charge')}} ,{{ __('without any restrictions or directives, your income will easily increase after every sale you make.') }} 
                        {{ __("Without wasting your time, you'll dedicate one or two hours a day to promote our products") }}{{ __('to your customers, add your order, and leave the rest to us.') }} 
                    </p>
                </div>
            </div>
            <div class="row flex-center mt-8">
                <div class="col-md col-lg-5 col-xl-4 ps-lg-6"><img class="img-fluid px-6 px-md-0"
                        src="../assets/img/icons/spot-illustrations/50.png" alt="" /></div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-warning"><span class="far fa-lightbulb me-2"></span>{{ __('THINK') }}</h5>
                    <h3 class="tcolor">{{ __('Who is Sonoo?') }} 
                    </h3>
                    <p>{{ __("We're an open market for affiliate marketers.")}}{{ __('With easy and simple transactions, we are able to deliver all of your orders to all the people,') }}  {{ __('whether you are a Seller or an Affiliate.') }}
                    </p>
                </div>
            </div>
            <div class="row flex-center mt-7">
                <div class="col-md col-lg-5 col-xl-4 pe-lg-6 order-md-2"><img class="img-fluid px-6 px-md-0"
                        src="../assets/img/icons/spot-illustrations/49.png" alt="" /></div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-info"> <span class="far fa-object-ungroup me-2"></span>{{ __('TRY') }}</h5>
                    <h3 class="tcolor">{{__('How did we make it so easy?')  }} 
                    </h3>
                    <p>{{ __('Your products and orders are delivered all across Egypt,')}} {{ __('with faster and safer shipping without the costing you shipping or storing.') }}
                    </p>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-light text-center">

        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="fs-2 fs-sm-4 fs-md-5"> {{ __('YOU ARE A SUCCESSS') }} <br> <span class="ncolorr">{{ __('PARTNER!') }}</span>
                    </h1>
                </div>
            </div>
            <div class="row mt-6">
                <div class="col-lg-4">
                    <div class="card card-span h-100">
                        <div class="card-span-img"><span class="fab fa-sass fs-4 text-info"></span></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2">{{ __('The largest number of affiliates for your products.') }}
                            </h5>
                            <p>"{{ __('Sell faster and profit more') }}"
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-6 mt-lg-0">
                    <div class="card card-span h-100">
                        <div class="card-span-img"><span class="fab fa-node-js fs-5 text-success"></span></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2"> {{ __('Free storage and packaging services.') }}</h5>
                            <p>"{{ __('Easy to store and pack your products.') }}"</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-6 mt-lg-0">
                    <div class="card card-span h-100">
                        <div class="card-span-img"><span class="fab fa-gulp fs-6 text-danger"></span></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2">{{ __('The strongest customer service team.') }}
                            </h5>
                            <p>“{{ __('Always with you momentarily') }}”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-6 mt-lg-7">
                    <div class="card card-span h-100">
                        <div class="card-span-img"><span class="fab fa-gulp fs-6 text-danger"></span></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2"> {{ __('Fastest shipping and fulfilment.') }}

                            </h5>
                            <p>"{{ __('Your product is delivered safely, with premium packaging, and a competitive shipping fee') }}"
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-6 mt-lg-7">
                    <div class="card card-span h-100">
                        <div class="card-span-img"><span class="fab fa-gulp fs-6 text-danger"></span></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2">{{ __('Collecting your profits from the customer') }} 
                            </h5>
                            <p>"{{ __('We will provide you with your sales report, and you will have your income without any effort,')}}' {{ __('and you can withdraw your profit  wherever you are') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-200 text-center">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <h1 class=" ncolor mb-1">{{ __('How can you be') }} 

                    </h1>
                    <h3 class=" ncolor mb-5"> {{ __('a marketer') }} <span class="ncolorr">{{ __('with Sonoo?') }}</span>
                    </h3>
                    <div class="swiper-container theme-slider"
                        data-swiper='{"autoplay":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"slideToClickedSlide":true}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class="fs-sm-1 fs-md-2 fst-italic text-danger">{{ __('Just register your private account with us from here. “Sonoo.Online”')}}
                                        {{ __('We offer all the products in  large quantities and whole price.') }}

                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class=" text-warning fs-sm-1 fs-md-2 fst-italic "> {{ __('Pick your product, promote it to your social media channels,')}} {{ __('choose the commission you like and leave the rest to us.') }}
                                    </p>

                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class="text-success fs-sm-1 fs-md-2 fst-italic "> {{ __('Our confirmation team, will
                                        confirm your orders with the customer.') }}
                                    </p>

                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class=" excolorr fs-sm-1 fs-md-2 fst-italic "> {{ __("We'll package and deliver your orders with our fast shipping") }}.<br>
                                        "{{ __("As we achieved speed and safety and earned the client's trust for the end") }}.”


                                    </p>

                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class="fs-sm-1 fs-md-2 fst-italic excolor">{{ __('We collect the money and you can withdraw your earnings three working days after the product')}} 
                                    {{ __('is delivered, and you choose the best way you for you weather it’s cash, e-wallet or bank account.') }}
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="swiper-nav">
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="light">

        <div class="bg-holder overlay"
            style="background-image:url(../assets/img/generic/bg-2.jpg);background-position: center top;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <p class="fs-3 fs-sm-4 text-white">Join our community of 20,000+ developers and content creators on
                        their mission to build better sites and apps.</p>
                    <button class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2" type="button">Start
                        your webapp</button>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
@endsection
