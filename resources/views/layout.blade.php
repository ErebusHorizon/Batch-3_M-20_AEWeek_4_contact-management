<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <header>
        <nav>
            <a href="{{ route('contacts.index') }}">All Contacts</a>
            <a href="{{ route('contacts.create') }}">Add New Contact</a>
        </nav>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>
</html>
