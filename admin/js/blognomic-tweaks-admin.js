jQuery(function($) {
	'use strict';

	// Make saving statuses intuitive.
	(function () {
		const $box = $('body.post-type-post #submitpost');

		if (!$box.length) {
			return;
		}

		const $saveButton = $box.find('#save-action');
		const $publishButton = $box.find('#publishing-action')
		const $savePostStatusButton = $box.find('.save-post-status');
		const $statusSelect = $box.find('#post_status');

		var changeButtonPrioritiesAndLabels = function () {
			const currentStatus = $statusSelect.val()
			var statusParts = currentStatus.replace(/[-_]/g, ' ').split(' ');
			const length = statusParts.length;

			// Capitalize the status.
			for (let i = 0; i < length; i++) {
				statusParts[i] = statusParts[i].slice(0, 1).toUpperCase() + statusParts[i].slice(1);
			}

			var formattedStatus = statusParts.join(' ');

			$saveButton.find('input').attr('value', `Save as ${formattedStatus}`);

			if (['pending', 'draft', 'publish'].indexOf(currentStatus) !== -1) {
				$saveButton.find('input[type=submit]').removeClass('button-primary');
				$publishButton.find('input[type=submit]').addClass('button-primary');
				return;
			}

			$saveButton.find('input[type=submit]').addClass('button-primary');
			$publishButton.find('input[type=submit]').removeClass('button-primary');
		}

		changeButtonPrioritiesAndLabels();

		var statusObserver = new MutationObserver(changeButtonPrioritiesAndLabels);

		statusObserver.observe($statusSelect.get(0), {
			childList: true,
			subtree: true
		});


		$savePostStatusButton.on('click', function () {
			changeButtonPrioritiesAndLabels();
		});
	})();
});
