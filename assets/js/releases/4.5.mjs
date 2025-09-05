import {
	animate,
	createTimeline,
	onScroll,
	eases,
	text,
	stagger,
} from "../modules/anime@4.1.2_esm.js";
import detectPlatform from "../modules/detect-browser.mjs";
import "../modules/dashjs@5.0.3.esm.min.js";

const { outCirc, inCirc } = eases;

// Reduced motion.
const prefersReducedMotion = window.matchMedia(
	"prefers-reduced-motion: reduce",
).matches;
const saveData = navigator?.connection?.saveData ?? false;

// Parallax scrolling.
const releaseHeaderBackground = document.querySelector(
	".release-header-background",
);
const scrollObserver = onScroll({
	target: ".release-header",
	enter: "top 0%-=64px",
	leave: "top 100%",
	onUpdate: () => {
		const progress = scrollObserver.progress;
		releaseHeaderBackground.style.transform = `
			translateY(${progress * releaseHeaderBackground.getBoundingClientRect().height}px)
			translateZ(-1px)
			scale(2)
		`;
		releaseHeaderBackground.style.filter = `blur(${inCirc(progress) * 5}px)`;
	},
});
const releaseHeaderBackgroundTween = animate(releaseHeaderBackground, {
	autoplay: scrollObserver,
	ease: outCirc,
});

// Add a scrolling effect to each card and title.
const windowHeight = window.innerHeight;
/**
 * @typedef {{
 *   element: HTMLElement,
 *   container: HTMLDivElement,
 *   isLastOfType: boolean
 * }} AnimatedElement
 */
/** @type {AnimatedElement[]} */
const elements = [];
/** @type {HTMLDivElement[]} */
const releaseCardContainers = Array.from(
	document.querySelectorAll(".release-cards"),
);
for (const releaseCardContainer of releaseCardContainers) {
	/** @type {HTMLDivElement[]} */
	const releaseCards = Array.from(
		releaseCardContainer.querySelectorAll(".release-card"),
	);
	/** @type {HTMLDivElement | null} */
	const lastReleaseCard = releaseCardContainer.querySelector(
		".release-card:last-of-type",
	);
	for (const releaseCard of releaseCards) {
		elements.push({
			element: releaseCard,
			container: releaseCardContainer,
			isLastOfType: releaseCard === lastReleaseCard,
		});
	}

	// releaseCardContainer.classList.add("overflow-y-hidden");
}
const sectionContainers = Array.from(
	document.querySelectorAll(".section:has(.section-title)"),
);
for (const sectionContainer of sectionContainers) {
	elements.push({
		element: sectionContainer.querySelector(
			".section-title h3, .section-title h4",
		),
		container: sectionContainer.querySelector(".section-title"),
		isLastOfType: true,
	});

	const sectionLinks = sectionContainer.querySelector(".section-links");
	if (sectionLinks == null) {
		continue;
	}

	elements.push({
		element: sectionLinks,
		container: sectionContainer.querySelector(".section-title"),
		isLastOfType: true,
	});

	// sectionContainer.classList.add("overflow-y-hidden");
}
elements.sort((a, b) => {
	const aRect = a.element.getBoundingClientRect();
	const bRect = b.element.getBoundingClientRect();
	return aRect.top - bRect.top;
});
for (const element of elements) {
	if (element.element == null) {
		debugger;
	}
	if (element.element.getBoundingClientRect().top < windowHeight) {
		if (element.isLastOfType) {
			// element.container.classList.remove("overflow-y-hidden");
		}
		continue;
	}

	const scrollObserver = onScroll({
		trigger: element.element,
		enter: {
			target: "top",
			container: "bottom",
		},
	});
	animate(element.element, {
		y: {
			from: "+=50px",
		},
		opacity: {
			from: 0,
		},
		duration: 500,
		autoplay: scrollObserver,
		ease: outCirc,
		onComplete: () => {
			if (element.isLastOfType) {
				element.container.classList.remove("overflow-y-hidden");
			}
		},
	});
}

