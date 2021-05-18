//Variables
var canvas = document.createElement("canvas");
var maindiv = document.getElementById("maindiv");
var context = canvas.getContext("2d");
var backgroundColor = "white";
var currentDrawing = false;
var lineW = 5;
var lineC = "#000000";
var width = 800;
var height = 800;

//Insertion Canvas

newCanvas();

function newCanvas(){
    canvas.style.border = "2px solid";
    canvas.width = width;
    canvas.height = height;
    canvas.style.background = "white";
    //context.fillStyle = backgroundColor;
    //context.fillRect(0,0,canvas.width,canvas.height);
    maindiv.appendChild(canvas);
}


//Listeners

canvas.addEventListener("mousedown", function () { down(event); });
canvas.addEventListener("mousemove", function () { move(event); });
canvas.addEventListener("mouseup", function () { up(); });
document.getElementById("size").addEventListener("click", function () { 
    width = document.getElementById("width").value;
    height = document.getElementById("height").value;
    newCanvas();
})

document.getElementById("lineW").addEventListener("change", function () { 
    lineC = document.getElementById("colorpickerC").value;
    context.strokeStyle = lineC;
    lineW = document.getElementById("lineW").value;
})

document.getElementById("backgroundColor").addEventListener("click", function () { 
    backgroundColor = document.getElementById("colorpicker").value;
    //context.fillStyle = backgroundColor;
    //context.fillRect(0,0,canvas.width,canvas.height);
    canvas.style.background = backgroundColor;
})
document.getElementById("eraseAll").addEventListener("click", function () { 
    //backgroundColor = "white";
    //context.fillStyle = backgroundColor;
    //context.fillRect(0,0,canvas.width,canvas.height);
    newCanvas();
})
document.getElementById("penColor").addEventListener("click", function () { 
    lineC = document.getElementById("colorpickerC").value;
    context.strokeStyle = lineC;
    lineW = document.getElementById("lineW").value;
})
document.getElementById("eraser").addEventListener("click", function () { 
    lineC = backgroundColor;
    context.strokeStyle = lineC;
    lineW = 50;
})
document.getElementById("pen").addEventListener("click", function () { 
    lineC = document.getElementById("colorpickerC").value;
    context.strokeStyle = lineC;
    lineW = document.getElementById("lineW").value;
})
//Position de la souris sur le canvas

function getPos(event) {
    var contour = canvas.getBoundingClientRect();
    return {
        canvasx: event.clientX - contour.left,
        canvasy: event.clientY - contour.top
    };
}

//Dessin

function down(event){
    currentDrawing = true;
    var pos = getPos(event);
    context.moveTo(pos.canvasx, pos.canvasy)
    context.beginPath();
    context.lineWidth  = lineW;
    context.lineCap = "round";
    context.strokeStyle = lineC;
}

function move(event){
    if(currentDrawing){
        var pos = getPos(event);
        context.lineTo(pos.canvasx, pos.canvasy)
        context.stroke();
    }
}

function up(){
    currentDrawing = false;
}

