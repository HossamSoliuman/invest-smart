<!DOCTYPE html>
<html lang="en">

<head>
    <script async src="https://www.google.com/recaptcha/api.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>
    <form method="POST" action="test">
        @csrf
       
        <div class="g-recaptcha mt-4" data-sitekey={{env('RECAPTCHA_SITEKEY')}}></div>

        <button type="submit">Sign Up</button>
    </form>


</body>

</html>
