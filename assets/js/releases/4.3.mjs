// GSAP for animations.
import { gsap } from "../modules/gsap@3.12.5/index.js"
import { ScrollTrigger } from "../modules/gsap@3.12.5/ScrollTrigger.js"

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
		duration: 0.2
	});
}
