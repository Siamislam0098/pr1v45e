const CACHE_NAME = 'bhc-assets-v2';
const ASSET_URLS = [
  'gif/hero.mp4',
  'loaded/logo.png',
  'showcase/Season1/1.png',
  'showcase/Season1/2.png',
  'showcase/Season1/3.png',
  'showcase/Season1/4.png',
  'showcase/Season1/5.png',
  'showcase/Season1/6.png'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(ASSET_URLS))
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => Promise.all(keys.map((k) => k !== CACHE_NAME ? caches.delete(k) : null)))
  );
});

self.addEventListener('fetch', (event) => {
  const req = event.request;
  const dest = req.destination;
  if (dest === 'image' || dest === 'video') {
    event.respondWith(
      caches.match(req).then((cached) => {
        const networkFetch = fetch(req).then((res) => {
          const resClone = res.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(req, resClone));
          return res;
        }).catch(() => cached);
        return cached || networkFetch;
      })
    );
  }
});


