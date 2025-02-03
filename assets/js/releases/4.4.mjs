// GSAP for animations.
import { gsap } from "../modules/gsap@3.12.5.min.mjs"
import { ScrollTrigger } from "../modules/gsap@3.12.5_ScrollTrigger.min.mjs"
import detectPlatform from "../modules/detect-browser.mjs"

gsap.registerPlugin(ScrollTrigger);

// Release numbers.
const RELEASE_NUMBERS_INITIAL_DELAY_S = 1;
const RELEASE_NUMBERS_DURATION_S = 1;
const RELEASE_NUMBERS_EASE_NAME = "power2.out";
const RELEASE_NUMBERS_MAX_BAR_WIDTH_PX = 200;

const releaseNumbersEase = gsap.parseEase(RELEASE_NUMBERS_EASE_NAME);
const numberFormat = new Intl.NumberFormat("en-US");

for (const el of ["commits", "contributors"]) {
	const timeline = gsap.timeline();
	const lines = gsap.utils.toArray(`.release-header .header-numbers-${el} .header-numbers-line`).reverse();
	for (let i = 0; i < lines.length; i++) {
		const line = lines[i];
		const localTimeline = gsap.timeline();
		localTimeline.to(line.querySelector(".bar"), {
			delay: i == 0
				? RELEASE_NUMBERS_INITIAL_DELAY_S
				: 0,
			duration: RELEASE_NUMBERS_DURATION_S,
			ease: RELEASE_NUMBERS_EASE_NAME,
			width: `${(Number(line.dataset.value) / Number(line.dataset.max)) * RELEASE_NUMBERS_MAX_BAR_WIDTH_PX}px`,
			onUpdate: () => {
				line.querySelector(".number").innerText = numberFormat.format(
					Math.round(releaseNumbersEase(localTimeline.progress()) * Number(line.dataset.value))
				);
			},
			onComplete: () => {
				line.querySelector(".number").innerText = numberFormat.format(Number(line.dataset.value));
			}
		});
		timeline.add(localTimeline);

		// Set commits to 0
		line.querySelector(".number").innerText = "0";
	}
}

// Add a scrolling effect to each card and title.
const windowHeight = window.innerHeight;
/** @type {HTMLDivElement[]} */
const elements = Array.from(gsap.utils.toArray(".release-content .section .release-cards .release-card, .release-content .section .section-title"));
for (const element of elements) {
	if (element.getBoundingClientRect().top < windowHeight) {
		continue;
	}

	const timeline = gsap.timeline({
		scrollTrigger: {
			trigger: element,
			start: "top bottom",
		}
	});
	timeline.from(element, {
		y: "+=50",
		duration: 0.5,
		opacity: 0
	});
}

// Hide downloads that aren't for the user's platform.
const platformData = detectPlatform(navigator.userAgent, navigator.userAgentData);
let platformName = "windows";
switch (platformData.os) {
	case "mac":
	case "iphone":
	case "ipad": {
		platformName = "macos";
	} break;

	case "linux": {
		platformName = "linux";
	} break;

	case "android": {
		platformName = "android";
	} break;

	case "windows":
	default:
		break;
}
const releasePlatformContainer = document.querySelector(".release-platform-container");
if (releasePlatformContainer != null) {
	const releasePlatform = releasePlatformContainer.querySelector(`.release-platform-${platformName}`);
	if (releasePlatform != null) {
		releasePlatform.classList.add("active");
	}
}

// Rename "Export templates and other downloads" to "More downloads"
const downloadOther = document.querySelector(".card-download-other");
if (downloadOther != null) {
	downloadOther.textContent = "More downloads";
}

// Add relative weight based on author data
const authors = Array.from(document.querySelectorAll("#special-thanks-release-authors .release-card-authors .release-card-author"));
let max_prs = 0;
for (const author of authors) {
	max_prs = Math.max(max_prs, Number(author.dataset.prs));
}
const scales = new Array(5);
for (let i = scales.length - 1; i >= 0; i--) {
	if (i + 1 == scales.length) {
		scales[i] = Math.floor(max_prs / 2);
	} else {
		scales[i] = Math.floor(scales[i + 1] / 2);
	}
}

