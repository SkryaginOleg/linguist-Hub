let autoScroll = true;
let currentChat = -1;
let chatData = {};
let userData = {};

const ws = new WebSocket("ws://localhost:8000");


ws.onmessage = function (event) {
    console.log("Message received from server:", event.data);
    const data = JSON.parse(event.data);
    const { userId, message } = data;
    alert(`User ${userId} sent a message: ${message}`);
};

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

$(document).ready(function () {

    $('#chat-message-send').submit(function (e) {
        message_text = $('#message_text').val().trim();
        if (message_text.length > 0) {
            $.post("actions/get_messages.php?action=add_message&chat_id=" + currentChat, {
                message: $('#message_text').val(),
            }).done(function (data) {
                console.log("Server response:", data);
                $('#message_text').val('');
                autoScroll = true;
    
                const chatId = currentChat;
                const message = message_text;
    
                console.log("WebSocket:", chatId, message);
    
                loadUser(function() {
                    let chatInfo = chatData[currentChat];
                    let userInfo = userData;
    
                    if (chatInfo && userInfo) {
                        chatName = chatInfo.name;
                        userName = userInfo.fullName;
    
                        var userId = getCookie('user');
                        if (userId) {
                            console.log("Sending init message with userId:", userId, chatName, message,  userName);
                            ws.send(JSON.stringify({
                                type: 'init',
                                userId: userId
                            }));
                            ws.send(JSON.stringify({chatName, message,  userName, userId }));
                        } else {
                            console.error("User ID cookie is missing");
                            ws.close();
                        }
                    }
                });
    
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error("Error:", textStatus, errorThrown);
            });
        }
        else {
            $('#message_text').val('');
        }
        return false;
    })
    
    function loadUser(callback) {
        $.ajax({
            url: "actions/get_messages.php?action=get_user",
            dataType: 'json',
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
            }
        })
        .done(function (data) {
            userData = {
                fullName: data[0].full_name,
                email: data[0].email,
                country: data[0].country,
                information: data[0].information
            };
    
            console.log('Данные о пользователе:', userData);
            if (callback && typeof callback === 'function') {
                callback();
            }
        });
    }

    let lastId = 0;
    setInterval(loadMessages, 1000);

    function loadMessages() {

        $.ajax({
            url: "actions/get_messages.php?lastId=" + lastId + "&chat_id=" + currentChat,
            dataType: 'json',
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
            }
        })
            .done(function (data) {

                data.forEach(item => {
                    $(".message-box-wrap").append(renderMessage(item));
                    lastId = lastId < item.message_id ? item.message_id : lastId;
                    console.log(lastId);
                })
                if (autoScroll) {
                    $('.chat-messages').animate({ scrollTop: $('.chat-messages')[0].scrollHeight });
                }
            });
    }

    function renderMessage(item) {
        if (item.user_id == getCookie('user')) {
            return `<li class="message-box my-message" data-message-id="${item.message_id}"> 
                <div class="message float-right">
                    ${item.text}
                    <div class="message-data-time">${formatTime(item.time)}</div>
                </div>
            </li>`;
        } else {
            return `<li class="message-box" data-message-id="${item.message_id}">
            <div class="message-wrap">
                <span class="message-data-avatar">
                    <img src="data:image/jpeg;base64,${item.photo}" alt="avatar">
                </span>
                <div class="message other-message">
                    <div class="message-data-name">${item.full_name}</div>
                    ${item.text}
                    <div class="message-data-time">${formatTime(item.time)}</div>
                </div>
            </div>
        </li>`;
        }
    }

    function formatTime(time) {
        const date = new Date(time);
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    }


    let scrollPos = 0;
    $('.chat-messages').scroll(function () {
        let st = $(this).scrollTop();
        if (st > scrollPos) {
            console.log('Down');
            let a = $('.chat-messages')[0].scrollHeight;
            let b = $('.chat-messages').scrollTop() + $('.chat-messages').innerHeight() + 10;
            if (a <= b) { autoScroll = true; }
        }
        else {
            autoScroll = false;
        }
        scrollPos = st;
    });

    function loadChats() {

        $.ajax({
            url: "actions/get_messages.php?action=get_chat",
            dataType: 'json',
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
            }
        })
            .done(function (data) {
                data.forEach(item => {
                    $(".list-unstyled").append(renderChat(item));

                    chatData[item.chat_id] = {
                        name: item.name,
                        photo: item.photo,
                        date: item.date
                    };
                })
            });
    }

    function renderChat(item) {

        return `<li class="" data-chat-id="${item.chat_id}">
            <img src= "${item.photo}"alt="avatar">
            <div class="about">
                <div class="name">${item.name}</div>
                <div class="status"> <span class="icon-cross"></span> left 7 mins ago </div>
            </div>
        </li>`;

    }

    function renderChatInfo(chatId) {

        let chatInfo = chatData[currentChat];
        let chatName;
        let chatPhoto;
        let chatDate;

        if (chatInfo) {
            chatName = chatInfo.name;
            chatPhoto = chatInfo.photo;
            chatDate = chatInfo.date;
        }

        return `<a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                    <img src="${chatPhoto}" alt="avatar">
                </a>
                <div class="chat-about">
                    <h6 class="m-b-0">${chatName}</h6>
                    <small>Last seen: 2 hours ago</small>
                </div>`;
    }

    loadChats();

    $('.list-unstyled').on('click', 'li', function () {

        $('.list-unstyled li').removeClass('active');
        $(".message-box-wrap").empty();
        $(this).attr('class', 'active');
        currentChat = $(this).data('chat-id');
        lastId = 0;

        $(".col-md-10").empty();
        $(".col-md-10").append(renderChatInfo(currentChat));

    });

});