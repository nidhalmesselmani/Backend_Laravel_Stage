<html >
<head>
    <meta charset="utf-8">
<link rel="stylesheet" href="main.css" type="text/css">
</head>
<body>

<h2> Password Reset </h2>
<div>

    <br><br>
  Hello {{ $nom }}
    you have requested to reset the login .
    click this url pls,To reset your password
    <br><br>
    if you did not request password to be reset, pls ingnor this message and your password will stay the same
    <br><br>

    your new temporary login password is : <br>
    <b> {{ $password }}</b>

    <br><br>
    Activate the new password by clicking the flowing link <br><br>
<a href="{{$lien}}"> {{$lien}} </a>
    <br><br>
    Thanks,
    <br>
    Nidhal Team ,
</div>
</body>

</html>