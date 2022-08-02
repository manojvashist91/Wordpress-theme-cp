Wordpress theme created with carbon fields.
https://docs.carbonfields.net/quickstart.html

Gulp Setup :
 step 1 : npm install
 step 2 : npm install -g gulp-cli



npm -v
node -v


Run this cmd id not work with latest version(old version)
nvm use 14.19.2


# wordpress + Theme

## Testimonials
Reviews are generated from local CPT records and Google Reviews.
To work with Google Reviews, the Google My Business (GMB) API is used, 
which requires OAuth2 authorization.  
For this reason, for local work with the GMB API, it is necessary:
1. Access to a Google business account
2. The name of the local domain must include the 1st and 2nd level domains: ******
3. A json file with access to the application (Google App) must be installed in Theme Options -> Google Api.
    1. To do this, you need to get a file with access to an already created application, 
       or create a new application and use the file with access for this new application.
4. Authorize your Google Business Account on the authorization page in the admin console 
   (there is a link to this page in Theme Settings -> Google Api)