for (const author of authors) {
	const prs = Number(author.dataset.prs);
	for (let i = 0; i < scales.length; i++) {
		if (prs >= scales[i]) {
			if (i + 1 == scales.length) {
				author.classList.add(`size-${i + 1}`);
				break;
			}
			continue;
		}
		if (i === 0) {
			break;
		}
		author.classList.add(`size-${i + 1}`);
		break;
	}
}

// Links and contributors.
const cLinks = Array.from(document.querySelectorAll(".c-link"));
for (const cLink of cLinks) {
	if (cLink.dataset.readMore != null) {
		// Clear cLink of no-script content.
		while (cLink.lastChild != null) {
			cLink.lastChild.remove();
		}
		const cLinkA = cLink.appendChild(document.createElement("a"));
		cLinkA.href = cLink.dataset.readMore;
		cLinkA.classList.add("c-link-a");
		cLinkA.textContent = "Read more";
		cLinkA.target = "_blank";
	}

	if (cLink.dataset.contributors != null) {
		let parentId = "";
		let parent = cLink.parentElement;
		while (parent != document.body) {
			if (parent.classList.contains("release-card")) {
				parentId = parent.id;
				break;
			}
			parent = parent.parentElement;
		}
		const contributorsId = `${parentId}-contributors`;

		/** @typedef {{ name: string, github: string }} Contributor */
		/**
		 * @param {string} previousValue
		 * @param {string} currentValue
		 * @param {number} currentIndex
		 * @param {Contributor[]} array
		 */
		const contributorsReducer = (previousValue, currentValue, currentIndex, array) => {
			if (currentIndex === 0) {
				return `${previousValue} ${currentValue}`;
			} else if (currentIndex < array.length - 1) {
				return `${previousValue}, ${currentValue}`;
			} else if (currentIndex === 1 && array.length === 2) {
				return `${previousValue} and ${currentValue}`;
			}
			return `${previousValue}, and ${currentValue}`;
		};

		/** @type {Contributor[]} */
		let contributors = [];
		try {
			contributors = JSON.parse(cLink.dataset.contributors);
		} catch (err) {
			const newErr = new Error(`Could not parse c-link contributors JSON. ${cLink.dataset.contributors}`);
			newErr.cause = err;
			throw newErr;
		}
		/**
		 * @param {Contributor} contributor
		 * @returns {string}
		 */
		const getContributorDisplayName = (contributor) => {
			if (contributor.name === contributor.github) {
				return contributor.github;
			}
			return `${contributor.name} (${contributor.github})`;
		};
		const contributorsToString = contributors.map(getContributorDisplayName);
		const contributorsText = contributorsToString.reduce(contributorsReducer, "Contributed by");
		const contributorsHtml = contributors.map((contributor) => {
			const link = document.createElement("a");
			link.href = `https://github.com/${contributor.github}`;
			link.target = "_blank";
			link.textContent = getContributorDisplayName(contributor);
			return link.outerHTML;
		}).reduce(contributorsReducer, "Contributed by");

		const button = cLink.appendChild(document.createElement("button"));
		button.classList.add("c-link-popover-button");
		const span = button.appendChild(document.createElement("span"));
		if (contributors.length === 1) {
			span.textContent = "person";
		} else if (contributors.length === 2) {
			span.textContent = "group";
		} else {
			span.textContent = "groups";
		}
		span.classList.add("material-symbols-outlined");
		span.style.transform = "translateY(5px)";
		button.title = contributorsText;
		button.setAttribute("popovertarget", contributorsId);

		const popover = cLink.appendChild(document.createElement("div"));
		popover.classList.add("c-link-popover");
		popover.id = contributorsId;
		popover.setAttribute("popover", "");
		popover.innerHTML = contributorsHtml;
	}
}

// Popovers.
let popoverAnimationFrame = 0;

