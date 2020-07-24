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
			const regex = /\/author\/(.*?)\/$/

			if (!href.match(regex)) {
				return;
			}

			$el.attr('href', href.replace(regex, '/members/$1/profile'));
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

		$('.acf-comment-fields').insertBefore('.comment-form-comment');
	})();

	// Automatic vote counting. First, identify and style EVCs.
	(function () {
		var $candidateEVCs = $('#comments .comment');
		const $mainPostWrapper = $('.elementor-location-single');
		const votableCategories = ['proposal', 'votable-matter', 'cfj', 'dov'];
		var postIsVotable = false;

		for (let i = 0; i < votableCategories.length; i++) {
			if ($mainPostWrapper.find('article.' + votableCategories[i])) {
				postIsVotable = true;
			}
		}

		if (!$candidateEVCs.length || !postIsVotable) {
			return;
		}

		$candidateEVCs = $candidateEVCs.filter(function (i, el) {
			const $el = $(el);
			const authorActive = $el.data('authorStatus') === 'active';
			const authorIsPlayer = $el.data('isPlayer');
			const playerVoted = $el.data('vote');

			return authorActive && authorIsPlayer && playerVoted;
		});

		console.log($candidateEVCs);

		const commentsByUser = {};

		$candidateEVCs.each(function (i, el) {
			const $el = $(el);
			const key = 'user' + $el.data('authorId');
			if (!commentsByUser[key]) {
				commentsByUser[key] = [];
			}

			commentsByUser[key].push($el);
		});

		for (const user in commentsByUser) {
			commentsByUser[user].sort(function ($a, $b) {
				// Later comments first.
				return $b.data('commentTime') - $a.data('commentTime');
			});

			// First comment is the EVC.
			commentsByUser[user][0].removeClass('not-evc').addClass('evc');
		}
	})();

	// Then, count the EVCs.
	(function () {
		const $evcs = $('#comments .comment.evc');

		if (!$evcs.length) {
			return;
		}

		const constructToteboardSection = function (vote, votes, collapseEmpty) {
			if (!votes[vote]) {
				votes[vote] = [];
			}

			if (collapseEmpty && !votes[vote].length) {
				return;
			}

			const numVotes = votes[vote].length;

			var $voters = $();

			if (numVotes) {
				votes[vote].sort();

				$voters = $('<ul class="voters"></ul>');

				for (let i = 0; i < numVotes; i++) {
					$voters.append(`<li>${votes[vote][i]}</li>`);
				}
			}

			const $section = $(`<li class="${vote}"></li>`);
			const capitalizedVote = vote.slice(0, 1).toUpperCase() + vote.slice(1);

			$section.append(`<h3>${capitalizedVote}: ${numVotes}</h3>`);
			$section.append($voters);

			return $section;
		};

		const votes = {};

		$evcs.each(function (i, el) {
			const $el = $(el);
			const vote = $el.data('vote');
			if (!votes[vote]) {
				votes[vote] = [];
			}

			votes[vote].push($el.data('authorName'));
		});

		const $toteboard = $('<div class="toteboard"></div>');

		$toteboard.append(constructToteboardSection('for', votes, false));
		$toteboard.append(constructToteboardSection('deferential', votes, true));
		$toteboard.append(constructToteboardSection('against', votes, false));
		$toteboard.append(constructToteboardSection('veto', votes, true));

		$toteboard.insertAfter($('.title-comments'));
	})();
});
