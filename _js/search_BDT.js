function addtolike(vocab) {
    document.getElementsByClassName(vocab + " hidding")[0].classList.remove("hidding");
    document.getElementsByClassName(vocab + " heart")[0].classList.add("hidding");
}

function cancellike(vocab) {
    document.getElementsByClassName(vocab + " hidding")[0].classList.remove("hidding");
    document.getElementsByClassName(vocab + " heart_like")[0].classList.add("hidding");
}