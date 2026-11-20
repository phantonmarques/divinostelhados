document.addEventListener("DOMContentLoaded", () => {
	const postsContainer = document.getElementById("posts-container");
	if (!postsContainer) return;

	const searchInput = document.getElementById("search");
	const categoryButtons = document.querySelectorAll(".category-button");
	const loadingContent = document.getElementById("loading");
	const pageSize = 8;
	let page = 1;
	let category = "all";
	let search = "";
	let finalPosts = false;
	let request;
	let debounce;

	postsContainer.addEventListener("click", (event) => {
		if (event.target.closest("a") || window.getSelection()?.toString()) return;
		event.target.closest(".post")?.querySelector(".post-link")?.click();
	});

	const renderPosts = (posts) => {
		const template = document.createElement("template");
		template.innerHTML = posts.map((post) => `
			<div class="post">
				<div class="post-info">
					<h2><a class="post-link">${post.title.rendered}</a></h2>
				<p>${post.excerpt.rendered}</p>
				</div>
				<div class="post-img"></div>
			</div>
		`).join("");

		Array.from(template.content.children).forEach((card, index) => {
			const post = posts[index];
			const link = card.querySelector(".post-link");
			link.href = post.link;

			const media = post._embedded?.["wp:featuredmedia"]?.[0];
			const thumbnail = media?.media_details?.sizes?.medium_large;
			const source = thumbnail?.source_url || media?.source_url;
			if (!source) return;

			const image = document.createElement("img");
			const dimensions = thumbnail || media.media_details;
			if (dimensions?.width && dimensions?.height) {
				image.width = dimensions.width;
				image.height = dimensions.height;
			}
			image.alt = media.alt_text || link.textContent.trim();
			image.decoding = "async";
			image.loading = page === 1 && index === 0 ? "eager" : "lazy";
			image.src = source;
			card.querySelector(".post-img").append(image);
		});

		return template.content;
	};

	const getPosts = async (reset = false) => {
		if (reset) {
			request?.abort();
			page = 1;
			finalPosts = false;
			postsContainer.replaceChildren();
		} else if (request || finalPosts) {
			return;
		}

		const currentRequest = new AbortController();
		request = currentRequest;
		loadingContent.style.display = "block";
		const url = new URL(postsContainer.dataset.postsUrl);
		url.searchParams.set("_embed", "wp:featuredmedia");
		url.searchParams.set("_fields", "title,excerpt,link,_links,_embedded");
		url.searchParams.set("per_page", pageSize);
		url.searchParams.set("page", page);
		if (category !== "all") url.searchParams.set("categories", category);
		if (search.length > 3) url.searchParams.set("search", search);

		try {
			const response = await fetch(url, { signal: currentRequest.signal });
			if (!response.ok) throw new Error(`HTTP ${response.status}`);
			const posts = await response.json();
			if (request !== currentRequest) return;

			const totalPages = Number(response.headers.get("X-WP-TotalPages"));
			finalPosts = totalPages > 0 ? page >= totalPages : posts.length < pageSize;
			if (page === 1 && !posts.length) {
				const message = document.createElement("p");
				message.id = "not-found";
				message.textContent = "Posts não encontrados";
				postsContainer.append(message);
			}
			postsContainer.append(renderPosts(posts));
			page++;
		} catch (error) {
			if (error.name !== "AbortError") console.error("Erro ao carregar posts:", error);
		} finally {
			if (request === currentRequest) {
				request = null;
				loadingContent.style.display = "none";
			}
		}
	};

	categoryButtons.forEach((button) => {
		button.addEventListener("click", () => {
			clearTimeout(debounce);
			const nextSearch = searchInput.value.trim();
			if (category === button.dataset.id && search === nextSearch && request) return;
			document.querySelector(".category-button.active")?.classList.remove("active");
			button.classList.add("active");
			category = button.dataset.id;
			search = nextSearch;
			getPosts(true);
		});
	});

	searchInput.addEventListener("input", () => {
		clearTimeout(debounce);
		debounce = setTimeout(() => {
			const nextSearch = searchInput.value.trim();
			if (nextSearch === search || (nextSearch.length <= 3 && search.length <= 3)) return;
			search = nextSearch;
			getPosts(true);
		}, 400);
	});

	let scrollFrame;
	window.addEventListener("scroll", () => {
		if (request || finalPosts || scrollFrame) return;
		scrollFrame = requestAnimationFrame(() => {
			scrollFrame = null;
			if (window.scrollY + window.innerHeight >= document.body.scrollHeight * 0.75) {
				getPosts();
			}
		});
	}, { passive: true });

	getPosts();
});
