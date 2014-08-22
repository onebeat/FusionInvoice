## FusionInvoice

FusionInvoice is built for freelancers and small businesses who need a simple, 
yet powerful self-hosted web based invoicing system.

### Notice

This project is currently being migrated from CodeIgniter, and should not be 
used in production until an official release is ready. For those interested, 
you can keep tabs on the development activity by switching to the develop 
branch.

### 2014-01-05

The master branch now contains the alpha-1 version of FusionInvoice. There are
some features not yet finished, such as data import, a browser installer and
online payments. At this point in time, the only method of installing the alpha
release is through command line - so if you don't have a local development 
environment or don't have access to the cli on your web host, then unfortunately
you'll have to wait until the browser installer is finished. These instructions
assume you have both git and composer installed and configured.

#### FusionInvoice Alpha-1 Installation via a Terminal

First, clone the repository:

	$ git clone https://github.com/jesseterry/FusionInvoice.git

Next, install the dependencies via Composer (from inside the cloned directory):

	$ composer install

Next, create an empty database and modify the database settings in 
app/config/database.php to match your environment.

Finally, run:

	$ php artisan migrate --seed

At this point, you should be able to log in using admin@admin.com as the user
and password as the password.

Please report your findings to either the github issue tracker or in the 
[Community Support Forums](https://groups.google.com/forum/#!forum/fusioninvoice-community-support).