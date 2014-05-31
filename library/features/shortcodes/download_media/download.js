jQuery(".download").click(function(e) {
	jQuery(this).parents("form:first").submit();
	e.preventDefault();
});