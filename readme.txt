=== Plugin Name ===
Contributors: (GruntRoll)
Donate link: NA
Tags: woocommerce, discount, coupon
Requires at least: 3.0.1
Tested up to: 4.2.2
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Support the troops while boosting sales and building brand loyalty

== Description ==

<p>The Military Discount plugin (by <a href="https://gruntroll.com/business">GruntRoll</a>)
integrates with WooCommerce to offer your customers military and veteran discounts. Verification
occurs securely through our DoD-approved servers. When a positive verification is made,
a discount of your choice is applied to your customer's cart.</p>

<p>This plugin <b>does not</b> require your customer to leave your website. It does
not require your customers to enroll with GruntRoll, LLC. or its affiliates.</p>

**Requirements:**
<ul>
<li>Customer's Last Name & Date of Birth (entered at checkout)</li>
<li><a href="https://wordpress.org/plugins/woocommerce">WooCommerce</a> plugin</li>
<li>Create a <a href="https://www.mashape.com/register">Mashape account</a>
and <a href="https://www.mashape.com/gruntroll/military-verification/pricing">select a plan</a></li>
</ul>

**Features include:**
<ul>
<li>Choose between Active Duty & Veterans or just Active Duty</li>
<li>Choose exact discount amount: fixed dollar or percentage</li>
<li>Option to disable standard coupons</li>
<li>Test Mode: Sample the plugin before you buy</li>
<li>Customizable prompt message</li>
<li>Customizable success message</li>
<li>Customizable rejection message</li>
<li>Option to display or hide reason for disqualification</li>
<li>Option for the customer to learn more about the service before entering info</li>
</ul>

**How it works:**
<p>Upon arriving at the checkout page, your customers are presented an unobtrusive box with a customized message offering
a military discount. When clicked, a form expands requiring personal (yet
non-sensitive) information. Upon submission, their information is scanned against our
real-time database. If a match is made, a discount is applied!</p>

**How we do it:**
<p>GruntRoll, LLC. is a DoD-licensed verifier of military personnel and takes
security seriously. We don't store sensitive information. All information
passed between networks occurs using industry-standard TLS.</p>

<p>Our company has partnered with <a href="https://www.mashape.com/gruntroll/military-verification">Mashape</a>
for usage-tracking and billing.</p>

**Got questions?**
<p>sales@gruntroll.com</p>

== Installation ==

1. Upload unzipped `military-discount` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Make sure <a href="http://www.woothemes.com/woocommerce/" target="_blank">WooCommerce</a> is installed.
4. Make sure coupons are Enabled in WooCommerce->Settings->Checkout.
5. Create a <a href="https://www.mashape.com/register" target="_blank">Mashape</a> account and <a href="https://www.mashape.com/gruntroll/military-verification/pricing">subscribe</a> to a plan.
6. Locate your `X-Mashape-Key` on <a href="https://www.mashape.com/gruntroll/military-verification">this page</a> (in the <b>Request Example</b> box).
7. Paste your `X-Mashape-Key` into the Access Token box in Military Discount Settings (found in WordPress Plugins menu).
5. Save settings.

== Frequently Asked Questions ==

= How much does it cost? =

We have a variety of flexible pricing plans starting at $10.00 for low-volume retailers.
We want to make it as affordable as possible, so we've integrated with <a href="https://www.mashape.com/gruntroll/military-verification">Mashape</a> to
provide an abundance of retailer pricing plans. If you need a larger volume than 
10,000/mo., please contact us at <b>sales@gruntroll.com</b>.

= Can you verify anyone other than military? =

No, we can only verify Active Duty military and Veterans who served any date after
October 1st, 1985.

= Is there a minimum API usage I must meet? =

There's no minimum API usage, and we do not automatically disable accounts for inactivity.
You'll simply need to maintain your account with <a href="https://www.mashape.com/gruntroll/military-verification/pricing">Mashape</a> in order to receive continued
access to providing verified military discounts.

= Are there any caveats I should know about? =

For security purposes, we opted to alter our verification method (following Patch 1.2) by removing our
requirement for Social Security number and instead requiring Date of Birth. The potential
risk is a small potential for "false positive" results, though this is a
very rare occurrence.

= Do I need a programmer/developer to install this plugin? =
No. By following the instructions in the Plugin Settings, you should be offering
military discounts in under 5 minutes.

= May I alter code in the plugin? =

If you're altering code which doesn't affect billing or tracking,
this is fine. However, you are not permitted to save/cache verification results 
in order to avoid your usage incrementing.

== Screenshots ==

1. Default template of military discount during checkout. Input form reveals when clicked (as shown above).
2. Settings menu accessed through Plugins page

== Changelog ==

= 1.2 =
* Integrated with <a href="https://www.mashape.com/gruntroll/military-verification/pricing">Mashape</a> for purposes of easier billing/tracking
* Removed the requirement for Social Security Number
* Added ability to verify by Date of Birth

= 1.1 =
* Added "Test Mode" for testing positive verification behavior
* Military discount prompt at checkout now only shows when an Access Token is set

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.2 =
Existing customers will need to create a <a href="https://www.mashape.com/gruntroll/military-verification/pricing">Mashape</a> account and copy/paste the
X-Mashape-Key provided. This will go in place of your current "Access Token".
No other changes are required.

= 1.0 =
Initial release, no upgrade necessary.
