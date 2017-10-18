@component('mail::message')
# Activisme Centrale authencatie.

Geachte,

Wij hebben jouw account wegens onderstaande rede en zal binnen een week gedeblokkeerd worden.

__Reden tot blokkering:__

{{ $input->reason }}

@component('mail::button', ['url' => 'info@activisme.be'])
Contacteer ons.
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
