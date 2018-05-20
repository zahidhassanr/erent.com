<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.22/fabric.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script src="https://superal.github.io/canvas2image/canvas2image.js"></script>

    <link type="text/css" rel="stylesheet" href="{{asset('css/draw2.css')}}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <title>Draw</title>


    <script>
    $(function() {


        let frontTshirt;
        let backTshirt;
        let checkFront=true;
        let checkBack=false;
        let obj= [];
        let count=-1;
        let canvas = new fabric.Canvas('firstCanvas');




        canvas.setBackgroundImage('images//back.jpg', canvas.renderAll.bind(canvas));
        backTshirt=canvas.toJSON();

        canvas.clear();
        canvas.setBackgroundImage('images//front.jpg', canvas.renderAll.bind(canvas));
        frontTshirt=canvas.toJSON();




        function front() {
            if(checkFront == true) return;
            checkFront=true;
            checkBack=false;
            backTshirt=canvas.toJSON();
            canvas.clear();
            canvas.setBackgroundImage('images//front.jpg', canvas.renderAll.bind(canvas));
            canvas.loadFromJSON(frontTshirt);
            $(".deleteBtn").remove();

        }

        function back() {

            if(checkBack == true) return;

            checkBack=true;
            checkFront=false;
            frontTshirt=canvas.toJSON();
            canvas.clear();
            canvas.setBackgroundImage('images//back.jpg', canvas.renderAll.bind(canvas));
            canvas.loadFromJSON(backTshirt);
            $(".deleteBtn").remove();

        }




        $(document).on('click', function (e) {

            // obj[++numObj] = new image(120,70);
            if ($(e.target).closest("#input").length !== 0) {

                count++;
                let id="id"+count;

                let textOptions = {
                    id:id,
                    fontSize: 40,
                    left: 200,
                    top: 200,
                    radius: 10,
                    borderRadius: '25px',
                    hasRotatingPoint: true
                };

                obj[count]= new fabric.IText('Text', textOptions);


               // obj[count]=textObject;

                canvas.add(obj[count]);
                canvas.renderAll();

                document.getElementById('input').addEventListener('keyup', function () {
                    obj[count].text = document.getElementById('input').value;
                    canvas.renderAll();
                });

            }

        });



        canvas.on('mouse:down', function(options) {
            if (options.target) {

            }
        });




        let HideControls = {
            'tl':true,
            'tr':false,
            'bl':true,
            'br':true,
            'ml':true,
            'mt':true,
            'mr':true,
            'mb':true,
            'mtr':true
        };


        canvas.renderAll();

        function addDeleteBtn(x, y){
            $(".deleteBtn").remove();
            let btnLeft = x-10;
            let btnTop = y-10;
            let deleteBtn = '<i class="fa fa-close deleteBtn" style="position:absolute;top:'+btnTop+'px;left:'+btnLeft+'px;cursor:pointer;font-size:30px;color:red;"></i>';
            $(".canvas-container").append(deleteBtn);
        }

        canvas.on('object:selected',function(e){
            addDeleteBtn(e.target.oCoords.tr.x, e.target.oCoords.tr.y);
        });

        canvas.on('mouse:down',function(e){
            if(!canvas.getActiveObject())
            {
                $(".deleteBtn").remove();
            }
        });

        canvas.on('object:modified',function(e){
            addDeleteBtn(e.target.oCoords.tr.x, e.target.oCoords.tr.y);
        });

        canvas.on('object:scaling',function(e){
            $(".deleteBtn").remove();
        });
        canvas.on('object:moving',function(e){
            $(".deleteBtn").remove();
        });
        canvas.on('object:rotating',function(e){
            $(".deleteBtn").remove();
        });
        $(document).on('click',".deleteBtn",function(){
            if(canvas.getActiveObject())
            {
                canvas.remove(canvas.getActiveObject());
                $(".deleteBtn").remove();
            }
        });



        $('input[type="file"]').change(function (e) {
            let fileName = e.target.files[0].name;

            let imageName="images//"+fileName;

            fabric.Image.fromURL(imageName, function(oImg) {
                oImg.scale(0.4);
                canvas.add(oImg);
            });

        });


        $('#submit').click(function () {

            Canvas2Image.saveAsPNG(firstCanvas);


        });

        $('#front').click(function () {

            front();


        });


        $('#back').click(function () {

            back();


        });




    });

    </script>

</head>


<body>


<div class="Canvas">

    <canvas  id="firstCanvas" height="500" width="550"  ></canvas>


</div>



<div class="WriteText">

    <input class="text" data-text="" value="" id="input" />
</div>


<div class="chooseFile">

<input type="file">

</div>

<div class="submit">
    <button id="submit">Submit</button>
</div>

<div class="submitx">
    <button id="front">Front</button>
    <button id="back">Back</button>

</div>



</body>
</html>