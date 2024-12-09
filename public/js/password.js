// const passwordField = document.getElementById('password1');
// const toggleCheckbox = document.getElementById('toggleCheckbox');

// toggleCheckbox.addEventListener('change', function() {
//     if(toggleCheckbox.checked) {
//         passwordField.type = 'text';
//     }else {
//         passwordField.type = 'password';
//     }
// });

// let eye = document.getElementsByClassName("toggle-eye");

// for(let i = 0; i < eye.length; i++){
// eye[i].addEventListener("click",() => { 
//         if (eye[i].previousElementSibling.getAttribute('type') == 'password') {
//                 eye[i].previousElementSibling.setAttribute('type', 'text');
//                 eye[i].classList.toggle('fa-eye');
//                 eye[i].classList.toggle('fa-eye-slash');
//         } else {
//                 eye[i].previousElementSibling.setAttribute('type', 'password');
//                 eye[i].classList.toggle('fa-eye');
//                 eye[i].classList.toggle('fa-eye-slash');
//         }
// });
// }

// eyeIconのclickイベント
// $("#eye1").on("click", () => {
//     // eyeIconのclass切り替え
//     $("#eye1").toggleClass("fa-eye-slash fa-eye");

//     // inputのtype切り替え
//     if($("#password1").attr("type") == "password") {
//         $("#password1").attr("type","text");
//     } else {
//         $("#password1").attr("type","password");
//     }
// });

let passwordField = document.getElementById('password');
let toggleIcon = document.getElementById('eye1');

let passwordField2 = document.getElementById('password2');
let toggleIcon2 = document.getElementById('eye2');

let passwordField3 = document.getElementById('password3');
let toggleIcon3 = document.getElementById('eye3');

toggleIcon.addEventListener('click', function(){
    switchPasswordVisibility(passwordField,toggleIcon)
});
toggleIcon2.addEventListener('click', function(){
    switchPasswordVisibility(passwordField2,toggleIcon2)
});
toggleIcon3.addEventListener('click', function(){
    switchPasswordVisibility(passwordField3,toggleIcon3)
});

function switchPasswordVisibility(passwordField,toggleIcon){
        if(passwordField.type == 'password'){
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }else{
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
}