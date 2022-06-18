@extends('layouts.front.app')

@section('contentFront')
    <div class="position-relative py-6 py-lg-8 light">
        <div class="bg-holder rounded-3 overlay overlay-0" style="background-image:url(../../assets/img/gallery/2.jpg);">
        </div>
        <!--/.bg-holder-->
        <div class="position-relative text-center">
            <h4 class="text-white">Frequent Questions</h4>
            <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
                <ol style="justify-content: center;" class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Frequent Questions</li>
                </ol>
            </nav>
        </div>
    </div>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-0 pb-5 overflow-hidden light background" id="banner">



        <div class="container  mt-7">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-7  col-xxl-6">

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">How long do
                                    payouts take?</button>
                            </h2>
                            <div class="accordion-collapse collapse show" id="collapse1" aria-labelledby="heading1"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">Once you’re set up, payouts arrive in your bank account on a
                                    2-day rolling basis. Or you can opt to receive payouts weekly or monthly.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">How do
                                    refunds work?</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="collapse2" aria-labelledby="heading2"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">You can issue either partial or full refunds. There are no fees
                                    to refund a charge, but the fees from the original charge are not returned.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">How much do
                                    disputes costs?</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="collapse3" aria-labelledby="heading3"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">Disputed payments (also known as chargebacks) incur a $15.00
                                    fee. If the customer’s bank resolves the dispute in your favor, the fee is fully
                                    refunded.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">Is there a
                                    fee to use Apple Pay or Google Pay?</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="collapse4" aria-labelledby="heading4"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">There are no additional fees for using our mobile SDKs or to
                                    accept payments using consumer wallets like Apple Pay or Google Pay.</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
