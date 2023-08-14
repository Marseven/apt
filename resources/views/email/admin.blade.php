@component('mail::message')
    <h1>Bonjour,</h1>

    Une nouvlle inscription a été faite.

    @if(isset($data->lastname))
        Le nouvel inscrit est : {{$data->lastname ?? ""}} {{$data->firstname ?? ""}}

        @component('mail::button', ['url' => config('app.url') . '/admin/list-registrations'])
            Voir les inscriptions
        @endcomponent
    @else
        Le nouvel inscrit est : {{$data->label ?? ""}}

        @component('mail::button', ['url' => config('app.url') . '/admin/list-entreprises'])
            Voir les inscriptions
        @endcomponent
    @endif
    

    Cordialement,
    LA CONFÉRENCE INTERNATIONALE DE L'AUDIT INTERNE
@endcomponent
