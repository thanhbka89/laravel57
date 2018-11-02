@component('mail::message')
Hello,
 
Welcome to our website.
 
@component('mail::button', ['url' => ''])
Learn More
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent