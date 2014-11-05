<?php if (!defined('THINK_PATH')) exit();?><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1">
<link href="<?php echo ADDON_PUBLIC_PATH;?>/css/scratch.css" rel="stylesheet" type="text/css">

<body id="scratch">

<!--以下是支付提示层-->
<div class="touch_us">
    <div class="touch_us_01">
        <div class="tu_font">
        </div>
    </div>
</div>
<!--以上是支付提示层-->


<div class="container body">
    <div class="scr_top">
        <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/top.jpg"/>
        <!--<div class="area">-->
        <div class="ggk_01">

            <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/area_01.jpg"/>
            <canvas class="ggk_div"></canvas>
            <img style="margin-top: -80px;" src="<?php echo ADDON_PUBLIC_PATH;?>/img/area_02.jpg"/>

        </div>
    </div>

</div>
<div class="block_out">
    <div class="block_inner">
        <h6>活动说明</h6>

        <p>
            1.一等奖果果哒体验一周
        </p>
    </div>
</div>
<!--中将记录 -->
<div class="block_out">

    <div class="block_inner">
        <h6>我的中奖记录</h6>
        <table class="ggk_table" cellpadding="0" cellspacing="0">
            <tr>
                <td class="ggk_td_01"><span>果果哒水果体验一月</span></td>
                <td class="ggk_td_02"><a href="#">前去领奖</a></td>
            </tr>
            <tr>
                <td class="ggk_td_01"><span>果果哒水果体验一周</span></td>
                <td class="ggk_td_02"><a href="#">前去领奖</a></td>
            </tr>
            <tr>
                <td class="ggk_td_01"><span>果果哒水果体验一天</span></td>
                <td class="ggk_td_02"><a href="#">前去领奖</a></td>
            </tr>
        </table>
    </div>
</div>
<input type="hidden" value="4" id="myPrize">

<script type="text/javascript" src="<?php echo ADDON_PUBLIC_PATH;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ADDON_PUBLIC_PATH;?>/js/ggk.js"></script>

<script>
//JS刮刮卡
(function(bodyStyle){
           var myPrize = document.getElementById('myPrize').value;

            bodyStyle.mozUserSelect = 'none';
            bodyStyle.webkitUserSelect = 'none';

            var img = new Image();
            var canvas = document.querySelector ('canvas');
            canvas.style.backgroundColor = 'transparent';
            //canvas.style.position = 'relative';

            img.addEventListener('load', function (e) {
                var ctx;

                /*var w = img.width,
                 h = img.height;*/
                var w = 200,
                    h = 80,
                    times = 0;

                var offsetX = canvas.offsetLeft,
                    offsetY = canvas.offsetTop;
                var mousedown = false;

                function layer(ctx){
                    ctx.fillStyle = 'gray';
                    ctx.fillRect (0, 0, w, h);
                }

                function eventDown(e){
                    e.preventDefault ();
                    mousedown = true;

                }

                function eventUp (e) {
                    e.preventDefault ();
                    mousedown = false;
                    if(times == 1){
                        if(myPrize==3){
                            prize1();
                        }else if(myPrize==4){
                            prize2();
                        }else if(myPrize==5){
                            prize3();
                        }else if(myPrize==2){
                            prize0();
                        }
                    }
                    times ++;
                }

                function eventMove (e) {
                    if(myPrize==0){
                        check1();
                        mousedown = false;
                    }
                    if(myPrize==1){
                        check2();
                        mousedown = false;
                    }
                    e.preventDefault ();
                    if (mousedown) {
                        if (e.changedTouches) {
                            e = e.changedTouches[e.changedTouches.length - 1];
                        }
                        var x = (e.clientX + document.body.scrollLeft || e.pageX) - offsetX || 0,
                                y = (e.clientY + document.body.scrollTop || e.pageY) - offsetY || 0;
                        with (ctx) {
                            beginPath ();
                            //这里限制挂的大小
                            arc (x, y, 20, 0, Math.PI * 2);
                            fill ();
                        }
                    }
                }

                canvas.width = w;
                canvas.height = h;
                canvas.style.backgroundImage='url(' + img.src + ')';
                ctx = canvas.getContext ('2d');
                ctx.fillStyle = 'transparent';
                ctx.fillRect (0, 0, w, h);
                layer (ctx);

                ctx.globalCompositeOperation = 'destination-out';

                canvas.addEventListener ('touchstart', eventDown);
                canvas.addEventListener ('touchend', eventUp);
                canvas.addEventListener ('touchmove', eventMove);
                canvas.addEventListener ('mousedown', eventDown);
                canvas.addEventListener ('mouseup', eventUp);
                canvas.addEventListener ('mousemove', eventMove);
            });
            //img.src = 'prize.jpg';
            if(myPrize==2 || myPrize==0 || myPrize==1){
                img.src = '<?php echo ADDON_PUBLIC_PATH;?>/img/4.jpg';
            }
            if(myPrize==3){
                img.src = '<?php echo ADDON_PUBLIC_PATH;?>/img/1.jpg';
            }
            if(myPrize==4){
                img.src = '<?php echo ADDON_PUBLIC_PATH;?>/img/2.jpg';
            }
            if(myPrize==5){
                img.src = '<?php echo ADDON_PUBLIC_PATH;?>/img/3.jpg';
            }

        })(document);

</script>
</body>
</html>