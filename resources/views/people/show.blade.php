<!DOCTYPE html>
<html>
<head>
    <title>Personne : {{ $person->first_name }} {{ $person->last_name }}</title>
</head>
<body>
    <h1>{{ $person->first_name }} {{ $person->last_name }}</h1>

    <p>Créé par : {{ $person->creator->name ?? 'Inconnu' }}</p>

    <h2>Enfants :</h2>
    <ul>
        @foreach ($person->children as $child)
            <li>{{ $child->first_name }} {{ $child->last_name }}</li>
        @endforeach
    </ul>

    <h2>Parents :</h2>
    <ul>
        @foreach ($person->parents as $parent)
            <li>{{ $parent->first_name }} {{ $parent->last_name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('people.index') }}">Retour</a>
</body>
</html>