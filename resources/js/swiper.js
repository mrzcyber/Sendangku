document.addEventListener('alpine:init', () => {
    Alpine.data('layananSection', () => ({
        active: 0,
        prev: null,
        animating: false,
        swiper: null,
        layanan: [
            {
                title: 'Layanan Berkuda',
                description: 'Latihan berkuda bermanfaat meningkatkan kekuatan otot, keseimbangan, membantu memperbaiki postur tubuh dan mengurangi stress.',
                href: '/layanan/berkuda',
                image: 'img/food2.png',
            },
            {
                title: 'Kolam Renang Olimpik',
                description: 'Nikmati fasilitas kolam renang standar olimpik yang bersih dan terawat, cocok untuk semua kalangan dari anak-anak hingga dewasa.',
                href: '/layanan/kolam-renang',
                image: 'img/overlay-food.png',
            },
            {
                title: 'Waterpark & Wahana',
                description: 'Rasakan sensasi meluncur di berbagai wahana waterpark seru yang memacu adrenalin bersama keluarga dan orang tercinta.',
                href: '/layanan/waterpark',
                image: 'img/icon-bg.png',
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

        goTo(i) {
            if (this.animating || i === this.active) return;

            this.animating = true;
            this.prev = this.active;
            this.active = i;

            if (this.swiper && this.swiper.realIndex !== i) {
                this.swiper.slideToLoop(i);
            }

            setTimeout(() => {
                this.animating = false;
                this.prev = null;
            }, 500);
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
                    0: { slidesPerView: 1.4, spaceBetween: 14, centeredSlides: true },
                    640: { slidesPerView: 2.2, spaceBetween: 16, centeredSlides: false },
                    1024: { slidesPerView: 3, spaceBetween: 20, centeredSlides: false },
                    1536: { slidesPerView: 3, spaceBetween: 28, centeredSlides: false },
                },
            });

            this.swiper.on('slideChange', () => {
                this.goTo(this.swiper.realIndex);
            });
        },

        init() {
            this.initSwiper();
        }
    }));
});