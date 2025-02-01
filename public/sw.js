const CACHE_NAME = "child-records-v4"; // Changed version to v4
const ASSETS_TO_CACHE = [
    '/',
    '/offline.html',
    '/manifest.json',
    '/build/js/app.js',
    '/build/css/app.css',
    '/icons/icon-192x192.png',
    '/icons/icon-512x512.png',
    '/logo.png'
  ];

self.addEventListener("install", (event) => {
    event.waitUntil(
        caches
            .open(CACHE_NAME)
            .then((cache) => {
                // New: Add error handling for individual assets
                return Promise.all(
                    ASSETS_TO_CACHE.map((url) => {
                        return fetch(new Request(url))
                            .then((response) => {
                                if (response.status === 200)
                                    return cache.put(url, response);
                            })
                            .catch((error) => {
                                console.log(
                                    `Cache add failed for ${url}:`,
                                    error
                                );
                            });
                    })
                );
            })
            .then(() => self.skipWaiting())
    );
});

self.addEventListener("fetch", (event) => {
    // Skip non-HTTP(S) requests (e.g., chrome-extension://)
    if (!event.request.url.startsWith("http")) {
        return;
    }

    // Handle navigation requests (HTML pages)
    if (event.request.mode === "navigate") {
        event.respondWith(
            fetch(event.request)
                .then((response) => {
                    // Clone the response to cache it
                    const clone = response.clone();
                    caches
                        .open(CACHE_NAME)
                        .then((cache) => cache.put(event.request, clone));
                    return response;
                })
                .catch(() => {
                    // If offline, show offline.html
                    return caches.match("/offline.html");
                })
        );
    } else {
        // Serve other assets from cache first
        event.respondWith(
            caches
                .match(event.request)
                .then((response) => response || fetch(event.request))
        );
    }
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
});