// Hide downloads that aren't for the user's platform.
const platformData = detectPlatform(
	navigator.userAgent,
	navigator.userAgentData,
);
let platformName = "windows";
switch (platformData.os) {
	case "mac":
	case "iphone":
	case "ipad":
		{
			platformName = "macos";
		}
		break;

	case "linux":
		{
			platformName = "linux";
		}
		break;

	case "android":
		{
			platformName = "android";
		}
		break;

	case "windows":
	default:
		break;
}
const releasePlatformContainer = document.querySelector(
	".release-platform-container",
);
if (releasePlatformContainer != null) {
	const releasePlatform = releasePlatformContainer.querySelector(
		`.release-platform-${platformName}`,
	);
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
const authors = Array.from(
	document.querySelectorAll(
		"#special-thanks-release-authors .release-card-authors .release-card-author",
	),
);
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

// Lazy-load videos
const lazyVideoObserver = new IntersectionObserver((entries, observer) => {
	for (const entry of entries) {
		if (!entry.isIntersecting) {
			continue;
		}

		const video = entry.target;
		const source = video.querySelector(":scope > source");
		if (source == null) {
			continue;
		}

		video.classList.remove("lazy");
		source.src = source.dataset.src;
		delete source.dataset.src;
		video.load();

		observer.unobserve(video);
	}
});
const releaseCardVideoContainers = Array.from(
	document.querySelectorAll(".release-card-video-container"),
);
for (const releaseCardVideoContainer of releaseCardVideoContainers) {
	const noScript = releaseCardVideoContainer.querySelector(":scope > noscript");
	if (noScript == null) {
		throw new Error("`.release-card-video-container > noscript` is null");
	}

	// The contents of noScript exist, but as text.
	// Let's create a document to store that content.
	const doc = document.implementation.createHTMLDocument();
	doc.write(noScript.innerHTML);

	// The video should exist on the virtual body. If not, let's skip it.
	const video = doc.body.querySelector(":scope > .release-card-video");
	if (video == null) {
		throw new Error(
			"`.release-card-video-container > noscript > .release-card-video` is null",
		);
	}
	video.classList.add("lazy");

	const source = video.querySelector(":scope > source");
	if (source == null) {
		throw new Error(
			"`.release-card-video-container > noscript > .release-card-video > source` is null",
		);
	}
	source.dataset.src = source.src;
	source.src = "";

	// Let's swap the noScript for the video itself.
	releaseCardVideoContainer.insertBefore(video, noScript);
	noScript.remove();

	lazyVideoObserver.observe(video);
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
		scrollToTopTween.cancel();
	}
	scrollToTopElement.style.display = "block";
	scrollToTopTween = animate(scrollToTopElement, {
		opacity: {
			to: 1,
		},
		duration: 500,
	});
};
const hideScrollToTop = () => {
	if (scrollState === "hide") {
		return;
	}
	scrollState = "hide";
	if (scrollToTopTween != null) {
		scrollToTopTween.cancel();
	}
	scrollToTopTween = animate(scrollToTopElement, {
		opacity: {
			to: 0,
		},
		duration: 500,
		onComplete: () => {
			scrollToTopElement.style.display = "none";
		},
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

// Image comparisons.
/** @type {HTMLDivElement[]} */
const releaseCardMediaElements = Array.from(
	document.querySelectorAll(".release-card-media"),
);
for (const releaseCardMedia of releaseCardMediaElements) {
	/** @type {HTMLVideoElement[]} */
	const videoElements = Array.from(releaseCardMedia.querySelectorAll("video"));
	/** @type {HTMLInputElement | null} */
	const comparisonRange = releaseCardMedia.querySelector(".comparison-range");
	if (comparisonRange == null) {
		continue;
	}
	/** @type {HTMLDivElement | null} */
	const comparisonRangeIndicator = releaseCardMedia.querySelector(
		".comparison-range-indicator",
	);
	if (comparisonRangeIndicator == null) {
		continue;
	}
	/** @type {HTMLDivElement | null} */
	const comparisonB = releaseCardMedia.querySelector(
		".image-comparison-b, .video-comparison-b",
	);
	if (comparisonB == null) {
		continue;
	}
	const updateMaskWidth = () => {
		comparisonB.style = `--mask-width: ${comparisonRange.valueAsNumber}%;`;
	};
	const updateComparisonRangeIndicator = () => {
		comparisonRangeIndicator.style = `left: calc(${comparisonRange.valueAsNumber}% - (0.25em / 2))`;
	};

	/** @type {(event: MouseEvent) => void} */
	const onPointerEvent = (event) => {
		const bounds = comparisonRange.getBoundingClientRect();
		const x = event.clientX - bounds.left;
		const width = bounds.width;
		comparisonRange.valueAsNumber = (x / width) * 100;

		for (const videoElement of videoElements) {
			if (videoElement.paused) {
				videoElement.play();
			}
		}

		updateMaskWidth();
		updateComparisonRangeIndicator();
	};
	comparisonRange.addEventListener("pointerdown", onPointerEvent);
	comparisonRange.addEventListener("pointermove", onPointerEvent);

	updateMaskWidth();
	updateComparisonRangeIndicator();
}

// target="_blank"
/** @type {HTMLAnchorElement[]} */
const anchors = Array.from(
	document.querySelector("main .release-container").querySelectorAll("a"),
);
for (const anchor of anchors) {
	if (
		anchor.classList.contains("download-button") &&
		anchor.dataset?.external !== "yes"
	) {
		continue;
	}
	try {
		const anchorUrl = new URL(anchor.href);
		const isInternalLink =
			anchorUrl.protocol === window.location.protocol &&
			anchorUrl.host === window.location.host &&
			anchorUrl.port === window.location.port &&
			anchorUrl.pathname === window.location.pathname &&
			anchorUrl.hash.startsWith("#");
		if (!isInternalLink) {
			anchor.target = "_blank";
		}
	} catch (err) {
		const newErr = new Error("Error while setting anchor target to blank.");
		newErr.cause = err;
		console.error(newErr);
	}
}

// Background video.
const initBackgroundVideo = () => {
	const videoUrl = "/storage/releases/4.5/video/godot-lander-manifest.mpd";
	const mediaPlayer = dashjs.MediaPlayer().create();
	const videoElement = document.getElementById(
		"release-header-background-video",
	);
	mediaPlayer.updateSettings({
		streaming: {
			lastBitrateCachingInfo: {
				enabled: true,
				ttl: 360000,
			},
			lastMediaSettingsCachingInfo: {
				enabled: true,
				ttl: 360000,
			},
			abr: {
				autoSwitchBitrate: {
					audio: true,
					video: true,
				},
				rules: {
					throughputRule: {
						active: true,
					},
					bolaRule: {
						active: true,
					},
					insufficientBufferRule: {
						active: true,
					},
					switchHistoryRule: {
						active: true,
					},
					droppedFramesRule: {
						active: false,
					},
					abandonRequestsRule: {
						active: true,
					},
				},
			},
			buffer: {
				fastSwitchEnabled: null,
				bufferTimeAtTopQuality: 30,
				bufferTimeAtTopQualityLongForm: 60,
				bufferTimeDefault: 12,
				longFormContentDurationThreshold: 600,
				reuseExistingSourceBuffers: true,
				stallThreshold: 0.3,
				lowLatencyStallThreshold: 0.3,
			},
		},
	});
	mediaPlayer.initialize(videoElement, videoUrl, true);
};
if (!prefersReducedMotion && !saveData) {
	initBackgroundVideo();
}

// Internationalization loop.
const intlBlockquote = document.querySelector(
	"#internationalization-live-preview .c-blockquote",
);
if (intlBlockquote == null) {
	throw new Error(
		"`#internationalization-live-preview .c-blockquote` doesn't exist",
	);
}
// Entries based on active translated languages on Weblate for the editor.
// (https://hosted.weblate.org/projects/godot-engine/godot/)
// Source for the translations: https://www.berlitz.com/blog/hello-different-languages
const intlBlockquoteTextEntries = [
	{ text: "Hello" }, // English
	{ text: "مرحبًا", rtl: true }, // Arabic
	{ text: "你好" }, // Chinese
	{ text: "Hallo" }, // Dutch
	{ text: "Bonjour" }, // French
	{ text: "Guten tag" }, // German
	{ text: "Halo" }, // Indonesian
	{ text: "Dia dhuit" }, // Irish
	{ text: "Ciao" }, // Italian
	{ text: "こんにちは" }, // Japanese
	{ text: "안녕하세요" }, // Korean
	{ text: "سلام", rtl: true }, // Persan
	{ text: "Cześć" }, // Polish
	{ text: "Olá" }, // Portuguese
	{ text: "Oi" }, // Portuguese (Brazil)
	{ text: "Привет" }, // Russian
	{ text: "Hola" }, // Spanish
	{ text: "Hallå" }, // Swedish
	{ text: "வணக்கம்" }, // Tamil
	{ text: "Merhaba" }, // Turkish
	{ text: "привіт" }, // Ukranian
];

for (const intlBlockquoteTextEntry of intlBlockquoteTextEntries) {
	const entry = document.createElement("p");
	entry.classList.add("entry");
	entry.textContent = intlBlockquoteTextEntry.text;
	entry.style.direction = intlBlockquoteTextEntry?.rtl ? "rtl" : "ltr";
	intlBlockquote.append(entry);
}

const intlBlockquoteEntries = Array.from(
	intlBlockquote.querySelectorAll("p.entry"),
).toSorted((a, b) => (Math.random() > 0.5 ? 1 : -1));
const intlBlockquoteTimeline = createTimeline({
	loop: true,
});

for (const intlBlockquoteEntry of intlBlockquoteEntries) {
	const { chars } = text.split(intlBlockquoteEntry, {
		chars: { wrap: "clip" },
	});
	const entryAnimation = animate(chars, {
		y: [
			{ to: ["120%", "0%"] },
			{ to: "-120%", delay: prefersReducedMotion ? 0 : 750, ease: "in(3)" },
		],
		duration: 750,
		ease: "out(3)",
		delay: prefersReducedMotion ? 0 : stagger(50, { from: "random" }),
		loop: false,
	});
	intlBlockquoteTimeline.sync(entryAnimation);
}
intlBlockquoteTimeline.init();

// Fix grid orphans.
const getCSSVariableValue = (name) => {
	return parseInt(
		window.getComputedStyle(document.body).getPropertyValue(name),
	);
};
const TEMPORARY_SPAN_2_COL_2 = "temporary-span-2-col-2";
const TEMPORARY_SPAN_2_COL_3 = "temporary-span-2-col-3";
const TEMPORARY_SPAN_3_COL_3 = "temporary-span-3-col-3";
const TEMPORARY_SPAN_CLASSES = [
	TEMPORARY_SPAN_2_COL_2,
	TEMPORARY_SPAN_2_COL_3,
	TEMPORARY_SPAN_3_COL_3,
];
const TEMPORARY_SPAN_CLASSES_LIST = TEMPORARY_SPAN_CLASSES.map(
	(className) => `.${className}`,
).join(", ");
let fixGridOrphansAnimationFrame = -1;
let lastColumns = -1;
const toFixedFloat = (num, precision) => {
	return parseFloat(num.toFixed(precision));
};
const fixGridOrphansProcess = () => {
	fixGridOrphansAnimationFrame = -1;

	const cardPadding = getCSSVariableValue("--card-padding");
	const oneColumnMaxWidth = getCSSVariableValue("--one-column-max-width");
	const twoColumnsMaxWidth = getCSSVariableValue("--two-columns-max-width");

	const columns =
		document.body.clientWidth > twoColumnsMaxWidth
			? 3
			: document.body.clientWidth > oneColumnMaxWidth
				? 2
				: 1;
	if (columns === lastColumns) {
		fixGridOrphansRequestFrame();
		return;
	}
	lastColumns = columns;

	const temporarySpans = Array.from(
		document.querySelectorAll(TEMPORARY_SPAN_CLASSES_LIST),
	);
	for (const temporarySpan of temporarySpans) {
		temporarySpan.classList.remove(...TEMPORARY_SPAN_CLASSES);
	}

	if (columns === 1) {
		fixGridOrphansRequestFrame();
		return;
	}

	for (const releaseCards of Array.from(
		document.querySelectorAll(".release-cards"),
	)) {
		const releaseCardsWidth = releaseCards.clientWidth;
		const releaseCardWidth =
			(releaseCardsWidth - (columns - 1) * cardPadding) / columns;
		const releaseCardSpan2Width = releaseCardWidth * 2 + cardPadding;
		const releaseCardSpan3Width = releaseCardWidth * 3 + cardPadding * 2;
		const yMap = new Map();
		for (const releaseCard of releaseCards.querySelectorAll(".release-card")) {
			const boundingBox = releaseCard.getBoundingClientRect();
			if (yMap.has(boundingBox.y)) {
				yMap.get(boundingBox.y).push(releaseCard);
			} else {
				yMap.set(boundingBox.y, [releaseCard]);
			}
		}
		for (const [_, cards] of yMap) {
			if (cards.length === columns) {
				continue;
			}
			const cardsColumns = cards.reduce((accumulator, card) => {
				return (
					accumulator +
					(card.classList.contains("span-3")
						? 3
						: card.classList.contains("span-2")
							? 2
							: 1)
				);
			}, 0);
			if (cardsColumns === columns) {
				continue;
			}
			if (cards.length === 2) {
				cards[1].classList.add(TEMPORARY_SPAN_2_COL_3);
				continue;
			}
			if (columns === 3) {
				cards[0].classList.add(TEMPORARY_SPAN_3_COL_3);
			} else {
				cards[0].classList.add(TEMPORARY_SPAN_2_COL_2);
			}
		}
	}

	fixGridOrphansRequestFrame();
};
const fixGridOrphansRequestFrame = () => {
	if (fixGridOrphansAnimationFrame !== -1) {
		return;
	}

	fixGridOrphansAnimationFrame = window.requestAnimationFrame(
		fixGridOrphansProcess,
	);
};
fixGridOrphansRequestFrame();