/** @type {(invoker: HTMLElement, popover: HTMLElement) => { x: number, y: number }} */
function computePosition(invoker, popover) {
	const invokerRect = invoker.getBoundingClientRect();
	const popoverRect = popover.getBoundingClientRect();
	const windowSize = {
		width: window.innerWidth,
		height: window.innerHeight
	};
	const padding = 10;
	const popoverPosition = {
		x: invokerRect.x - (popoverRect.width / 2),
		y: invokerRect.y - popoverRect.height - padding,
	};

	popoverPosition.x = Math.min(Math.max(popoverPosition.x, 0), windowSize.width - popoverRect.width);
	if (popoverPosition.y < 0) {
		popoverPosition.y = invokerRect.y + invokerRect.height + padding;
	}

	return popoverPosition;
}

/** @type {(event: ToggleEvent) => void} */
function positionPopover(event) {
	if (event.newState !== "open") {
		cancelAnimationFrame(popoverAnimationFrame);
		popoverAnimationFrame = 0;
		return;
	}
	const popover = event.target;
	const invoker = document.querySelector(`[popovertarget="${popover.getAttribute("id")}"`);
	const { x, y } = computePosition(invoker, popover);
	Object.assign(popover.style, {
		left: `${x}px`,
		top: `${y}px`,
	});

	if (popoverAnimationFrame > 0) {
		cancelAnimationFrame(popoverAnimationFrame);
	}

	const updatePopover = () => {
		const { x, y } = computePosition(invoker, popover);
		Object.assign(popover.style, {
			left: `${x}px`,
			top: `${y}px`,
		});
		popoverAnimationFrame = requestAnimationFrame(updatePopover);
	};
	popoverAnimationFrame = requestAnimationFrame(updatePopover);
}

const popovers = document.querySelectorAll("[popover]");
for (const popover of popovers) {
	popover.addEventListener("toggle", positionPopover);
}

// Lazy-load videos
const lazyVideos = Array.from(document.querySelectorAll("video.lazy"));
const lazyVideoObserver = new IntersectionObserver((entries, observer) => {
	for (const entry of entries) {
		if (!entry.isIntersecting) {
			continue;
		}

		for (var entryChildElement of entry.target.children) {
			if (typeof entryChildElement.tagName === "string" && entryChildElement.tagName === "SOURCE") {
				entryChildElement.src = entryChildElement.dataset.src;
			}
		}

		entry.target.load();
		entry.target.classList.remove("lazy");
		observer.unobserve(entry.target);
	}
});
for (const lazyVideo of lazyVideos) {
	lazyVideoObserver.observe(lazyVideo);
}

// Show/hide the scroll-to-top button
const linksElement = document.querySelector("#links");
const scrollToTopElement = document.querySelector("#scroll-to-top");
let scrollToTopTween = null;
let scrollState = "";
const showScrollToTop = () => {
	if (scrollState === "show") {
		return;
	}
	scrollState = "show";
	if (scrollToTopTween != null) {
		scrollToTopTween.kill();
	}
	scrollToTopElement.style.display = "block";
	scrollToTopTween = gsap.to(scrollToTopElement, {
		opacity: 1,
		duration: 0.5,
	});
};
const hideScrollToTop = () => {
	if (scrollState === "hide") {
		return;
	}
	scrollState = "hide";
	if (scrollToTopTween != null) {
		scrollToTopTween.kill();
	}
	scrollToTopTween = gsap.to(scrollToTopElement, {
		opacity: 0,
		duration: 0.5,
		onComplete: () => {
			scrollToTopElement.style.display = "none";
		}
	});
};
const scrollToTopObserver = new IntersectionObserver((entries, observer) => {
	// requestAnimationFrame(animationFrameHandler);
	const entry = entries[0];
	if (entry.isIntersecting) {
		hideScrollToTop();
	} else {
		const rect = linksElement.getBoundingClientRect();
		if (rect.y > window.innerHeight) {
			hideScrollToTop();
		} else {
			showScrollToTop();
		}
	}
});
scrollToTopObserver.observe(linksElement);
