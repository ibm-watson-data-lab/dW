# IBM Developer Advocacy 

## Pages:

* **Home** (page-home.php)

* **Blog** (index.php)

    * Blog Single (single.php)

* **Showcase Home** (showcase-home.php)

    * Showcase Single (showcase-single.php)

* **Events** (events.php)

* **Services** (single-doc_page.php)

    * Services Menu

    * Service Children Items

* **Developer Advocate** (author.php)

* **Services Tray **(partials/tray-services.php)

* **Search Tray **(partials/tray-search.php)

* **Search Results** (search-results.php)

### Home: (page-home.php)

1. To view the Home Page, got to the Pages tab on the WP Admin panel and click the ‘All Pages’ tab.

2. Find the Page titled ‘Home’

3. On the right hand side in the Page Attributes section, set the Template to  Home Page’. The ‘Parent’ should be set to (no parent).

4. Click the ‘Update’ button and save your changes.

### Blog and Blog Single: 
The Blog(index.php) and Blog Single page (single.php) are default pages so there is no setup involved from a Page Template perspective. Anytime a new Post is added, that most recent post will appear at the top of the page.

There are only two additional fields to address in order for these pages to match design.

* Select an Author for the post.

* Select the ‘Categories’ that are related to the Post.

### Events: (events.php)
	

1. To view the Events page go to the Pages tab on the WP Admin panel and and click the ‘Add New’ tab.

2. Enter Events as the name of the Page. 

3. On the right hand side in the Page Attributes section, set the Template to ‘Events Home Page’. The ‘Parent’ should be set to (no parent).

4. Click the ‘Update’ button and save your changes and add the Events page to the list of a pages.

5. Once the previous steps are complete, navigate to the path ‘/events-home’ to view the page.

	

* To add an Event to the Events page

    1. Click the ‘Events’  tabs on the WP Admin Panel  

    2. Click ‘Add Event’

    3. On the new event page add the name of the event and complete the fields as usual.

    4. To populate the registration CTA paste the url of the registration page in the field   titled ‘Registration Link’.

    5.  To Select the Dev Advocate(s) attending the event go to the field titled ‘Developer Advocates’ and select and advocate from the list. You can select more that one advocate attending the event by simply holding down the ‘command’ key and select another candidate.

### Services: To add a Service (parent)

1. Go to the Docs tab on the WP Admin panel and and click the ‘Add New’ tab.

2. Enter the Title of the Service. 

3. In the text editor, Enter basic introductory content for the service

4. On the right hand side in the ‘Attributes’ section,  set the page to (no parent).

5. Add the icon for the service as the ‘Featured Image’. This image will appear on the services Tray.

6. Click the ‘Update’ button and save your changes and add the Events page to the list of a pages.

7. Once the previous steps are complete, the service will appear on the Service Tray.

* **Direct Children:** Menu Items on the Services Page are created using a similar process as setting  up a service. The menu items serve as larger ‘buckets’ for which additional pieces of relevant content are assigned.

    1. Go to the Doc Pages tab on the WP Admin panel and and click the ‘Add New’ tab.

    2. Enter the Title of the Menu Item. 

    3. Only enter content in text area if this Menu Item will not have any children items of its own.

    4. On the right hand side in the ‘Attributes’ section, set the page to the relevant Parent service.

    5. Click the ‘Update’ button and save your changes and add the Events page to the list of a pages. The Menu item will now appear on the home page of the respective service.

* **Grandchildren Items:** these items are assigned to one of the larger menu items and appear as links displayed on a tray once the menu item is clicked. On click of one of these links, the user is sent to the respective page. The same setup process exists as for Direct children. The only difference is that in the Attributes section, set the Parent to the corresponding Menu Item.

    * Ex:  Service (Parent)  > How To (Direct Child) > Create Tables in dasDB (grandchild)

### Developer Advocate: 
The Dev Advocate page (author.php) is a default page so there is no setup involved from a Page Template perspective. In order for the page to properly load content from the ‘User’ profile, the following fields need to be complete on the ‘Users’ page for each respective user.

* Username

* Role (usually author)

* First Name

* Last Name

* Nickname

* Display name

* Email

* Website

* Twitter

* Facebook

* Biographical Info

* Avatar

* Title to use for Author Page

* Meta Description

* Home Base

### Showcase Home Page: (showcase-home.php)

1. To view the Showcases Home Page go to the Pages tab on the WP Admin panel and and click the ‘Add New’ tab.

2. Enter Showcases as the name of the Page. 

3. On the right hand side in the Page Attributes section, set the Template to ‘Showcase Home Page’. The ‘Parent’ should be set to (no parent).

4. Click the ‘Update’ button and save your changes and add the Events page to the list of a pages.

5. Once the previous steps are complete, navigate to the path ‘/showcases’ to view the page.

* **To add a Showcase (Showcase Single)  to the Showcases Home Page**

    1. Go to the Pages tab on the WP Admin panel and and click the ‘Add New’ tab.

    2. Enter the title of the Showcase as the name of the Page. 

    3. In the text editor, add the content for the Showcase.

    4. On the right hand side in the Page Attributes section, set the Template to ‘Single Showcase Page’. The ‘Parent’ should be set to (no parent).

    5. On the right hand side in the ‘Categories’ field, select the relevant categories.

    6. On the right hand side in the ‘Custom Categories’ field, select ‘Showcase’.

    7. Below the text editor, paste the the url of the respective Bluemix deployment

    8. Below the Bluemix field, paste the the url of the respective Github repo

        * The url is  parsed and used to construct the endpoint for the api request. The returned date populates the Github relevant content for the Showcase on the Showcase Home and Single Pages. If the project does not have a Bluemix Deployment it is ok to leave the field blank as the ‘Deploy to Bluemix’ cta will not appear on the showcase page.

    9. Below the Github field Select the relevant Use Cases for this Showcase. 

        * You can select as many as you like. These selections will populate the carousel on the Showcase Single Page.

    10. Below the Use Cases multi-select, select the Author of the Showcase.

    11. Click the ‘Update’ button and save your changes and add the Events page to the list of a pages.

    12. Once the previous steps are complete, navigate to the path ‘/showcases’ to view the the showcase. 

    13. Click the ‘Details’ button to view the Single Showcase Page

### Search Results Page: (search-results.php) 
[will need to change to how-tos to match current url structure]

1. To view the Search Results Page go to the Pages tab on the WP Admin panel and and click the ‘Add New’ tab.

2. Enter Search Results as the name of the Page. 

3. On the right hand side in the Page Attributes section, set the Template to ‘Search Results Page’. The ‘Parent’ should be set to (no parent).

4. Click the ‘Update’ button and save your changes.

5. Once the previous steps are complete, navigate to the path ‘/how-tos’ to view the page.

## Custom Fields:

* **Registration Link:** populates the ‘Register’ CTA on the events page 

* **Bluemix Deployment:** populates the ‘Deploy to Bluemix’ CTA on the Showcase Home Page

* **Github Repo Data:** this field populates the the Github repo content at the top of the Showcase Single page the the Github content on the Showcase Home page

* **Advocate Attending:** this multi-select field allow the admin to assign the developer advocate(s) attending the event to appear on the right side of each event

* **Use Cases:** this field populates the ‘Use Cases Carousel’

* **Home Base:** this field populates the country location that the advocate is based out of/from on the Dev Advocate page

### Registration Link
On the Events page, this field populates the ‘Register’ CTA. Just paste the url of the destination for the user to register and ‘on-click’ take the user to the destination.

1. To create the field, click into the ‘Custom Fields’ tab on the on the admin Dashboard. 

2. Click the gray ‘Add New’ tab to the right of the ‘Field Groups label.

3. Enter ‘Registration Link’ for the title name.

4. Click the blue ‘Add Field’ button and fill in the inputs with the following text

**Field Order**

    1. Field Label: Registration Link

    2. Field Name: registration_link (should auto populate)

    3. Field Type: Text

    4. Placeholder Text: enter link to registration here

**Location: select the following parameters**

a.	Post Type > is equal to > event

After these fields are entered and options select, click the ‘Update button on the top right corner of this page and the field should appear on the Events Admin page.

### Bluemix Deployment:
On the Showcase page, this field populates the ‘Deploy to Bluemix’ CTA. Just paste the url of the destination for the user to register and ‘on-click’ of the cta takes the user to the destination.

1. To create the field, click into the ‘Custom Fields’ tab on the on the admin Dashboard. 

2. Click the gray ‘Add New’ tab to the right of the ‘Field Groups label.

