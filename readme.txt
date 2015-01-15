=== Plugin Name ===
Contributors: (GruntRoll)
Donate link: NA
Tags: woocommerce, discount, coupon
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides an optional military discount for your WooCommerce checkout.

== Description ==

Support the troops while driving sales and building customer loyalty

<p>Install GruntRoll's Military Discount plugin alongside your WooCommerce plugin
to begin offering your customers verified military and veteran discounts.</p>

<p>After the 30-day/30-sale Free Trial, you only pay when you make money
by positively identifying a military or veteran customer during the checkout
process. Your customers who are positively identified but did not complete a sale
may be refunded. For more information on our billing policy, visit our
<a href="https://businesses.gruntroll.com/pricing" target="_blank">pricing</a> page.
</p>

<b><u>Requirements:</b></u>
<ul>
<li><a href="https://wordpress.org/plugins/woocommerce">WooCommerce</a> plugin</li>
<li>PHP 5.3.2 (Released March 2010)</li>
<li>Coupons enabled (you may disable them in our Settings)</li>
<li>Create an <a href="https://businesses.gruntroll.com/register" target="_blank">account</a></li>
</ul>

<b><u>Features include:</b></u>
<ul>
<li>Choose between Active Duty, Veterans, or both</li>
<li>Choose exact discount amount: fixed dollar or percentage</li>
<li>Option to disable standard coupons</li>
<li>Customizable prompt message</li>
<li>Customizable success message</li>
<li>Customizable rejection message</li>
<li>Option to display or hide reason for disqualification</li>
<li>Option for the customer <a href="https://businesses.gruntroll.com/end-users">learn more</a> about the service before entering info</li>
</ul>

<p><b><u>How it works:</u></b></p>
We don't maintain any personnel records on our server or yours. Instead, we have an 
exclusive API which is able to securely interact directly with live military
personnel records ran by the Department of Defense. We take security very 
seriously and encourage you to use SSL/TLS (https) 
on all customer transactions.</p>

== Installation ==

1. Upload unzipped `military-discount` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create an account and retrieve your Access Token at https://businesses.gruntroll.com/register
4. Paste your Access Token into the Access Token box in Military Discount Settings link (found in Plugins menu)
5. Save settings.

== Frequently Asked Questions ==

= How does pricing work? =

You only pay for what you use. If you don't make money with our service, you don't pay.
When you use our service to verify military status and subsequently complete a transaction 
with your customer, you pay a flat commission of $2.00. Once a month, we'll send you an 
invoice with your uses (payable online through PayPal). We don't want to charge you for 
the use of our service when it doesn't translate to an earned sale. If there are no 
billable uses, you won't receive an invoice.

= Can you verify anyone other than military? =

No, we can only verify Active Duty military and Veterans.

= Why is the price fixed? =

We pay for every query, regardless of the result. You pay a flat rate for positive
confirmation of an individual's military status. This way, you aren't eating the cost
when you receive a negative result&#8212;instead, you pay a small fee when you complete a sale.
It feels pretty good to spend just a bit of money right after you made money.

= Is there a minimum API usage I must meet? =

There's no minimum API usage, and we do not automatically disable accounts for inactivity. Every
30 days you'll receive an invoice by e-mail (if you have billable uses).

= Do I need a programmer/developer to integrate verification into my website? =
No. Our plugin for WordPress/WooCommerce requires no additional effort on your
behalf except what is outlined in the Installation guide. Since our plugin 
takes the styling from standard WooCommerce coupons, you may wish to alter
this style to better suit your website.

= May I alter code in the plugin? =

If you're altering the code which doesn't affect billing or tracking,
this is fine. However, you are not permitted to save/cache verification results 
in order to avoid our tracking.

== Screenshots ==

1. Default template of military discount during checkout. Input form reveals when clicked (as shown above).
2. Settings menu accessed through Plugins page

== Changelog ==

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.0 =
Initial release, no upgrade necessary.
