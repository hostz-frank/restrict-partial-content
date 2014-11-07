=== Restrict Partial Content Plugin ===
Contributors: speedito
Tags: Restrict specific content portion for role type or users
Requires at least: 3.9.1
Tested up to: 3.9.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a simple plugin to restrict the access based on user role, user id or date/time (displays a countdown timer).

== Description ==
Typical use case would be to restrict access to a portion of the content to users unless. Restriction can be based on user role (to boost user subscriptions). You can also setup a timer function to open up content after a certain time.

Options available are:
<ol>
<li>Restrict access based on the type of user</li>
<li>Restrict access based on specific user id</li>
<li>Restrict access based date/time</li>
</ol>

Details and examples about using the plugin are available at <a href="http://speedsoftsol.com/restrict-partial-content" target="_blank">speedsoftsol.com/simple-faq-plugin/</a>

== Installation ==
1. Upload zip archive `restrict-partial-content.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==
Shortcode to use: [restrict][/restrict]
All content between the start and end of the shortcode will be restricted

Shortcode parameters:
1. allow_role => The Role(s) to allow access to the restricted content. This should correspond to the Wordpress roles. Can take multiple values which are comma separated
2. allow_user => The User ID(s) to allow access to the restricted content.
3. message => The message that is visible when content is restricted
4. open_time => The exact date and time when the content should become visible (format to use YYYY-MM-DD HH:MM:SS see example on <a href="http://speedsoftsol.com/restrict-partial-content" target="_blank">demo page</a>)


== Changelog ==

= 0.1 =
Initial launch

= 1.0 = 
Added option to restrict content based on role and timeouts

= 1.1 = 
Small fixes to styling
