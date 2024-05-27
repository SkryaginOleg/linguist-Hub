<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>chat AJAX </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/style-chat.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/script-chat.js"></script>
</head>

<body>
    <link href="iccon/style.css" rel="stylesheet" />

    <div class="chat-app">
        <div id="layout-list" class="layout-list">
            <div class="input-group">

                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-text"><span class="icon-plus" title="Создать чат"></span></span>

            </div>
            <ul class="list-unstyled chat-list mt-4 mb-0"><!-- CHAT--></ul>
        </div>
        <div id="layout-chat" class="layout-chat">
            <div class="chat-header ">
                <div class="row">
                    <div class="col-md-10">
                        <!-- CHAT_INFO -->
                    </div>
                    <div class="col-md-2 buttons">
                        <div class="input-group mb-3 w-auto">
                            <span class="input-group-text"><span class="icon-cog"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-messages">
                <ul class="message-box-wrap m-b-0"> <!--message--></ul>
            </div>
            <div class="chat-message-send">
                <form id="chat-message-send">
                    <div class="input-group mb-0">
                        <input type="text" id="message_text" class="form-control" placeholder="Введите сообщение...">
                        <span class="input-group-text"><button type="submit"><span class="icon-compass"></span></button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>