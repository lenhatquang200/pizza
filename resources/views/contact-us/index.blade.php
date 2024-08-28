@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h1-custom">Contact Us</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="contact-info">
                <p class="text">
                    <strong>Address:</strong><br>
                    120 Cedar Grove Ln<br>
                    Cedar Grove Center<br>
                    Somerset, NJ 08873
                </p>
                <p class="text">
                    <strong>Phone:</strong><br>
                    (732) 805-9506
                </p>
                <p class="text">
                    <strong>Hours:</strong><br>
                    Mon-Sat 11 am - 10 pm
                </p>
                <p class="text">
                    <strong>Accepts All Major Credit Cards:</strong>
                </p>
                <p class="text">
                    <strong>Catering Available</strong>
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;safe=off&amp;ie=UTF8&amp;q=120+Cedar+Grove+Ln+Cedar+Grove+Center+Somerset,+NJ+08873&amp;fb=1&amp;hq=120+Cedar+Grove+Ln+Cedar+Grove+Center&amp;hnear=0x89c3c00e3f9bc429:0x9b9c65b0422e9ad,Somerset,+Franklin+Township,+NJ&amp;cid=0,0,12822767076795410191&amp;ll=40.52199,-74.520648&amp;spn=0.006295,0.006295&amp;t=m&amp;output=embed"></iframe>
        </div>
    </div>
</div>
@endsection
