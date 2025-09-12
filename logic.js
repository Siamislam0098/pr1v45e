document.addEventListener('DOMContentLoaded', () => {
            const mainHeader = document.getElementById('main-header');
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const fullScreenMenu = document.getElementById('full-screen-menu');
            const menuCloseBtn = document.getElementById('menu-close-btn');
            const menuLinks = document.querySelectorAll('#full-screen-menu a');
            const scrollToTopBtn = document.getElementById('scroll-to-top');
            function adjustScrollButton() {
                const footerRect = footer.getBoundingClientRect();
                const btnRect = scrollToTopBtn.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // If the button would overlap the footer, move it up
                if (footerRect.top < windowHeight - btnRect.height - 20) {
                    // Move button up so it's above the footer
                    scrollToTopBtn.style.bottom = (windowHeight - footerRect.top + 20) + 'px';
                } else {
                    // Default position
                    scrollToTopBtn.style.bottom = '20px';
                }
            }
            window.addEventListener('scroll', adjustScrollButton);
            window.addEventListener('resize', adjustScrollButton);
            const footer = document.querySelector('footer');
            const progressBar = document.getElementById('progress-bar');
            const statusContainer = document.getElementById('status-container');

            const SERVER_STATUS_API_URL = 'https://api.mcsrvstat.us/2/demo.minecraft.net';

            const seasonImages = {
                season1: [
                    { src: 'showcase/1.png', alt: '' },
                    { src: 'showcase/2.png', alt: '' },
                    { src: 'showcase/3.png', alt: '' },
                    { src: 'showcase/4.png', alt: '' },
                    { src: 'showcase/5.png', alt: '' },
                    { src: 'showcase/6.png', alt: '' },
                ],
                season2: [
                ]
            };

            // Preload helper to eagerly fetch images
            const preloadImages = (urls) => {
                const uniqueUrls = Array.from(new Set(urls.filter(Boolean)));
                return Promise.all(uniqueUrls.map((url) => new Promise((resolve) => {
                    const img = new Image();
                    img.decoding = 'sync';
                    img.loading = 'eager';
                    img.onload = img.onerror = () => resolve(url);
                    img.src = url;
                })));
            };

            // Force all existing <img> tags to load eagerly (disables browser lazy-loading)
            const forceEagerLoading = () => {
                document.querySelectorAll('img').forEach((el) => {
                    el.setAttribute('loading', 'eager');
                    el.setAttribute('decoding', 'sync');
                });
            };

            const gallery1 = document.getElementById('gallery-1');
            const gallery2 = document.getElementById('gallery-2');
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const season1Btn = document.getElementById('season1-btn');
            const season2Btn = document.getElementById('season2-btn');

            let currentIndex = 0;
            let currentSeason = 'season1';

            const renderGallery = (season) => {
                gallery1.innerHTML = '';
                gallery2.innerHTML = '';
                const images = seasonImages[season] || [];

                const renderImages = (container) => {
                    [...images, ...images].forEach((image, index) => { // Duplicate for seamless scroll
                        const imgElement = document.createElement('img');
                        imgElement.src = image.src;
                        imgElement.fetchPriority = 'high';
                        imgElement.alt = image.alt;
                        imgElement.loading = 'eager';
                        imgElement.decoding = 'sync';
                        imgElement.classList.add('gallery-image');
                        imgElement.dataset.index = index;
                        container.appendChild(imgElement);
                    });
                };

                renderImages(gallery1);
                renderImages(gallery2);
            };

            renderGallery('season1');
            season1Btn.classList.add('active');
            season2Btn.classList.remove('active');

            // Kick off eager loading across the page
            forceEagerLoading();

            // Build a list of image URLs to preload (gallery + existing DOM images)
            const galleryUrls = Object.values(seasonImages).flat().map(i => i.src);
            const domImgUrls = Array.from(document.querySelectorAll('img'))
                .map(img => img.getAttribute('src'));
            preloadImages([...galleryUrls, ...domImgUrls]);

            // Register a simple service worker for image caching
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('sw.js').catch(() => {});
            }

            const showImage = (index) => {
                const images = seasonImages[currentSeason] || [];
                if (index >= 0 && index < images.length) {
                    currentIndex = index;
                    modalImage.src = images[currentIndex].src;
                    modalImage.alt = images[currentIndex].alt;
                    modal.classList.add('is-active');
                    modal.classList.remove('hidden');
                    document.body.classList.add('modal-open');
                }
            };

            const hideImage = () => {
                modal.classList.add('hidden');
                modal.classList.remove('is-active');
                document.body.classList.remove('modal-open');
            };

            document.addEventListener('click', (e) => {
                const clickedImg = e.target.closest('.gallery-image');
                if (clickedImg) {
                    const index = parseInt(clickedImg.dataset.index, 10);
                    showImage(index);
                }
            });

            closeModalBtn.addEventListener('click', hideImage);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    hideImage();
                }
            });

            const showPreviousImage = () => {
                const images = seasonImages[currentSeason] || [];
                let prevIndex = currentIndex - 1;
                if (prevIndex < 0) {
                    prevIndex = images.length - 1;
                }
                showImage(prevIndex);
            };

            const showNextImage = () => {
                const images = seasonImages[currentSeason] || [];
                let nextIndex = currentIndex + 1;
                if (nextIndex >= images.length) {
                    nextIndex = 0;
                }
                showImage(nextIndex);
            };

            prevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                showPreviousImage();
            });

            nextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                showNextImage();
            });

            document.addEventListener('keydown', (e) => {
                if (!modal.classList.contains('hidden')) {
                    if (e.key === 'ArrowLeft') {
                        showPreviousImage();
                    } else if (e.key === 'ArrowRight') {
                        showNextImage();
                    } else if (e.key === 'Escape') {
                        hideImage();
                    }
                }
            });

            season1Btn.addEventListener('click', () => {
                currentSeason = 'season1';
                renderGallery(currentSeason);
                season1Btn.classList.add('active');
                season2Btn.classList.remove('active');
            });

            season2Btn.addEventListener('click', () => {
                currentSeason = 'season2';
                renderGallery(currentSeason);
                season2Btn.classList.add('active');
                season1Btn.classList.remove('active');
            });

            async function fetchServerStatus() {
                try {
                    statusContainer.classList.add('animate-pulse');
                    const response = await fetch(SERVER_STATUS_API_URL);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const data = await response.json();
                    const isOnline = data.online;
                    const playerCount = data.players ? `${data.players.online}/${data.players.max}` : 'N/A';
                    const uptime = data.debug ? data.debug.query_time : 'N/A';
                    let statusHTML = '';

                    if (isOnline) {
                        statusHTML = `
                            <div class="flex items-center justify-center mb-4">
                                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-xl font-semibold">Server is Online</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-center">
                                <div class="bg-gray-800 p-4 rounded-lg">
                                    <p class="text-3xl font-bold">${playerCount}</p>
                                    <p class="text-sm text-gray-400">Players</p>
                                </div>
                                <div class="bg-gray-800 p-4 rounded-lg">
                                    <p class="text-3xl font-bold">${uptime} ms</p>
                                    <p class="text-sm text-gray-400">Query Time</p>
                                </div>
                            </div>
                        `;
                    } else {
                        statusHTML = `
                            <div class="flex items-center justify-center">
                                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                <span class="text-xl font-semibold">Server is Offline</span>
                            </div>
                        `;
                    }
                    statusContainer.innerHTML = statusHTML;
                    statusContainer.classList.remove('animate-pulse');
                } catch (error) {
                    console.error('Failed to fetch server status:', error);
                    statusContainer.innerHTML = `
                        <div class="flex items-center justify-center">
                            <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                            <span class="text-xl font-semibold">Server is Offline</span>
                        </div>
                    `;
                    statusContainer.classList.remove('animate-pulse');
                }
            }

            const lenis = new Lenis()
            const heroBackground = document.getElementById('hero-bg');
            const heroContent = document.querySelector('.hero-content');
            const heroPauseBtn = document.getElementById('hero-pause-btn');
            const heroMuteBtn = document.getElementById('hero-mute-btn');
            const heroPauseIcon = document.getElementById('hero-pause-icon');
            const heroPauseLabel = document.getElementById('hero-pause-label');
            const heroVolumeIcon = document.getElementById('hero-volume-icon');
            const heroMuteLabel = document.getElementById('hero-mute-label');

            lenis.on('scroll', (e) => {
                if (heroBackground) {
                    heroBackground.style.transform = `translateY(${e.scroll * 0.5}px) translateZ(0)`;
                }
                if (e.scroll > 50) {
                    mainHeader.classList.add('py-4', 'bg-black/50', 'backdrop-blur-sm');
                    mainHeader.classList.remove('py-8');
                } else {
                    mainHeader.classList.remove('py-4', 'bg-black/50', 'backdrop-blur-sm');
                    mainHeader.classList.add('py-8');
                }

                if (e.scroll > 400) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
                const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollProgress = (e.scroll / totalHeight) * 100;
                progressBar.style.height = scrollProgress + '%';
                const revealElements = document.querySelectorAll('.reveal-element');
                const viewportHeight = window.innerHeight;
                const elementVisible = 150;
                revealElements.forEach(element => {
                    const rect = element.getBoundingClientRect();
                    const elementTop = rect.top;
                    if (elementTop < viewportHeight - elementVisible) {
                        element.classList.add('is-visible');
                    }
                });
            })

            function raf(time) {
                lenis.raf(time)
                requestAnimationFrame(raf)
            }
            requestAnimationFrame(raf)

            // Initialize HLS (.m3u8) source if provided via data-hls attribute
            const initHeroMedia = async () => {
                if (!heroBackground) return;
                const hlsSrc = heroBackground.getAttribute('data-hls');
                if (hlsSrc) {
                    if (heroBackground.canPlayType('application/vnd.apple.mpegurl')) {
                        heroBackground.src = hlsSrc;
                    } else if (window.Hls && window.Hls.isSupported()) {
                        const hls = new Hls({ enableWorker: true });
                        hls.loadSource(hlsSrc);
                        hls.attachMedia(heroBackground);
                    }
                }
                try {
                    heroBackground.muted = false;
                    const playPromise = heroBackground.play();
                    if (playPromise && typeof playPromise.then === 'function') {
                        playPromise.catch(() => {
                            heroBackground.muted = true;
                            heroBackground.dispatchEvent(new Event('volumechange'));
                            heroBackground.play().finally(() => {
                                const tryUnmuteOnInteract = () => {
                                    heroBackground.muted = false;
                                    heroBackground.dispatchEvent(new Event('volumechange'));
                                    if (heroBackground.paused) {
                                        heroBackground.play().catch(() => {});
                                    }
                                    window.removeEventListener('click', tryUnmuteOnInteract);
                                    window.removeEventListener('touchstart', tryUnmuteOnInteract, { passive: true });
                                };
                                window.addEventListener('click', tryUnmuteOnInteract);
                                window.addEventListener('touchstart', tryUnmuteOnInteract, { passive: true });
                            });
                        });
                    }
                } catch (e) {}
            };
            initHeroMedia();

            // Fade hero text based on video state
            const syncHeroContentVisibility = () => {
                if (!heroBackground || !heroContent) return;
                if (heroBackground.paused) {
                    heroContent.classList.remove('is-faded-out');
                } else {
                    heroContent.classList.add('is-faded-out');
                }
            };
            if (heroBackground && heroContent) {
                heroBackground.addEventListener('play', syncHeroContentVisibility);
                heroBackground.addEventListener('pause', syncHeroContentVisibility);
                heroBackground.addEventListener('ended', syncHeroContentVisibility);
                // Initial state after attempting autoplay
                setTimeout(syncHeroContentVisibility, 0);
            }

            // Hero video controls
            if (heroBackground && heroPauseBtn && heroMuteBtn) {
                // Initialize labels based on current state
                const syncPauseUi = () => {
                    const isPaused = heroBackground.paused;
                    heroPauseLabel && (heroPauseLabel.textContent = isPaused ? 'Play' : 'Pause');
                    if (heroPauseIcon) {
                        heroPauseIcon.innerHTML = isPaused
                            ? '<path d="M8 5v14l11-7z"/>'
                            : '<path d="M6 4h4v16H6zM14 4h4v16h-4z"/>'
                    }
                };
                const syncMuteUi = () => {
                    const isMuted = heroBackground.muted || heroBackground.volume === 0;
                    heroMuteLabel && (heroMuteLabel.textContent = isMuted ? 'Unmute' : 'Mute');
                    if (heroVolumeIcon) {
                        heroVolumeIcon.innerHTML = isMuted
                            ? '<path d="M16.5 12l3.5 3.5-1.5 1.5L15 13.5 11.5 17l-1.5-1.5L13.5 12 10 8.5l1.5-1.5L15 10.5l3.5-3.5 1.5 1.5L16.5 12zM3 9v6h4l5 5V4L7 9H3z"/>'
                            : '<path d="M3 9v6h4l5 5V4L7 9H3z"/>'
                    }
                };

                // Initial sync after potential autoplay starts
                setTimeout(() => {
                    syncPauseUi();
                    syncMuteUi();
                }, 0);

                heroPauseBtn.addEventListener('click', () => {
                    if (heroBackground.paused) {
                        heroBackground.play();
                    } else {
                        heroBackground.pause();
                    }
                    syncPauseUi();
                });

                heroMuteBtn.addEventListener('click', () => {
                    heroBackground.muted = !heroBackground.muted;
                    // If unmuting and volume is 0, set to a sensible default
                    if (!heroBackground.muted && heroBackground.volume === 0) {
                        heroBackground.volume = 0.5;
                    }
                    syncMuteUi();
                });

                // Keep UI synced with actual media events
                heroBackground.addEventListener('play', syncPauseUi);
                heroBackground.addEventListener('pause', syncPauseUi);
                heroBackground.addEventListener('playing', syncPauseUi);
                heroBackground.addEventListener('volumechange', syncMuteUi);
                heroBackground.addEventListener('loadedmetadata', syncMuteUi);
            }

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    lenis.scrollTo(this.getAttribute('href'));
                });
            });

            scrollToTopBtn.addEventListener('click', () => {
                lenis.scrollTo(0);
            });

            const openMenu = () => {
                fullScreenMenu.classList.add('open');
                document.body.style.overflow = 'hidden';
            };
            const closeMenu = () => {
                fullScreenMenu.classList.remove('open');
                document.body.style.overflow = '';
            };
            hamburgerBtn.addEventListener('click', openMenu);
            menuCloseBtn.addEventListener('click', closeMenu);
            menuLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });

            // Theme toggle (guard if the control isn't present)
            const themeToggleInput = document.querySelector('.switch .input');
            const storedTheme = localStorage.getItem('theme') || 'dark-theme';
            document.body.className = storedTheme;
            if (themeToggleInput) {
                if (storedTheme === 'light-theme') {
                    themeToggleInput.checked = true;
                }
                themeToggleInput.addEventListener('change', (e) => {
                    if (e.target.checked) {
                        document.body.classList.remove('dark-theme');
                        document.body.classList.add('light-theme');
                        localStorage.setItem('theme', 'light-theme');
                    } else {
                        document.body.classList.remove('light-theme');
                        document.body.classList.add('dark-theme');
                        localStorage.setItem('theme', 'dark-theme');
                    }
                });
            }

            renderGallery(currentSeason);
            fetchServerStatus();
            setInterval(fetchServerStatus, 5000);

        });