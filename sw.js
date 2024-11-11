importScripts(
	"https://storage.googleapis.com/workbox-cdn/releases/6.4.1/workbox-sw.js"
);

/** @type {(options: { url: URL, request: Request, event: Event }) => boolean} */
const matchCb = ({url, request, event}) => {
	if (url.origin !== "https://adamscott.github.io") {
		return false;
	}
	return url.pathname.startsWith("/") && !url.pathname.startsWith("/godot-website");
};

/** @type {(options: { url: URL, request: Request, event: Event, params: string[] }) => Promise<Response>} */
const handlerCb = async ({url, request, event, params}) => {
	const newRequest = new Request(
		url.origin + "/godot-website" + url.pathname,
		{
			body: request.body,
			cache: request.cache,
			credentials: request.credentials,
			headers: request.headers,
			integrity: request.integrity,
			keepalive: request.keepalive,
			method: request.method,
			mode: request.mode,
			redirect: request.redirect,
			referrer: request.referrer,
			referrerPolicy: request.referrerPolicy,
			signal: request.signal,
		}
	);
	const response = await fetch(newRequest, { cache: "no-cache" });
	return response;
};

workbox.routing.registerRoute(matchCb, handlerCb);
