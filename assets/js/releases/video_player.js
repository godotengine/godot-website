// Page video player script
// Fetch all video elements inside media-block elements
// Add a play/pause toggle
// Pause video when outside view
(()=>{
    let mediaBlocks = document.querySelectorAll(".media-block");

    const options = {
        rootMargin: "0px",
        scrollMargin: "0px",
        threshold: 0.0,
    };

    const observerCallback = function(entries, observer){
        entries.forEach((entry)=>{
            let player = entry.target;
            if(!entry.isIntersecting && !player.paused) player.pause();
            if(entry.isIntersecting && player.paused) player.play(); 
        });
    };

    const observer = new IntersectionObserver(observerCallback, options);

    mediaBlocks.forEach((mediaBlock) => {
        // Check if mediablock contains a video element
        let player = mediaBlock.querySelector("video");
        if(player == null) return;

        observer.observe(player);

        let playIcon = mediaBlock.querySelector("[name='play']");
        let pauseIcon = mediaBlock.querySelector("[name='pause']");

        player.addEventListener("click", function(e){
            if(player.paused){
                player.play();
            }else{
                player.pause();
            }
        });

        player.addEventListener("play", function(e){
            playIcon.classList.add("hidden");
            pauseIcon.classList.remove("hidden");
        });

        player.addEventListener("pause", function(e){
            playIcon.classList.remove("hidden");
            pauseIcon.classList.add("hidden");
        });

    });
})();