// Setting the necessary classes to enable a nice dropdown menu for the navbar
// Make sure the root element <ul> of the navbar has the id "navbar-menu"
$('navbar-menu').getChildren().each(function(li){
	// If an element has the class "deeper" it is marked by jommla that it has submenus
	if(li.hasClass('deeper') == true)
	{
		// The submenu <li> needs the class "dropdown"
		li.addClass('dropdown');
		// The <a> of the submenu needs "dropdown-toggle" and a new attribute "data-toggle"
		li.getChildren('a').each(function(a){
			a.addClass('dropdown-toggle');
			a.set('data-toggle', 'dropdown');
			var caret = new Element('b', {
				'class' : 'caret'
			});
			a.grab(caret);
		});

		// The children <ul> of the submenu get the class "dropdown-menu"
		li.getChildren('ul').each(function(ul){
			ul.addClass('dropdown-menu');
		});
	}
});
new Bootstrap.Dropdown($('navbar-menu'));

// Only initializing the slideshow if its enabled/pics are there
if(useSlideshow)
{
	// Using CSS transformations if available
	if (Modernizr.csstransitions && Modernizr.csstransforms){
		SlideShow.useCSS();
	}

	// Initalizing the slideshow
	var slideshow = new SlideShow('slideshow', {
		transition: 'pushLeft',
		delay: 10000,
		duration: 400,
		autoplay: true,
		selector: 'img'
	});

	// Binding the events for the carousel controls
	$$('.carousel-control').each(function(item){
		var changeTo = 'next';
		var options = {};

		if(item.hasClass('left') == true)
		{
			changeTo = 'previous';
			options = {transition: 'pushRight'};
		}

		item.addEvent('click', function(){
			slideshow.show(changeTo, options);
		})
	});
}