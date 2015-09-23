(function ($) {
	$('#form-search').on('click', '#submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: site_url + 'blog/search/',
			method: 'POST',
			data: {
				keyword: $('#form-search #search').val(),
				ajax: '1'
			},
			success: function (msg) {
				$('#search-results').html(msg);
			}
		});
	});
})(jQuery);