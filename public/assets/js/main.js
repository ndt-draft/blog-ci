(function ($) {
	$('#form-search').on('click', '#submit', function (e) {
		e.preventDefault();

		var keyword = $('#form-search #search').val();

		if (!keyword.trim()) {
			return;
		}

		$.ajax({
			url: site_url + 'blog/search/',
			method: 'POST',
			data: {
				keyword: keyword,
				ajax: '1'
			},
			success: function (msg) {
				$('#search-results').html(msg);
			}
		});
	});
})(jQuery);