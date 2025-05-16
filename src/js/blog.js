document.addEventListener("DOMContentLoaded", () => {
	const postsContainer = document.getElementById("posts-container");
	const searchInput = document.getElementById("search");
	const categoryButton = document.querySelectorAll(".category-button");
	const loadingContent = document.getElementById("loading");

	let page = 1;
	let category = "all";
	let search = "";
	let loading = false;
	let finalPosts = false;

	postsContainer.addEventListener("click", (event) => {
		const post = event.target.closest(".post");

		if (!post) return;

		const link = post.querySelector(".post-link");

		if (link) {
			link.click();
		}
	});

	const mount = (post) => {
		const thumb = post._embedded?.["wp:featuredmedia"]?.[0]?.source_url || "";
		const html = `
            <div class="post">
                <div class="post-info">
                    <h2>
                        <a class="post-link" href="${post.link}">
                            ${post.title.rendered}
                        </a>
                    </h2>
                    <p>${post.excerpt.rendered}</p>
                </div>
                <div class="post-img">
                    ${
											thumb
												? `<img src="${thumb}" alt="${post.title.rendered}" />`
												: ""
										}
                </div>
            </div>
        `;
		postsContainer.insertAdjacentHTML("beforeend", html);
	};

	const getPosts = (reset = false) => {
		if (loading || (finalPosts && reset === false)) {
			return;
		}

		loading = true;
		loadingContent.style.display = "block";

		if (reset) {
			page = 1;
			finalPosts = false;
			postsContainer.innerHTML = "";
		}

		let baseUrl =
			location.hostname === "localhost"
				? "https://divinostelhados.com.br/"
				: `${location.protocol}//${location.hostname}/`;
		let url = `${baseUrl}wp-json/wp/v2/posts?_embed&per_page=8&page=${page}`;

		if (category !== "all") {
			url += `&categories=${category}`;
		}

		if (search.length > 3) {
			url += `&search=${encodeURIComponent(search)}`;
		}

		fetch(url)
			.then((res) => {
				if (!res.ok) {
					finalPosts = true;
					return [];
				}
				return res.json();
			})
			.then((data) => {
				if (!data.length) {
					finalPosts = true;
				} else {
					data.forEach(mount);
					page++;
					if (data.length < 8) {
						finalPosts = true;
					}
				}

				const posts = document.querySelectorAll(".post");

				console.log("posts", posts);
				console.log("posts.lenght", posts.length);

				if (posts.length === 0) {
					html = `<p id="not-found">Posts não encontrados</p>`;
					postsContainer.insertAdjacentHTML("beforeend", html);
				}
			})
			.catch((error) => {
				console.error("Erro ao carregar posts:", error);
			})
			.finally(() => {
				loading = false;
				loadingContent.style.display = "none";
			});
	};

	categoryButton.forEach((item) => {
		item.addEventListener("click", () => {
			categoryButton.forEach((b) => b.classList.remove("active"));
			item.classList.add("active");
			category = item.dataset.id;
			getPosts(true);
		});
	});

	let debounce;

	searchInput.addEventListener("input", () => {
		clearTimeout(debounce);
		debounce = setTimeout(() => {
			const valor = searchInput.value.trim();
			search = valor;
			getPosts(true);
		}, 400);
	});

	window.addEventListener("scroll", () => {
		if (
			window.scrollY + window.innerHeight >=
			document.body.scrollHeight * 0.75
		) {
			getPosts();
		}
	});

	getPosts();
});
