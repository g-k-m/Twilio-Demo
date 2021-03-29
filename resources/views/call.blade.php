@extends('layouts.app')

@section('pagespecificscripts')
<script src="js/jquery.min.js" defer></script>
<script src="js/twilio.min.js" defer></script>
<script src="js/twilio_call_instructions.js" defer></script>
@endsection

@section('content')
<div class="container__call">
    <img class="container__call__logo" src="images/call-phone-top.webp" alt="">

    <span class="container__call__desc">
        <p class="container__call__desc__big">Free phone calling</p>
        <p class="container__call__desc__small">Make free calls to USA, India, UK and many other countries to mobiles and landlines, absolutely free</p>
    </span>

    <span class="container__call__main">
        <p class="container__call__main__title">Free Call Phone</p>

        <p class="container__call__main__numberLabel">Enter the phone number you wish to call:</p>

        <input name="number" class="container__call__main__number" type="tel" id="toNumber">

        <p class="container__call__main__status"></p>

        <button class="container__call__main__call" id="container__call__main__call">Call</button>
        <button class="container__call__main__hangup" id="container__call__main__hangup">Hang Up</button>
    </span>
</div>

@endsection