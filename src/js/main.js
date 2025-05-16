document.addEventListener("DOMContentLoaded", function () {
	// Function to handle the mobile menu toggle
	const menuIcon = document.querySelector(".menu-icon");
	const menuSidebar = document.querySelector(".menu-sidebar");
	const menuLinks = document.querySelectorAll(".menu-mobile a");

	const closeMenu = () => {
		menuIcon.classList.remove("active");
		menuSidebar.classList.remove("active");
		document.removeEventListener("click", outsideClickListener);
	};

	const outsideClickListener = ({ target }) => {
		if (!menuSidebar.contains(target) && !menuIcon.contains(target)) {
			closeMenu();
		}
	};

	menuIcon.addEventListener("click", () => {
		const isActive = menuIcon.classList.toggle("active");
		menuSidebar.classList.toggle("active");

		if (isActive) {
			setTimeout(() => {
				document.addEventListener("click", outsideClickListener);
			}, 10);

			return;
		}

		document.removeEventListener("click", outsideClickListener);
	});

	menuLinks.forEach((link) => {
		link.addEventListener("click", closeMenu);
	});

	// Function to handle the header fixed class
	function handleHeaderFixed() {
		const header = document.querySelector("header");

		if (!header) return;

		header.classList.remove("initial");

		const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

		if (scrollTop > 100) {
			header.classList.add("fixed");
		} else {
			header.classList.remove("fixed");
		}
	}

	window.addEventListener("scroll", handleHeaderFixed);
	handleHeaderFixed();

	// Function to handle the phone number mask
	const maskPhone = ({ target }) => {
		let value = target.value.replace(/\D/g, "");

		if (value.length === 0) {
			target.value = "";
			return;
		}

		if (value.length > 11) value = value.slice(0, 11);

		if (value.length <= 10) {
			// Formato fixo: (00) 0000-0000
			value = value.replace(/^(\d{2})(\d)/, "($1) $2");
			value = value.replace(/(\d{4})(\d)/, "$1-$2");
		} else {
			// Formato celular: (00) 00000-0000
			value = value.replace(/^(\d{2})(\d)/, "($1) $2");
			value = value.replace(/(\d{5})(\d)/, "$1-$2");
		}

		target.value = value;
	};

	const phoneMaskFields = document.querySelectorAll('input[name="phone"]');

	phoneMaskFields.forEach((field) => {
		field.addEventListener("input", maskPhone);
	});

	// Select all images in the blog
	const blogImages = document.querySelectorAll(".blog-list img");

	blogImages.forEach((img) => {
		img.addEventListener("click", function () {
			const parent = this.closest("li.item") || null;
			const button = parent ? parent.querySelector(".blog-link") : null;

			if (button) {
				button.click();
			}
		});
	});

	if ("IntersectionObserver" in window) {
		// Function to handle the counter animation
		const animateCounter = (counter) => {
			const startValue = parseInt(counter.getAttribute("data-init"), 10);
			const endValue = parseInt(counter.getAttribute("data-num"), 10);
			const duration = parseInt(counter.getAttribute("data-time"), 10);
			const totalFrames = Math.max(duration / 16, 60);
			const increment = (endValue - startValue) / totalFrames;

			let currentValue = startValue;

			const updateCounter = () => {
				currentValue += increment;

				if (currentValue >= endValue) {
					counter.textContent = endValue;
				} else {
					counter.textContent = Math.floor(currentValue);
					requestAnimationFrame(updateCounter);
				}
			};

			updateCounter();
		};

		const counterObserver = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.value = 0;
						setTimeout(() => {
							animateCounter(entry.target);
						}, 500);
					}
				});
			},
			{ threshold: 0.5 }
		);

		const counters = document.querySelectorAll(".counter");
		counters.forEach((counter) => counterObserver.observe(counter));

		// Function to handle the review widget
		// This code is for the Elfsight Google Reviews widget
		const targetDiv = document.querySelector(
			".elfsight-app-245ad3b9-ba31-47a6-bc70-c24cb2f4710c"
		);

		if (targetDiv) {
			const reviewObserver = new IntersectionObserver(
				(entries) => {
					entries.forEach((entry) => {
						const intervalId = setInterval(() => {
							if (entry.isIntersecting) {
								const link = targetDiv.querySelector(
									'a[href="https://elfsight.com/google-reviews-widget/?utm_source=websites&utm_medium=clients&utm_content=google-reviews&utm_term=localhost&utm_campaign=free-widget"]'
								);

								if (link) {
									link.removeAttribute("style");
									link.style.display = "none";
								}
							}
						}, 250);

						setTimeout(() => {
							clearInterval(intervalId);
						}, 10000);

						reviewObserver.unobserve(targetDiv);
					});
				},
				{ threshold: 0.75 }
			);

			reviewObserver.observe(targetDiv);
		}

		// Function to handle the animation on scroll
		const animate = document.querySelectorAll('[class*="animate-"]');

		if (animate.length) {
			const animateObserver = new IntersectionObserver(
				(entries, observer) => {
					entries.forEach((entry) => {
						const animationClasses = Array.from(entry.target.classList).filter(
							(cls) => cls.startsWith("animate-")
						);

						if (entry.isIntersecting) {
							animationClasses.forEach(() => {
								entry.target.classList.add("animated");
							});

							observer.unobserve(entry.target);
						}
					});
				},
				{ threshold: 0.1 }
			);

			animate.forEach((element) => animateObserver.observe(element));
		}
	}
});
