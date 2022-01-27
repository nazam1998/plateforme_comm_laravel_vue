@component('mail::message')
Hello **{{ $nom }}**,
You received a new task: **{{ $task }}**

@component('mail::button', ['url' => $link])
Go to your dashboard
@endcomponent
Sincerely,
Task Manager Team
@endcomponent
