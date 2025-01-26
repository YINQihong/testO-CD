<!DOCTYPE html>
<html>
<head>
    <title>Liste des personnes</title>
</head>
<body>
    <h1>Liste des personnes</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('people.create') }}">Ajouter une nouvelle personne</a>

    <ul>
        @foreach ($people as $person)
            <li>
                <a href="{{ route('people.show', $person->id) }}">{{ $person->first_name }} {{ $person->last_name }}</a>
                (Créé par : {{ $person->creator->name ?? 'Inconnu' }})
            </li>
        @endforeach
    </ul>
</body>
</html>