@component('mail::message')
# Hello, Admin

{{ $contact->name }} sent you a message.

{{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
