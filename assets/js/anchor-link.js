window.applyAnchorLinks = (baseSelector) => {
    const baseNode = document.querySelector(baseSelector);
    if (typeof baseNode === "undefined") {
        return;
    }

    const headings = baseNode.querySelectorAll("h2, h3, h4, h5");
    for (let i = 0; i < headings.length; i++) {
        const headingNode = headings[i];
        if (headingNode.classList.contains("anchored")) {
            continue; // Already handled.
        }
        headingNode.classList.add("anchored");

        // Create a new anchor link.
        var anchorNode = document.createElement("a");
        anchorNode.setAttribute("href", "#" + headingNode.id);
        anchorNode.setAttribute("title", "Click to copy a link to this section.");
        anchorNode.classList.add("anchored-link");

        // Add the anchor link to the heading.
        headingNode.insertAdjacentElement("beforeend", anchorNode);

        // Add click event listener to anchor link to copy link to clipboard.
        anchorNode.addEventListener("click", (event) => {
            event.preventDefault();
            // Imitate default behavior that we just cancelled.
            history.pushState(null, null, event.target.getAttribute("href"));

            const anchorLink = window.location.href.split("#")[0] + event.target.getAttribute("href");
            navigator.clipboard
                .writeText(anchorLink)
                .then(() => {
                    // Create a new toast element and add it to the DOM.
                    const toast = document.createElement("div");
                    toast.classList.add("anchored-toast");
                    toast.textContent = "Section link copied to the clipboard";
                    document.body.appendChild(toast);
        
                    // Remove the toast element after 2 seconds.
                    setTimeout(() => {
                        toast.remove();
                    }, 2000);
                })
                .catch(() => {
                    console.error("Failed to copy an anchor link to the clipboard.");
                });
        });
    }
};
