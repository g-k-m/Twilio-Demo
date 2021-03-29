@extends('layouts.app')

@section('pagespecificscripts')
<script src="js/Chart.min.js" defer></script>
<script src="js/jschart_instructions.js" defer></script>

@endsection

@section('content')
<div class="container__recommendations" id="container__recommendations">
    <ul class="container__recommendations__list">
        <li><a href="video-chat">
                <img src="images/video.webp" alt="">
                <span class="container__recommendations__list__undercard">
                    <p>Video -></p>
                    <p>Free Online Phone</p>
                </span>
            </a></li>
        <li><a href="p2p-file-sharing">
                <img src="images/sharing.webp" alt="">
                <span class="container__recommendations__list__undercard">
                    <p>Share -></p>
                    <p>P2P - file sharing</p>
                </span>
            </a></li>
        <li><a href="message">
                <img src="images/text.webp" alt="">
                <span class="container__recommendations__list__undercard">
                    <p>Sms -></p>
                    <p>Free text online</p>
                </span>
            </a></li>
        <li><a href="call">
                <img src="images/call.webp" alt="">
                <span class="container__recommendations__list__undercard">
                    <p>Call -></p>
                    <p>Call phone, free calling</p>
                </span>
            </a></li>
    </ul>
</div>

<div class="chart__container">
    <canvas id="pieChart" width="200" height="200" role="img"></canvas>
</div>

@endsection