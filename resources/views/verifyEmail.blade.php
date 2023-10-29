<!DOCTYPE html>
<html>
<head>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Verificación de correo electrónico.</h1>
    <h1>{{$verified}}</h1>
    <h1>Será redirigido a la aplicación...</h1>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.close();
            }, 6000); // 6000 milisegundos = 6 segundos
        });
    </script>
</body>
</html>