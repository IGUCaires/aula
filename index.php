<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de ChatBot</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="chatbox">
            <div class="header">
                <h3>Exemplo de ChatBot</h3>
                <br>
                <p>Digite <strong>ajuda</strong> para obter a lista de opções.</p>
            </div>
            <div class="body" id="chatbody">
                <div class="scroller"></div>
            </div>
            <form class="chat" method="post" autocomplete="off">
                <div>
                    <input type="text" name="chat" id="chat" placeholder="Mensagem...">
                </div>
                <div>
                    <input type="submit" value="Enviar" id="btn">
                </div>
            </form>
        </div>
    </div>
    <script src="app.js"></script>
</body>

</html>