3. Enter ‘Bluemix Deployment’ for the title name.

4. Click the blue ‘Add Field’ button and fill in the inputs with the following text

	

**Field Order**

Field Label: Bluemix URL

Field Name: bluemix_url (should auto populate)

Field Type: Text

Placeholder Text: add bluemix deployment url

**		**

**Location: select the following parameters**

**		     **a.	Page template > is equal to > Single Showcase Page	

		

After these fields are entered and options select, click the ‘Update button on the top right corner of this page and the field should appear on the Showcase Admin page.

### Github Repo Data:
On the Showcase page, this field populates the the Github repo content at the top of the Showcase Single page the the Github content on the Showcase Home page. Just paste the url of the Github repo.

1. To create the field, click into the ‘Custom Fields’ tab on the on the admin Dashboard. 

2. Click the gray ‘Add New’ tab to the right of the ‘Field Groups label.

3. Enter ‘Github Repository’’ for the title name.

4. Click the blue ‘Add Field’ button and fill in the inputs with the following text

	

**Field Order**

1. Field Label: Github Repo

2. Field Name: github_repo (should auto populate)

3. Field Type: Text

4. Placeholder Text: enter github repo url here**	**

**	**

**Location: select the following parameters**

**		     **a.	Page template > is equal to > Single Showcase Page	

		

After these fields are entered and options select, click the ‘Update button on the top right corner of this page and the field should appear on the Showcase Admin page.

### Advocate Attending:
On the Events page, this multi-select field allow the admin to assign the developer advocate(s) attending the event to appear on the right side of each event.

1. To create the field, click into the ‘Custom Fields tab on the admin

2. Click the gray ‘Add New’ tab to the right of the ‘Field Groups

3. Enter ‘Advocate Attending’ for the title name.

4. Click the blue ‘Add Field button and fill in the inputs with the following text

			

		Field Order

1. Field Label: Developer Advocates

2. Field Name: devadvocates

3. Field Type: User

4. Filter by role: All

5. Allow Null?: Yes

6. Second Field Type: Multi Select

		

		Location: select the following parameters

1. Post Type > is equal to > event

After these fields are entered and options select, click the ‘Update button on the top right corner of this page and the field should appear on the Showcase Admin page.

### Use Cases:
On the Showcase Single page, this field populates the ‘Use Cases Carousel’.

1. To create the field, click into the ‘Custom Fields’ tab on the on the admin Dashboard. 

2. Click the gray ‘Add New’ tab to the right of the ‘Field Groups label.

3. Enter ‘Use Cases’ for the title name.

4. Click the blue ‘Add New’ button and fill in the inputs with the following text

	

**Field Order**

1. Field Label: Use Case

2. Field Name: use_case (should auto populate)

3. Field Type: Post Object

4. Post Type: All

Filter from Taxonomy: All

Allow Null: no

Select Multiple Values: Yes

Conditional Logic: No

**		**

**Location: select the following parameters**

**		     **a.	Page template > is equal to > Single Showcase Page	

		

After these fields are entered and options select, click the ‘Update button on the top right corner of this page and the field should appear on the Showcase Admin page.

### Home Base:
On the Dev Advocate page, this field populates the country location that the advocate is based out of/from.

1. To create the field, click into the ‘Custom Fields’ tab on the on the admin Dashboard.

2. Click the gray ‘Add New’ tab to the right of the ‘Field Groups label.

3. Enter ‘Home Base’ for the title name.

4. Click the blue ‘Add New’ button and fill in the inputs with the following text

	

**Field Order**

      a.   Field Label: Home Base

      b.   Field Name: home_base (should auto populate)

      c.   Field Type: Text

      d.   Placeholder Text: enter the dev advocate country base location

      e.   Conditional Logic: No

**		**

**Location: select the following parameters**

**		     **a.	User > is equal to > All

		

After these fields are entered and options select, click the ‘Update button on the top right corner of this page and the field should appear on the Showcase Admin page.

## Plugins:

### Events  Manager:
Allows the admin or a user to add a photo for their Avatar

1. To access the Plugin, click the ‘Plugins’ tab 

2. Click ‘Add New’ and search for ‘Events Manager’

3. Once found, click ‘Install Now’.

4. Back on the Plugins page, find the ‘Events Manager’ and Activate the plugin.

