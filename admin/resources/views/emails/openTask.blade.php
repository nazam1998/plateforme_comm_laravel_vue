@component('mail::message')
Hello **{{ $nom }}**,
<p>Here are your current tasks:</p>
<ul>

@foreach ($taches as $tache)
<li>{{$tache->tache}}</li>
@endforeach
</ul>
@component('mail::button', ['url' => $link])
Go to your dashboard
@endcomponent
Sincerely,
Task Manager Team
@endcomponent
