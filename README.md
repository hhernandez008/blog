# blog

## Project Blog

### Suggested Pages

- Home / Landing Page
	- What happens when a user is logged in vs logged out?
	- Where do I login?
	- Where can I register?
- Registration
	- What info is needed to create a user?
	- Is this on all other pages when logged in or is it a specific page?
- Blog List
	- List of blogs with
		- title
		- summary
		- User display name
		- User profile pic
	- Pagination for additional blogs
	- Search input field
		- Search by tag or by title
- Search tag’s results
	- List of blogs with
		- title
		- summary
		- User display name
		- User profile pic
	- Pagination for additional blogs
- Blog Post
	- Full blog info & metadata
	- What happens if the post is public vs private
		- Is there edit functionality?
		- Can I delete if I am the one that created the blog
- User Profile
	- What if it's my profile?
		- Can I edit my profile
		- Can I upload a picture?
	- What information can I see about someone else vs myself?




### API’s

- *create_blog*
	- example data urls : 
		- s-apis.learningfuze.com/blog/create.json
		- s-apis.learningfuze.com/blog/create_error.json
	- use: creates a blog entry with the given parameters, returns ID of the blog and timestamp.
	- parameters:
		- title (string): title of the blog entry
		- text (string): main description of the blog entry
		- tags (array): array of strings that categorize the blog entry
		- public (boolean): whether the blog should be publicly displayed or not.  Default is private (false)
		- auth_token (string): user’s current authentication token
	- response:
		- success (boolean) - whether the api call was successful or not
		- data (object)
		- id (int) - unique id of the newly created blog
		- ts (timestamp) - unix timestamp of the blogs creation time
	- errors (array of strings)[optional] - array of strings with errors that happened, if any
