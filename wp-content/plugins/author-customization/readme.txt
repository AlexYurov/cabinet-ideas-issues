=== Author Customization ===
Contributors: cconover
Donate link: https://christiaanconover.com/code/wp-author-customization#donate
Tags: author, user, profile, tinymce, wysiwyg, rel-nofollow
Requires at least: 3.5.2
Tested up to: 3.8
Stable tag: 0.1.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Author Customization adds additional author management capabilities beyond the native user account structure.

== Description ==

Author Customization gives you much more flexibility in managing post and page author data. Your author data will no longer be tied to the WordPress user system, and can now be managed on a per-post basis.

Features: per-post author display name and biographical info, TinyMCE (WYSIWYG) editor for user profile and per-post biographical info, rel="nofollow" link inside biographical info entries

== Installation ==

1. Upload the `author-customization` directory to the `wp-content/plugins` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. Adjust the settings on the `Author Custom` Settings page

== Frequently Asked Questions ==

= What data about an author gets saved to post metadata? =
User data is copied from the selected author's profile at the time the post is first started. This includes:
* Display name
* Biographical info

= Can I turn on per-post author info down the line? =
Yes. The plugin saves author info to each post you edit whether or not you've enabled displaying author data from the post metadata.

= Can I assign multiple authors to a post? =
Not yet, but that's in the works. I plan to add support for this in a future update.

= I'm not seeing any author information on my posts! What's gone wrong? =
In order for author information to appear on your posts and pages, the theme you're using must have support for this. If it does, you should see your author info changes without issue. If you know it shows author information but you're not seeing the changes you made using this plugin, pop over to the Support area. If your theme does not have support for author info, contact the theme developer.

== Screenshots ==

1. Author meta box, displayed when editing a post or page. The author dropdown menu is only shown to editors and higher.

2. Plugin options page.

3. TinyMCE editor on user profile page. This is optional, but enabled by default.

== Changelog ==

= 0.1.0 =
Initial release.