var headings = document.querySelectorAll("h2, h3, h4, h5");

// Loop through each heading
for (var i = 0; i < headings.length; i++) {
    var heading = headings[i];

    // Creating a new anchor link
    var anchor = document.createElement("a");
    anchor.setAttribute("href", "#" + heading.id);
    anchor.setAttribute("class", "anchor-link");
    anchor.setAttribute("title", "Click to copy link to this section");
    anchor.innerHTML = "🔗";

    // Adding the anchor link to the heading
    heading.insertAdjacentElement("beforeend", anchor);
        
    // Add click event listener to anchor link to copy link to clipboard
    anchor.addEventListener("click", function(event) {
        event.preventDefault();
        var anchorLink = window.location.href.split("#")[0] + event.target.getAttribute("href");
        history.pushState(null, null, event.target.getAttribute("href"));
        navigator.clipboard.writeText(anchorLink).then(function() {
            // Create a new toast element and add it to the DOM
            var toast = document.createElement("div");
            toast.setAttribute("class", "toast");
            toast.innerHTML = "Anchor link copied to clipboard";
            document.body.appendChild(toast);
 
            // Remove the toast element after 3 seconds
            setTimeout(function() {
                toast.remove();
            }, 2000);
        }, function() {
            console.log("Copy failed");
        });
    });
}

var style = document.createElement("style");
style.innerHTML = `
    .anchor-link {
        display: none;
        font-size: 16px;
        vertical-align: middle;
        text-decoration: none;
        margin-left: 10px;
    }

    h2:hover .anchor-link,
    h3:hover .anchor-link,
    h4:hover .anchor-link,
    h5:hover .anchor-link {
        display: inline;
    }

    .toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        padding: 16px;
        background-color: #444444;
        color: #FFF;
        font-size: 12px;
        border-radius: 24px;
        transform: translateX(-50%);
    }
`;

document.head.appendChild(style);