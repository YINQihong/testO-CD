<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une personne</title>
</head>
<body>
    <h1>Ajouter une personne</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('people.store') }}" method="POST">
        @csrf
        <label>Prénom :</label>
        <input type="text" name="first_name" required>
        
        <label>Nom :</label>
        <input type="text" name="last_name" required>
        
        <label>Nom de naissance :</label>
        <input type="text" name="birth_name">

        <label>Noms intermédiaires :</label>
        <input type="text" name="middle_names">

        <label>Date de naissance :</label>
        <input type="date" name="date_of_birth">

        <label>Créé par :</label>
        <select name="created_by" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <button type="submit">Ajouter</button>
    </form>

    <a href="{{ route('people.index') }}">Retour</a>
</body>
</html>