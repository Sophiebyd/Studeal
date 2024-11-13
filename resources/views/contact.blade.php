<!DOCTYPE html>
<html>
<head>
    <title>Nouveau Message de Contact</title>
</head>
<body>
    <h2>Détails du message</h2>
    <p><strong>Nom :</strong> {{ $details['first_name'] }} {{ $details['last_name'] }}</p>
    <p><strong>Email :</strong> {{ $details['email'] }}</p>
    <p><strong>Téléphone :</strong> {{ $details['phone'] }}</p>
    <p><strong>Message :</strong></p>
    <p>{{ $details['message'] }}</p>
</body>
</html>
