<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link rel="stylesheet"  type="text/css"  href="{{asset('css/draw.css')}}">

    <title>Draw</title>



    <script>
        $(function(){

            var canvas=document.getElementById("canvas");
            var ctx=canvas.getContext("2d");
            //var ctx1=canvas.getContext("2d");


            var canvasOffset=$("#canvas").offset();
            var offsetX=canvasOffset.left;
            var offsetY=canvasOffset.top;

            var isDown=false;


            var pi2=Math.PI*2;
            var resizerRadius=8;
            var rr=resizerRadius*resizerRadius;
            var draggingResizer={x:0,y:0};
            var imageX=50;
            var imageY=50;
            var imageWidth,imageHeight,imageRight,imageBottom,imageWidth1,imageHeight1,imageRight1,imageBottom1;
            var draggingImage=false;
            var startX;
            var startY;



            var img=new Image();
            $(img).on('load',function(){
                imageWidth = img.width / 10;
                imageHeight = img.height / 10;
                imageRight = imageX + imageWidth;
                imageBottom = imageY + imageHeight;
                draw(true, false);
            });
            img.src="images\\back.jpg";

            var imaggge=img;

            var img2=new Image();
            img2.onload=function(){
                imageWidth1 = img2.width ;
                imageHeight1 = img2.height ;
                imageRight1 = imageX + imageWidth1;
                imageBottom1 = imageY + imageHeight1;
                draw(true, false);
            };

            img2.src="images\\Tulips.jpg";



            function draw(withAnchors,withBorders){

                // clear the canvas
                ctx.clearRect(0,0,canvas.width,canvas.height);

                // draw the image
                ctx.drawImage(img2,0,0,img2.width,img2.height,50,50,imageWidth1,imageHeight1);
                ctx.drawImage(imaggge,0,0,imaggge.width,imaggge.height,imageX,imageY,imageWidth,imageHeight);

                // optionally draw the draggable anchors
                if(withAnchors){
                    drawDragAnchor(imageX,imageY);
                    drawDragAnchor(imageRight,imageY);
                    drawDragAnchor(imageRight,imageBottom);
                    drawDragAnchor(imageX,imageBottom);
                }

                // optionally draw the connecting anchor lines
                if(withBorders){
                    ctx.beginPath();
                    ctx.moveTo(imageX,imageY);
                    ctx.lineTo(imageRight,imageY);
                    ctx.lineTo(imageRight,imageBottom);
                    ctx.lineTo(imageX,imageBottom);
                    ctx.closePath();
                    ctx.stroke();
                }

            }

            function drawDragAnchor(x,y){
                ctx.beginPath();
                ctx.arc(x,y,resizerRadius,0,pi2,false);
                ctx.closePath();
                ctx.fill();
            }

            function anchorHitTest(x,y){

                var dx,dy;

                // top-left
                dx=x-imageX;
                dy=y-imageY;
                if(dx*dx+dy*dy<=rr){ return(0); }
                // top-right
                dx=x-imageRight;
                dy=y-imageY;
                if(dx*dx+dy*dy<=rr){ return(1); }
                // bottom-right
                dx=x-imageRight;
                dy=y-imageBottom;
                if(dx*dx+dy*dy<=rr){ return(2); }
                // bottom-left
                dx=x-imageX;
                dy=y-imageBottom;
                if(dx*dx+dy*dy<=rr){ return(3); }
                return(-1);

            }


            function hitImage(x,y){
                return(x>imageX && x<imageX+imageWidth && y>imageY && y<imageY+imageHeight);
            }


            function handleMouseDown(e){
                startX=parseInt(e.clientX-offsetX);
                startY=parseInt(e.clientY-offsetY);
                draggingResizer=anchorHitTest(startX,startY);
                draggingImage= draggingResizer<0 && hitImage(startX,startY);
            }

            function handleMouseUp(e){
                draggingResizer=-1;
                draggingImage=false;
                draw(true,false);
            }

            function handleMouseOut(e){
                handleMouseUp(e);
            }

            function handleMouseMove(e){

                if(draggingResizer>-1){

                    mouseX=parseInt(e.clientX-offsetX);
                    mouseY=parseInt(e.clientY-offsetY);

                    // resize the image
                    switch(draggingResizer){
                        case 0: //top-left
                            imageX=mouseX;
                            imageWidth=imageRight-mouseX;
                            imageY=mouseY;
                            imageHeight=imageBottom-mouseY;
                            break;
                        case 1: //top-right
                            imageY=mouseY;
                            imageWidth=mouseX-imageX;
                            imageHeight=imageBottom-mouseY;
                            break;
                        case 2: //bottom-right
                            imageWidth=mouseX-imageX;
                            imageHeight=mouseY-imageY;
                            break;
                        case 3: //bottom-left
                            imageX=mouseX;
                            imageWidth=imageRight-mouseX;
                            imageHeight=mouseY-imageY;
                            break;
                    }

                    // enforce minimum dimensions of 25x25
                    if(imageWidth<25){imageWidth=25;}
                    if(imageHeight<25){imageHeight=25;}

                    // set the image right and bottom
                    imageRight=imageX+imageWidth;
                    imageBottom=imageY+imageHeight;

                    // redraw the image with resizing anchors
                    draw(true,true);

                }else if(draggingImage){

                    imageClick=false;

                    mouseX=parseInt(e.clientX-offsetX);
                    mouseY=parseInt(e.clientY-offsetY);

                    // move the image by the amount of the latest drag
                    var dx=mouseX-startX;
                    var dy=mouseY-startY;
                    imageX+=dx;
                    imageY+=dy;
                    imageRight+=dx;
                    imageBottom+=dy;
                    // reset the startXY for next time
                    startX=mouseX;
                    startY=mouseY;

                    // redraw the image with border
                    draw(false,true);

                }


            }


            $("#canvas").mousedown(function(e){handleMouseDown(e);});
            $("#canvas").mousemove(function(e){handleMouseMove(e);});
            $("#canvas").mouseup(function(e){handleMouseUp(e);});
            $("#canvas").mouseout(function(e){handleMouseOut(e);});


        }); // end $(function(){});
    </script>

</head>
<body>

    <div class="container">
        <div class="image-container">


            <canvas id="canvas" width="500 px" height="500px">

            </canvas>

        </div>


    </div>


</body>

</html>