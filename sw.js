const CACHE_NAME = 'bhc-assets-v1';
const ASSET_URLS = [
  'loaded/logo.png',
  'showcase/1.png',
  'showcase/2.png',
  'showcase/3.png',
  'showcase/4.png',
  'showcase/5.png',
  'showcase/6.png'
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
  if (req.destination === 'image') {
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


