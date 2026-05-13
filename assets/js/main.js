(function () {
	const toggle = document.querySelector('.menu-toggle');
	const nav = document.querySelector('.primary-navigation');

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			const isOpen = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', String(!isOpen));
			nav.classList.toggle('is-open', !isOpen);
		});
	}

	document.querySelectorAll('.single-product-gallery').forEach(function (gallery) {
		const mainImage = gallery.querySelector('.single-product-gallery__main-image');
		const zoomLink = gallery.querySelector('.single-product-gallery__zoom');
		const thumbs = gallery.querySelectorAll('.single-product-gallery__thumb');

		if (!mainImage || !thumbs.length) {
			return;
		}

		thumbs.forEach(function (thumb) {
			thumb.addEventListener('click', function () {
				const largeImage = thumb.getAttribute('data-large-image');
				const fullImage = thumb.getAttribute('data-full-image');
				const imageAlt = thumb.getAttribute('data-image-alt');

				if (largeImage) {
					mainImage.setAttribute('src', largeImage);
					mainImage.removeAttribute('srcset');
					mainImage.removeAttribute('sizes');
				}

				if (imageAlt) {
					mainImage.setAttribute('alt', imageAlt);
				}

				if (zoomLink && fullImage) {
					zoomLink.setAttribute('href', fullImage);
				}

				thumbs.forEach(function (item) {
					item.classList.remove('is-active');
				});

				thumb.classList.add('is-active');
			});
		});
	});
})();
