// Puja Tour & Travel - Interactive Scripts
import { createIcons, icons } from 'lucide';

// Make lucide available globally
window.lucide = { createIcons, icons };

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

    // 4. Interactive Trip Calculator & WhatsApp Order Generator
    const calcPackage = document.getElementById('calc-package');
    const calcPax = document.getElementById('calc-pax');
    const calcDate = document.getElementById('calc-date');
    const calcName = document.getElementById('calc-name');
    const calcPhone = document.getElementById('calc-phone');
    const calcNote = document.getElementById('calc-note');
    const priceDisplay = document.getElementById('calc-total-display');
    const submitWhatsappBtn = document.getElementById('btn-order-whatsapp');

    function updatePriceEstimate() {
        if (!calcPackage || !calcPax || !priceDisplay) return;
        const selectedOption = calcPackage.options[calcPackage.selectedIndex];
        const basePrice = parseInt(selectedOption.getAttribute('data-price') || '0', 10);
        const paxCount = parseInt(calcPax.value || '1', 10);
        
        let discount = 1.0;
        if (paxCount >= 10) discount = 0.85; // 15% discount for 10+ pax
        else if (paxCount >= 5) discount = 0.90; // 10% discount for 5+ pax

        const totalPrice = Math.round(basePrice * paxCount * discount);
        priceDisplay.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }

    if (calcPackage) calcPackage.addEventListener('change', updatePriceEstimate);
    if (calcPax) calcPax.addEventListener('input', updatePriceEstimate);
    if (calcPackage) updatePriceEstimate();

    if (submitWhatsappBtn) {
        submitWhatsappBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const packageName = calcPackage ? calcPackage.options[calcPackage.selectedIndex].text : 'Paket Wisata Pangandaran';
            const pax = calcPax ? calcPax.value : '1';
            const date = calcDate && calcDate.value ? calcDate.value : 'Akan disesuaikan';
            const name = calcName && calcName.value.trim() ? calcName.value.trim() : 'Wisatawan';
            const phone = calcPhone && calcPhone.value.trim() ? calcPhone.value.trim() : '-';
            const note = calcNote && calcNote.value.trim() ? calcNote.value.trim() : 'Tidak ada catatan khusus';
            const total = priceDisplay ? priceDisplay.textContent : '-';

            const message = `Halo Admin Puja Tour & Travel,\n\nSaya ingin konsultasi & reservasi paket wisata Pangandaran:\n\n*Nama:* ${name}\n*No. WhatsApp:* ${phone}\n*Paket Pilihan:* ${packageName}\n*Jumlah Peserta:* ${pax} Orang\n*Rencana Tanggal:* ${date}\n*Estimasi Total:* ${total}\n*Catatan Khusus:* ${note}\n\nMohon info ketersediaan jadwal dan detail paketnya. Terima kasih!`;

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

    // 6. Gallery Lightbox Modal
    const lightboxModal = document.getElementById('lightbox-modal');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');
    const galleryItems = document.querySelectorAll('.gallery-item');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const imgSrc = item.getAttribute('data-img');
            const caption = item.getAttribute('data-caption');
            if (lightboxModal && lightboxImage) {
                lightboxImage.src = imgSrc;
                if (lightboxCaption) lightboxCaption.textContent = caption || '';
                lightboxModal.classList.remove('hidden');
                lightboxModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                createIcons({ icons });
            }
        });
    });

    function closeLightbox() {
        if (!lightboxModal) return;
        lightboxModal.classList.add('hidden');
        lightboxModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxModal) {
        lightboxModal.addEventListener('click', (e) => {
            if (e.target === lightboxModal) closeLightbox();
        });
    }

    // 7. Quick Package Detail Modal
    const packageModal = document.getElementById('package-modal');
    const packageModalTitle = document.getElementById('package-modal-title');
    const packageModalDesc = document.getElementById('package-modal-desc');
    const packageModalPrice = document.getElementById('package-modal-price');
    const packageModalDuration = document.getElementById('package-modal-duration');
    const packageModalImg = document.getElementById('package-modal-img');
    const packageModalWa = document.getElementById('package-modal-wa');
    const packageModalClose = document.getElementById('package-modal-close');
    const detailBtns = document.querySelectorAll('.btn-view-package');

    detailBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const title = btn.getAttribute('data-title');
            const desc = btn.getAttribute('data-desc');
            const price = btn.getAttribute('data-price');
            const duration = btn.getAttribute('data-duration');
            const img = btn.getAttribute('data-img');

            if (packageModal) {
                if (packageModalTitle) packageModalTitle.textContent = title;
                if (packageModalDesc) packageModalDesc.textContent = desc;
                if (packageModalPrice) packageModalPrice.textContent = price;
                if (packageModalDuration) packageModalDuration.textContent = duration;
                if (packageModalImg) packageModalImg.src = img;
                if (packageModalWa) {
                    const waNum = packageModalWa.getAttribute('data-whatsapp') || '6281234567890';
                    const waText = encodeURIComponent(`Halo Puja Tour & Travel, saya tertarik dengan paket "${title}" (${duration}, ${price}). Boleh minta info detail dan jadwalnya?`);
                    packageModalWa.href = `https://wa.me/${waNum}?text=${waText}`;
                }

                packageModal.classList.remove('hidden');
                packageModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                createIcons({ icons });
            }
        });
    });

    function closePackageModal() {
        if (!packageModal) return;
        packageModal.classList.add('hidden');
        packageModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    if (packageModalClose) packageModalClose.addEventListener('click', closePackageModal);
    if (packageModal) {
        packageModal.addEventListener('click', (e) => {
            if (e.target === packageModal) closePackageModal();
        });
    }

    // 8. Keyboard ESC to close modals
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeLightbox();
            closePackageModal();
            closeMobileMenu();
        }
    });
});
