const confirm_passwrod = document.querySelector("#confirm_password");
const passwrod = document.querySelector("#password");
const btn_submit = document.querySelector("#submit")

confirm_passwrod.addEventListener("keyup", (e) => {
    if(passwrod.value == confirm_passwrod.value) {
       btn_submit.disabled = false;
    } else {
       btn_submit.disabled = true 
    }
})