- *list_blogs*
- example data urls : 
- s-apis.learningfuze.com/blog/list.json
- s-apis.learningfuze.com/blog/list_error.json
- use: retrieves a list of blog data for the logged-in user
- parameters:
- tag (string)[optional]: tag to use to limit returned values
- count (number)[optional]: number of blog entries to list
- auth_token (string)[optional]: user’s current authentication token.  If not provided, only public blog entries are listed
- response:
- success (boolean) - whether the api call was successful or not
- data (array of objects) - each object has the following
- id (int) - unique id of the newly created blog
- uid (int) : the id of the user that created the blog
- ts (timestamp) - unix timestamp of the blogs creation time
- title (string): title of the blog entry
- text (string): main description of the blog entry
- summary (string) : first X number of characters of the text & or title.
- tags (array): array of strings that categorize the blog entry
- public (boolean): whether the blog should be publicly displayed or not
- errors (array of strings)[optional] - array of strings with errors that happened, if any
- delete_blogs
- example data urls : 
- s-apis.learningfuze.com/blog/delete.json
- s-apis.learningfuze.com/blog/delete_error.json
- use: deletes one or more blog entries
- parameters:
- blog_ids (array): array of IDs of the blog entries to delete
- auth_token (string): user’s current authentication token
- response:
- success (boolean) - whether the api call was successful or not
- data (array of objects) - each object has the following
- id (int) - unique id of the deleted blog
- errors (array of objects)[optional] - array of strings with any errors that happened, if any
- id (int) - unique ID of the blog entry that was not deleted
- error_messages (array of strings) - array of strings with any errors that happened, if any
- read_one_blog
- example data urls : 
- s-apis.learningfuze.com/blog/read.json
- s-apis.learningfuze.com/blog/read_error.json
- use: retrieves information for one blog entry
- parameters:
- id (int) : id of the blog
- auth_token (string)[optional]: user’s current authentication token.  If not provided, only public blog entries will be  returned
- response:
- success (boolean) - whether the api call was successful or not
- data (object)
- id (int) - unique id of the newly created blog
- uid (int) : the id of the user that created the blog
- ts (timestamp) - unix timestamp of the blogs creation time
- title (string): title of the blog entry
- text (string): main description of the blog entry
- summary (string) : first X number of characters of the text & or title.
- tags (array): array of strings that categorize the blog entry
- public (boolean): whether the blog should be publicly displayed or not
- errors (array of strings)[optional] - array of strings with errors that happened, if any
- update_blog
- example data urls : 
- s-apis.learningfuze.com/blog/update.json
- s-apis.learningfuze.com/blog/update_error.json
- use: updates one or more values of a blog entry
- parameters:
- id (int) : id of the blog
- auth_token (string): user’s current authentication token
- data (object): fields to be updated in the blog entry, including
- title (string)[optional]: title of the blog entry
- text (string)[optional]: main description of the blog entry
- tags (array)[optional]: array of strings that categorize the blog entry
- public (boolean)[optional]: whether the blog should be publicly displayed or not. 
- response:
- success (boolean) - whether the api call was successful or not
- data (array of objects) - each object has the following
- id (int) - unique id of the updated blog
- errors (array of objects)[optional] - array of strings with any errors that happened, if any
- id (int) - unique ID of the blog entry that was not updated
- error_messages (array of strings) - array of strings with any errors that happened, if any, while updating
- login_user
- example data urls : 
- s-apis.learningfuze.com/blog/login.json
- s-apis.learningfuze.com/blog/login_error.json
- use: logs in a user
- parameters:
- email (string) : email address of the user’s login credentials
- password (string) : user’s login password credential
- response:
- success (boolean) - whether the api call was successful or not
- data (object)
- uid (int) : the id of the user
- username (name) : username of the user
- auth_token (string) : unique token given to the current user session
- register_user
- example data urls : 
- s-apis.learningfuze.com/blog/registert.json
- s-apis.learningfuze.com/blog/register_error.json
- use: creates a user account
- parameters:
- email (string) : private email address of the user
- display_name (string) : public username of the user 
- password (string) - min 8 characters : 
- response:
- success (boolean) - whether the api call was successful or not
- data (object)
- uid (int) : the id of the user
- email (string)
- display_name (string) - Name to be displayed to other users
- errors (array of strings)[optional] 
- text describing the error for end users to see
- edit_user
- example data urls : 
- s-apis.learningfuze.com/blog/edit.json
- s-apis.learningfuze.com/blog/edit_error.json 
- use: edits a user’s information
- parameters:
- uid (string) : unique id of the user
- auth_token (string) - unique token given to the current user session
- display_name (string) [optional] : Name used for other users to se
- password (string) [optional] - min 8 characters
- profile_img (string) [optional] - image of the user profile. Default to a generic profile pic if none is uploaded
- response:
- success (boolean) - whether the api call was successful or not
- data (object) - same as get_user_profile api call
- errors (array of strings)[optional] 
- text describing the error for end users to see

- logout_user
- example data urls : 
- s-apis.learningfuze.com/blog/logout.json
- s-apis.learningfuze.com/blog/logout_error.json
- use: logs a user out of the system
- parameters:
- auth_token (string) - unique token given to the current user session
- response:
- success (boolean) - whether the api call was successful or not
- data (NULL)
- errors (array of strings) [optional]
- text describing the error for end users to see
- get_user_profile
- example data urls : 
- s-apis.learningfuze.com/blog/profile.json
- s-apis.learningfuze.com/blog/profile_error.json
- use: retrieves information for a user.  Information for [self] is only returned for the currently logged in user. [private] is only returned if the user is logged in
- parameters:
- uid (int) - Id of the user
- auth_token (string) - unique token given to the current user session
- response:
- success (boolean) - whether the api call was successful or not
- data (NULL)
- uid (int) : the id of the user
- email (string)[private][self] - email address of the user
- name (string) - Profile name of the registered user
- profile_img (string) - image of the user profile. Default to a generic profile pic if none is uploaded
- last_login (int)[private] - unix timestamp of the last time the user logged in
- is_logged_in (boolean)[private] - whether the user is currently logged in or not
- recent_posts (array of int) - an array of blog post id’s
- errors (array of strings) [optional]
- text describing the error for end users to see


- 
	
