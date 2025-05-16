/** External JS */

/** Library Swiper 11 */
const swiperContainer = document.querySelector(".swiper-container");

if (swiperContainer) {
	new Swiper(".swiper", {
		direction: "horizontal",
		loop: true,
		slidesPerView: 1,
		spaceBetween: 12,
		navigation: {
			nextEl: ".swiper-custom-button-next",
			prevEl: ".swiper-custom-button-prev",
		},
		breakpoints: {
			998: {
				direction: "vertical",
				slidesPerView: 2,
				spaceBetween: 20,
			},
			768: {
				direction: "vertical",
				slidesPerView: 1,
				spaceBetween: 20,
			},
		},
		on: {
			resize: function () {
				const swiperWrapper = this.el.querySelector(".swiper-wrapper");

				if (window.innerWidth < 768) {
					swiperWrapper.style.width = `${window.innerWidth - 40}px`;
					swiperWrapper.style.height = `${swiperContainer.offsetHeight + 48}px`;
				} else if (window.innerWidth < 998) {
					swiperWrapper.style.width = `${swiperContainer.offsetWidth - 72}px`;
					swiperWrapper.style.height = "400px";
				} else {
					swiperWrapper.style.width = `${swiperContainer.offsetWidth - 72}px`;
					swiperWrapper.style.height = "505px";
				}

				this.update();
			},
		},
	});
}
