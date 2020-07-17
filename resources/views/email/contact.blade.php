<h1>Ciao admin!</h1>
<p>C'è un nuovo contatto che ti aspetta!</p>
<div>
    <strong>Da:</strong> {{ $lead->name }}<br>
    <strong>Email:</strong> {{ $lead->email }}<br>
    <strong>Messaggio:</strong> <br>{{ $lead->message }}
</div>
