<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vaccination Program</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen flex-col font-sans gap-2">
<h1 class="text-2xl text-slate-600 font-semibold">Welcome to Vaccination Program</h1>
<p class="text-md text-stone-500 font-semibold">A Vaccine Registration Application.</p>
<a role="button" href="{{ route('sign-up') }}"
   class="text-md px-5 py-1 border-2 rounded-lg border-amber-600 text-amber-600 hover:bg-amber-600 hover:text-white transition-all">
    Register Now
</a>
</body>

</html>
