function gotoreg() {
    document.getElementsByClassName("registerframe")[0].style.display = "block";
    document.getElementsByClassName("loginframe")[0].style.display = "none";
    // console.log(document.getElementsByClassName("registerframe")[0].style.display);
}

function gotolog() {
    document.getElementsByClassName("loginframe")[0].style.display = "block";
    document.getElementsByClassName("registerframe")[0].style.display = "none";

}

function checkInput(evt) {
    switch (evt.keyCode) {
        case 126:
        case 33:
        case 35:
        case 36:
        case 37:
        case 94:
        case 38:
        case 42:
        case 40:
        case 41:
        case 95:
        case 43:
        case 61:
        case 123:
        case 125:
        case 91:
        case 93:
        case 92:
        case 124:
        case 58:
        case 59:
        case 60:
        case 62:
        case 44:
        case 63:
        case 47:
            evt.preventDefault();
            break;
    };
}

function checkname(nn) {
    if (nn.keyCode > 122 || nn.keyCode < 65) {
        if (nn.keyCode > 90 || nn.keyCode < 97) {
            nn.preventDefault();
        }
    }
}

