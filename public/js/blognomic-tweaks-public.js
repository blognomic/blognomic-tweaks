jQuery(($) => {
	'use strict';
	// Make clocks update live.
	(function () {
		const updateClock = function(el) {
			const now = new Date();
			const weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][now.getUTCDay()];
			const month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'][now.getUTCMonth()];
			const day = now.getUTCDate();
			const year = now.getUTCFullYear();
			const hours = String(now.getUTCHours()).padStart(2, '0');
			const minutes = String(now.getUTCMinutes()).padStart(2, '0');
			const seconds = String(now.getUTCSeconds()).padStart(2, '0');

			el.innerHTML = `${weekday}, ${month} ${day}, ${year} · ${hours}:${minutes}:${seconds} UTC`;
		};

		window.setInterval(
			function() {
				document.querySelectorAll('.blognomic-clock').forEach(updateClock)
			},
			500
		);
	})();

	// Change author archive links into BuddyPress profile links.
	(function () {
		$('a[href]').each((i, el) => {
			const $el = $(el);
			var href = $el.attr('href');
			const regex = /\/(author|members)\/(.*?)\/$/

			if (!href.match(regex)) {
				return;
			}

			$el.attr('href', href.replace(regex, '/members/$2/profile'));
		})
	})();

	// Move stuff around in the comment form.
	(function () {
		const $form = $('#commentform');

		if (!$form.length) {
			return;
		}

		$form.each((i, el) => {
			let $el = $(el);
			$el.find('.wpml_commentbox').insertAfter($el.find('.comment-form-comment label'));
		});
	})();


});
