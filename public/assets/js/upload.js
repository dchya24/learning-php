const input_file = document.querySelector("#file");
const image_div = document.querySelector(".img");
const image_view = document.querySelector("#img");
const size = document.querySelector("#text_size");
const name_input = document.querySelector("#name")

let file_type = {
    "application/postscript" : "adobe", // ilustrator
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document" : "word", // word
    "application/vnd.openxmlformats-officedocument.presentationml.presentation" :  "presentation" , // presention
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" : "sheet", // excel
    "application/zip" : "zip", // zip
    "image/jpeg" : "foto", // jpg image
    "image/png" : "foto", // png image
    "video/mp4" : "video",
    "video/x-matroska" : "video", // mkv
    "application/octet-stream" : "subtitle", // srt (subtitle film)
    "application/pdf" : "pdf"
} 

input_file.addEventListener("change", (e) => {
    console.log(e.target.files[0]);
    console.log(e.target.files[0].type);
    image_div.style.display = "block";
    size.innerText = `size: ${e.target.files[0].size} byte`
    name_input.value = e.target.files[0].name

    var key = e.target.files[0].type; 
    if(key in file_type){
        if(file_type[key] != "foto"){
            image_view.src = `${window.BASE_URL}image/${file_type[key]}.svg`
        }else{
            image_view.src = URL.createObjectURL(e.target.files[0])
        }
    }

})