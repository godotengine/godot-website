(()=>{

    function clamp(number, min, max) {
        return Math.max(min, Math.min(number, max));
    }


    let compareBlocks = document.querySelectorAll(".media-compare");

    compareBlocks.forEach((compareBlock) => {
        let slider = compareBlock.querySelector(".slider");
        let beforeBlock = compareBlock.querySelector(".before");

        let onMouseEvent = function(e){
            let mousePressed = e.buttons == 1;
            if (!mousePressed) return;

            e.stopPropagation();
            e.preventDefault();

            let percent = clamp(e.layerX / compareBlock.clientWidth, 0.0, 1.0) * 100.0;

            if(percent < 10) {
                percent = 0;
                compareBlock.classList.add("transition");
            }else if(percent > 90) {
                percent = 100;
                compareBlock.classList.add("transition");
            }else{
                if(compareBlock.classList.contains("transition")){
                    compareBlock.classList.remove("transition");
                }
            };

            slider.style.left = `${percent}%`;
            beforeBlock.style.clipPath = `inset(0 ${100.0 - percent}% 0 0)`;
        }

        compareBlock.addEventListener("pointerdown", onMouseEvent);
        compareBlock.addEventListener("pointermove", onMouseEvent);




    });
})();