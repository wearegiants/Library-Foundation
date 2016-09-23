=== Clean Inactive Images ===
Contributors: brunojti

Tags: clean, images, uploads, gallery, disk space, removal
Requires at least: 4.1
Tested up to: 4.2.2
Stable tag: 1.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Removes unused images (and all of its thumbnails) from uploads folder

* Checks for images in: Post Content, Image Galleries (only from post_status = publish and draft) and Post Thumbnails.
* Removes all other images from uploads folder and its references in database.

* NEVER FORGET TO BACKUP YOUR DATABASE AND UPLOADS FOLDER BEFORE RUNNING THIS PLUGIN.

Built with [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate)!

== Installation ==

1. BACKUP your database and uploads folder.
1. Upload `clean-inactive-images` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Usage ==

1. Open the plugin page under `Settings` -> `Clean Inactive Images`
1. Click the GO Button!
1. Wait for the plugin finish working (It can take a long time)

== Changelog ==

= 1.2.4 =
* Add plugin icon

= 1.2.3 =
* Checks for used images (in galleries) in whole post_content, not only in the beginning as before.

= 1.2.0 =
* Checks for used images in post content for all posts;
* Checks for used images in post thumbnails;

= 1.1.0 =
* Separate requests by actions, avoiding server timeouts.

= 1.0.2 =
Fix 'uninstall' bug

= 1.0.0 =
* Update of directory retrieval method to be compatible to WordPress plugin directory
* Update plugin name (now capitalized )

= 0.0.2 =
Allow post type selection.

= 0.0.1 =
Initial version. Add basic functionality.
