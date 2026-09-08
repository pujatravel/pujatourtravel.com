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
        setTimeout(() => drawerOverlay.classList.add('hidden'), 300);
        document.body.style.overflow = '';
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMobileMenu);
    if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileMenu);
    drawerLinks.forEach(link => link.addEventListener('click', closeMobileMenu));

    // 2. Sticky Navbar Solid Effect on Scroll
    const mainHeader = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        if (!mainHeader) return;
        if (window.scrollY > 40) {
            mainHeader.classList.add('shadow-md', 'py-3', 'bg-white');
            mainHeader.classList.remove('py-4', 'bg-white/95');
        } else {
            mainHeader.classList.remove('shadow-md', 'py-3', 'bg-white');
            mainHeader.classList.add('py-4', 'bg-white/95');
        }
    });

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
                dot.classList.remove('w-2.5', 'bg-white/40');
                dot.classList.add('w-8', 'bg-emerald-400');
            } else {
                dot.classList.remove('w-8', 'bg-emerald-400');
                dot.classList.add('w-2.5', 'bg-white/40');
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
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) nextHeroSlide();
                    else prevHeroSlide();
                    startHeroSlider();
                }
            }, { passive: true });
        }
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

    // 5. FAQ Accordion
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const content = toggle.nextElementSibling;
            const icon = toggle.querySelector('.faq-icon');
            const isOpen = !content.classList.contains('hidden');

            // Close all
            document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
            document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));

            if (!isOpen) {
                content.classList.remove('hidden');
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
                    d.classList.remove('w-1.5', 'bg-white/50');
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
    const lightboxDetailLink = document.getElementById('lightbox-detail-link');
    const lightboxWaLink = document.getElementById('lightbox-wa-link');

    let currentLightboxImages = [];
    let currentLightboxIndex = 0;
    let lightboxTimer = null;
    let isLightboxAutoplay = true;

    function renderLightboxSlide() {
        if (!currentLightboxImages.length || !lightboxImage) return;

        const total = currentLightboxImages.length;
        currentLightboxIndex = (currentLightboxIndex + total) % total;
        const currentSrc = currentLightboxImages[currentLightboxIndex];

        // Smooth fade effect
        lightboxImage.style.opacity = '0';
        setTimeout(() => {
            lightboxImage.src = currentSrc;
            lightboxImage.style.opacity = '1';
        }, 150);

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

    function openLightboxCarousel({ title, caption, images, startIndex = 0, slug = '', price = '' }) {
        if (!lightboxModal) return;

        currentLightboxImages = images && images.length ? images : ['/images/greencanyon.jpg'];
        currentLightboxIndex = startIndex;
        isLightboxAutoplay = currentLightboxImages.length > 1;

        if (lightboxTitle) lightboxTitle.textContent = title || 'Galeri Foto';
        if (lightboxCaption) lightboxCaption.textContent = caption || '';

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

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            const caption = item.getAttribute('data-caption') || 'Dokumentasi Wisatawan Puja Tour';
            openLightboxCarousel({
                title: 'Dokumentasi Wisatawan Pangandaran',
                caption: caption,
                images: allGalleryImages.length ? allGalleryImages : [item.getAttribute('data-img')],
                startIndex: index,
            });
        });
    });

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
