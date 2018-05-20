<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script src="https://superal.github.io/canvas2image/canvas2image.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


    <link rel="stylesheet" type="text/css" href="{{asset('css/draw.css')}}">

    <title>Draw</title>


    <script>

        $(function () {
            //    $('#canvas').hide();
            //  $('#SecCanvas').show();


            const canvas = document.getElementById("canvas");
            const ctx = canvas.getContext("2d");
            const canvasOffset = $("#canvas").offset();
            const offsetX = canvasOffset.left;
            const offsetY = canvasOffset.top;


            const Seccanvas = document.getElementById("SecCanvas");
            const Secctx = Seccanvas.getContext("2d");
            const SeccanvasOffset = $("#SecCanvas").offset();
            const SecoffsetX = SeccanvasOffset.left;
            const SecoffsetY = SeccanvasOffset.top;





            const pi2 = Math.PI * 2;
            const resizerRadius = 3;
            const rr = resizerRadius * resizerRadius;


            let startX;
            let startY;
            let mouseX;
            let mouseY;
            let imageClick;


            class image {

                constructor(imageWidth, imageHeight) {

                    this.imageX = 0;
                    this.imageY = 0;
                    this.imageWidth = imageWidth;
                    this.imageHeight = imageHeight;
                    this.imgRight = this.imageX + this.imageWidth;
                    this.imgBottom = this.imageY + this.imageHeight;


                    this.img = "";
                    this.imageSrc = "";
                }

                get imageRight() {
                    return this.imageX + this.imageWidth;
                }

                get imageBottom() {
                    return this.imageY + this.imageHeight;
                }

            }

            let draggingResizer = {objectNum: -1, position: -1};
            let draggingImage = -1;

            let numObj = -1;


            let obj = [];

            let SecdraggingResizer = {objectNum: -1, position: -1};
            let SecdraggingImage = -1;

            let SecnumObj = -1;

            let level = 0;

            let Secobj = [];


            init_1();
            init_2();

            function init_1() {
                obj[++numObj] = new image(498, 498);
                obj[numObj].img = new Image();
                obj[numObj].img.src = "images\\front.jpg";

                obj[numObj].img.onload = function () {


                    partDraw();

                };

            }


            function init_2() {
                Secobj[++SecnumObj] = new image(498, 498);
                Secobj[SecnumObj].img = new Image();
                Secobj[SecnumObj].img.src = "images\\back.jpg";

                Secobj[SecnumObj].img.onload = function () {


                    SecpartDraw();

                };

            }

            function frontLev() {


                level = 0;
                partDraw();


            }


            function backLev() {


                level = 1;
                SecpartDraw();


            }

            function newImage(fileName) {
                obj[++numObj] = new image(150, 150);
                obj[numObj].img = new Image();
                obj[numObj].img.src = "images\\" + fileName;
                obj[numObj].img.onload = function () {
                    obj[numObj].imageX = 200;
                    obj[numObj].imageY = 250;
                    obj[numObj].imgRight = obj[numObj].imageX + obj[numObj].imageWidth;
                    obj[numObj].imgBottom = obj[numObj].imageY + obj[numObj].imageHeight;

                    partDraw();

                };
            }

            function SecnewImage(fileName) {
                Secobj[++SecnumObj] = new image(150, 150);
                Secobj[SecnumObj].img = new Image();
                Secobj[SecnumObj].img.src = "images\\" + fileName;
                Secobj[SecnumObj].img.onload = function () {
                    Secobj[SecnumObj].imageX = 200;
                    Secobj[SecnumObj].imageY = 250;
                    Secobj[SecnumObj].imgRight = Secobj[SecnumObj].imageX + Secobj[SecnumObj].imageWidth;
                    Secobj[SecnumObj].imgBottom = Secobj[SecnumObj].imageY + Secobj[SecnumObj].imageHeight;

                    SecpartDraw();

                };
            }


            function partDraw() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                // draw the image
                let i;

                for (i = 0; i <= numObj; i++) {

                    ctx.drawImage(obj[i].img, obj[i].imageX, obj[i].imageY, obj[i].imageWidth, obj[i].imageHeight);

                    if (i > 0) {
                        drawDragAnchor(obj[i].imageX, obj[i].imageY);
                        drawDragAnchor(obj[i].imgRight, obj[i].imageY);
                        drawDragAnchor(obj[i].imgRight, obj[i].imgBottom);
                        drawDragAnchor(obj[i].imageX, obj[i].imgBottom);
                    }
                }


            }


            function SecpartDraw() {
                Secctx.clearRect(0, 0, Seccanvas.width, Seccanvas.height);
                // draw the image
                let i;

                for (i = 0; i <= SecnumObj; i++) {
                  Secctx.drawImage(Secobj[i].img,  Secobj[i].imageX, Secobj[i].imageY, Secobj[i].imageWidth, Secobj[i].imageHeight);

                    //alert(obj[i].imageSrc);
                    if (i > 0) {
                        SecdrawDragAnchor(Secobj[i].imageX, Secobj[i].imageY);
                        SecdrawDragAnchor(Secobj[i].imgRight, Secobj[i].imageY);
                        SecdrawDragAnchor(Secobj[i].imgRight, Secobj[i].imgBottom);
                        SecdrawDragAnchor(Secobj[i].imageX, Secobj[i].imgBottom);
                    }
                }


            }

            function draw(object) {

                // clear the canvas

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                // draw the image
                let i;
                for (i = 0; i <= numObj; i++) {

                    ctx.drawImage(obj[i].img, obj[i].imageX, obj[i].imageY, obj[i].imageWidth, obj[i].imageHeight);

                }

                drawDragAnchor(object.imageX, object.imageY);
                drawDragAnchor(object.imgRight, object.imageY);
                drawDragAnchor(object.imgRight, object.imgBottom);
                drawDragAnchor(object.imageX, object.imgBottom);


                // optionally draw the connecting anchor lines

                ctx.beginPath();
                ctx.moveTo(object.imageX, object.imageY);
                ctx.lineTo(object.imgRight, object.imageY);
                ctx.lineTo(object.imgRight, object.imgBottom);
                ctx.lineTo(object.imageX, object.imgBottom);
                ctx.closePath();
                ctx.stroke();


            }


            function Secdraw(object) {

                // clear the canvas

                Secctx.clearRect(0, 0, Seccanvas.width, Seccanvas.height);
                // draw the image
                let i;
                for (i = 0; i <= SecnumObj; i++) {

                    Secctx.drawImage(Secobj[i].img, Secobj[i].imageX, Secobj[i].imageY, Secobj[i].imageWidth, Secobj[i].imageHeight);

                }


                // optionally draw the draggable anchors
                SecdrawDragAnchor(object.imageX, object.imageY);
                SecdrawDragAnchor(object.imgRight, object.imageY);
                SecdrawDragAnchor(object.imgRight, object.imgBottom);
                SecdrawDragAnchor(object.imageX, object.imgBottom);


                // optionally draw the connecting anchor lines

                Secctx.beginPath();
                Secctx.moveTo(object.imageX, object.imageY);
                Secctx.lineTo(object.imgRight, object.imageY);
                Secctx.lineTo(object.imgRight, object.imgBottom);
                Secctx.lineTo(object.imageX, object.imgBottom);
                Secctx.closePath();
                Secctx.stroke();


            }


            function drawDragAnchor(x, y) {
                ctx.beginPath();
                ctx.arc(x, y, resizerRadius, 0, pi2, false);
                ctx.closePath();
                ctx.fill();
            }


            function SecdrawDragAnchor(x, y) {
                Secctx.beginPath();
                Secctx.arc(x, y, resizerRadius, 0, pi2, false);
                Secctx.closePath();
                Secctx.fill();
            }


            function anchorHitTest(x, y) {

                let dx, dy;
                let object = {objectNum: -1, position: -1};
                let i;
                for (i = 1; i <= numObj; i++) {
                    // top-left
                    dx = x - obj[i].imageX;
                    dy = y - obj[i].imageY;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 0;
                        break;
                    }
                    // top-right
                    dx = x - obj[i].imgRight;
                    dy = y - obj[i].imageY;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 1;
                        break;
                    }
                    // bottom-right
                    dx = x - obj[i].imgRight;
                    dy = y - obj[i].imgBottom;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 2;
                        break;
                    }
                    // bottom-left
                    dx = x - obj[i].imageX;
                    dy = y - obj[i].imgBottom;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 3;
                        break;
                    }

                }
                return object;

            }


            function SecanchorHitTest(x, y) {

                let dx, dy;
                let object = {objectNum: -1, position: -1};
                let i;
                for (i = 1; i <= SecnumObj; i++) {
                    // top-left
                    dx = x - Secobj[i].imageX;
                    dy = y - Secobj[i].imageY;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 0;
                        break;
                    }
                    // top-right
                    dx = x - Secobj[i].imgRight;
                    dy = y - Secobj[i].imageY;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 1;
                        break;
                    }
                    // bottom-right
                    dx = x - Secobj[i].imgRight;
                    dy = y - Secobj[i].imgBottom;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 2;
                        break;
                    }
                    // bottom-left
                    dx = x - Secobj[i].imageX;
                    dy = y - Secobj[i].imgBottom;
                    if (dx * dx + dy * dy <= rr) {
                        object.objectNum = i;
                        object.position = 3;
                        break;
                    }

                }
                return object;

            }


            function hitImage(x, y) {

                let objectNum = -1;
                let i;

                for (i = 1; i <= numObj; i++) {

                    if (x > obj[i].imageX && x < obj[i].imageX + obj[i].imageWidth && y > obj[i].imageY && y < obj[i].imageY + obj[i].imageHeight) {
                        objectNum = i;
                        break;
                    }
                }

                return objectNum;
            }


            /**
             * @return {number}
             */
            function SechitImage(x, y) {

                let objectNum = -1;
                let i;

                for (i = 1; i <= SecnumObj; i++) {

                    if (x > Secobj[i].imageX && x < Secobj[i].imageX + Secobj[i].imageWidth && y > Secobj[i].imageY && y < Secobj[i].imageY + Secobj[i].imageHeight) {
                        objectNum = i;
                        break;
                    }
                }

                return objectNum;
            }


            function handleMouseDown(e) {

                //alert("Im in handleMouseDown front");
                startX = parseInt(e.clientX - offsetX);
                startY = parseInt(e.clientY - offsetY);
                draggingResizer = anchorHitTest(startX, startY);
                if (draggingResizer.objectNum < 0) {
                    draggingImage = hitImage(startX, startY);
                }
            }


            function SechandleMouseDown(e) {

                startX = parseInt(e.clientX - SecoffsetX);
                startY = parseInt(e.clientY - SecoffsetY);
                SecdraggingResizer = SecanchorHitTest(startX, startY);
                if (SecdraggingResizer.objectNum < 0) {
                    SecdraggingImage = SechitImage(startX, startY);
                }
            }


            function handleMouseUp(e) {

                draggingResizer = -1;
                draggingImage = -1;
                partDraw();
            }


            function SechandleMouseUp(e) {
                // alert("Im in handleMouseUP back");

                SecdraggingResizer = -1;
                SecdraggingImage = -1;
                SecpartDraw();
            }


            function handleMouseOut(e) {
                //  alert("Im in handleMouseOut front");

                handleMouseUp(e);
                //document.getElementById("theimage").src = canvas.toDataURL();
                // Canvas2Image.saveAsPNG(canvas);

            }

            function SechandleMouseOut(e) {
                //  alert("Im in handleMouseUP back");

                SechandleMouseUp(e);
                //document.getElementById("theimage").src = canvas.toDataURL();
                // Canvas2Image.saveAsPNG(canvas);

            }


            function handleMouseMove(e) {

                // alert("Im in handleMouseMove front");

                if (draggingResizer.objectNum > -1) {

                    mouseX = parseInt(e.clientX - offsetX);
                    mouseY = parseInt(e.clientY - offsetY);

                    // resize the image
                    switch (draggingResizer.position) {
                        case 0: //top-left
                            obj[draggingResizer.objectNum].imageX = mouseX;
                            obj[draggingResizer.objectNum].imageWidth = obj[draggingResizer.objectNum].imgRight - mouseX;
                            obj[draggingResizer.objectNum].imageY = mouseY;
                            obj[draggingResizer.objectNum].imageHeight = obj[draggingResizer.objectNum].imgBottom - mouseY;
                            break;
                        case 1: //top-right
                            obj[draggingResizer.objectNum].imageY = mouseY;
                            obj[draggingResizer.objectNum].imageWidth = mouseX - obj[draggingResizer.objectNum].imageX;
                            obj[draggingResizer.objectNum].imageHeight = obj[draggingResizer.objectNum].imgBottom - mouseY;
                            break;
                        case 2: //bottom-right
                            obj[draggingResizer.objectNum].imageWidth = mouseX - obj[draggingResizer.objectNum].imageX;
                            obj[draggingResizer.objectNum].imageHeight = mouseY - obj[draggingResizer.objectNum].imageY;
                            break;
                        case 3: //bottom-left
                            obj[draggingResizer.objectNum].imageX = mouseX;
                            obj[draggingResizer.objectNum].imageWidth = obj[draggingResizer.objectNum].imgRight - mouseX;
                            obj[draggingResizer.objectNum].imageHeight = mouseY - obj[draggingResizer.objectNum].imageY;
                            break;
                    }

                    // enforce minimum dimensions of 25x25
                    if (obj[draggingResizer.objectNum].imageWidth < 25) {
                        obj[draggingResizer.objectNum].imageWidth = 25;
                    }
                    if (obj[draggingResizer.objectNum].imageHeight < 25) {
                        obj[draggingResizer.objectNum].imageHeight = 25;
                    }

                    // set the image right and bottom
                    obj[draggingResizer.objectNum].imgRight = obj[draggingResizer.objectNum].imageX + obj[draggingResizer.objectNum].imageWidth;
                    obj[draggingResizer.objectNum].imgBottom = obj[draggingResizer.objectNum].imageY + obj[draggingResizer.objectNum].imageHeight;

                    // redraw the image with resizing anchors
                    draw(obj[draggingResizer.objectNum]);

                } else if (draggingImage > -1) {

                    imageClick = false;

                    mouseX = parseInt(e.clientX - offsetX);
                    mouseY = parseInt(e.clientY - offsetY);

                    // move the image by the amount of the latest drag
                    let dx = mouseX - startX;
                    let dy = mouseY - startY;
                    obj[draggingImage].imageX += dx;
                    obj[draggingImage].imageY += dy;
                    obj[draggingImage].imgRight += dx;
                    obj[draggingImage].imgBottom += dy;
                    // reset the startXY for next time
                    startX = mouseX;
                    startY = mouseY;

                    // redraw the image with border
                    draw(obj[draggingImage]);

                }


            }


            function SechandleMouseMove(e) {


                //     alert("Im in handleMouseMove back");

                if (SecdraggingResizer.objectNum > -1) {

                    mouseX = parseInt(e.clientX - SecoffsetX);
                    mouseY = parseInt(e.clientY - SecoffsetY);

                    // resize the image
                    switch (SecdraggingResizer.position) {
                        case 0: //top-left
                            Secobj[SecdraggingResizer.objectNum].imageX = mouseX;
                            Secobj[SecdraggingResizer.objectNum].imageWidth = Secobj[SecdraggingResizer.objectNum].imgRight - mouseX;
                            Secobj[SecdraggingResizer.objectNum].imageY = mouseY;
                            Secobj[SecdraggingResizer.objectNum].imageHeight = Secobj[SecdraggingResizer.objectNum].imgBottom - mouseY;
                            break;
                        case 1: //top-right
                            Secobj[SecdraggingResizer.objectNum].imageY = mouseY;
                            Secobj[SecdraggingResizer.objectNum].imageWidth = mouseX - Secobj[SecdraggingResizer.objectNum].imageX;
                            Secobj[SecdraggingResizer.objectNum].imageHeight = Secobj[SecdraggingResizer.objectNum].imgBottom - mouseY;
                            break;
                        case 2: //bottom-right
                            Secobj[SecdraggingResizer.objectNum].imageWidth = mouseX - Secobj[SecdraggingResizer.objectNum].imageX;
                            Secobj[SecdraggingResizer.objectNum].imageHeight = mouseY - Secobj[SecdraggingResizer.objectNum].imageY;
                            break;
                        case 3: //bottom-left
                            Secobj[SecdraggingResizer.objectNum].imageX = mouseX;
                            Secobj[SecdraggingResizer.objectNum].imageWidth = Secobj[SecdraggingResizer.objectNum].imgRight - mouseX;
                            Secobj[SecdraggingResizer.objectNum].imageHeight = mouseY - Secobj[SecdraggingResizer.objectNum].imageY;
                            break;
                    }

                    // enforce minimum dimensions of 25x25
                    if (Secobj[SecdraggingResizer.objectNum].imageWidth < 25) {
                        Secobj[SecdraggingResizer.objectNum].imageWidth = 25;
                    }
                    if (Secobj[SecdraggingResizer.objectNum].imageHeight < 25) {
                        Secobj[SecdraggingResizer.objectNum].imageHeight = 25;
                    }

                    // set the image right and bottom
                    Secobj[SecdraggingResizer.objectNum].imgRight = Secobj[SecdraggingResizer.objectNum].imageX + Secobj[SecdraggingResizer.objectNum].imageWidth;
                    Secobj[SecdraggingResizer.objectNum].imgBottom = Secobj[SecdraggingResizer.objectNum].imageY + Secobj[SecdraggingResizer.objectNum].imageHeight;

                    // redraw the image with resizing anchors
                    Secdraw(Secobj[SecdraggingResizer.objectNum]);

                } else if (SecdraggingImage > -1) {

                    imageClick = false;

                    mouseX = parseInt(e.clientX - SecoffsetX);
                    mouseY = parseInt(e.clientY - SecoffsetY);

                    // move the image by the amount of the latest drag
                    let dx = mouseX - startX;
                    let dy = mouseY - startY;
                    Secobj[SecdraggingImage].imageX += dx;
                    Secobj[SecdraggingImage].imageY += dy;
                    Secobj[SecdraggingImage].imgRight += dx;
                    Secobj[SecdraggingImage].imgBottom += dy;
                    // reset the startXY for next time
                    startX = mouseX;
                    startY = mouseY;

                    // redraw the image with border
                    Secdraw(Secobj[SecdraggingImage]);

                }


            }


            $("#canvas").mousedown(function (e) {

                handleMouseDown(e);
            });
            $("#canvas").mousemove(function (e) {

                handleMouseMove(e);
            });
            $("#canvas").mouseup(function (e) {

                handleMouseUp(e);
            });
            $("#canvas").mouseout(function (e) {

                handleMouseOut(e);
            });


            $("#SecCanvas").mousedown(function (e) {

                SechandleMouseDown(e);
            });
            $("#SecCanvas").mousemove(function (e) {

                SechandleMouseMove(e);
            });
            $("#SecCanvas").mouseup(function (e) {

                SechandleMouseUp(e);
            });
            $("#SecCanvas").mouseout(function (e) {

                SechandleMouseOut(e);
            });


            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;

                if (level == 0) {
                    newImage(fileName);
                }

                if (level == 1) {
                    SecnewImage(fileName);
                }

            });


            $('#submit').click(function () {

                Canvas2Image.saveAsPNG(canvas);
                Canvas2Image.saveAsPNG(SecCanvas);

            });

            $('#front').click(function () {

                  $('#canvas').show();
                 $('#SecCanvas').hide();
                frontLev();

            });

            $('#back').click(function () {


                 $('#canvas').hide();
                 $('#SecCanvas').show();
                backLev();

            });



          //  let txtCanvas = document.getElementById('imageText');
           // let txt=txtCanvas.getContext('2d');
           // let imageElem = document.getElementById('image');
            let count=1;

            $(document).on('click', function (e) {

               // obj[++numObj] = new image(120,70);
                if ($(e.target).closest("#text").length !== 0) {
                    obj[++numObj] = new image(120,70);
                    let id="id"+count;
                    let imgId="imageId"+count;
                    count++;
                    let element=document.getElementById('hiddenImage');
                    let tempCan=document.createElement('canvas');
                    let tempImg=document.createElement('img');
                    tempCan.setAttribute('id',id);
                    tempCan.setAttribute('height',30);

                    tempImg.setAttribute('id',imgId);
                    element.appendChild(tempCan);
                    element.appendChild(tempImg);

                    let txtCanvas = document.getElementById(id);
                    let txt=txtCanvas.getContext('2d');
                    let imageElem = document.getElementById(imgId);


                    document.getElementById('text').addEventListener('keyup', function (){
                        txt.canvas.width = txt.measureText(this.value).width;
                        txt.font="20px Arial";

                        txt.fillText(this.value,0,20);
                        //textImage= new Image();

                        imageElem.src = txt.canvas.toDataURL();
                        // textImage.src = ctx.canvas.toDataURL();


                        obj[numObj].img=new Image();
                        obj[numObj].img = imageElem;
                        obj[numObj].img.src = imageElem.src;
                        obj[numObj].img.onload = function () {
                            obj[numObj].imageX = 200;
                            obj[numObj].imageY = 250;
                            obj[numObj].imgRight = obj[numObj].imageX + obj[numObj].imageWidth;
                            obj[numObj].imgBottom = obj[numObj].imageY + obj[numObj].imageHeight;

                            partDraw();

                        };


                        //   alert(imageElem.src);
                    }, false);




                }

                if ($(e.target).closest("#text").length === 0) {

                    partDraw();
                }
            });





        });


    </script>

</head>
<body>

<div class="container">

    <div class="secondCanvas">
        <canvas id="SecCanvas" width="500 px" height="500px"></canvas>


    </div>

    <div class="firstCanvas">


        <canvas id="canvas" width="500 px" height="500px"></canvas>
    </div>



</div>


<div class="chooseFile">

    <input type="file">

</div>

<div class="submit">
    <button id="submit">Submit</button>
</div>


<div class="change">

    <button id="front">Front</button>
    <button id="back">Back</button>

</div>

<div class="textarea">
    <textarea id="text"></textarea>

</div>


<div id="hiddenImage">


</div>

<img id="image">


</body>

</html>