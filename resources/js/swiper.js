document.addEventListener('alpine:init', () => {
    Alpine.data('layananSection', (layanan = []) => ({
        active: 0,
        swiper: null,
        layanan,

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
            if (!this.layanan.length) {
                return;
            }

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
                    0:    { slidesPerView: 1, spaceBetween: 0, centeredSlides: true },
                    640:  { slidesPerView: 2, spaceBetween: 21, centeredSlides: false },
                    1024: { slidesPerView: 3,   spaceBetween: 21, centeredSlides: false },
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



    // resto menu swiper (mobile only)
    const swiperRestoMenu = new Swiper('.swiper-resto-menu', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        // centeredSlides: true,
        grabCursor: true,
        speed: 1000,
        pagination: {
            el: '.swiper-resto-menu .swiper-pagination',
            clickable: true,
        },
    });


        // Detail Gallery Swiper — same pattern as event swiper
        const swiperDetailGallery = new Swiper('.swiper-detail-gallery', {
            loop: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
                el: '.swiper-detail-gallery .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0:   { slidesPerView: 1,   spaceBetween: 0,  centeredSlides: true },

            },
        });


});
