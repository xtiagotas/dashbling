<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assinatura Cancelada</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f6f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #32325d;
            margin-bottom: 20px;
        }
        p {
            color: #525f7f;
            margin: 20px 0;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 15px rgba(50, 50, 93, 0.1), 0 2px 5px rgba(50, 50, 93, 0.08), 0 1px 1px rgba(0, 0, 0, 0.05);
        }
        .logo {
            margin-bottom: 20px;
            max-width: 200px; /* Ajuste o tamanho máximo do logo */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/images/logo_azul_com_texto.png" alt="Dash Bling Logo" class="logo">
        <h1>Assinatura Cancelada</h1>
        <p>Sua assinatura do DashBling foi cancelada. Sentimos muito em vê-lo partir. Se houver algo que possamos fazer para melhorar sua experiência, por favor, entre em contato conosco.</p>
        <form action="{{ route('subscribe') }}" method="GET">
            <button type="submit" class="button">Assinar Novamente</button>
        </form>
    </div>
</body>
</html>
