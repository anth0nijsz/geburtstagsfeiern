<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ralf wird 19 | Geburtstagseinladung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <canvas id="confetti" aria-hidden="true"></canvas>
    <main class="invite-shell">
        <section class="name-screen" id="nameScreen" aria-labelledby="welcomeTitle">
            <div class="topline"><span>GEBURTSTAGFEIERN / 26</span><span>BITTE ANTWORTEN</span></div>
            <div class="name-content">
                <p class="eyebrow">Eine Nachricht vom Geburtstags-Team</p>
                <h1 id="welcomeTitle">Wer ist<br><em>eingeladen?</em></h1>
                <p class="intro">Schreib deinen Namen. Die Einladung wartet auf der anderen Seite.</p>
                <form id="nameForm" class="name-form">
                    <label for="guestName">Dein Name</label>
                    <div class="input-row">
                        <input id="guestName" name="guest_name" type="text" maxlength="80" autocomplete="name" placeholder="z. B. Maya" required>
                        <button type="submit" class="arrow-button" aria-label="Einladung öffnen">&#8594;</button>
                    </div>
                    <p class="form-error" id="nameError" role="alert"></p>
                </form>
            </div>
            <div class="scribble">diese<br>Einladung<br>behalten</div>
        </section>

        <section class="card-stage is-hidden" id="cardStage" aria-live="polite">
            <div class="stage-header"><span class="brand-mark">R / 19</span><button class="text-button" id="backButton" type="button">&#8592; Name ändern</button></div>
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
                                <img class="portrait-image" src="{{ asset('images/'.basename($portraitPath)) }}" alt="Ralfs Foto">
                            @else
                                    <div class="portrait-placeholder" aria-label="Platzhalter für Ralfs Foto"><span>DEIN<br>FOTO<br>HIER</span></div>
                            @endif
                            <span class="portrait-tag">RALF / GASTGEBER</span>
                        </div>
                        <div class="front-copy"><p class="kicker">Du bist zu meinem Geburtstag eingeladen!</p><h2>RALF<br><span>WIRD 19!</span></h2><p class="guest-line">Diese Einladung ist für <strong id="guestDisplay">dich</strong>.</p></div>
                        <div class="front-footer"><span>DONNERSTAG ABEND</span><span>FÜR DEN ORT WENDEN &#8594;</span></div>
                    </div>
                    <div class="card-face card-back">
                        <div class="back-pattern"></div>
                        <div class="back-content"><p class="kicker">Der Treffpunkt</p><h2>Wir sehen uns<br>bei <em>McD.</em></h2>
                            <div class="details-grid"><div><span>WANN</span><strong>DONNERSTAG<br>29. OKTOBER 2026</strong></div><div><span>WO</span><strong>MCDONALD'S<br><small>Die genaue Adresse kommt noch</small><a class="map-link" href="https://maps.app.goo.gl/w2DM4wwLAn9Gb78X8" target="_blank" rel="noopener">Google Maps öffnen &#8599;</a></strong></div><div><span>KLEIDUNG</span><strong>HALLOWEEN<br><small>Geist, Gespenst und weiße Kleidung</small></strong></div></div>
                            <div class="back-note">NICHT VERGESSEN<br>ZU KOMMEN!</div><p class="flip-hint">Karte zurückdrehen</p>
                        </div>
                    </div>
                </article>
            </div>
            <button class="flip-button" id="flipButton" type="button">Karte drehen <span>&#8596;</span></button>
            <section class="message-panel" aria-labelledby="messageTitle"><div><p class="eyebrow">Noch eine Sache</p><h2 id="messageTitle">Schreib Ralf<br>eine Nachricht.</h2></div>
                <form id="messageForm" class="message-form"><input type="text" name="sender_name" id="senderName" maxlength="80" placeholder="Dein Name" required><textarea name="message" id="birthdayMessage" maxlength="1000" rows="3" placeholder="Schreib etwas Nettes ..." required></textarea><button type="submit" class="submit-button">An Ralf senden <span>&#8599;</span></button><p class="form-status" id="messageStatus" role="status"></p></form>
            </section>
        </section>
    </main>
</body>
</html>
