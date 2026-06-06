document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.swiper-event', {
        loop: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        spaceBetween: 28,
        grabCursor: true,

        pagination: {
            el: '.swiper-event .swiper-pagination',
            clickable: true,
        },

        breakpoints: {
            0:    { spaceBetween: 14 },
            768:  { spaceBetween: 24 },
            1024: { spaceBetween: 28 },
        },
    });


    // ── Event slider ──
    new Swiper('.swiper-event', {
        loop: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        spaceBetween: 28,
        grabCursor: true,
        pagination: {
            el: '.swiper-event .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            0:    { spaceBetween: 14 },
            768:  { spaceBetween: 24 },
            1024: { spaceBetween: 28 },
        },
    });
 
    // ── Layanan slider ──
    const swiperLayanan = new Swiper('.swiper-layanan', {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 20,
        grabCursor: true,
        centeredSlides: false,   // slide aktif di KIRI (index 0)
        speed: 550,
        watchSlidesProgress: true,
 
        navigation: {
            nextEl: '.swiper-layanan-next',
            prevEl: '.swiper-layanan-prev',
        },
 
        breakpoints: {
            0: {
                slidesPerView: 1.4,
                spaceBetween: 14,
                centeredSlides: true,
            },
            640: {
                slidesPerView: 2.2,
                spaceBetween: 16,
                centeredSlides: false,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 20,
                centeredSlides: false,
            },
            1536: {
                slidesPerView: 3,
                spaceBetween: 28,
                centeredSlides: false,
            },
        },
    });
 
    // Sync Alpine active index → Swiper
    // Cari Alpine component dari section parent
    const section = document.querySelector('[x-data]');
    if (section && section._x_dataStack) {
        const alpineData = section._x_dataStack[0];
 
        // Saat Alpine ganti active → geser swiper ke slide itu
        const origGoTo = alpineData.goTo.bind(alpineData);
        alpineData.goTo = function(i) {
            origGoTo(i);
            swiperLayanan.slideTo(i);
        };
 
        // Saat swiper geser → update Alpine active
        swiperLayanan.on('slideChange', () => {
            alpineData.active = swiperLayanan.activeIndex;
        });
    }

    
});