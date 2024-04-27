let boxes = document.querySelectorAll(".info-box");
let removeClassess = () => {
    boxes.forEach((box) => {
        box.classList.remove("active");
    });
};

boxes.forEach ((box)=>{
    box.addEventListener("click",()=>{
removeClassess();
box.classList.toggle("active");
    });
});
