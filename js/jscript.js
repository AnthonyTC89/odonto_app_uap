var toothPress = "";
var surfacePress = "";

document.getElementById("btn_teeth").addEventListener("click", BtnTeeth_Clicked);

for (let tooth of document.getElementsByClassName("tooth")) {
    tooth.addEventListener("click", BtnTooth_Clicked);
}

for (let surface of document.getElementsByClassName("tooth-surface")) {
    surface.addEventListener("click", BtnSurface_Clicked);
}

function BtnTeeth_Clicked (){
    toothPress = "";
    surfacePress = "";
    ShowImageTooth();
}

function BtnTooth_Clicked (event){
    toothPress = event.srcElement.value;
    surfacePress = "vestibular";
    document.getElementById("interior").value = toothPress <= 28 ? "Palatino" : "Lingual";
    ShowImageTooth();
}

function BtnSurface_Clicked (event){
    if (toothPress != ""){
        surfacePress = event.srcElement.value;
        ShowImageTooth();
    }
}

function ShowImageTooth() {
    if (toothPress == "" || surfacePress == ""){
        document.getElementById("img_main").src = "images/dentadura_completa.jpg";
        document.getElementById("img_main").alt = "dentadura_completa";
    }
    else{
        document.getElementById("img_main").src = "images/"+ toothPress + "/" + surfacePress  + ".jpg";
        document.getElementById("img_main").alt = toothPress + "_" + surfacePress;
    }
}


