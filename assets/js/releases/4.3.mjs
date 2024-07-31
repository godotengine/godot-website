// GSAP for animations.
import { gsap } from "../modules/gsap@3.12.5/index.js"
import { ScrollTrigger } from "../modules/gsap@3.12.5/ScrollTrigger.js"
import detectPlatform from "../modules/detect-browser/detect-browser.js"

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
	}
}

// Add a scrolling effect to each card and title.
const windowHeight = window.innerHeight;
/** @type {HTMLDivElement[]} */
const elements = Array.from(gsap.utils.toArray(".release-content .section .release-cards .release-card"));
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
		duration: 0.2
	});
}

// Hide downloads that aren't for the user's platform.
const platformData = detectPlatform(navigator.userAgent, navigator.userAgentData);
let platformName = "windows";
switch (platformData.os) {
	case "mac": {
		platformName = "macos";
	} break;

	case "linux": {
		platformName = "linux";
	} break;

	case "windows":
	default:
		break;
}
const cardDownloadPlatformsElement = document.querySelector(".card-download-platforms");
if (cardDownloadPlatformsElement != null) {
	for (const child of Array.from(cardDownloadPlatformsElement.childNodes)) {
		if (child instanceof HTMLElement) {
			if (child.classList.contains(`platform-${platformName}`)) {
				child.style.display = "flex";
			}
		}
	}
}

// Add relative weight based on author data
const authors = Array.from(document.querySelectorAll("#special-thanks-release-authors .release-card-authors .release-card-author"));
let max_prs = 0;
for (const author of authors) {
	max_prs = Math.max(max_prs, Number(author.dataset.prs));
}
const scales = new Array(5);
scales[4] = Math.floor(max_prs / 2);
scales[3] = Math.floor(scales[4] / 2);
scales[2] = Math.floor(scales[3] / 2);
scales[1] = Math.floor(scales[2] / 2);
scales[0] = Math.floor(scales[1] / 2);

for (const author of authors) {
	const prs = Number(author.dataset.prs);
	for (let i = 0; i < scales.length; i++) {
		if (prs >= scales[i]) {
			continue;
		}
		if (i === 0) {
			break;
		}
		author.classList.add(`size-${i + 1}`);
		break;
	}
}
