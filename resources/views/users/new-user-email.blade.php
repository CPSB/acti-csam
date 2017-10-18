@component('mail::message')
# Activisme Centrale authencatie.

Geachte,

Er is voor jouw een login aangemaakt op het netwerk van activismeBE.
Hieronder vind je alle gegevens nog eens.

**Ter info:** Met uw email en wachtwoord. Kunt u inloggen op elke applicatie in ons activisme netwerk.

| | | |
|-|-|-|
|__Naam__| {{ $input->name }} |
|__Email adres:__| {{ $input->email }} |
|__Wachtwoord:__| {{ $password }} |
|__Ingestelde taal:__| {{ strtoupper($input->language) }}


@component('mail::button', ['url' => 'informatica@activisme.be'])
Contacteer ons
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
