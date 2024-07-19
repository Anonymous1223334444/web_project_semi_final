<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .emoji-wrap{
            position: relative;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
            height: 350px;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: 50% 50%;
            user-select: none;
        }

        .emoji{
            font-size: 53px;
            position: absolute;
            display: inline-block;
            cursor: move;
            line-height: 1;
            user-select: none;
        }

        .emoji-wrap_0,
        .emoji-wrap_4{
            height: 370px;
            display: inline-block;
            position: relative;
            vertical-align: top;
            font-size: 0;
        }
        .emoji-wrap_0{
            width: 293px;
            margin: 0 40px;

            .emoji {
                &1 {
                    top: 0;
                    left: (100% * 117)/ 293;
                }
                &2 {
                    top: 6.02703%;
                    left: 63.50512%;
                }
                &3{
                    top: (100% * 74)/ 370;
                    left: (100% * 220)/ 293;
                }
                &4{
                    top: (100% * 135)/ 370;
                    left: (100% * 239)/ 293;
                }
                &5{
                    top: (100% * 197)/ 370;
                    left: (100% * 239)/ 293;
                }
                &6{
                    top: (100% * 260)/ 370;
                    left: (100% * 219)/ 293;
                }
                &7{
                    top: (100% * 305)/ 370;
                    left: (100% * 177)/ 293;
                }
                &8{
                    top: (100% * 322)/ 370;
                    left: (100% * 117)/ 293;
                }
                &9{
                    top: (100% * 305)/ 370;
                    left: (100% * 59)/ 293;
                }
                &10{
                    top: (100% * 260)/ 370;
                    left: (100% * 20)/ 293;
                }
                &11{
                    top: (100% * 197)/ 370;
                    left: (100% * 3)/ 293;
                }
                &12{
                    top: (100% * 135)/ 370;
                    left: (100% * 3)/ 293;
                }
                &13{
                    top: (100% * 74)/ 370;
                    left: (100% * 20)/ 293;
                }
                &14{
                    top: (100% * 26)/ 370;
                    left: (100% * 53)/ 293;
                }

            }
        }
        .emoji-wrap_4{
            width: 280px;

            .emoji{
                &1{
                    top: (100% * 4)/ 370;
                    left: (100% * 159)/ 280;
                }
                &2{
                    top: (100% * 52)/ 370;
                    left: (100% * 122)/ 280;
                }
                &3{
                    top: (100% * 100)/ 370;
                    left: (100% * 80)/ 280;
                }
                &4{
                    top: (100% * 149)/ 370;
                    left: (100% * 38)/ 280;
                }
                &5{
                    top: (100% * 198)/ 370;
                    left: 0;
                }
                &6{
                    top: (100% * 198)/ 370;
                    left: (100% * 54)/ 280;
                }
                &7{
                    top: (100% * 198)/ 370;
                    left: (100% * 110)/ 280;
                }
                &8{
                    top: (100% * 198)/ 370;
                    left: (100% * 170)/ 280;
                }
                &9{
                    top: (100% * 198)/ 370;
                    left: (100% * 227)/ 280;
                }
                &10{
                    top: (100% * 143)/ 370;
                    left: (100% * 170)/ 280;
                }
                &11{
                    top: (100% * 255)/ 370;
                    left: (100% * 170)/ 280;
                }
                &12{
                    top: (100% * 315)/ 370;
                    left: (100% * 170)/ 280;
                }
            }
        }
    </style>


    <div class="emoji-wrap">
        <div class="emoji-wrap_4"></div>
        <div class="emoji-wrap_0"></div>
        <div class="emoji-wrap_4"></div>
    </div>
    

    <script>
        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }


        function p404(){

            var emojiEl, emojiBlock4="", emojiBlock0 = "";

            for(var i=1; i<13; i++){
                emojiEl = "<span class='emoji emoji"+ i +"'>&#1285"+getRandomInt(13,67)+";</span>";
                emojiBlock4 += emojiEl; 
            }
            document.querySelectorAll('.emoji-wrap_4').forEach(
                function(el){
                    el.innerHTML = emojiBlock4;
                }
            );
            for(var j=1; j<15; j++){
                emojiEl = "<span class='emoji emoji"+ j +"'>&#1285"+getRandomInt(13,67)+";</span>";
                emojiBlock0 += emojiEl;
            }
            document.querySelectorAll('.emoji-wrap_0').forEach(
                function(el){
                    el.innerHTML = emojiBlock0;
                }
            );


            //drag n drop
            var ball = document.querySelectorAll('.emoji');
            ball.forEach(
                function(el){
                    el.onmousedown = function(e){
                        el.style.position = 'absolute';
                        moveAt(e);
                        document.body.appendChild(el);
                        el.style.zIndex = 1000;

                        function moveAt(e){
                            el.style.left = e.pageX - el.offsetWidth / 2 +'px';
                            el.style.top = e.pageY - el.offsetHeight / 2 +'px';
                        }
                        document.onmousemove = function(e){
                            moveAt(e);
                        };
                        el.onmouseup = function(){
                            document.onmousemove = null;
                            el.onmouseup = null;
                        }
                    };
                    el.ondragstart = function(){
                        return false;
                    }
                }
            )
        }

        p404();
    </script>
</body>
</html>