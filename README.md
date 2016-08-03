# Wordpress widget to show user photo and last login time

## Frontend:

![alt tag](https://raw.githubusercontent.com/orlov0562/astbiz-user-last-login-widget/master/screenshot-frontend.png)

## Backend:

![alt tag](https://raw.githubusercontent.com/orlov0562/astbiz-user-last-login-widget/master/screenshot-backend.png)

## Language management

To add new language you should copy lang/en.php to new file, ex: lang/de.php. Then you can add translation and custom logic inside this file. At the end select language through widget configuration.

## Instalation
Through terminal (ssh, etc)
- `cd /wp-content/plugins/`
- execute: `git clone https://github.com/orlov0562/astbiz-user-last-login-widget.git`


Through ftp
- download files: https://github.com/orlov0562/astbiz-user-last-login-widget/archive/master.zip
- unzip it
- upload folder `astbiz-user-last-login-widget/{files}` to your site into `/wp-content/plugins/astbiz-user-last-login-widget/{files}`

Next:
- Go to worpdress admin and activate plugin "AstBiz User Last Login Widget"
- Go to widget management section and add widget "AstBiz User Last Login Widget" to the sidebar
