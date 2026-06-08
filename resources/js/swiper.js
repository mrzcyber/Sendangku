document.addEventListener('alpine:init', () => {
    Alpine.data('layananSection', () => ({
        active: 0,
        swiper: null,

        layanan: [
            {
                title: 'Layanan Berkuda',
                description: 'Latihan berkuda bermanfaat meningkatkan kekuatan otot, keseimbangan, membantu memperbaiki postur tubuh dan mengurangi stress.',
                href: '/layanan/berkuda',
                image: 'img/sendang.png',
            },
            {
                title: 'Kolam Renang Olimpik',
                description: 'Nikmati fasilitas kolam renang standar olimpik yang bersih dan terawat, cocok untuk semua kalangan dari anak-anak hingga dewasa.',
                href: '/layanan/kolam-renang',
                image: 'img/sendang.png',
            },
            {
                title: 'Waterpark & Wahana',
                description: 'Rasakan sensasi meluncur di berbagai wahana waterpark seru yang memacu adrenalin bersama keluarga dan orang tercinta.',
                href: '/layanan/waterpark',
                image: 'img/sendang.png',
            },
            {
                title: 'Resto & Angkringan',
                description: 'Santap hidangan khas Wonosobo yang lezat di restoran kami dengan pemandangan alam yang indah dan suasana nyaman.',
                href: '/layanan/resto',
                image: 'img/sendang.png',
            },
            {
                title: 'Karaoke Family',
                description: 'Nikmati hiburan karaoke bersama keluarga di ruangan bersih, nyaman, dan dilengkapi koleksi lagu terlengkap.',
                href: '/layanan/karaoke',
                image: 'img/sendang.png',
            },
        ],

        /* Ambil index asli dari slide element — reliable di loop mode */
        _getSlideIndex() {
            const el = this.swiper?.slides?.[this.swiper.activeIndex];
            if (!el) return this.swiper?.realIndex ?? 0;

            /* Swiper 11 loop mode: data-swiper-slide-index berisi index asli */
            const attr = el.getAttribute('data-swiper-slide-index');
            if (attr !== null) return parseInt(attr, 10);

            /* Fallback: baca dari data-index yang kita pasang di template */
            const custom = el.getAttribute('data-index');
            if (custom !== null) return parseInt(custom, 10);

            return this.swiper.realIndex;
        },

        /* Dipanggil saat klik langsung pada slide */
        goTo(i) {
            if (i === this.active) return;
            this.active = i;

            if (this.swiper) {
                this.swiper.slideToLoop(i);
            }
        },

        initSwiper() {
            this.swiper = new Swiper(this.$refs.swiperLayanan, {
                loop: true,
                slidesPerView: 3,
                spaceBetween: 16,
                centeredSlides: false,
                speed: 550,
                grabCursor: true,
                navigation: {
                    nextEl: this.$refs.btnNext,
                    prevEl: this.$refs.btnPrev,
                },
                breakpoints: {
                    0:    { slidesPerView: 1.4, spaceBetween: 14, centeredSlides: false },
                    640:  { slidesPerView: 2, spaceBetween: 21, centeredSlides: false },
                    1024: { slidesPerView: 3,   spaceBetween: 20, centeredSlides: false },
                    1536: { slidesPerView: 3,   spaceBetween: 28, centeredSlides: false },
                },
            });

            /* Sync teks kiri setiap kali slide berubah */
            this.swiper.on('slideChange', () => {
                this.active = this._getSlideIndex();
            });

            /*
             * Handle klik pada slide — pakai event native Swiper
             * agar bekerja di slide asli maupun slide clone (loop mode).
             * Swiper menyimpan data-swiper-slide-index di semua slide.
             */
            this.swiper.on('click', () => {
                const slide = this.swiper.clickedSlide;
                if (!slide) return;

                const attr = slide.getAttribute('data-swiper-slide-index');
                if (attr === null) return;

                const idx = parseInt(attr, 10);
                this.goTo(idx);
            });
        },

        init() {
            this.initSwiper();
        }
    }));



// event swiper


 const swiperEvent = new Swiper('.swiper-event', {
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
            0: {
                spaceBetween: 14,
            },
            768: {
                spaceBetween: 24,
            },
            1024: {
                spaceBetween: 28,
            },
        },
    });




});