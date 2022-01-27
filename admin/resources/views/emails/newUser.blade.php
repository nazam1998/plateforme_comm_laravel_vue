@component('mail::message')
Hello **{{$email}}**,
Thank you for registering
Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent
