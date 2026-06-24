(()=>{
    function clamp(pNumber, pMin, pMax) {
        return Math.max(pMin, Math.min(pNumber, pMax));
    }

    const compareBlocks = Array.from(document.querySelectorAll(".media-compare"));

    for (const compareBlock of compareBlocks) {
        const slider = compareBlock.querySelector(".slider");
        const beforeBlock = compareBlock.querySelector(".before");
		let compareBlockData = {
			isPressing: false,
			requestAnimationFrameId: -1,
			event: null,
		};

		const cancelAnimationFrameRequest = () => {
			if (compareBlockData.requestAnimationFrameId === -1) {
				return;
			}
			window.cancelAnimationFrame(compareBlockData.requestAnimationFrameId);
			compareBlockData.requestAnimationFrameId = -1;
		};

        const onPointerEvent = (pEventName, pEvent) => {
			const eventIs = {
				touch: pEventName.startsWith("touch"),
				move: pEventName.endsWith("move"),
				up: pEventName.endsWith("up"),
				down: pEventName.endsWith("down"),
			};

			if (compareBlockData.isPressing) {
				if (eventIs.up) {
					compareBlockData.isPressing = false;
				}
			} else {
				if (eventIs.down) {
					compareBlockData.isPressing = true;
				}
			}

			if (!compareBlockData.isPressing) {
				cancelAnimationFrameRequest();
				return;
			}

            pEvent.stopPropagation();
            pEvent.preventDefault();

			// Do nothing if it's a touch PointerEvent.
			// We handle the logic with TouchEvent.
			if (!eventIs.touch && pEvent.touchType === "touch") {
				return;
			}

			if (eventIs.move) {
				compareBlockData.event = pEvent;

				if (compareBlockData.requestAnimationFrameId === -1) {
					compareBlockData.requestAnimationFrameId = window.requestAnimationFrame(() => {
						compareBlockData.requestAnimationFrameId = -1;
						const event = compareBlockData.event;
						compareBlockData.event = null;

						if (event == null || !compareBlockData.isPressing) {
							return;
						}

						updateComparisonBlock(event);
					});
				}
				return;
			}

			updateComparisonBlock(pEvent);
        };

		const updateComparisonBlock = (pEvent) => {
            let percent = clamp(pEvent.layerX / compareBlock.clientWidth, 0.0, 1.0) * 100.0;
            if (percent < 10) {
                percent = 0;
                compareBlock.classList.add("transition");
            } else if (percent >= 90) {
                percent = 100;
                compareBlock.classList.add("transition");
            } else {
                if (compareBlock.classList.contains("transition")){
                    compareBlock.classList.remove("transition");
                }
            }

            slider.style.left = `${percent}%`;
            beforeBlock.style.clipPath = `inset(0 ${100.0 - percent}% 0 0)`;
		};

		for (const eventNameSuffix of ["down", "up", "move"]) {
			let eventName = `pointer${eventNameSuffix}`;
			compareBlock.addEventListener(eventName, onPointerEvent.bind(null, eventName), { passive: false });

			eventName = `touch${eventNameSuffix}`;
			compareBlock.addEventListener(eventName, onPointerEvent.bind(null, eventName), { passive: false });
		}
    }
})();
