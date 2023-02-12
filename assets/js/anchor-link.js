var headings = document.querySelectorAll("h2, h3, h4, h5");

// Loop through each heading
for (var i = 0; i < headings.length; i++) {
    var heading = headings[i];
    var parent = heading.parentElement;

    // Check if the heading and its parent chain do not have an anchor link
    while (parent) {
        if (parent.tagName === "A") {
            break;
        }
        parent = parent.parentElement;
    }
    if (!parent && heading.tagName !=="A") {
        // Creating an id for the heading based on its content
        var headingId = heading.textContent.toLowerCase().replace(/ /g, "-");
        heading.id = headingId;

        // Creating a new anchor link
        var anchor = document.createElement("a");
        anchor.setAttribute("href", "#" + headingId);
        anchor.setAttribute("class", "anchor-link");
        anchor.setAttribute("title", "This is the anchor link to this heading");
        anchor.innerHTML = "🔗";

        // Adding the anchor link to the heading
        heading.insertAdjacentElement("beforeend", anchor);
    }
}

// Add styles for the anchor links
var style = document.createElement("style");
style.innerHTML = `
    .anchor-link {
    display: none;
    font-size: 16px;
    line-height: .8;
    vertical-align: top;
    }

    h2:hover .anchor-link,
    h3:hover .anchor-link,
    h4:hover .anchor-link,
    h5:hover .anchor-link {
    display: inline;
    }
`;

document.head.appendChild(style);