<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-divice-width, initial-scale=1.0">
    <title>Вікно подорожей</title>
    <link rel="stylesheet" href="tr.css">
    <script src="tr.js"></script>
</head>

<body>
    <header>
        <div>
            <h1>Linguist Hub</h1>
        </div>

        <div class="header-buttons">
            <button>Home</button>
            <button>Find language</button>
            <button>Meetings</button>
            <button>Courses</button>
        </div>

        <div class="header2-buttons">
            <button>App</button>
            <div class="header2-buttons button img">
                <button><img src="data:image/png;base64,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"></button>
            </div>
            <button>Sign Up</button>
        </div>
    </header>

    <div class="content-area">
        <div class="ca-row1">
            <h1>Plan your trip!</h1>
        </div>
        <div class="ca-row2">
            <div class="ca-row2-c1">
                <div class="ca-row2-c1-row1">
                    <div class="ca-row2-c1-row1-r1">
                        <h1>Meeting preferences</h1>
                    </div>
                    <div class="ca-row2-c1-row1-r2">
                        <button class="button2"></button>
                        <button class="button3"></button>
                    </div>
                </div>
                <div class="ca-row2-c1-row2">
                    <div class="ca-row2-c1-row2-r1">
                        <h1>Language learning trip details</h1>
                    </div>
                    <div class="ca-row2-c1-row2-r2">
                        <div class="ca-row2-c1-row2-r2-a">
                            <h1>Destanation country:</h1>
                            <input type="text" placeholder="Type in country..." class="inp">
                        </div>
                        <div class="ca-row2-c1-row2-r2-a">
                            <h1>Duration in days:</h1>
                            <div class="input-container">
                                <input type="number" id="daysInput" class="inp2" min="1" value="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ca-row2-c2">
                <div class="ca-row2-c2-r1">
                    <div class="ca-row2-c2-r1-ryad1">
                        <h1>Trip with:</h1>
                    </div>
                    <div class="ca-row2-c2-r1-ryad2">
                        <div class="ca-row2-c2-r1-ryad2-kolonka1">
                            <img src="">
                        </div>
                        <div class="ca-row2-c2-r1-ryad2-kolonka2">
                            <p class="i1">Dukhota Ivan</p>
                            <p class="i2">Ukraine, Kharkiv</p>
                            <p class="i3">Some random info about me and someone else fr fs da da da da da </p>
                        </div>
                    </div>
                </div>

                <div class="ca-row2-c2-r2">
                    <button>CANCEL</button>
                    <button>ACCEPT</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const daysInput = document.getElementById('daysInput');
            const upButton = document.querySelector('.up');
            const downButton = document.querySelector('.down');

            upButton.addEventListener('click', () => {
                daysInput.stepUp();
            });

            downButton.addEventListener('click', () => {
                if (daysInput.value > 1) {
                    daysInput.stepDown();
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.button2, .button3');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    buttons.forEach(function(btn) {
                        btn.classList.remove('highlight');
                    });
                    button.classList.add('highlight');
                });
            });
        });
    </script>
    <style>
        header {
            background-color: #1d2024;
            color: rgb(255, 255, 255);
            padding: 0px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);
        }


        body {
            margin: 0;
            padding: 0;
            background-color: #182444;
        }


        .header-buttons {
            display: flex;
            gap: 50px;
            margin-right: 750px;
            background-color: transparent;
        }


        .header-buttons button {
            padding: 8px 8px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            cursor: pointer;
            background-color: transparent;
            font-size: 18px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin-top: 4px;
        }


        .header2-buttons {
            display: flex;
            gap: 50px;
            margin-right: 5px;
            background-color: transparent;
        }


        .header2-buttons button {
            padding: 8px 15px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            cursor: pointer;
            background-color: transparent;
            font-size: 18px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin-top: 4px;
        }


        .header2-buttons button img {
            width: 20px;
            height: 20px;
            object-fit: cover;
        }

        .content-area {
            width: 1500px;
            height: 900px;
            background-color: #1b203f;
            margin: auto;
            margin-top: 100px;
            margin-bottom: 100px;
            display: grid;
            grid-template-rows: 10% 90%;
        }

        .ca-row1 {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #111932;
        }

        .ca-row1 h1 {
            color: white;
            font-size: 24px;
        }

        .ca-row2 {
            display: grid;
            grid-template-columns: 70% 30%;
        }

        .ca-row2-c1 {
            display: grid;
            grid-template-rows: 50% 50%;
        }

        .ca-row2-c1-row1 {
            display: grid;
            grid-template-rows: 10% 90%;
        }

        .ca-row2-c1-row1-r1 {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-top: 10px;
        }

        .ca-row2-c1-row1-r1 h1 {
            color: white;
            font-size: 22px;
        }

        .ca-row2-c1-row1-r2 {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ca-row2-c1-row2 {
            display: grid;
            grid-template-rows: 10% 90%;
        }

        .ca-row2-c1-row2-r1 {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .ca-row2-c1-row2-r1 h1 {
            color: white;
            font-size: 22px;
        }

        .ca-row2-c1-row2-r2 {
            display: grid;
            grid-template-columns: 50% 50%;
        }

        .ca-row2-c1-row2-r2-a {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .ca-row2-c1-row2-r2-a h1 {
            color: white;
            font-size: 20px;
            margin-right: 10px;
        }

        .inp {
            width: 180px;
            height: 20px;
        }

        .inp2 {
            width: 140px;
            height: 30px;
            padding-right: 30px;
            box-sizing: border-box;
        }

        .input-container {
            position: relative;
            display: inline-block;
        }

        .buttons {
            position: absolute;
            top: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: right;
        }

        .arrow {
            width: 20px;
            height: 10px;
            background-size: contain;
            background-repeat: no-repeat;
            cursor: pointer;
        }

        .up {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray"><path d="M4 12h8l-4-4-4 4z"/></svg>');
        }

        .down {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray"><path d="M4 4h8l-4 4-4-4z"/></svg>');
        }



        .ca-row2-c2 {
            display: grid;
            grid-template-rows: 50% 50%;
        }

        .ca-row2-c2-r1 {
            display: grid;
            grid-template-rows: 10% 90%;
            background-color: #111932;
            margin-top: 20px;
            margin-right: 20px;
        }

        .ca-row2-c2-r1-ryad1 {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .ca-row2-c2-r1-ryad1 h1 {
            color: white;
            font-size: 22px;
        }

        .ca-row2-c2-r1-ryad2 {
            display: grid;
            grid-template-columns: 35% 65%;
        }

        .ca-row2-c2-r1-ryad2-kolonka1 {
            display: flex;
            align-items: start;
            justify-content: center;
            overflow: hidden;
        }

        .ca-row2-c2-r1-ryad2-kolonka1 img {
            width: 100px;
            height: 100px;
            margin-top: 15px;
        }

        .ca-row2-c2-r1-ryad2-kolonka2 {
            display: grid;
        }

        .i1 {
            color: white;
            font-size: 20px;
            height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
            white-space: nowrap;
            margin-left: 10px;
        }

        .i2 {
            color: white;
            font-size: 20px;
            height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
            white-space: nowrap;
            margin-left: 10px;
        }

        .i3 {
            color: white;
            font-size: 20px;
            height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
            max-height: 100px;
            margin-left: 10px;
        }

        .ca-row2-c2-r2 {

            display: flex;
            align-items: end;
            justify-content: right;
        }

        .ca-row2-c2-r2 button {
            width: 100px;
            height: 50px;
            background-color: orange;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .button2 {
            margin-right: 25px;
            width: 150px;
            height: 150px;
            background-size: cover;
            background-image: url('data:image/png;base64,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');
        }

        .button3 {
            margin-left: 25px;
            width: 150px;
            height: 150px;
            background-size: cover;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkc8otvkAMtPPVa2yP2_QEijtzvyW46OciNA&s');
        }

        .highlight {
            border: 3px solid white;
        }
    </style>
</body>

</html>