// Puja Tour & Travel - Interactive Scripts
import { createIcons, icons } from 'lucide';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { Indonesian } from 'flatpickr/dist/l10n/id.js';
import Choices from 'choices.js';
import 'choices.js/public/assets/styles/choices.min.css';

import Sortable from 'sortablejs';

// Make lucide, flatpickr, Choices, and Sortable available globally
window.lucide = {
    createIcons: (options = {}) => createIcons({ icons, ...options }),
    icons
};
window.flatpickr = flatpickr;
window.Choices = Choices;
window.Sortable = Sortable;

// Initialize Lucide Icons immediately and on DOMContentLoaded
try {
    createIcons({ icons });
} catch (e) {
    // DOM not ready yet
}

document.addEventListener('DOMContentLoaded', () => {
    // 0. Initialize Lucide Icons across all views
    createIcons({ icons });

    // 1. Mobile Menu Drawer Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');
    const drawerLinks = document.querySelectorAll('.drawer-link');

    function openMobileMenu() {
        if (!mobileDrawer) return;
        mobileDrawer.classList.remove('invisible', 'pointer-events-none');
        mobileDrawer.classList.remove('translate-x-full');
        drawerOverlay.classList.remove('hidden');
        setTimeout(() => drawerOverlay.classList.remove('opacity-0'), 10);
        document.body.style.overflow = 'hidden';
        createIcons({ icons });
    }

    function closeMobileMenu() {
        if (!mobileDrawer) return;
        mobileDrawer.classList.add('translate-x-full');
        drawerOverlay.classList.add('opacity-0');
        setTimeout(() => {
            drawerOverlay.classList.add('hidden');
            mobileDrawer.classList.add('invisible', 'pointer-events-none');
        }, 300);
        document.body.style.overflow = '';
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
    document.querySelectorAll('#close-menu-btn, #close-drawer-btn, .close-drawer-btn').forEach(btn => {
        btn.addEventListener('click', closeMobileMenu);
    });
    if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileMenu);
    drawerLinks.forEach(link => link.addEventListener('click', closeMobileMenu));

    // 2. Automatic Smart Navbar Background Detection
    // Automatically detects if what's behind the navbar is non-white (transparent navbar) or white (white navbar)
    const mainHeader = document.getElementById('main-header');
    if (mainHeader) {
        const updateNavbarTheme = () => {
            const headerHeight = mainHeader.offsetHeight || 64;
            const probeY = headerHeight / 2;

            const darkElements = document.querySelectorAll(
                '[data-nav-color="dark"], section.bg-slate-950, section.bg-slate-900, footer.bg-slate-950, footer.bg-slate-900'
            );

            let isOverDark = false;
            for (let i = 0; i < darkElements.length; i++) {
                const rect = darkElements[i].getBoundingClientRect();
                if (rect.top <= probeY && rect.bottom >= probeY) {
                    isOverDark = true;
                    break;
                }
            }

            if (isOverDark) {
                // Non-white/dark background behind navbar -> TRANSPARENT
                mainHeader.classList.remove('is-white-nav');
                mainHeader.classList.add('is-transparent-nav');
            } else {
                // White background behind navbar -> WHITE NAVBAR
                mainHeader.classList.remove('is-transparent-nav');
                mainHeader.classList.add('is-white-nav');
            }
        };

        window.addEventListener('scroll', updateNavbarTheme, { passive: true });
        window.addEventListener('resize', updateNavbarTheme, { passive: true });
        updateNavbarTheme();
    }

    // 2.5 Hero Section Cinematic Auto-Slider
    const heroSection = document.getElementById('beranda');
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');
    const heroPrevBtn = document.getElementById('hero-prev-btn');
    const heroNextBtn = document.getElementById('hero-next-btn');
    const heroLocationText = document.getElementById('hero-location-text');
    let currentHeroIndex = 0;
    let heroAutoTimer = null;
    const heroInterval = 5000;

    function setHeroSlide(index) {
        if (!heroSlides.length) return;
        currentHeroIndex = (index + heroSlides.length) % heroSlides.length;

        heroSlides.forEach((slide, idx) => {
            if (idx === currentHeroIndex) {
                slide.classList.remove('opacity-0', 'pointer-events-none');
                slide.classList.add('opacity-100');
                const loc = slide.getAttribute('data-location');
                if (heroLocationText && loc) {
                    heroLocationText.textContent = loc;
                }
            } else {
                slide.classList.remove('opacity-100');
                slide.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        heroDots.forEach((dot, idx) => {
            if (idx === currentHeroIndex) {
                dot.classList.remove('w-2', 'w-2.5', 'w-6', 'w-8', 'sm:w-2.5', 'sm:w-8', 'bg-white/40');
                dot.classList.add('w-6', 'sm:w-8', 'bg-emerald-400');
            } else {
                dot.classList.remove('w-6', 'w-8', 'sm:w-8', 'bg-emerald-400');
                dot.classList.add('w-2', 'sm:w-2.5', 'bg-white/40');
            }
        });
    }

    function nextHeroSlide() {
        setHeroSlide(currentHeroIndex + 1);
    }

    function prevHeroSlide() {
        setHeroSlide(currentHeroIndex - 1);
    }

    function startHeroSlider() {
        stopHeroSlider();
        if (heroSlides.length > 1) {
            heroAutoTimer = setInterval(nextHeroSlide, heroInterval);
        }
    }

    function stopHeroSlider() {
        if (heroAutoTimer) {
            clearInterval(heroAutoTimer);
            heroAutoTimer = null;
        }
    }

    if (heroSlides.length > 0) {
        setHeroSlide(0);
        startHeroSlider();

        if (heroPrevBtn) {
            heroPrevBtn.addEventListener('click', () => {
                prevHeroSlide();
                startHeroSlider();
            });
        }

        if (heroNextBtn) {
            heroNextBtn.addEventListener('click', () => {
                nextHeroSlide();
                startHeroSlider();
            });
        }

        heroDots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                setHeroSlide(idx);
                startHeroSlider();
            });
        });

        if (heroSection) {
            heroSection.addEventListener('mouseenter', stopHeroSlider);
            heroSection.addEventListener('mouseleave', startHeroSlider);

            // Touch swipe support for mobile
            let touchStartX = 0;
            heroSection.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            heroSection.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].screenX;
                if (touchStartX - touchEndX > 50) {
                    nextHeroSlide();
                    startHeroSlider();
                } else if (touchEndX - touchStartX > 50) {
                    prevHeroSlide();
                    startHeroSlider();
                }
            }, { passive: true });
        }
    }

    // 2.8 Traveloka-Style Scroll Reveal Observer
    const revealElements = document.querySelectorAll('.reveal-fade-up, .reveal-fade-left, .reveal-fade-right, .reveal-scale-up');
    if (revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-active');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -30px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    }

    // 3. Package Category Filters
    const filterBtns = document.querySelectorAll('.package-filter-btn');
    const packageCards = document.querySelectorAll('.package-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.getAttribute('data-category');

            // Active button state - Solid Emerald Primary
            filterBtns.forEach(b => {
                b.classList.remove('bg-emerald-700', 'text-white', 'shadow-sm');
                b.classList.add('bg-white', 'text-slate-600', 'hover:bg-slate-100', 'border', 'border-slate-200');
            });
            btn.classList.add('bg-emerald-700', 'text-white', 'shadow-sm');
            btn.classList.remove('bg-white', 'text-slate-600', 'hover:bg-slate-100', 'border', 'border-slate-200');

            // Filter packages
            packageCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 200);
                }
            });
        });
    });

    // 3.5 Modern Datepicker (Flatpickr with Indonesian Localization)
    const dateInputs = document.querySelectorAll('input[type="date"], .custom-datepicker');
    dateInputs.forEach(input => {
        flatpickr(input, {
            locale: Indonesian,
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'j F Y',
            minDate: 'today',
            disableMobile: true,
            altInputClass: input.className + ' custom-datepicker-input',
            defaultDate: input.value || null,
        });
    });

    // 3.6 Modern Rounded Select (Choices.js)
    const selectPackageElements = [
        document.getElementById('calc-package'),
        document.getElementById('calc-page-package'),
        document.getElementById('msg-topic'),
    ];

    selectPackageElements.forEach(el => {
        if (el) {
            new Choices(el, {
                searchEnabled: false,
                itemSelectText: '',
                shouldSort: false,
                allowHTML: true,
            });
        }
    });

    // 4. Interactive Trip Calculator & WhatsApp Order Generator
    const calcPackage = document.getElementById('calc-package');
    const calcPax = document.getElementById('calc-pax');
    const calcDate = document.getElementById('calc-date');
    const calcName = document.getElementById('calc-name');
    const calcNote = document.getElementById('calc-note');
    const priceDisplay = document.getElementById('calc-total-display');
    const submitWhatsappBtn = document.getElementById('btn-order-whatsapp');

    function updatePriceEstimate() {
        if (!calcPackage || !calcPax || !priceDisplay) return;
        const selectedOption = calcPackage.querySelector(`option[value="${calcPackage.value}"]`) || calcPackage.options[calcPackage.selectedIndex];
        const basePrice = parseInt(selectedOption?.getAttribute('data-price') || '0', 10);
        
        // Defensively clamp pax between 1 and 500
        let paxCount = parseInt(calcPax.value || '1', 10);
        if (isNaN(paxCount) || paxCount < 1) {
            paxCount = 1;
        } else if (paxCount > 500) {
            paxCount = 500;
        }
        
        let discount = 1.0;
        if (paxCount >= 10) discount = 0.85; // 15% discount for 10+ pax
        else if (paxCount >= 5) discount = 0.90; // 10% discount for 5+ pax

        const totalPrice = Math.round(basePrice * paxCount * discount);
        priceDisplay.textContent = 'Rp ' + (isNaN(totalPrice) ? 0 : totalPrice).toLocaleString('id-ID');
    }

    if (calcPackage) calcPackage.addEventListener('change', updatePriceEstimate);
    if (calcPax) {
        calcPax.addEventListener('input', updatePriceEstimate);
        calcPax.addEventListener('blur', () => {
            let pax = parseInt(calcPax.value, 10);
            if (isNaN(pax) || pax < 1) calcPax.value = 1;
            else if (pax > 500) calcPax.value = 500;
            updatePriceEstimate();
        });
    }

    if (calcDate) {
        calcDate.addEventListener('change', () => {
            const today = new Date().toISOString().split('T')[0];
            if (calcDate.value && calcDate.value < today) {
                calcDate.value = today;
                alert('Tanggal perjalanan tidak boleh di masa lalu. Tanggal telah otomatis disesuaikan ke hari ini.');
            }
        });
    }

    if (calcPackage) updatePriceEstimate();

    // 4.5 Mobile Widget Sync
    // Sync the mobile calc total display with the desktop calculator result
    const mobileCalcTotal = document.getElementById('mobile-calc-total');

    function syncMobileCalcTotal() {
        if (mobileCalcTotal && priceDisplay) {
            mobileCalcTotal.textContent = priceDisplay.textContent;
        }
    }

    // Patch updatePriceEstimate to also update mobile display
    const _origUpdatePriceEstimate = updatePriceEstimate;
    // We already assigned updatePriceEstimate above, we just add a side-effect via event listener
    if (calcPackage) calcPackage.addEventListener('change', syncMobileCalcTotal);
    if (calcPax) calcPax.addEventListener('input', syncMobileCalcTotal);

    // Initial sync
    syncMobileCalcTotal();

    // Mobile WhatsApp button handler (mirrors desktop)
    const submitWhatsappBtnMobile = document.getElementById('btn-order-whatsapp-mobile');
    if (submitWhatsappBtnMobile) {
        submitWhatsappBtnMobile.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedOption = calcPackage ? (calcPackage.querySelector(`option[value="${calcPackage.value}"]`) || calcPackage.options[calcPackage.selectedIndex]) : null;
            const packageName = selectedOption ? selectedOption.text : 'Paket Wisata Pangandaran';

            let pax = parseInt(calcPax?.value || '1', 10);
            if (isNaN(pax) || pax < 1) pax = 1;
            else if (pax > 500) pax = 500;

            const today = new Date().toISOString().split('T')[0];
            const altDateInput = calcDate?.parentElement?.querySelector('.flatpickr-input[type="text"]');
            let date = altDateInput && altDateInput.value ? altDateInput.value : (calcDate?.value || 'Akan disesuaikan');
            if (calcDate && calcDate.value && calcDate.value < today) {
                date = today;
                calcDate.value = today;
            }

            const name = calcName && calcName.value.trim() ? calcName.value.trim() : 'Wisatawan';
            const total = mobileCalcTotal ? mobileCalcTotal.textContent : (priceDisplay ? priceDisplay.textContent : '-');

            let message = `Halo Admin Puja Tour & Travel Pangandaran,\n\n`;
            message += `Saya ingin konsultasi & reservasi paket wisata melalui website (mobile):\n\n`;
            message += `📋 *Detail Rencana Trip:*\n`;
            message += `• *Nama Pemesan:* ${name}\n`;
            message += `• *Paket Pilihan:* ${packageName}\n`;
            message += `• *Jumlah Peserta:* ${pax} Orang\n`;
            message += `• *Rencana Tanggal:* ${date}\n`;
            message += `• *Estimasi Total:* ${total}\n`;
            message += `\nMohon info ketersediaan slot dan jadwalnya. Terima kasih!`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappNumber = submitWhatsappBtnMobile.getAttribute('data-whatsapp') || '6281234567890';
            window.open(`https://wa.me/${whatsappNumber}?text=${encodedMessage}`, '_blank');
        });
    }

    if (submitWhatsappBtn) {
        submitWhatsappBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedOption = calcPackage ? (calcPackage.querySelector(`option[value="${calcPackage.value}"]`) || calcPackage.options[calcPackage.selectedIndex]) : null;
            const packageName = selectedOption ? selectedOption.text : 'Paket Wisata Pangandaran';
            
            // Validate & clamp pax
            let pax = parseInt(calcPax?.value || '1', 10);
            if (isNaN(pax) || pax < 1) pax = 1;
            else if (pax > 500) pax = 500;

            // Validate date
            const today = new Date().toISOString().split('T')[0];
            const altDateInput = calcDate?.parentElement?.querySelector('.flatpickr-input[type="text"]');
            let date = altDateInput && altDateInput.value ? altDateInput.value : (calcDate?.value || 'Akan disesuaikan');

            if (calcDate && calcDate.value && calcDate.value < today) {
                date = today;
                calcDate.value = today;
            }

            const name = calcName && calcName.value.trim() ? calcName.value.trim() : 'Wisatawan';
            const note = calcNote && calcNote.value.trim() ? calcNote.value.trim() : 'Tidak ada catatan khusus';
            const total = priceDisplay ? priceDisplay.textContent : '-';

            let message = `Halo Admin Puja Tour & Travel Pangandaran,\n\n`;
            message += `Saya ingin konsultasi & reservasi paket wisata melalui website:\n\n`;
            message += `📋 *Detail Rencana Trip:*\n`;
            message += `• *Nama Pemesan:* ${name}\n`;
            message += `• *Paket Pilihan:* ${packageName}\n`;
            message += `• *Jumlah Peserta:* ${pax} Orang\n`;
            message += `• *Rencana Tanggal:* ${date}\n`;
            message += `• *Estimasi Total:* ${total}\n`;
            if (note !== 'Tidak ada catatan khusus') {
                message += `• *Catatan Khusus:* ${note}\n`;
            }
            message += `\nMohon info ketersediaan slot dan jadwalnya. Terima kasih!`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappNumber = submitWhatsappBtn.getAttribute('data-whatsapp') || '6281234567890';
            window.open(`https://wa.me/${whatsappNumber}?text=${encodedMessage}`, '_blank');
        });
    }

    // 5. FAQ Accordion with Smooth Slide-Down Animation
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const item = toggle.closest('.faq-item') || toggle.parentElement;
            const collapse = item ? item.querySelector('.faq-collapse') : toggle.nextElementSibling;
            const icon = toggle.querySelector('.faq-icon');
            const isCurrentlyOpen = collapse ? collapse.classList.contains('is-open') : false;

            // Close all open accordions smoothly
            document.querySelectorAll('.faq-collapse.is-open').forEach(c => {
                c.classList.remove('is-open');
                const pItem = c.closest('.faq-item');
                if (pItem) pItem.classList.remove('is-active');
                const pToggle = pItem ? pItem.querySelector('.faq-toggle') : null;
                const pIcon = pToggle ? pToggle.querySelector('.faq-icon') : null;
                if (pIcon) pIcon.classList.remove('rotate-180');
            });

            // Backward compatibility fallback for static hidden class
            document.querySelectorAll('.faq-content:not(.faq-collapse-content)').forEach(c => c.classList.add('hidden'));
            document.querySelectorAll('.faq-icon:not(.rotate-180)').forEach(i => i.classList.remove('rotate-180'));

            // Open clicked item if it was closed
            if (!isCurrentlyOpen) {
                if (collapse) {
                    collapse.classList.remove('hidden');
                    collapse.classList.add('is-open');
                }
                if (item) item.classList.add('is-active');
                if (icon) icon.classList.add('rotate-180');
            }
        });
    });

    // 6. Package Card Multi-Image Auto-Sliders
    const cardSliders = document.querySelectorAll('.package-card-slider');

    cardSliders.forEach((slider, cardIndex) => {
        const slides = slider.querySelectorAll('.card-slide-img');
        const dots = slider.querySelectorAll('.card-dot');
        let activeIdx = 0;
        let cardTimer = null;

        function showCardSlide(idx) {
            if (slides.length <= 1) return;
            activeIdx = (idx + slides.length) % slides.length;

            slides.forEach((s, i) => {
                if (i === activeIdx) {
                    s.classList.remove('opacity-0', 'pointer-events-none');
                    s.classList.add('opacity-100');
                } else {
                    s.classList.remove('opacity-100');
                    s.classList.add('opacity-0', 'pointer-events-none');
                }
            });

            dots.forEach((d, i) => {
                if (i === activeIdx) {
                    d.classList.remove('w-1.5', 'w-3.5', 'bg-white/50');
                    d.classList.add('w-3.5', 'bg-emerald-400');
                } else {
                    d.classList.remove('w-3.5', 'bg-emerald-400');
                    d.classList.add('w-1.5', 'bg-white/50');
                }
            });
        }

        function startCardTimer() {
            if (slides.length <= 1) return;
            stopCardTimer();
            // Stagger by cardIndex so all cards don't rotate on the exact same second
            cardTimer = setInterval(() => {
                showCardSlide(activeIdx + 1);
            }, 4000 + (cardIndex % 3) * 700);
        }

        function stopCardTimer() {
            if (cardTimer) {
                clearInterval(cardTimer);
                cardTimer = null;
            }
        }

        startCardTimer();

        slider.addEventListener('mouseenter', stopCardTimer);
        slider.addEventListener('mouseleave', startCardTimer);

        // Clicking on package card image directly opens the Lightbox Carousel
        slider.addEventListener('click', () => {
            const name = slider.getAttribute('data-package-name') || 'Paket Wisata';
            const location = slider.getAttribute('data-package-location') || 'Pangandaran';
            const price = slider.getAttribute('data-package-price') || '';
            const duration = slider.getAttribute('data-package-duration') || '';
            const slug = slider.getAttribute('data-package-slug') || '';
            let images = [];
            try {
                images = JSON.parse(slider.getAttribute('data-package-images') || '[]');
            } catch {
                images = [];
            }

            if (!images.length) {
                slides.forEach(s => {
                    const src = s.getAttribute('src');
                    if (src) images.push(src);
                });
            }

            openLightboxCarousel({
                title: name,
                caption: `${name} • ${location} (${duration}) - Mulai dari ${price}`,
                images: images,
                startIndex: activeIdx,
                slug: slug,
                price: price,
            });
        });
    });

    // 7. Full Interactive Lightbox Modal Carousel
    const lightboxModal = document.getElementById('lightbox-modal');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const lightboxDots = document.getElementById('lightbox-dots');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxAutoplayBtn = document.getElementById('lightbox-autoplay-btn');
    const lightboxAutoplayLabel = document.getElementById('lightbox-autoplay-label');
    const lightboxPlayIcon = document.getElementById('lightbox-play-icon');
    const lightboxFitBtn = document.getElementById('lightbox-fit-btn');
    const lightboxFitLabel = document.getElementById('lightbox-fit-label');
    const lightboxFitIcon = document.getElementById('lightbox-fit-icon');
    const lightboxFullscreenBtn = document.getElementById('lightbox-fullscreen-btn');
    const lightboxFullscreenLabel = document.getElementById('lightbox-fullscreen-label');
    const lightboxFullscreenIcon = document.getElementById('lightbox-fullscreen-icon');
    const lightboxDetailLink = document.getElementById('lightbox-detail-link');
    const lightboxWaLink = document.getElementById('lightbox-wa-link');

    let currentLightboxImages = [];
    let currentLightboxCaptions = [];
    let currentLightboxIndex = 0;
    let lightboxTimer = null;
    let isLightboxAutoplay = true;
    let isLightboxCoverMode = false;

    function setLightboxFitMode(cover) {
        isLightboxCoverMode = cover;
        if (!lightboxImage) return;

        if (isLightboxCoverMode) {
            // Mode Penuh (fill container completely edge-to-edge)
            lightboxImage.classList.remove('max-w-full', 'max-h-full', 'w-auto', 'h-auto', 'object-contain', 'cursor-zoom-in');
            lightboxImage.classList.add('w-full', 'h-full', 'object-cover', 'cursor-zoom-out');
            lightboxImage.title = 'Klik untuk kembali ke Mode Asli (Proporsional)';
            if (lightboxFitLabel) lightboxFitLabel.textContent = 'Mode Asli';
            if (lightboxFitIcon) lightboxFitIcon.setAttribute('data-lucide', 'minimize');
        } else {
            // Mode Asli / Proporsional (natural aspect ratio without cropping)
            lightboxImage.classList.remove('w-full', 'h-full', 'object-cover', 'cursor-zoom-out');
            lightboxImage.classList.add('max-w-full', 'max-h-full', 'w-auto', 'h-auto', 'object-contain', 'cursor-zoom-in');
            lightboxImage.title = 'Klik untuk Mode Layar Penuh (Zoom)';
            if (lightboxFitLabel) lightboxFitLabel.textContent = 'Mode Penuh';
            if (lightboxFitIcon) lightboxFitIcon.setAttribute('data-lucide', 'maximize');
        }
        createIcons({ icons });
    }

    function toggleLightboxFitMode() {
        setLightboxFitMode(!isLightboxCoverMode);
    }

    function toggleLightboxFullscreen() {
        if (!document.fullscreenElement) {
            if (lightboxModal && lightboxModal.requestFullscreen) {
                lightboxModal.requestFullscreen().catch(() => {});
            } else if (lightboxModal && lightboxModal.webkitRequestFullscreen) {
                lightboxModal.webkitRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen().catch(() => {});
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }

    function syncFullscreenState() {
        const isFs = !!document.fullscreenElement;
        if (lightboxFullscreenIcon) {
            lightboxFullscreenIcon.setAttribute('data-lucide', isFs ? 'shrink' : 'expand');
        }
        if (lightboxFullscreenLabel) {
            lightboxFullscreenLabel.textContent = isFs ? 'Normal' : 'Layar Penuh';
        }
        createIcons({ icons });
    }

    document.addEventListener('fullscreenchange', syncFullscreenState);
    document.addEventListener('webkitfullscreenchange', syncFullscreenState);

    function renderLightboxSlide() {
        if (!currentLightboxImages.length || !lightboxImage) return;

        const total = currentLightboxImages.length;
        currentLightboxIndex = (currentLightboxIndex + total) % total;
        const currentSrc = currentLightboxImages[currentLightboxIndex];
        const currentCaption = currentLightboxCaptions[currentLightboxIndex] || '';

        // Smooth fade effect for image
        lightboxImage.style.opacity = '0';
        setTimeout(() => {
            lightboxImage.src = currentSrc;
            lightboxImage.style.opacity = '1';
        }, 150);

        // Smooth slide/fade effect for caption
        if (lightboxCaption) {
            lightboxCaption.style.opacity = '0';
            lightboxCaption.style.transform = 'translateY(8px)';
            setTimeout(() => {
                lightboxCaption.textContent = currentCaption;
                lightboxCaption.style.opacity = '1';
                lightboxCaption.style.transform = 'translateY(0)';
            }, 150);
        }

        if (lightboxCounter) {
            lightboxCounter.textContent = `Foto ${currentLightboxIndex + 1} / ${total}`;
        }

        // Render dot thumbnails
        if (lightboxDots) {
            lightboxDots.innerHTML = '';
            currentLightboxImages.forEach((_, idx) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = `h-2 rounded-full transition-all duration-300 cursor-pointer ${
                    idx === currentLightboxIndex ? 'w-6 bg-emerald-400' : 'w-2 bg-white/40 hover:bg-white/70'
                }`;
                dot.setAttribute('aria-label', `Lihat foto ${idx + 1}`);
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    currentLightboxIndex = idx;
                    renderLightboxSlide();
                    if (isLightboxAutoplay) resetLightboxTimer();
                });
                lightboxDots.appendChild(dot);
            });
        }
    }

    function nextLightboxSlide() {
        currentLightboxIndex++;
        renderLightboxSlide();
    }

    function prevLightboxSlide() {
        currentLightboxIndex--;
        renderLightboxSlide();
    }

    function resetLightboxTimer() {
        if (lightboxTimer) clearInterval(lightboxTimer);
        if (isLightboxAutoplay && currentLightboxImages.length > 1) {
            lightboxTimer = setInterval(nextLightboxSlide, 4500);
        }
    }

    function stopLightboxTimer() {
        if (lightboxTimer) {
            clearInterval(lightboxTimer);
            lightboxTimer = null;
        }
    }

    function toggleLightboxAutoplay() {
        isLightboxAutoplay = !isLightboxAutoplay;
        if (isLightboxAutoplay) {
            if (lightboxAutoplayLabel) lightboxAutoplayLabel.textContent = 'Auto-Slide Aktif';
            if (lightboxPlayIcon) {
                lightboxPlayIcon.setAttribute('data-lucide', 'pause');
            }
            resetLightboxTimer();
        } else {
            if (lightboxAutoplayLabel) lightboxAutoplayLabel.textContent = 'Putar Otomatis';
            if (lightboxPlayIcon) {
                lightboxPlayIcon.setAttribute('data-lucide', 'play');
            }
            stopLightboxTimer();
        }
        createIcons({ icons });
    }

    function openLightboxCarousel({ title, caption, captions = [], images, startIndex = 0, slug = '', price = '' }) {
        if (!lightboxModal) return;

        currentLightboxImages = images && images.length ? images : ['/images/greencanyon.jpg'];
        currentLightboxIndex = startIndex;
        isLightboxAutoplay = currentLightboxImages.length > 1;

        // Reset fit mode to original proportional aspect ratio
        setLightboxFitMode(false);

        // Build per-image captions array; fall back to single caption for all slides
        if (captions && captions.length === currentLightboxImages.length) {
            currentLightboxCaptions = captions;
        } else {
            currentLightboxCaptions = currentLightboxImages.map(() => caption || '');
        }

        if (lightboxTitle) lightboxTitle.textContent = title || 'Galeri Foto';

        // Detail Link
        if (lightboxDetailLink) {
            if (slug) {
                lightboxDetailLink.href = `/paket/${slug}`;
                lightboxDetailLink.classList.remove('hidden');
                lightboxDetailLink.classList.add('inline-flex');
            } else {
                lightboxDetailLink.classList.remove('inline-flex');
                lightboxDetailLink.classList.add('hidden');
            }
        }

        // WhatsApp Link
        if (lightboxWaLink) {
            const waNum = lightboxWaLink.getAttribute('data-whatsapp') || '6281234567890';
            const msg = encodeURIComponent(`Halo Admin Puja Tour & Travel Pangandaran,\n\nSaya tertarik dengan paket wisata: *${title}* (${price}).\nBoleh minta info jadwal dan penawaran lengkapnya? Terima kasih.`);
            lightboxWaLink.href = `https://wa.me/${waNum}?text=${msg}`;
        }

        // Autoplay button visibility
        if (lightboxAutoplayBtn) {
            if (currentLightboxImages.length > 1) {
                lightboxAutoplayBtn.classList.remove('hidden');
                if (lightboxAutoplayLabel) lightboxAutoplayLabel.textContent = 'Auto-Slide Aktif';
                if (lightboxPlayIcon) lightboxPlayIcon.setAttribute('data-lucide', 'pause');
            } else {
                lightboxAutoplayBtn.classList.add('hidden');
            }
        }

        // Nav buttons visibility
        if (lightboxPrev && lightboxNext) {
            if (currentLightboxImages.length > 1) {
                lightboxPrev.classList.remove('hidden');
                lightboxNext.classList.remove('hidden');
            } else {
                lightboxPrev.classList.add('hidden');
                lightboxNext.classList.add('hidden');
            }
        }

        renderLightboxSlide();
        resetLightboxTimer();

        lightboxModal.classList.remove('hidden');
        lightboxModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        createIcons({ icons });
    }

    function closeLightbox() {
        if (!lightboxModal) return;
        stopLightboxTimer();
        if (document.fullscreenElement) {
            document.exitFullscreen().catch(() => {});
        }
        lightboxModal.classList.add('hidden');
        lightboxModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxPrev) {
        lightboxPrev.addEventListener('click', (e) => {
            e.stopPropagation();
            prevLightboxSlide();
            if (isLightboxAutoplay) resetLightboxTimer();
        });
    }
    if (lightboxNext) {
        lightboxNext.addEventListener('click', (e) => {
            e.stopPropagation();
            nextLightboxSlide();
            if (isLightboxAutoplay) resetLightboxTimer();
        });
    }
    if (lightboxAutoplayBtn) {
        lightboxAutoplayBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleLightboxAutoplay();
        });
    }
    if (lightboxFitBtn) {
        lightboxFitBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleLightboxFitMode();
        });
    }
    if (lightboxFullscreenBtn) {
        lightboxFullscreenBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleLightboxFullscreen();
        });
    }
    if (lightboxImage) {
        lightboxImage.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleLightboxFitMode();
        });
    }

    if (lightboxModal) {
        lightboxModal.addEventListener('click', (e) => {
            if (e.target === lightboxModal) closeLightbox();
        });
    }

    // Section 8: Gallery Grid click integration
    const galleryItems = document.querySelectorAll('.gallery-item');
    const allGalleryImages = [];
    galleryItems.forEach(item => {
        const src = item.getAttribute('data-img');
        if (src) allGalleryImages.push(src);
    });

    // Also collect per-image captions
    const allGalleryCaptions = [];
    galleryItems.forEach(item => {
        const cap = item.getAttribute('data-caption') || 'Dokumentasi Wisatawan Puja Tour';
        allGalleryCaptions.push(cap);
    });

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            openLightboxCarousel({
                title: 'Dokumentasi Wisatawan Pangandaran',
                caption: item.getAttribute('data-caption') || 'Dokumentasi Wisatawan Puja Tour',
                captions: allGalleryCaptions,
                images: allGalleryImages.length ? allGalleryImages : [item.getAttribute('data-img')],
                startIndex: index,
            });
        });
    });

    // Section 8.1: Authentic Experience / Putra Daerah Local Slider
    const authenticContainer = document.getElementById('authentic-slider-container');
    const authenticSlides = document.querySelectorAll('.authentic-slide');
    const authenticCaption = document.getElementById('authentic-location-caption');
    const authenticTag = document.getElementById('authentic-slide-tag');
    const authenticDotsContainer = document.getElementById('authentic-dots');
    const authenticPrevBtn = document.getElementById('authentic-prev');
    const authenticNextBtn = document.getElementById('authentic-next');

    if (authenticSlides.length > 0) {
        let currentAuthenticIndex = 0;
        let authenticTimer = null;
        const totalAuthenticSlides = authenticSlides.length;

        // Build dots
        if (authenticDotsContainer) {
            authenticDotsContainer.innerHTML = '';
            authenticSlides.forEach((_, idx) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', `Lihat foto spot ${idx + 1}`);
                dot.className = `h-1.5 rounded-full transition-all duration-300 cursor-pointer ${
                    idx === 0 ? 'w-5 bg-emerald-400' : 'w-1.5 bg-white/50 hover:bg-white/80'
                }`;
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    updateAuthenticSlide(idx);
                    restartAuthenticTimer();
                });
                authenticDotsContainer.appendChild(dot);
            });
        }

        function updateAuthenticSlide(index) {
            currentAuthenticIndex = (index + totalAuthenticSlides) % totalAuthenticSlides;

            authenticSlides.forEach((slide, idx) => {
                if (idx === currentAuthenticIndex) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                }
            });

            // Update caption with smooth fade
            const activeSlide = authenticSlides[currentAuthenticIndex];
            if (activeSlide && authenticCaption) {
                const newLocation = activeSlide.getAttribute('data-location') || '';
                authenticCaption.style.opacity = '0';
                authenticCaption.style.transform = 'translateY(4px)';
                setTimeout(() => {
                    authenticCaption.textContent = newLocation;
                    authenticCaption.style.opacity = '1';
                    authenticCaption.style.transform = 'translateY(0)';
                }, 200);
            }

            // Update tag badge
            if (activeSlide && authenticTag) {
                const newTag = activeSlide.getAttribute('data-tag') || 'Pangandaran';
                authenticTag.textContent = newTag;
            }

            // Update dots
            if (authenticDotsContainer) {
                const dots = authenticDotsContainer.querySelectorAll('button');
                dots.forEach((d, idx) => {
                    if (idx === currentAuthenticIndex) {
                        d.className = 'h-1.5 rounded-full transition-all duration-300 cursor-pointer w-5 bg-emerald-400';
                    } else {
                        d.className = 'h-1.5 rounded-full transition-all duration-300 cursor-pointer w-1.5 bg-white/50 hover:bg-white/80';
                    }
                });
            }
        }

        function nextAuthenticSlide() {
            updateAuthenticSlide(currentAuthenticIndex + 1);
        }

        function prevAuthenticSlide() {
            updateAuthenticSlide(currentAuthenticIndex - 1);
        }

        function startAuthenticTimer() {
            if (authenticTimer) clearInterval(authenticTimer);
            authenticTimer = setInterval(nextAuthenticSlide, 4500);
        }

        function stopAuthenticTimer() {
            if (authenticTimer) {
                clearInterval(authenticTimer);
                authenticTimer = null;
            }
        }

        function restartAuthenticTimer() {
            startAuthenticTimer();
        }

        if (authenticPrevBtn) {
            authenticPrevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                prevAuthenticSlide();
                restartAuthenticTimer();
            });
        }

        if (authenticNextBtn) {
            authenticNextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                nextAuthenticSlide();
                restartAuthenticTimer();
            });
        }

        // Pause auto-slide on hover & Lightbox integration on image click
        if (authenticContainer) {
            authenticContainer.addEventListener('mouseenter', stopAuthenticTimer);
            authenticContainer.addEventListener('mouseleave', startAuthenticTimer);

            authenticContainer.addEventListener('click', (e) => {
                if (e.target.closest('#authentic-prev') || e.target.closest('#authentic-next') || e.target.closest('#authentic-dots')) {
                    return;
                }
                const authenticImages = Array.from(authenticSlides).map(s => s.querySelector('img')?.src).filter(Boolean);
                const authenticCaptions = Array.from(authenticSlides).map(s => s.getAttribute('data-location') || '');
                if (authenticImages.length && typeof openLightboxCarousel === 'function') {
                    openLightboxCarousel({
                        title: 'Spot Destinasi Pengalaman Lokal Autentik',
                        caption: authenticCaptions[currentAuthenticIndex] || '',
                        captions: authenticCaptions,
                        images: authenticImages,
                        startIndex: currentAuthenticIndex,
                    });
                }
            });
        }

        // Start auto-slider
        startAuthenticTimer();
    }

    // 8. Global Keyboard Navigation
    window.addEventListener('keydown', (e) => {
        if (lightboxModal && !lightboxModal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') {
                prevLightboxSlide();
                if (isLightboxAutoplay) resetLightboxTimer();
            }
            if (e.key === 'ArrowRight') {
                nextLightboxSlide();
                if (isLightboxAutoplay) resetLightboxTimer();
            }
            if (e.key === 'f' || e.key === 'F') {
                toggleLightboxFullscreen();
            }
            if (e.key === 'm' || e.key === 'M') {
                toggleLightboxFitMode();
            }
            if (e.key === ' ' || e.code === 'Space') {
                e.preventDefault();
                toggleLightboxAutoplay();
            }
            return;
        }

        if (e.key === 'ArrowLeft' && typeof prevHeroSlide === 'function') {
            prevHeroSlide();
            if (typeof startHeroSlider === 'function') startHeroSlider();
        } else if (e.key === 'ArrowRight' && typeof nextHeroSlide === 'function') {
            nextHeroSlide();
            if (typeof startHeroSlider === 'function') startHeroSlider();
        }

        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
});
