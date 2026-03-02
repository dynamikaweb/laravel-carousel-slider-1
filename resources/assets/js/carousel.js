const swiperLazyLoad = (swiper) => {
    const slides = swiper.slides || [];
    slides.forEach(slide => {
        const img = slide.querySelector('img[data-src]');
        if (!img) return;
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
        img.onload = () => slide.querySelector('.swiper-lazy-preloader')?.remove();
    });
};

window.initCarouselSlider2 = function(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const dataset = container.dataset;
    const hasAutoplay = dataset.autoplay === 'true';
    const delayTime = parseInt(dataset.delay || 3000, 10);
    
    const autoplayConfig = hasAutoplay ? {
        delay: delayTime,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
    } : false;

    const isHorizontal = ['top', 'bottom'].includes(dataset.layout);
    const mainEl = container.querySelector(".mySwiper2");
    const thumbsEl = container.querySelector(".mySwiper");

    if (!mainEl) return;

    let thumbsSwiper = null;
    if (thumbsEl && dataset.layout !== 'notumbs') {
        thumbsSwiper = new Swiper(thumbsEl, {
            spaceBetween: 10,
            watchSlidesProgress: true,
            breakpoints: {
                0: { direction: 'horizontal', slidesPerView: 3 },
                475: { direction: 'horizontal', slidesPerView: 4 },
                768: { direction: isHorizontal ? 'horizontal' : 'vertical', slidesPerView: 5 }
            },
            on: {
                init: function() { swiperLazyLoad(this); },
                slideChange: function() { swiperLazyLoad(this); }
            }
        });
    }

    const mainSwiper = new Swiper(mainEl, {
        loop: true,
        spaceBetween: 10,
        autoplay: autoplayConfig,
        navigation: {
            nextEl: container.querySelector(".swiper-button-next"),
            prevEl: container.querySelector(".swiper-button-prev")
        },
        thumbs: {
            swiper: thumbsSwiper
        }
    });

    const modal = document.querySelector(`#lightboxModal-${containerId}`);
    if (modal) {
        const lbSwiper = new Swiper(modal.querySelector(`.myLightbox-${containerId}`), {
            loop: true,
            slidesPerView: 1,
            navigation: {
                nextEl: modal.querySelector('.swiper-button-next'),
                prevEl: modal.querySelector('.swiper-button-prev')
            },
            keyboard: { enabled: true }
        });

        const toggleModal = (show) => {
            modal.style.display = show ? 'flex' : 'none';
            document.body.style.overflow = show ? 'hidden' : '';
        };

        container.querySelectorAll('.open-lightbox').forEach(el => {
            el.addEventListener('click', e => {
                e.preventDefault();
                const index = parseInt(el.dataset.index, 10);
                toggleModal(true);
                lbSwiper.slideToLoop(index, 0);
            });
        });

        modal.querySelector('.lightbox-close')?.addEventListener('click', () => toggleModal(false));
        modal.addEventListener('click', e => e.target === modal && toggleModal(false));
        
        window.addEventListener("keydown", e => {
            if (e.key === "Escape" && modal.style.display === "flex") toggleModal(false);
        });
    }
};

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".container-swiper").forEach(container => {
        if (container.id) window.initCarouselSlider2(container.id);
    });
});