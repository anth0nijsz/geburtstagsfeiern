<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ralf turns 19 | Birthday invitation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <canvas id="confetti" aria-hidden="true"></canvas>
    <main class="invite-shell">
        <section class="name-screen" id="nameScreen" aria-labelledby="welcomeTitle">
            <div class="topline"><span>BIRTHDAY PARTY / 26</span><span>PLEASE RSVP</span></div>
            <div class="name-content">
                <p class="eyebrow">A note from the birthday team</p>
                <h1 id="welcomeTitle">Who is<br><em>invited?</em></h1>
                <p class="intro">Type your name. The invitation is waiting on the other side.</p>
                <form id="nameForm" class="name-form">
                    <label for="guestName">Your name</label>
                    <div class="input-row">
                        <input id="guestName" name="guest_name" type="text" maxlength="80" autocomplete="name" placeholder="e.g. Maya" required>
                        <button type="submit" class="arrow-button" aria-label="Open invitation">&#8594;</button>
                    </div>
                    <p class="form-error" id="nameError" role="alert"></p>
                </form>
            </div>
            <div class="scribble">keep<br>this<br>close</div>
        </section>

        <section class="card-stage is-hidden" id="cardStage" aria-live="polite">
            <div class="stage-header"><span class="brand-mark">R / 19</span><button class="text-button" id="backButton" type="button">&#8592; Change name</button></div>
            <div class="card-wrap" id="cardWrap">
                <article class="invite-card" id="inviteCard">
                    <div class="card-face card-front">
                        <div class="card-noise"></div>
                        <div class="front-top"><span>OCT 29 / 2026</span><span>ISSUE 019</span></div>
                        <div class="portrait-frame">
                            @php
                                $portraitPath = collect(glob(public_path('images/*.{jpg,jpeg,png,webp}'), GLOB_BRACE))->first();
                            @endphp
                            @if ($portraitPath)
                                <img class="portrait-image" src="{{ asset('images/'.basename($portraitPath)) }}" alt="Ralf's photo">
                            @else
                                    <div class="portrait-placeholder" aria-label="Placeholder for Ralf's photo"><span>YOUR<br>PHOTO<br>HERE</span></div>
                            @endif
                            <span class="portrait-tag">RALF / HOST</span>
                        </div>
                        <div class="front-copy"><p class="kicker">You're invited to my birthday!</p><h2>RALF<br><span>TURNS 19!</span></h2><p class="guest-line">This invitation is for <strong id="guestDisplay">you</strong>.</p></div>
                        <div class="front-footer"><span>THURSDAY NIGHT</span><span>FLIP FOR THE LOCATION &#8594;</span></div>
                    </div>
                    <div class="card-face card-back">
                        <div class="back-pattern"></div>
                        <div class="back-content"><p class="kicker">The meeting point</p><h2>See you<br>at <em>McD.</em></h2>
                            <div class="details-grid"><div><span>WHEN</span><strong>THURSDAY<br>29 OCTOBER 2026</strong></div><div><span>WHERE</span><strong>MCDONALD'S<br><small>The exact address is coming soon</small><a class="map-link" href="https://maps.app.goo.gl/w2DM4wwLAn9Gb78X8" target="_blank" rel="noopener">Open Google Maps &#8599;</a></strong></div><div><span>DRESS CODE</span><strong>HALLOWEEN<br><small>Ghosts, costumes and white clothes</small></strong></div></div>
                            <div class="back-note">DON'T FORGET<br>TO COME!</div><p class="flip-hint">Click to flip back</p>
                        </div>
                    </div>
                </article>
            </div>
            <button class="flip-button" id="flipButton" type="button">Flip the card <span>&#8596;</span></button>
            <section class="message-panel" aria-labelledby="messageTitle"><div><p class="eyebrow">One more thing</p><h2 id="messageTitle">Leave Ralf<br>a message.</h2></div>
                <form id="messageForm" class="message-form"><input type="text" name="sender_name" id="senderName" maxlength="80" placeholder="Your name" required><textarea name="message" id="birthdayMessage" maxlength="1000" rows="3" placeholder="Write something nice ..." required></textarea><button type="submit" class="submit-button">Send to Ralf <span>&#8599;</span></button><p class="form-status" id="messageStatus" role="status"></p></form>
            </section>
        </section>
    </main>
</body>
</html>
