@extends('layouts.app')

@section('pagespecificscripts')
<script src="js/jquery.min.js" defer></script>
<script src="js/twilio_message_instructions.js" defer></script>
@endsection

@section('content')

@if (session('alert'))
    <script>alert({{ session('alert') }})</script>
@endif

<div class="container__call">
    <img class="container__call__logo" src="images/text-top.webp" alt="">

    <span class="container__call__desc">
        <p class="container__call__desc__big">Free text online</p>
        <p class="container__call__desc__small">Send text online without worrying about phone bills. Free SMS to hundreds of GSM operators worldwide</p>
    </span>

    <span class="container__call__main container__call__main2">
        <form id="container__call__main__form">
            <p class="container__call__main__title">Free Text Online</p>

            <p class="container__call__main__numberLabel">Enter the phone number you wish to send a message to:</p>
            <input name="number" class="container__call__main__number" type="tel" id="container__call__main__number">

            <p class="container__call__main__messageLabel">Enter message:</p>
            <textarea class="container__call__main__message" name="message" cols="30" rows="10" id="container__call__main__message"></textarea>

            <button class="container__call__main__submit" id="container__call__main__submit">Send</button>
        </form>
    </span>
</div>

@endsection