<html>
<head>
    <title>CSRF Token</title>
</head>
<body>
<form action="/form" method="post">
    <label for="name">
        <input type="text" name="name">
    </label>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="submit" value="Say Hello">
</form>
</body>
</html>
