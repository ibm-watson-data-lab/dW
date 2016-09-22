# Dev Advocacy Code Documentation

## Key Ingredients:

* In order for the Showcases content to display you will need to change the Custom Category id # when you’ve finished migration. (showcases-home.php [line 35] & page-home.php [line 45] ie. the ‘terms’ value). 

* Once migration is complete, you will need to update lines 362 and 366 of the search-tool.js file to properly redirect/match the new url structure.

* Currently the Github content on the Showcases on in the Footer is being pulled from the Github public API. As a result you are limited to 60 requests/hr per IP address. You will need to update the request to use your own key to increase the overall number or requests.

* On the Footer, the content for Stackoverflow is currently static content. As discussed, the IBM team

## HTML/PHP: lists the pages and their content

* **Partials**

    * tray-search.php: content for the search tray

    * tray-services.php : content for the services tray

* **404.php**: Error page has basic design and simple hard-coded message

* **author.php**: All the content for the developer advocate page

* **comments.php**: Contains the disqus code to render content on pages 

* **events.php**: Contains the content and php logic for the events page

* **footer.php**: Contains the content and php logic for the footer

* **functions.php**

* **header-devadv.php**: contains the content and logic for left for the main site navigation. 

* **index.php**: the home page for the blog content

* **page-home.php**: Home page content 

* **showcase-home.php**: showcase home page

* **showcase-single.php**: a single showcase

* **single-doc_page.php**: the service page and php logic

* **single.php**: a single blog post

## JS

* **events-filter.js**:  js logic for displaying events based on selected item from dropdown

* **infobox.js**: Ajax request to populate content from the public Github Api

* **resources_menu.js**: Click event that closes any dropdowns that are open

* **script.js**: General js file (comments are added to each method)

* **search-tool.js**: js file that builds out the search functionality

* **tray-interaction.js**: controls opening and closes of both the service and search trays

## SASS and CSS
All scss files are imported to the styles.scss file. The style.scss file is then compiled and exported to style.css found in library/css/style.scss)

* Modules

    * **_footer.scss**: styling for footer

    * **_header.scss**: styling for header

    * **_masthead.scss**: styling overrides for the masthead

    * **_modal.scss**: styling for modals that appear on the blog section 

    * **_site-art.scss**: styling for the carousel and top section

    * **_tray.scss**: styling for Search & Services trays

* Pages

    * **_blog-home.scss**: styling for the blog home page (index.php)

    * **_developer-advocate.scss**: styling for the individual advocate page (author.php)

    * **_event.scss**: styling for the events page (events.php)

    * **_home.scss**: styling for the home page (page-home.php)

    * **_search-results.scss**: styles for the search/how-to page (search-results.php)

    * **_services.scss**: styling for the service section (single-doc_page.php)

    * **_showcase-home.scss**: styles for the showcases front page (showcase-home.php)

    * **_showcase-single.scss**: styles for the showcase individual page (showcase-single.php)

* Partials

    * **_dropdown.scss**: base level styling for all dropdowns throughout site

    * **_typography.scss**: assigned variables to font styles used throughout site

    * **_variable.scss**: color declarations assigned to variables

