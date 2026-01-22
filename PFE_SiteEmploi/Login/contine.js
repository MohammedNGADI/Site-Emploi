let profilPic = document.getElementById("profile-pic");
let inputfile = document.getElementById("PhotoP");

inputfile.onchange = function() {
    profilPic.src = URL.createObjectURL(inputfile.files[0]);
};


